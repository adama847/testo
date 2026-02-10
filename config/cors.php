<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    */

    // Les routes concernées par le CORS
    'paths' => [
        'api/*',
        'login',
        'logout',
        'register',
        'forgot-password',
        'reset-password',
    ],

    // Méthodes HTTP autorisées
    'allowed_methods' => ['*'],

    // Origines autorisées (frontend React)
    'allowed_origins' => [
        'http://localhost:5173',
        'http://127.0.0.1:5173',
    ],

    // Autoriser tous les headers
    'allowed_headers' => ['*'],

    // Headers exposés au frontend
    'exposed_headers' => [
        'Authorization',
    ],

    // Durée de cache du preflight
    'max_age' => 0,

    // ⚠️ IMPORTANT
    // JWT n’utilise PAS les cookies → false
    'supports_credentials' => false,
];
