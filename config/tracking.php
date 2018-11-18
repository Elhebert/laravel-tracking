<?php

return [
    'tracker' => Elhebert\Tracking\Trackers\Basic::class,

    'enabled' => env('TRACKING_ENABLED', true),
    'support_dnt' => env('SUPPORT_DNT', true),

    'gtm' => [
        'id' => env('GTM_ID'),
    ],

    'matomo' => [
        'id' => env('MATOMO_SITE_ID'),
        'url' => env('MATOMO_URL'),
    ],
];
