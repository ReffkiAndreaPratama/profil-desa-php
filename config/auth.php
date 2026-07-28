<?php
return [
    'defaults' => ['guard' => 'web', 'passwords' => 'users'],
    'guards' => ['web' => ['driver' => 'session', 'provider' => 'users']],
    'providers' => ['users' => ['driver' => 'eloquent', 'model' => App\Models\User::class]],
    'passwords' => ['users' => ['provider' => 'users', 'table' => 'password_reset_tokens', 'expire' => 60, 'throttle' => 60]],
    'password_timeout' => 10800,

    /*
    |--------------------------------------------------------------------------
    | Admin Credentials
    |--------------------------------------------------------------------------
    */
    'admin' => [
        'email' => env('ADMIN_EMAIL', 'admin@desatalangmarap.id'),
        'password' => env('ADMIN_PASSWORD', 'admin123'),
        'setup_key' => env('SETUP_KEY', 'talangmarap_setup_2026'),
    ],
];

