<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'actionstep' => [
        'client_id' => env('ACTIONSTEP_CLIENT_ID'),
        'client_secret' => env('ACTIONSTEP_CLIENT_SECRET'),
        'auth_url' => env('ACTIONSTEP_AUTH_URL'),
        'token_url' => env('ACTIONSTEP_TOKEN_URL'),
        'redirect_url' => env('ACTIONSTEP_REDIRECT_URL'),
    ],
    

];
