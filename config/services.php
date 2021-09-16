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

    'facebook' => [
        'client_id' => '880944925781460',
        'client_secret' => '7ddb066e244c8e74744af65446bd23d7',
        'redirect' => 'https://fat-boar.fr/callback',
    ],
    
    'google' => [
        'client_id' => '758501089369-andma8gop3t27peo3bnsle7ckr9286h3.apps.googleusercontent.com',
        'client_secret' => 'CT-YONBvGq9Lyg6SzY8jUwTH',
        'redirect' => 'https://fat-boar.fr/googlecallback',
    ],

];
