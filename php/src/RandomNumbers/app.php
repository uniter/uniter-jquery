<?php

$select_random_closure = function() use ($jQuery, $jsMath, $console){
    $larger = $jsMath->random() * 10 ;
    $endRand = $jsMath->floor($larger + 1) ;
    $jQuery('h2#counter')->html($endRand);
};

$jQuery('div#random_select_button')->on('click', $select_random_closure);
