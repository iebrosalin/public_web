<?php
function root(): string
{
    return getenv('ROOT_DIRECTORY');
}

function view(): string
{
    return root().'/views';
}

function isHome(): bool
{
    return $_SERVER['REQUEST_URI']==='/' || $_SERVER['REQUEST_URI']==='/admin' || $_SERVER['REQUEST_URI']==='/admin/';
}

function notHome(): bool
{
    return !isHome();
}

function partUriMatch($uri): bool
{
    $uri=str_replace('/','\/',$uri);
    return preg_match('/'.$uri.'/',$_SERVER['REQUEST_URI']);
}

function redirect($uri)
{
    header("Location: ".$uri);
}