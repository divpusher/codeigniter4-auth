<?php namespace Auth\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table      = 'users';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'name', 'email', 'new_email', 'password', 'password_confirm',
		'activate_hash', 'reset_hash', 'reset_expires', 'active'
	];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $dateFormat  	 = 'int';

	protected $validationRules = [];

	// we need different rules for registration, account update, etc
	protected $dynamicRules = [
		'registration' => [
			'name' 				=> 'required|min_length[2]',
			'email' 			=> 'required|valid_email|is_unique[users.email]',
			'password'			=> 'required|min_length[5]',
			'password_confirm'	=> 'matches[password]'
		],
		'updateAccount' => [
			'id'	=> 'required|is_natural_no_zero',
			'name'	=> 'required|min_length[2]'
		],
		'changeEmail' => [
			'id'			=> 'required|is_natural_no_zero',
			'new_email'		=> 'required|valid_email|is_unique[users.email]',
			'activate_hash'	=> 'required'
		]
	];

	protected $validationMessages = [];

	protected $skipValidation = false;

	// this runs after field validation
	protected $beforeInsert = ['hashPassword'];
	protected $beforeUpdate = ['hashPassword'];


    //--------------------------------------------------------------------

    /**
     * Retrieves validation rule
     */
	public function getRule(string $rule)
	{
		return $this->dynamicRules[$rule];
	}

    //--------------------------------------------------------------------

    /**
     * Hashes the password after field validation and before insert/update
     */
	protected function hashPassword(array $data)
	{
		if (! isset($data['data']['password'])) return $data;

		$data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
		unset($data['data']['password']);
		unset($data['data']['password_confirm']);

		return $data;
	}

}
