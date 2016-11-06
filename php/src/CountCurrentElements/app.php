<?php


function update_counter($jQuery) {
    $count = $jQuery('.demo_standard_entry')->length ;
    $jQuery('h2#counter')->html($count);
}

function get_demo_element_html() {
    $html = '
    <div class="demo_entry demo_standard_entry">
        A demo entry
    </div>
    ';
    return $html ;
}

$add_element_closure = function() use ($jQuery, $console){
    $console->log("something to say 1") ;
    $new_el = get_demo_element_html() ;
    $console->log("something to say 2", $new_el) ;
    $jQuery('#demo_element_list')->append($new_el) ;
    $console->log("something to say 3") ;
    update_counter($jQuery);
    $console->log("something to say 4") ;
};

$remove_element_closure = function() use ($jQuery){
    $last_el = $jQuery('.demo_standard_entry')->last() ;
    $last_el->remove() ;
    update_counter($jQuery);
};

$jQuery('div#add_element')->on('click', $add_element_closure);
$jQuery('div#remove_element')->on('click', $remove_element_closure);
