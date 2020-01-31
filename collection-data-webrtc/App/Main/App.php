<?php

namespace App\Main;


class App
{
    const BASE='/var/www/html/diplom-alpha.ieb.pw';
    const HEADER='/var/www/html/diplom-alpha.ieb.pw/App/Main/header.php';
    const FOOTER='/var/www/html/diplom-alpha.ieb.pw/App/Main/footer.php';
//    public  static function getHeader(){
//        require_once (App::BASE.'');
//    }
//    public  static function getFooter(){
//         require_once (App::BASE.'');
//    }

    public static function getSection($path){
        $arDir=scandir(self::BASE.$path);
         return array_filter($arDir ,function($item){
            return !preg_match('/\./',$item);
        });
    }
    public static function getSectionFile($path){
        $arDir=scandir(self::BASE.$path);
        return array_filter($arDir ,function($item){
            return preg_match('/.*\.php/',$item);
        });
    }
}