<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Installation Verification
    |--------------------------------------------------------------------------
    |
    | This option determines if the application has been installed. This can
    | be used to prevent access to certain routes or features if the application
    | has not been properly installed.
    |
    */
    'verify' => [
        'installed' => env('APP_INSTALLED', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Role Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can specify the role ID or other logic that determines whether
    | a user is an admin. This can be used in middleware or other areas of
    | the package that require admin access.
    |
    */
    'admin_role_id' => env('ADMIN_ROLE_ID', 1),

    /*
    |--------------------------------------------------------------------------
    | Installer Routes
    |--------------------------------------------------------------------------
    |
    | You can specify route prefixes, middleware, or other options here.
    |
    */
    'route' => [
        'prefix' => 'installer',
        'middleware' => ['web'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Other Configuration Settings
    |--------------------------------------------------------------------------
    |
    | Add any other settings here that the package needs, such as file paths,
    | storage locations, etc.
    |
    */
];
