<?php

namespace UsingNamespaces;

use UsingNamespaces\Logic ;

$using_namespaces_closure = function() use ($jQuery, $jsMath) {
    $larger = $jsMath->random() * 10 ;
    $endRand = $jsMath->floor($larger + 1) ;
    $jQuery('h2#counter')->html($endRand);
};

$jQuery('div#using_namespaces_button')->on('click', $using_namespaces_closure);