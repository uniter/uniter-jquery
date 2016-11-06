<?php

namespace Demo;

use Demo\Component\NavMenuComponent;

spl_autoload_register(function ($class) {
    $class = 'php/src/' . str_replace("\\", '/', $class) . '.php';
    require_once $class;
});

$navMenu = new NavMenuComponent(
    $jQuery,
    $jQuery('body'),
    $jQuery('.primary-nav')
);

$navMenu->initialize();