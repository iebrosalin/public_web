<?php

return array(
    'host' => getenv('DB_HOST'),
    'dbname' => getenv('MYSQL_DATABASE'),
    'user' => getenv('MYSQL_USER'),
    'password' => getenv('MYSQL_PASSWORD'),
);
