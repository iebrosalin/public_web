<?php
use Workerman\Worker;
use NotificationDemon\Demon;
use NotificationDemon\Notification;
use WebSocket\Client;

require_once dirname(__DIR__).'/vendor/autoload.php';

$client = new Client(Demon::getSocketSend());
$client->send('');