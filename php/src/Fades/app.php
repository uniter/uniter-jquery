<?php


function update_counter($jQuery, $count) {
    $jQuery('h2#counter')->html($count);
}

$select_random_closure = function() use ($jQuery, $jsMath, $console){
    $console->log("something to say 1") ;
    $standard_rand = $jsMath->random() ;
    $console->log("something to say 2", $standard_rand) ;
    $larger = $jsMath->random() * 10 ;
    $console->log("something to say 3, $larger") ;
    $endRand = $jsMath->floor($larger + 1) ;
    $console->log("something to say 4, $endRand") ;
    update_counter($jQuery, $endRand);
    $console->log("something to say 5, $endRand") ;
};


$jQuery('div#random_select_button')->on('click', $select_random_closure);
