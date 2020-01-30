<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;

if (!Loader::IncludeModule('iblock')) {
    jsonError('Ошибка подключения модуля инфоблоков');
}
define('COUNT_ELEMENT_IN_SET', 6); //Кол-во подгружаемых элементов
define('ALL_ELEMENT_IN_SET', 12); //Кол-во элементов через которое идёт чередование в вёрстке

//p_f($_POST);
$arSelect = ['ID', 'NAME', 'PROPERTY_SIGN', 'PROPERTY_HREF', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'PREVIEW_TEXT','SORT'];
if ($_POST['active_category'] === 'all') {
    $res = CIBlockElement::GetList(
        [
            'SORT' => 'ASC',
            'NAME' => 'ASC',
        ],
        [
            'IBLOCK_ID' => $_POST['iblock_id'],
            'ACTIVE' => 'Y',
        ],
        false,
        false,
        $arSelect
    );

} else {
    $res = CIBlockElement::GetList(
        [
            'SORT' => 'ASC',
            'NAME' => 'ASC',
        ],
        [
            'IBLOCK_ID' => $_POST['iblock_id'],
            'SECTION_ID' => $_POST['active_category'],
            'ACTIVE' => 'Y',
        ],
        false,
        false,
        $arSelect
    );

}

for ($i = 1; $arItem = $res->GetNext(); ++$i) {
    $arResult['ITEMS'] [$i] ['NAME'] = $arItem['NAME'];
    $arResult['ITEMS'] [$i] ['DETAIL_PICTURE'] = existImageFile(CFile::GetPath($arItem['DETAIL_PICTURE']));
    $arResult['ITEMS'] [$i] ['PROPERTY_SIGN_VALUE'] = $arItem['PROPERTY_SIGN_VALUE'];
    $arResult['ITEMS'] [$i] ['PROPERTY_HREF_VALUE'] = $arItem['PROPERTY_HREF_VALUE'];
    $arResult['ITEMS'] [$i] ['PREVIEW_PICTURE'] = existImageFile(CFile::GetPath($arItem['PREVIEW_PICTURE']));
    $arResult['ITEMS'] [$i] ['PREVIEW_TEXT'] = $arItem['PREVIEW_TEXT'];
}
$res = CIBlockSection::GetList(
   array("SORT" => "ASC"),
    Array(
        'IBLOCK_ID' => $_POST['iblock_id'],
        'ACTIVE' => 'Y',
    ),
    false,
    Array(
        'ID', 'PICTURE',
    ),
    false
);

while ($el = $res->Fetch()) {
    $arResult['NAME_SECTION'] [$el['ID']]['PICTURE'] = CFile::GetPath($el['PICTURE']);
}


$sendRes = [];
$count = 0;
$countEl;
for ($i = $_POST['count_elems'] + 1; $i != $_POST['count_elems'] + COUNT_ELEMENT_IN_SET + 1; ++$i) {
    if (empty($arResult['ITEMS'][$i])) {
        break;
    }

    $name = $arResult['ITEMS'] [$i] ['NAME'];
    $sign = $arResult['ITEMS'] [$i] ['PROPERTY_SIGN_VALUE'];
    $pic = $arResult['ITEMS'] [$i] ['PREVIEW_PICTURE'];
    $detail = $arResult['ITEMS'] [$i] ['DETAIL_PICTURE'];
    $href_video = $arResult['ITEMS'] [$i] ['PROPERTY_HREF_VALUE'];
    $text = htmlspecialcharsback($arResult['ITEMS'] [$i] ['PREVIEW_TEXT']);
    if ( !(isset($href_video) && isset($detail)) ) {
        $sendRes['ITEMS'][$count] = <<<TAG
                    <div class="col-12 col-lg-6">
                    <div class="item smoke-color" ">
                                <div class="box__head">
                                    <div class="box__cover"
                                         style="background-image: url($pic);"></div>
                                    <div class="box__description">
                                        <h3 class="name">$name</h3>
                                        <span class="profile">$sign</span>
                                    </div>
                                </div>
TAG;
        if (mb_strlen($text) < $_POST['message_size']) {
            $sendRes['ITEMS'][$count]=$sendRes['ITEMS'][$count] . <<<TAG
<div class="box__text">
                                        $text
                                    </div> 
                                               
                                                <div class="box__text-big hidden">
                                      $text
                                    </div><div class="btn__more" data-reviewpopup-open>Показать полностью</div>
                                               
                                               </div>
                    </div>
TAG;

        } else {
            $small = htmlspecialcharsback(substr($arResult['ITEMS'] [$i] ['PREVIEW_TEXT'], 0, $_POST['message_size']) . '...');
            $sendRes['ITEMS'][$count]=$sendRes['ITEMS'][$count] . <<<TAG
<div class="box__text">
                                        $small
                                    </div>
                                    <div class="box__text-big hidden">
                                      $text
                                    </div><div class="btn__more" data-reviewpopup-open>Показать полностью</div>            </div>
                    </div>
TAG;

        }
    }
    else {
        $sendRes['ITEMS'][$count] = <<<TAG
        <div class="col-12 col-lg-6">
                            <div class="item box__video" data-boxvideo
                                 data-video="$href_video">
                                <span style="background-image: url( $detail);"><i></i></span>
                            </div>
                        </div>
TAG;
}
    $countEl=$i;
++$count;
}
// для удаления кнопки
//p_f($arResult);
if(count($sendRes['ITEMS'])==0 || $countEl==count($arResult['ITEMS'])){
    $sendRes ['status']='empty';
}
else{
    $sendRes ['status']='ok';
}
$sendRes['len']=count($sendRes['ITEMS']);
echo json_encode($sendRes);

die();
