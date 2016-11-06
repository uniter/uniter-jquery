<?php

spl_autoload_register(function ($class) {
    $class = 'php/src/' . str_replace("\\", '/', $class) . '.php';
    require_once $class;
});

require_once "php/src/HelloWorld/app.php" ;
require_once "php/src/JQueryColourDemo/app.php" ;
require_once "php/src/WindowAlertDemo/app.php" ;
require_once "php/src/UsingClasses/app.php" ;
require_once "php/src/UsingNamespaces/app.php" ;
require_once "php/src/CountCurrentElements/app.php" ;
require_once "php/src/Demo/app.php" ;

$fade_in_closure = function() use ($jQuery) {
    $jQuery('div#homepage_loading')->slideUp("slow") ;
} ;
$jQuery('div#homepage_slider')->fadeIn("slow", $fade_in_closure) ;
