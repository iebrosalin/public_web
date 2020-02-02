<?php

use Workerman\Worker;
use NotificationDemon\Demon;
use NotificationDemon\Notification;
use NotificationDemon\ProductInfo;
use WebSocket\Client;
//$_SERVER["DOCUMENT_ROOT"] = "/home/sidorov/domains/maximus.sidorov.spb4.webdoka.ru/public_html";
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require_once dirname(__DIR__).'/vendor/autoload.php';

    /***Создание канала для отправления всем пользвателям уведомлений***/
    $channel_server = new Channel\Server(Demon::$ADDRESS_CHANNEL, Demon::$PORT_CHANNEL);

    /***Демон, отправлющий уведомления***/
    $ws_worker = new Worker(Demon::getSocket());

    $ws_worker->count = Demon::$DEFAULT_COUNT_PROCESS;

//    $ws_worker->onWorkerStop = function ($ws_worker) {
//    };

    $ws_worker->onWorkerStart = function ($ws_worker) {
        Channel\Client::connect();
        Channel\Client::on('broadcast', function ($data) use ($ws_worker) {
            foreach ($ws_worker->connections as $connection) {
                $connection->send($data);
            }
        });
    };
    $ws_worker->onWorkerStop = function ($ws_worker) {
        /*Дату остановки стоит выводить*/
    };

$ws_worker->onConnect = function ($connection)  use ($ws_worker){

    $connection->onWebSocketConnect = function ($connection) use ($ws_worker){
    };
};

    $ws_worker->onMessage = function ($connection, $data) use ($ws_worker) {
        switch ($data) {
            case "item":
            case "order":
                $notification = new Notification();
                $ar = $notification->getByRank(0, $notification->getDefaultCount(), ['withscores' => false,]);
                foreach ($ar as $k => $v) {
                    $ar[$k] = json_decode($v);
                }
                $notification->remByRank(0, count($ar));
                Channel\Client::publish('broadcast', json_encode($ar));
                break;
            default:
                break;
        }
    };
    $ws_worker->onClose = function ($connection) {
    };

    /***Демон чистильщик***/
    $ws_cleaner = new Worker(Demon::getSocketCleaner());
    $ws_cleaner->onWorkerStart = function ($ws_cleaner) {
        /****Функция для удаления старых уведомлений из Redis***/
        $time_interval = 60; //sec
        \Workerman\Lib\Timer::add($time_interval, function () use ($time_interval) {
            $stop = microtime(true);
            $start = $stop - $time_interval;
            $notification = new Notification();
            $notification->remByScore($start, $stop);
        });
    };
    /*
     * Задел на будущее для управления демоном чистильщиком
     */
    $ws_cleaner->onMessage = function ($connection, $data) {
    };
    $ws_cleaner->onWorkerStop = function ($ws_worker) {
        /*Дату остановки наверное стоит выводить*/
    };

    Worker::runAll();
