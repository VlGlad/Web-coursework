<?php

return [
    'database' => [
        'connect' => 'mysql:host=localhost' . ';',
        'dbname' => 'dbname=weightapp',
        'user' => 'bduser',
        'password' => 'password',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]    
];