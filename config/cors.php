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

    'paths' => ['api/*'],

    'allowed_methods' => ['GET', 'PUT', 'POST', 'PATCH', 'DELETE'],

    'allowed_origins' => ['https://next-bingewatch.vercel.app', 'http://localhost:3000,https://next-bingewatch-git-refactor-feat-authdev-ranepaarths-projects.vercel.app'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['https://next-bingewatch.vercel.app,https://next-bingewatch-git-refactor-feat-authdev-ranepaarths-projects.vercel.app'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
