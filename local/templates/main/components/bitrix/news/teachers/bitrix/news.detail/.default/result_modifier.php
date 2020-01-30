<?php
//if ( ! defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) {
//    die();
//}
//use \Bitrix\Main\Loader;
//Loader::includeModule('iblock');
//$arSelect=['ID','PREVIEW_TEXT','PREVIEW_PICTURE','NAME'];
//
//foreach ($arResult['PROPERTIES'] ['WORK_OF_TEACHER'] ['WORK_OF_TEACHER'] ['VALUE'] as $id){
//    $res = CIBlockElement::GetList(
//        [
//            'SORT' => 'ASC',
//            'NAME' => 'ASC',
//        ],
//        [
//            'IBLOCK_ID' => 25,
//           // 'SECTION_ID'=> $id,
//            'ACTIVE' => 'Y',
//        ],
//        false,
//        false,
//        []
//    );
//    $arResult ['WORK_OF_TEACHER'] [$id] ['NAME_SECTION']=CIBlockElement::GetProperty($arParams['IBLOCK_ID'],$id,  array("sort" => "asc" ),["CODE" => "NAME"])->Fetch()['VALUE'];
//
////    for ($i = 1; $arItem = $res->GetNext(); ++$i) {
////
////    }
//
//}
//
//
//p_f($res->GetNext());