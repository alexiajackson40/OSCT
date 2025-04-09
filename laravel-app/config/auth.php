<?php

return [

    /*
    |----------------------------------------------------------------------
    | Authentication Defaults
    |----------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |----------------------------------------------------------------------
    | Authentication Guards
    |----------------------------------------------------------------------
    |
    | Define every authentication guard for your application. You can use
    | session storage plus the Eloquent user provider or other methods.
    |
    | We'll define custom guards for admins, personnel, and patients.
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',  // Custom provider for admins
        ],

        'personnel' => [
            'driver' => 'session',
            'provider' => 'personnel',  // Custom provider for personnel
        ],

        'patient' => [
            'driver' => 'session',
            'provider' => 'patients',  // Custom provider for patients
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | User Providers
    |----------------------------------------------------------------------
    |
    | Define how users are retrieved from your database or other storage.
    | We'll define providers for admins, personnel, and patients.
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),  // Default User model
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,  // Use Admin model for admins
        ],

        'personnel' => [
            'driver' => 'eloquent',
            'model' => App\Models\Personnel::class,  // Use Personnel model for personnel
        ],

        'patients' => [
            'driver' => 'eloquent',
            'model' => App\Models\Patient::class,  // Use Patient model for patients
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Resetting Passwords
    |----------------------------------------------------------------------
    |
    | Settings for password resets and token storage for different user types.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],

        'admins' => [
            'provider' => 'admins',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],

        'personnel' => [
            'provider' => 'personnel',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],

        'patients' => [
            'provider' => 'patients',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Password Confirmation Timeout
    |----------------------------------------------------------------------
    |
    | Define the amount of seconds before a password confirmation window
    | expires and users are asked to re-enter their password.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
];
