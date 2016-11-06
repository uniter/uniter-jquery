<?php

require_once "php/src/HelloWorld/app.php" ;
require_once "php/src/JQueryColourDemo/app.php" ;
require_once "php/src/WindowAlertDemo/app.php" ;
require_once "php/src/UsingClasses/app.php" ;
require_once "php/src/UsingNamespaces/app.php" ;
require_once "php/src/CountCurrentElements/app.php" ;
require_once "php/src/RandomNumbers/app.php" ;
require_once "php/src/Fades/app.php" ;
require_once "php/src/Slides/app.php" ;
require_once "php/src/Demo/app.php" ;

$entries = $jQuery('div.demo_entry')->length ;
$full_height = $entries * 130 ;
$jQuery('div#homepage_slider')->css("height", $full_height) ;

$fade_in_closure = function() use ($jQuery) {
    $jQuery('div#homepage_loading')->slideUp("slow") ;
} ;
$jQuery('div#homepage_slider')->fadeIn("slow", $fade_in_closure) ;
