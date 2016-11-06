<?php

$hello_world_closure = function() use ($jQuery){
    $jQuery('h2#hello_world_value')->html('Hello World!');
};

$jQuery('h2#hello_world_button')->on('click', $hello_world_closure);
