<?php

namespace Scandiweb;

use \PDO;

return [
    'database' => [
        'driver' => 'mysql',
        'database' => 'Catalog',
        'user' => 'root',
        'password' => '',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ],
    ],
];
