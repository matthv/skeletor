<?php

return [
    'guards' => [
        'admin' => [
            'driver'   => 'session',
            'provider' => 'admins',
        ],
    ],

    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model'  => \Matthv\Skeletor\Models\Admin::class,
        ],
    ],

    'passwords' => [
        'admins' => [
            'provider' => 'admins',
            'table'    => 'admin_password_resets',
            'expire'   => 60,
        ],
    ],
];
