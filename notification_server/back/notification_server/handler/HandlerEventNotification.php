<?php

include_once (dirname(__DIR__).'/demon/vendor/autoload.php');

use NotificationDemon\Demon;
use NotificationDemon\Notification;
use WebSocket\Client;

class HandlerEventNotification
{
    private static $ignoreURL=['/basket/order.php'];
    public function pushNotificationAddItem(\Bitrix\Main\Event $event)
    {
        /*
         * Костыль для отключения срабатывания события на определённой странице.
         */
        if(in_array($_SERVER['SCRIPT_URL'],self::$ignoreURL)){
            return new \Bitrix\Main\EventResult(\Bitrix\Main\EventResult::SUCCESS);
        }

        $order = $event->getParameter("ENTITY");

        $notification = new Notification();
        $prepMember=[
            'name'=>$order->getField('NAME'),
            'url'=>$order->getField('DETAIL_PAGE_URL'),
            'price'=>$order->getField('PRICE'),
            'type'=>Demon::$PUSH_ADD_ITEM,
            'id'=>$_COOKIE['idWS'],

        ];
        $member=json_encode($prepMember);
        $score=Notification::getTimeScore();
        $notification->push([$score=>$member]);
        try{
            $client = new Client(Demon::getSocketSend());
            $client->send(Demon::$PUSH_ADD_ITEM);
        }
        catch (Exception $e){
            /*
             * Try catch нужен для подавления исключений в случае недачного
             * подкючения к демону. Главное что добавленный товар в корзину
             * занесён в очередь уведомлений в Redis.
             *
             * Остальная работа на поллержаниие демона возложена на cronJob_push-server.php
             */

        }

        return new \Bitrix\Main\EventResult(\Bitrix\Main\EventResult::SUCCESS);
    }

    public static function pushNotificationConfirmOrder($itemsAr){
        $notification = new Notification();
        $max=array_column($itemsAr,'PRICE');
        $max=max($max);
        foreach ($itemsAr as $item){
            if($item['PRICE']!=$max){
                continue;
            }
            $prepMember=[
                'name'=>$item['NAME'],
                'url'=>$item['DETAIL_PAGE_URL'],
                'price'=>$item['PRICE'],
                'type'=>Demon::$PUSH_CONFIRM_ORDER,
                'id'=>$_COOKIE['idWS'],
            ];
            $member=json_encode($prepMember);
            $score=Notification::getTimeScore();
            $notification->push([$score=>$member]);
            break;
        }
        try{
            $client = new Client(Demon::getSocketSend());
            $client->send(Demon::$PUSH_CONFIRM_ORDER);
        }
        catch (Exception $e){
            /*
             * Try catch нужен для подавления исключений в случае недачного
             * подкючения к демону. Главное что добавленный товар в корзину
             * занесён в очередь уведомлений в Redis.
             *
             * Остальная работа на поллержаниие демона возложена на cronJob_push-server.php
             */
        }
    }
}
