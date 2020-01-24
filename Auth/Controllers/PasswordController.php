<?php
namespace Auth\Controllers;

use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use Auth\Models\UserModel;

class PasswordController extends Controller
{

	/**
	 * Access to current session.
	 *
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;

	/**
	 * Authentication settings.
	 */
	protected $config;


    //--------------------------------------------------------------------

	public function __construct()
	{
		// start session
		$this->session = Services::session();

		// load auth settings
		$this->config = config('Auth');
	}

    //--------------------------------------------------------------------

    public function forgotPassword()
	{
		if ($this->session->isLoggedIn) {
			return redirect()->to('account');
		}

		return view($this->config->views['forgot-password'], ['config' => $this->config]);
	}

    //--------------------------------------------------------------------

	public function attemptForgotPassword()
	{
		// validate request
		if (! $this->validate(['email' => 'required|valid_email'])) {
            return redirect()->back()->with('error', lang('Auth.wrongEmail'));
        }

		// check if email exists in DB
		$users = new UserModel();
		$user = $users->where('email', $this->request->getPost('email'))->first();
		if (! $user) {
            return redirect()->back()->with('error', lang('Auth.wrongEmail'));
        }

        // check if email is already sent to prevent spam
        if (! empty($user['reset_expires']) && $user['reset_expires'] >= time()) {
			return redirect()->back()->with('error', lang('Auth.emailAlreadySent'));
        }

		// set reset hash and expiration
		helper('text');
		$updatedUser['id'] = $user['id'];
		$updatedUser['reset_hash'] = random_string('alnum', 32);
		$updatedUser['reset_expires'] = time() + HOUR;
		$users->save($updatedUser);

		// send password reset e-mail
		helper('auth');
        send_password_reset_email($this->request->getPost('email'), $updatedUser['reset_hash']);

        return redirect()->back()->with('success', lang('Auth.forgottenPasswordEmail'));
	}

    //--------------------------------------------------------------------

	public function resetPassword()
	{
		// check reset hash and expiration
		$users = new UserModel();
		$user = $users->where('reset_hash', $this->request->getGet('token'))
			->where('reset_expires >', time())
			->first();

		if (! $user) {
            return redirect()->to('login')->with('error', lang('Auth.invalidRequest'));
        }

		return view($this->config->views['reset-password'], ['config' => $this->config]);
	}

    //--------------------------------------------------------------------

	public function attemptResetPassword()
	{
		// validate request
		$rules = [
			'token'	=> 'required',
			'password' => 'required|min_length[5]',
			'password_confirm' => 'matches[password]'
		];
		if (! $this->validate($rules)) {
            return redirect()->back()->with('error', lang('Auth.passwordMismatch'));
        }

		// check reset hash, expiration
		$users = new UserModel();
		$user = $users->where('reset_hash', $this->request->getPost('token'))
			->where('reset_expires >', time())
			->first();

		if (! $user) {
            return redirect()->to('login')->with('error', lang('Auth.invalidRequest'));
        }

		// update user password
        $updatedUser['id'] = $user['id'];
        $updatedUser['password'] = $this->request->getPost('password');
        $updatedUser['reset_hash'] = null;
        $updatedUser['reset_expires'] = null;
        $users->save($updatedUser);

		// redirect to login
        return redirect()->to('login')->with('success', lang('Auth.passwordUpdateSuccess'));

	}

}
