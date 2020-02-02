<?php

use Channel\Server;
use NotificationDemon\ProductInfo;
use Workerman\Worker;
use NotificationDemon\Demon;
use NotificationDemon\Notification;
use WebSocket\Client;

require_once dirname(__DIR__) . '/vendor/autoload.php';

class CronNotificationPush
{
    public static function run()
    {

        try {
            $client = new Client(Demon::getSocketSend());
            $client->send('');
            /*
             * Имитация передачи аргумента через cli
             * php имя_скрипта stop
             * убъёт демона и всех его процессов
             */
            global $argv;
            if ((string)$argv[2] === 'stop') {
                unset($argv[2]);
                $argv[1] = 'stop';
                Worker::runAll();
            }
        } catch (Exception $e) {
            /*
             * Имитация передачи аргумента через cli
             * php имя_скрипта
             * запустит скрипт
             */
            global $argv;
            $argv[1] = 'start';
            $argv[2] = '-d';
            /*
            * Костыль для отключениябуферизации от ядра битркиса и
            * избавление от ошибки Fatal error: Unknown: Cannot use output buffering in output buffering display handlers in Unknown on line 0
            */
            while (ob_get_level()) {
                ob_get_clean();
            }

            $channel_server = new Channel\Server(Demon::$ADDRESS_CHANNEL, Demon::$PORT_CHANNEL);

            /***Демон, отправлющий уведомления***/
            $ws_worker = new Worker(Demon::getSocket());

            $ws_worker->count = Demon::$DEFAULT_COUNT_PROCESS;

            $ws_worker->onWorkerStop = function ($ws_worker) {
            };

            $ws_worker->onWorkerStart = function ($ws_worker) {
                \Channel\Client::connect();
                \Channel\Client::on('broadcast', function ($data) use ($ws_worker) {
                    foreach ($ws_worker->connections as $connection) {
                        $connection->send($data);
                    }
                });

            };
            $ws_worker->onWorkerStop = function ($ws_worker) {
                /*Дату остановки стоит выводить*/

            };

            $ws_worker->onConnect = function ($connection) {
                $connection->onWebSocketConnect = function ($connection) {

                };
            };

            $ws_worker->onMessage = function ($connection, $data) {
                $decodeData = json_decode($data);
                $data = $decodeData !== null ? $decodeData : $data;

                $prepData = [];
                if (is_object($data)) {
                    $prepData['type'] = $data->type;
                    $prepData['data'] = $data->data;
                } else {
                    $prepData['type'] = $data;
                }

                switch ($prepData['type']) {
                    case "item":
                    case "order":
                        $notification = new Notification();
                        $ar = $notification->getByRank(0, $notification->getDefaultCount(), ['withscores' => false,]);
                        foreach ($ar as $k => $v) {
                            $ar[$k] = json_decode($v);
                        }
                        $notification->remByRank(0, count($ar));
                        $resMessage['typeMessage'] = $prepData['type'];
                        $resMessage['data'] = $ar;
                        Channel\Client::publish('broadcast', json_encode($resMessage));
                        break;
                    case "productInfo":
                        $productInfo = new ProductInfo();
                        $resMessage['typeMessage'] = $prepData['type'];
                        $resMessage['data'] = $productInfo->getView($prepData['data'], ProductInfo::getTimeScore());
                        $resMessage = json_encode($resMessage);
                        $connection->send($resMessage);
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

                /****Функция для удаления старых просмтров товара из Redis***/
                $productInfo = new ProductInfo();
                \Workerman\Lib\Timer::add(ProductInfo::$DEFAULT_INTERVAL_CLEAN, function () use ($productInfo) {
                    $productInfo->delOldView(ProductInfo::$DEFAULT_INTERVAL_CLEAN);
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

        }

    }
}
