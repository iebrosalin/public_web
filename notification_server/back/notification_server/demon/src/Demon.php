<?php
namespace NotificationDemon;

class Demon
{
    public static $ADDRESS_CHANNEL='0.0.0.0';
    public static $PORT_CHANNEL=2206;
    public static $DEFAULT_COUNT_PROCESS=4;
    /*
     * Начало команд для демона
     */
    public static $PUSH_ADD_ITEM="item";
    public static $PUSH_CONFIRM_ORDER="order";
    /*
     * Конец команд для демона
     */
    private static $PORT_SOCKET=2346;
    private static $PORT_SOCKET_CLEANER=2347;
    private static $PROTOCOL_SOCKET='websocket';
    private static $PROTOCOL_SOCKET_SEND='ws';

    public static function getURL_SERVER(){
        return SITE_SERVER_NAME;
    }

    public static function getSocket(){
        return self::$PROTOCOL_SOCKET.'://'.self::getURL_SERVER().':'.self::$PORT_SOCKET;
    }
    public static function getSocketSend(){
        return self::$PROTOCOL_SOCKET_SEND.'://'.self::getURL_SERVER().':'.self::$PORT_SOCKET;
    }
    public static function getSocketCleaner(){
        return self::$PROTOCOL_SOCKET.'://'.self::getURL_SERVER().':'.self::$PORT_SOCKET_CLEANER;
    }
}
