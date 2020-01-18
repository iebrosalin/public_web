<?php
declare(strict_types=1);

return [
    'host' => getenv('DB_HOST'),
    'dbname' => getenv('MYSQL_DATABASE'),
    'user' => getenv('MYSQL_USER'),
    'password' => getenv('MYSQL_PASSWORD'),
];
