<?php

$up_slide_closure = function() use ($jQuery){
    $jQuery('div#demo_slider')->slideUp("slow") ;
    $jQuery('div#demo_slider_wrap')->css("height", 0) ;
};

$toggle_slide_closure = function() use ($jQuery){
    $jQuery('div#demo_slider')->slideToggle("slow") ;
    if ($jQuery('div#demo_slider')->css('display') == "block"){
        $jQuery('div#demo_slider_wrap')->css("height", 255) ;
    }
};

$down_slide_closure = function() use ($jQuery){
    $jQuery('div#demo_slider')->slideDown("slow") ;
    $jQuery('div#demo_slider_wrap')->css("height", 255) ;
};

$jQuery('div#up_slide_button')->on('click', $up_slide_closure);
$jQuery('div#toggle_slide_button')->on('click', $toggle_slide_closure);
$jQuery('div#down_slide_button')->on('click', $down_slide_closure);
