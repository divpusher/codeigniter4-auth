A simple authentication library for [CodeIgniter 4](https://codeigniter.com).

**Features:**

- registration
- email activation
- login/logout
- forgotten password
- account settings (with proper email and password change options)
- CSRF protection
- localization


## Install

Download the package and place the `Auth` folder in `app/ThirdParty/`.

Open `app/Config/Autoload.php` and add to autoload like this:

```
$psr4 = [
    'Config'        => APPPATH . 'Config',
    APP_NAMESPACE   => APPPATH,
    'App'           => APPPATH,
    'Auth'          => APPPATH . 'ThirdParty/Auth',
];
```

Set up the email in `app/Config/Email`. **Fill the `$fromEmail` and `$fromName` as well!** I suggest you to use [mailtrap.io](https://mailtrap.io) for local development.

Enable CSRF in `app/Config/Filters`.

Make sure that your database is set in `.env` file or in `app/Config/Database.php`. Install the users table by running the following command in your project root:

`php spark migrate`


Visit `/register` on your local server to begin.

## To-do list

- use the new `is_not_unique` validation rule where possible