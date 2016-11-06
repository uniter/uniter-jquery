<?php


class SimpleClass {

    public function attachOnClick($jQuery, $window) {
        $closure = function() use ($window){
            $window->alert('A browser alert in real time from a php class') ;
        };
        $jQuery('body#using_classes_alert_button')->on('click', $closure);
    }

}

$sc = new SimpleClass();
$sc->attachOnClick($jQuery, $window) ;
