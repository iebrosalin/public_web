<?
if ( ! defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) {
	die();
}
use \Bitrix\Main\Loader;
Loader::includeModule('iblock');
//$arResult;
$element= CIBlockElement::GetList(
    [],
    [
        //'IBLOCK_ID' => 1,
        'ACTIVE' => 'Y',
        'CODE'=>'informatsiya-o-shkole'
    ],
    false,
    false,
    []
);
//
$element=$element->GetNext();
$arItem['MARK']=CIBlockElement::GetProperty(1,1,  array("sort" => "asc"), ["CODE" => "MARK"])->Fetch() ['VALUE'];
$arItem['MARK_TEXT']=CIBlockElement::GetProperty(1,1,  array("sort" => "asc"), ["CODE" => "MARK_TEXT"])->Fetch() ['VALUE'];
$lat=explode(",",$arItem['MARK'])[0];
$lon=explode(",",$arItem['MARK'])[1];
$arResult['POINT']=serialize([
    "yandex_lat"=>$lat,
    "yandex_lon"=>$lon,
    "yandex_scale"=>16,
    "PLACEMARKS"=>[
        0=>[
            "LON"=>$lon,
            "LAT"=>$lat,
            "TEXT"=>$arItem["MARK_TEXT"],
        ]
    ]
]);
