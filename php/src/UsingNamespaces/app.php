<?php

namespace UsingNamespaces;

use UsingNamespaces\Logic ;

Logic\Math::$math = $math ;

$closure = function() use ($jQuery) {
    $random_number = Logic\Math::$math->floor((Logic\Math::$math->random() * 10) + 1);
    $jQuery('div#display_random')->html($random_number) ;
};

$jQuery('body#using_namespaces')->on('click', $closure);