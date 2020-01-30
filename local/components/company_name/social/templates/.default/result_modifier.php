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
        'CODE'=>'informatsiya-o-shkole'
    ],
    false,
    false,
    []
);
//
$element=$element->GetNext();
$arSocial=[
    "VIBER",
    "WHATSAPP",
    "TELEGRAM",
    "SKYPE",
    'VK_SEND_MESSAGE',
    'FACEBOOK_MASSENGER'
];
$i=0;
foreach ($arSocial as $item){
    // IBLOCK_ID=1, ELEMENT_ID=1
    $arProp=CIBlockElement::GetProperty(1,1,  array("sort" => "asc"),['CODE'=>$item])->Fetch();
//    $arResult['SOCIAL'] [$i] ['CODE'] = $arProp['CODE'];
    $arResult['SOCIAL'] [$arProp['CODE']] ['VALUE'] = $arProp['VALUE'];
    ++$i;
}

$arResult['SOCIAL'];
// IBLOCK_ID=1, ELEMENT_ID=1
$arResult['PHONE']=CIBlockElement::GetProperty(1,1,  array("sort" => "asc"),["CODE" => "PHONE"])->Fetch()['VALUE'];

