<?php

$alert_closure = function() use ($window){
    $window->alert('omg my first client side php') ;
};

$jQuery('h2#window_alert_button')->on('click', $alert_closure);