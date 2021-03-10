<?php

return [
    'database' => [

        'migrations' => [

            'order' => ['core'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Supported Locales
    |--------------------------------------------------------------------------
    |
    | These are the list of currently supported locales
    | If the user sets a locale not set in the array it will fall back
    | to the user default in the users table
    |
    */

    'supported_locales' => ['nl', 'fr', 'en'],
];
