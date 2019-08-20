<?php
function root(){
    return getenv('ROOT_DIRECTORY');
}

function view(){
    return root().'/views';
}