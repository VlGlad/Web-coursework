<?php

session_start();

require "vendor/autoload.php";

function dd($var)
{
    die(var_dump($var));
}

App::bind(
    'database', require "core/bootstrap.php"
);


App::bind(
    'router', Router::create('app/routes.php')
);

App::get('router')->direct();


// ДОБАВИТЬ ПРЕДУПРЕЖДЕНИЕ ЕСЛИ НИК УЖЕ ЗАНЯТ