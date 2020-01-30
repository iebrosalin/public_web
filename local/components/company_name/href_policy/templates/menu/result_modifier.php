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
        'ACTIVE' => 'Y',
        'CODE'=>'informatsiya-o-shkole',
        'IBLOCK_ID'=>$arParams["IBLOCK_ID"],
    ],
    false,
    false,
    ['ID',
        [
            "VK"=>"",
            "INSTAGRAM"=>"",
            "FACEBOOK"=>"",
            "YOUTUBE"=>"",
        ]
    ]
);
//
$element=$element->Fetch();

$arResult['SOCIAL'] ["vk"]=CIBlockElement::GetProperty($arParams["IBLOCK_ID"],$element['ID'],  array("sort" => "asc"),['CODE'=>"VK"])->Fetch()['VALUE'];
$arResult['SOCIAL'] ["instagram"]=CIBlockElement::GetProperty($arParams["IBLOCK_ID"],$element['ID'],  array("sort" => "asc"),['CODE'=>"INSTAGRAM"])->Fetch()['VALUE'];
$arResult['SOCIAL'] ["facebook"]=CIBlockElement::GetProperty($arParams["IBLOCK_ID"],$element['ID'],  array("sort" => "asc"),['CODE'=>"FACEBOOK"])->Fetch()['VALUE'];
$arResult['SOCIAL'] ["youtube"]=CIBlockElement::GetProperty($arParams["IBLOCK_ID"],$element['ID'],  array("sort" => "asc"),['CODE'=>"YOUTUBE"])->Fetch()['VALUE'];
$arResult['FILE'] = CFile::GetPath(CIBlockElement::GetProperty($arParams["IBLOCK_ID"],$element['ID'],  array("sort" => "asc"),['CODE'=>"PRESENTATION_COURSE"])->Fetch()['VALUE']);
//p_f($arResult);

