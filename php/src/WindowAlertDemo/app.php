<?php

$closure = function() use ($window){
    $window->alert('omg my first client side php') ;
};

$jQuery('body')->on('click', $closure);