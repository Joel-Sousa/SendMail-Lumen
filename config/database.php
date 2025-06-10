<?php

return [

    'redis' => [

        'client' => 'predis', // ou 'phpredis' se estiver usando ext-redis

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],

    ],

];

