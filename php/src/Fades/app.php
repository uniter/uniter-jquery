<?php

$fade_in_closure = function() use ($jQuery){
    $jQuery('div#fade_target')->fadeIn("slow") ;
};

$fade_out_closure = function() use ($jQuery){
    $jQuery('div#fade_target')->fadeOut("slow") ;
};

$jQuery('div#fade_in_button')->on('click', $fade_in_closure);
$jQuery('div#fade_out_button')->on('click', $fade_out_closure);
