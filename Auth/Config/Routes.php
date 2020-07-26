<?php

$routes->group('', ['namespace' => 'Auth\Controllers'], function($routes) {
	// Registration
    $routes->get('register', 'RegistrationController::register', ['as' => 'register']);
    $routes->post('register', 'RegistrationController::attemptRegister');

    // Activation
    $routes->get('activate-account', 'RegistrationController::activateAccount', ['as' => 'activate-account']);

    // Login/out
    $routes->get('login', 'LoginController::login', ['as' => 'login']);
    $routes->post('login', 'LoginController::attemptLogin');
    $routes->get('logout', 'LoginController::logout');

    // Forgotten password and reset
    $routes->get('forgot-password', 'PasswordController::forgotPassword', ['as' => 'forgot-password']);
    $routes->post('forgot-password', 'PasswordController::attemptForgotPassword');
    $routes->get('reset-password', 'PasswordController::resetPassword', ['as' => 'reset-password']);
    $routes->post('reset-password', 'PasswordController::attemptResetPassword');

    // Account settings
    $routes->get('account', 'AccountController::account', ['as' => 'account']);
    $routes->post('account', 'AccountController::updateAccount');
    $routes->post('change-email', 'AccountController::changeEmail');
    $routes->get('confirm-email', 'AccountController::confirmNewEmail');
    $routes->post('change-password', 'AccountController::changePassword');
    $routes->post('delete-account', 'AccountController::deleteAccount');
});
