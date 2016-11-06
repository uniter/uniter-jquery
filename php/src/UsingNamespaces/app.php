<?php

namespace UsingNamespaces;

use UsingNamespaces\Logic ;

spl_autoload_register(function ($class) {
    $class = 'php/src/' . str_replace("\\", '/', $class) . '.php';
    require_once $class;
});

Logic\Math::$math = $math ;

$closure = function() use ($jQuery){
    $random_number = Logic\Math::$math->floor((Logic\Math::$math->random() * 10) + 1);
    $jQuery('')->css('background-color', 'blue') ;
};

$jQuery('body')->on('click', $closure);