<?php
function root()
{
    return getenv('ROOT_DIRECTORY');
}

function view()
{
    return root().'/views';
}

function isHome()
{
    return $_SERVER['REQUEST_URI']==='/' || $_SERVER['REQUEST_URI']==='/admin' || $_SERVER['REQUEST_URI']==='/admin/';
}

function notHome()
{
    return !isHome();
}

function partUriMatch($uri)
{
    $uri=str_replace('/','\/',$uri);
    return preg_match('/'.$uri.'/',$_SERVER['REQUEST_URI']);
}