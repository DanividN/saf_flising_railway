<?php

return [
    'name' => 'LaravelPWA',
    'manifest' => [
        'name' => env('APP_NAME', 'My PWA App'),
        'short_name' => 'PWA',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => 'http://localhost/flising_saf/public/images/icons/icon-72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => 'http://localhost/flising_saf/public/images/icons/icon-96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => 'http://localhost/flising_saf/public/images/icons/icon-128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => 'http://localhost/flising_saf/public/images/icons/icon-144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => 'http://localhost/flising_saf/public/images/icons/icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => 'http://localhost/flising_saf/public/images/icons/icon-192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => 'http://localhost/flising_saf/public/images/icons/icon-384x384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => 'http://localhost/flising_saf/public/images/icons/icon-512x512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => 'http://localhost/flising_saf/public/images/icons/splash-640x1136.png',
            '750x1334' => 'http://localhost/flising_saf/public/images/icons/splash-750x1334.png',
            '828x1792' => 'http://localhost/flising_saf/public/images/icons/splash-828x1792.png',
            '1125x2436' => 'http://localhost/flising_saf/public/images/icons/splash-1125x2436.png',
            '1242x2208' => 'http://localhost/flising_saf/public/images/icons/splash-1242x2208.png',
            '1242x2688' => 'http://localhost/flising_saf/public/images/icons/splash-1242x2688.png',
            '1536x2048' => 'http://localhost/flising_saf/public/images/icons/splash-1536x2048.png',
            '1668x2224' => 'http://localhost/flising_saf/public/images/icons/splash-1668x2224.png',
            '1668x2388' => 'http://localhost/flising_saf/public/images/icons/splash-1668x2388.png',
            '2048x2732' => 'http://localhost/flising_saf/public/images/icons/splash-2048x2732.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => 'http://localhost/flising_saf/public/shortcutlink1',
                'icons' => [
                    "src" => "http://localhost/flising_saf/public/images/icons/icon-72x72.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => 'http://localhost/flising_saf/public/shortcutlink2'
            ]
        ],
        'custom' => []
    ]
];
