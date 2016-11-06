<?php

namespace Demo;

use Demo\Component\NavMenuComponent;

spl_autoload_register(function ($class) {
    $class = 'php/src/' . str_replace("\\", '/', $class) . '.php';

    require_once $class;
});

require_once "php/src/JQueryColourDemo/app.php" ;
require_once "php/src/WindowAlertDemo/app.php" ;
require_once "php/src/CountCurrentElements/app.php" ;

$navMenu = new NavMenuComponent(
    $jQuery,
    $jQuery('body'),
    $jQuery('.primary-nav')
);

$navMenu->initialize();
