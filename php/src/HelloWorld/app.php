<?php

$add_element_closure = function() use ($jQuery){
    $jQuery('h2#counter')->html('Hello World!');
};

$jQuery('div#add_element')->on('click', $add_element_closure);
