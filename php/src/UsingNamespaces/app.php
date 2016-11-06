<?php

namespace UsingNamespaces;

use UsingNamespaces\Logic ;

$closure = function() use ($jQuery, $jsMath) {
    $random_number = $jsMath->math->floor(($jsMath->math->random() * 10) + 1);
    $jQuery('div#display_random')->html($random_number) ;
};

$jQuery('h2#using_namespaces')->on('click', $closure);