<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use \Bitrix\Main\Loader;
if (!Loader::IncludeModule('iblock')) {
    jsonError('Ошибка подключения модуля инфоблоков');
}
define('COUNT_ELEMENT_IN_SET',6); //Кол-во подгружаемых элементов
define('ALL_ELEMENT_IN_SET',12); //Кол-во элементов через которое идёт чередование в вёрстке

//p_f($_POST);
$arSelect=[ 'ID','NAME','IBLOCK_SECTION_ID', 'PROPERTY_LEVEL','PREVIEW_PICTURE','DETAIL_PAGE_URL'];
if($_POST['active_category']==='all') {
    $res=CIBlockElement::GetList(
        [
            'TIMESTAMP_X'=>'DESC',
            'SORT'=>'ASC',
        ],
        [
            'IBLOCK_ID'=>$_POST['iblock_id'],
            'ACTIVE'=>'Y',
        ],
        false,
        false,
        $arSelect
    );

}
else {
    $res=CIBlockElement::GetList(
        [
            'TIMESTAMP_X'=>'DESC',
            'SORT'=>'ASC',
        ],
        [
            'IBLOCK_ID'=>$_POST['iblock_id'],
            'SECTION_ID'=>$_POST['active_category'],
            'ACTIVE'=>'Y',
        ],
        false,
        false,
        $arSelect
    );

}

for($i=1; $arItem=$res->GetNext(); ++$i){
    $arResult['ITEMS'] [$i] ['NAME']=$arItem['NAME'];
    $arResult['ITEMS'] [$i] ['SECTION_ID']=$arItem['IBLOCK_SECTION_ID'];
    $arResult['ITEMS'] [$i] ['DETAIL_PAGE_URL']=$arItem['DETAIL_PAGE_URL'];
    $arResult['ITEMS'] [$i] ['PROPERTY_LEVEL_VALUE']=$arItem['PROPERTY_LEVEL_VALUE'];
    $arResult['ITEMS'] [$i] ['PREVIEW_PICTURE']=CFile::GetPath($arItem['PREVIEW_PICTURE']);
}
$res = CIBlockSection::GetList(
    $arOrder = array("SORT" => "ASC"),
    Array(
        'IBLOCK_ID' =>$_POST['iblock_id'],
        'ACTIVE'=>'Y',
    ),
    false,
    Array(
        'ID','PICTURE',
    ),
    false
);

while ($el = $res->Fetch()) {
    $arResult['NAME_SECTION'] [$el['ID']]['PICTURE'] = CFile::GetPath($el['PICTURE']);
}


$sendRes=[];
$count;
for($i=$_POST['count_elems']+1;$i!=$_POST['count_elems']+COUNT_ELEMENT_IN_SET+1; ++$i){
    if(empty($arResult['ITEMS'][$i])){
        break;
    }

    $name=$arResult['ITEMS'] [$i] ['NAME'];
    $level= $arResult['ITEMS'] [$i] ['PROPERTY_LEVEL_VALUE'];
    $pic=$arResult['ITEMS'] [$i] ['PREVIEW_PICTURE'];
    $sect_pic=$arResult ['NAME_SECTION'] [$arResult['ITEMS'] [$i] ['SECTION_ID']] ['PICTURE'];
    $detail=$arResult['ITEMS'] [$i] ['DETAIL_PAGE_URL'];

    switch ($i%ALL_ELEMENT_IN_SET){
        case 0:
            $sendRes ['ITEMS'] []=<<<EOL1
  <li class="item-animation" >
                                    <a href="$detail"  style="background-image: url($pic)"
                                       data-item-wraper-animation>
                                        <span class="box__title" data-item-title-animation>$name</span>
                                        <span class="box__description"
                                              data-item-description-animation>$level</span>
                                        <span class="box__logo-image" data-item-logo-animation
                                              style="background-image: url($sect_pic)"></span>
                                    </a>
                                </li>
EOL1;
            break;
        case 1:
            $sendRes['ITEMS'] []=<<<EOL1
  <li class=" box-big-bottom item-animation" >
                                    <a href="$detail"  style="background-image: url($pic)"
                                       data-item-wraper-animation>
                                        <span class="box__title" data-item-title-animation>$name</span>
                                        <span class="box__description"
                                              data-item-description-animation>$level</span>
                                        <span class="box__logo-image" data-item-logo-animation
                                              style="background-image: url($sect_pic)"></span>
                                    </a>
                                </li>
EOL1;
            break;
        case 2:
            $sendRes ['ITEMS'] []=<<<EOL1
  <li class="box-big-left item-animation" >
                                    <a href="$detail"  style="background-image: url($pic)"
                                       data-item-wraper-animation>
                                        <span class="box__title" data-item-title-animation>$name</span>
                                        <span class="box__description"
                                              data-item-description-animation>$level</span>
                                        <span class="box__logo-image" data-item-logo-animation
                                              style="background-image: url($sect_pic)"></span>
                                    </a>
                                </li>
EOL1;
            break;
        case 3:
        case 4:
        case 5:
        case 6:
        case 7:
            $sendRes ['ITEMS'] []=<<<EOL1
  <li class="item-animation" >
                                    <a href="$detail"  style="background-image: url($pic)"
                                       data-item-wraper-animation>
                                        <span class="box__title" data-item-title-animation>$name</span>
                                        <span class="box__description"
                                              data-item-description-animation>$level</span>
                                        <span class="box__logo-image" data-item-logo-animation
                                              style="background-image: url($sect_pic)"></span>
                                    </a>
                                </li>
EOL1;
            break;
        case 8:
            $sendRes ['ITEMS'] []=<<<EOL1
  <li class="box-big-left item-animation" >
                                    <a href="$detail"  style="background-image: url($pic)"
                                       data-item-wraper-animation>
                                        <span class="box__title" data-item-title-animation>$name</span>
                                        <span class="box__description"
                                              data-item-description-animation>$level</span>
                                        <span class="box__logo-image" data-item-logo-animation
                                              style="background-image: url($sect_pic)"></span>
                                    </a>
                                </li>
EOL1;
            break;
        case 9:
            $sendRes ['ITEMS'] []=<<<EOL1
  <li class="box-big-bottom item-animation" >
                                    <a href="$detail"  style="background-image: url($pic)"
                                       data-item-wraper-animation>
                                        <span class="box__title" data-item-title-animation>$name</span>
                                        <span class="box__description"
                                              data-item-description-animation>$level</span>
                                        <span class="box__logo-image" data-item-logo-animation
                                              style="background-image: url($sect_pic)"></span>
                                    </a>
                                </li>
EOL1;
            break;
        case 10:
        case 11:
            $sendRes ['ITEMS'] []=<<<EOL1
  <li class="item-animation" >
                                    <a href="$detail"  style="background-image: url($pic)"
                                       data-item-wraper-animation>
                                        <span class="box__title" data-item-title-animation>$name</span>
                                        <span class="box__description"
                                              data-item-description-animation>$level</span>
                                        <span class="box__logo-image" data-item-logo-animation
                                              style="background-image: url($sect_pic)"></span>
                                    </a>
                                </li>
EOL1;
    }
    $count=$i;
}
//// для удаления кнопки
if(count($sendRes)==0 || $count==count($arResult['ITEMS'])){
    $sendRes ['status']='empty';
}
else{
    $sendRes ['status']='ok';
}
$sendRes['len']=count($sendRes['ITEMS']);
echo json_encode($sendRes);
//p_f($sendRes);
die();
