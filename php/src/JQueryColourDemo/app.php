<?php

$closure = function() use ($jQuery){
    $jQuery('body')->css('background-color', 'blue') ;
};

$jQuery('body')->on('click', $closure);