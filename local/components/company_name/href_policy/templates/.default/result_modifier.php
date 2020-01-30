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
$arResult['POLICY']=CFile::GetPath(CIBlockElement::GetProperty($arParams["IBLOCK_ID"],$element['ID'],  array("sort" => "asc"),['CODE'=>"POLICY"])->Fetch()['VALUE']);

