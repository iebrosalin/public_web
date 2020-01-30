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
    ['ID']
);
//
$element=$element->Fetch();
$arResult['SIGN_Person_REF']=CIBlockElement::GetProperty($arParams["IBLOCK_ID"],$element['ID'],  array("sort" => "asc"),['CODE'=>"SIGN_Person_REF"])->Fetch()['VALUE'];
$arResult['REF_Person']=CIBlockElement::GetProperty($arParams["IBLOCK_ID"],$element['ID'],  array("sort" => "asc"),['CODE'=>"REF_Person"])->Fetch()['VALUE'];
$arResult['SIGN_BTN']=CIBlockElement::GetProperty($arParams["IBLOCK_ID"],$element['ID'],  array("sort" => "asc"),['CODE'=>"SIGN_BTN"])->Fetch()['VALUE'];
//p_f($arResult);

