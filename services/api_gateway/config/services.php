<?php

declare(strict_types=1);

return [
    'users' => [
        'base_uri' => env('USERS_SERVICE_BASE_URI'),
        'secret' => env('USERS_SERVICE_SECRET')
    ],
    'p2p-chat' => [
        'base_uri' => env('P2P_CHAT_SERVICE_BASE_URI'),
        'secret' => env('P2P_CHAT_SERVICE_SECRET')
    ],
];
