<?php

return [

    'paths' => ['api/*', 'oauth/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:5173',
        'https://sucer-front.vercel.app/',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => ['Authorization'],

    'max_age' => 0,

    'supports_credentials' => true,

];
return [

    /*
    |--------------------------------------------------------------------------
    | Paths habilitados para CORS
    |--------------------------------------------------------------------------
    */
    'paths' => ['api/*', 'oauth/*'],

    /*
    |--------------------------------------------------------------------------
    | Métodos HTTP permitidos
    |--------------------------------------------------------------------------
    */
    'allowed_methods' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Dominios de origen permitidos
    |--------------------------------------------------------------------------
    */
    'allowed_origins' => [
        'https://sucer-front.vercel.app',   // ← tu frontend
    ],

    /*
    |--------------------------------------------------------------------------
    | Headers permitidos y expuestos
    |--------------------------------------------------------------------------
    */
    'allowed_headers' => ['*'],
    'exposed_headers' => [],

    /*
    |--------------------------------------------------------------------------
    | ¿Permitir credenciales?
    |--------------------------------------------------------------------------
    */
    'supports_credentials' => false,

    'allowed_origins_patterns' => [],
    'max_age' => 0,
];
