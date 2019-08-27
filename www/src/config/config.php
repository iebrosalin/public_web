<?php

function config()
{
    $config=new stdClass ();
    $config->mail='siber-test@yandex.ru';
    $config->password='test-siber';
    $config->webhook='https://postman-echo.com/post';
    $config->subject="Одноразовый код";
    return $config;
}




