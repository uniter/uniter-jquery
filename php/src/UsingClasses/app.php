<?php


class SimpleClass {

    public function attachOnClick($jQuery) {
        $closure = function() use ($jQuery){
            $jQuery('body')->css('background-color', 'blue') ;
        };
        $jQuery('body')->on('click', $closure);
    }

}

$sc = new SimpleClass();
$sc->attachOnClick($jQuery) ;
