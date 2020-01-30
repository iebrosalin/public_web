<?php
$tempResult;
$res = CIBlockSection::GetList(
    $arOrder = array("SORT" => "ASC"),
    Array(
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ACTIVE' => 'Y',
    ),
    false,
    Array(
        'NAME', 'ID', 'PICTURE',
    ),
    false
);

while ($el = $res->Fetch()) {
    $tempResult[$el['ID']]['NAME'] = $el['NAME'];
    $tempResult[$el['ID']]['PICTURE'] = CFile::GetPath($el['PICTURE']);
}

$arResult['NAME_SECTION'] = $tempResult;
?>

<?
$count_el = -1;
$count_el_max = $arParams["CUR_COUNT_ELEM"] + SHOW_COURSE_TEACHER;
$arSend;
for ($i = 0; $i != count($arResult["ITEMS"]); ++$i):?>

    <? if (in_array($arResult["ITEMS"] [$i]['ID'], $arParams['LIST'])):
        ++$count_el;
        if ($count_el >= $arParams["CUR_COUNT_ELEM"] && $count_el < $count_el_max):
            $detail_url=$arResult["ITEMS"] [$i]['DETAIL_PAGE_URL'];
            $pic_course=existImageFile($arResult["ITEMS"] [$i]['PREVIEW_PICTURE']);
            $name=$arResult["ITEMS"] [$i]['NAME'];
            $level=$arResult["ITEMS"] [$i]['PROPERTIES'] ['LEVEL'] ['VALUE'];
            $logo=existImageFile($arResult['NAME_SECTION'] [$arResult["ITEMS"] [$i] ['IBLOCK_SECTION_ID']] ['PICTURE']);
            $arSend ['ITEMS'][]=<<<TAG
            <div class="col-12 col-lg-4">
                <div class="box__item item-animation">
                    <a href="$detail_url"
                       style="background-image: url($pic_course)"
                       data-item-wraper-animation>
                        <span class="title" data-item-title-animation>$name</span>
                        <span class="description"
                              data-item-description-animation>$level</span>
                        <span class="box__logo" data-item-logo-animation
                              style="background-image: url($logo)"></span>
                    </a>
                </div>
            </div>
TAG;

        elseif ($count_el==$count_el_max+1):
            break;
        else:
            continue;
        endif;
    else:
        continue;
    endif; ?>
<? endfor;
if(count($arParams['LIST'])==$arParams["CUR_COUNT_ELEM"]+count($arSend['ITEMS'])){
    $arSend ["status"]="empty";
}
else{
    $arSend ["status"]="ok";
}
$arSend['len']=count($arSend['ITEMS']);
$APPLICATION->RestartBuffer();
echo json_encode($arSend);
