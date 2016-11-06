<?php

spl_autoload_register(function ($class) {
    $class = 'php/src/' . str_replace("\\", '/', $class) . '.php';
    require_once $class;
});

require_once "php/src/JQueryColourDemo/app.php" ;
require_once "php/src/WindowAlertDemo/app.php" ;
require_once "php/src/CountCurrentElements/app.php" ;
require_once "php/src/Demo/app.php" ;

$jQuery('div#homepage_slider')->slideDown('slow');