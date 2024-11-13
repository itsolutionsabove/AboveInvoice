<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['*'],  // Allow access to all paths

    'allowed_methods' => ['*'],  // Allow all HTTP methods

    'allowed_origins' => ['*'],  // Allow requests from any origin

    'allowed_origins_patterns' => [],  // No specific origin patterns

    'allowed_headers' => ['*'],  // Allow any headers in requests

    'exposed_headers' => [],  // No specific headers exposed

    'max_age' => 0,  // No caching of preflight response

    'supports_credentials' => false,  // No credentials (cookies, authorization headers, etc.)
];