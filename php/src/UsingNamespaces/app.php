<?php

namespace UsingNamespaces;

use UsingNamespaces\Lorem ;

$using_namespaces_closure = function() use ($jQuery, $jsMath) {
    $loremIpsum = new Lorem\Ipsum() ;
    $larger = $jsMath->random() * 10 ;
    $endRand = $jsMath->floor($larger + 1) ;
    $jQuery('h2#counter')->html($loremIpsum->options[$endRand]);
};

$jQuery('div#using_namespaces_button')->on('click', $using_namespaces_closure);
