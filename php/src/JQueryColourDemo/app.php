<?php

$colour_change_closure = function() use ($jQuery){
    $jQuery('body')->css('background-color', 'darkgray') ;
};

$jQuery('body#jquery_simple_colour_change')->on('click', $colour_change_closure);