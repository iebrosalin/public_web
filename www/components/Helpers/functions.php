<?php
declare(strict_types=1);
/**
 * @return string
 */
function root(): string
{
    return getenv('ROOT_DIRECTORY');
}

/**
 * @return string
 */
function view(): string
{
    return root().'/views';
}

/**
 * @return bool
 */
function isHome(): bool
{
    return $_SERVER['REQUEST_URI']==='/' || $_SERVER['REQUEST_URI']==='/admin' || $_SERVER['REQUEST_URI']==='/admin/';
}

/**
 * @return bool
 */
function notHome(): bool
{
    return !isHome();
}

/**
 *
 * @param $uri
 * @return bool
 */
function partUriMatch($uri): bool
{
    $uri=str_replace('/', '\/', $uri);
    return preg_match('/'.$uri.'/', $_SERVER['REQUEST_URI']) != false;
}

/**
 * @param $uri
 */
function redirect($uri)
{
    header("Location: ".$uri);
}
