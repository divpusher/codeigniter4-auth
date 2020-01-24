<?php

use Config\Services;

if (! function_exists('send_activation_email'))
{
    /**
    * Builds an account activation HTML email from views and sends it.
    */
    function send_activation_email($to, $activateHash)
    {
    	$htmlMessage = view('Auth\Views\emails\header');
    	$htmlMessage .= view('Auth\Views\emails\activation', ['hash' => $activateHash]);
    	$htmlMessage .= view('Auth\Views\emails\footer');

    	$email = \Config\Services::email();
		$email->initialize([
			'mailType' => 'html'
		]);

    	$email->setTo($to);
        $email->setSubject(lang('Auth.registration'));
		$email->setMessage($htmlMessage);

        return $email->send();
    }
}

if (! function_exists('send_confirmation_email'))
{
    /**
    * Builds an email confirmation HTML email from views and sends it.
    */
    function send_confirmation_email($to, $activateHash)
    {
        $htmlMessage = view('Auth\Views\emails\header');
        $htmlMessage .= view('Auth\Views\emails\confirmation', ['hash' => $activateHash]);
        $htmlMessage .= view('Auth\Views\emails\footer');

        $email = \Config\Services::email();
        $email->initialize([
            'mailType' => 'html'
        ]);

        $email->setTo($to);
        $email->setSubject(lang('Auth.confirmEmail'));
        $email->setMessage($htmlMessage);

        return $email->send();
    }
}


if (! function_exists('send_notification_email'))
{
    /**
    * Builds a notification HTML email about email address change from views and sends it.
    */
    function send_notification_email($to)
    {
        $htmlMessage = view('Auth\Views\emails\header');
        $htmlMessage .= view('Auth\Views\emails\notification');
        $htmlMessage .= view('Auth\Views\emails\footer');

        $email = \Config\Services::email();
        $email->initialize([
            'mailType' => 'html'
        ]);

        $email->setTo($to);
        $email->setSubject(lang('Auth.emailUpdateRequest'));
        $email->setMessage($htmlMessage);

        return $email->send();
    }
}


if (! function_exists('send_password_reset_email'))
{
    /**
    * Builds a password reset HTML email from views and sends it.
    */
    function send_password_reset_email($to, $resetHash)
    {
        $htmlMessage = view('Auth\Views\emails\header');
        $htmlMessage .= view('Auth\Views\emails\reset', ['hash' => $resetHash]);
        $htmlMessage .= view('Auth\Views\emails\footer');

        $email = \Config\Services::email();
        $email->initialize([
            'mailType' => 'html'
        ]);

        $email->setTo($to);
        $email->setSubject(lang('Auth.passwordResetRequest'));
        $email->setMessage($htmlMessage);

        return $email->send();
    }
}
