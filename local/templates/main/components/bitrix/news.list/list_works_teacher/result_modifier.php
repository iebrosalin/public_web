<?php
$tempResult;
$res = CIBlockSection::GetList(
    $arOrder = array("SORT" => "ASC", "NAME" => "ASC"),
    Array(
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ACTIVE'=>'Y',
        'SECTION_ID'=> $arParams['PARENT_SECTION'],
        'INCLUDE_SUBSECTIONS' => 'Y' 
    ),
    false,
    Array(
        'NAME', 'ID','UF_HIGHLIGHT',
    ),
    false
);

while ($el = $res->Fetch()) {
    $tempResult[$el['ID']]['NAME'] = $el['NAME'];
    $tempResult[$el['ID']]['UF_HIGHLIGHT']=$el['UF_HIGHLIGHT'];
}

$arResult['NAME_SECTION'] = $tempResult;