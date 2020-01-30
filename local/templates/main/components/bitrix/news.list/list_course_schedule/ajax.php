<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;

if (!Loader::IncludeModule('iblock')) {
    jsonError('Ошибка подключения модуля инфоблоков');
}
define('COUNT_ELEMENT_IN_SET', 6); //Кол-во подгружаемых элементов
define('ALL_ELEMENT_IN_SET', 12); //Кол-во элементов через которое идёт чередование в вёрстке

$arResult["MONTHS"] = MONTHS;

$arSelect = ['ID', 'PROPERTY_DAY', 'PROPERTY_COURSE', 'DATE_ACTIVE_TO','PROPERTY_REPEAT'];
$res = CIBlockElement::GetList(
    [
        'DATE_ACTIVE_TO' => 'DESC',
    ],
    [
        'IBLOCK_ID' => $_POST['iblock_id'],
        'ACTIVE' => 'Y',
        'PROPERTY_COURSE' => $_POST['course_id'],
    ],
    false,
    false,
    $arSelect
);


$arCourseId = [];
$arCourseBId = [];
for ($i = 1; $arItem = $res->GetNext(); ++$i) {
    $arResult['ITEMS'] [$i] ['PROPERTY_DAY_VALUE'] = htmlspecialcharsback($arItem['PROPERTY_DAY_VALUE'] ['TEXT']);
    $arResult['ITEMS'] [$i] ['PROPERTY_COURSE_VALUE'] = $arItem['PROPERTY_COURSE_VALUE'];
    $arResult['ITEMS'] [$i] ['DATE_ACTIVE_TO'] = $arItem['DATE_ACTIVE_TO'];
    $arCourseId[] = $arItem['PROPERTY_COURSE_VALUE'];
    $arCourseBId[] = $_POST['course_iblock_id'];
    $arResult['ITEMS'] [$i] ['PROPERTIES'] ['REPEAT'] ['VALUE'] = $arItem['PROPERTY_REPEAT_VALUE'];
}

$t=count($arResult['ITEMS']).' ';

    $res= repeatSchedule($arResult['ITEMS'],true);
    if(isset($res)) {
        foreach ($res as $item) {
            $arResult ['ITEMS'] [] = $item;
        }
        sortSchedule($arResult['ITEMS']);
    }

$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    Array(
        'IBLOCK_ID' => $arCourseBId,
        'ACTIVE' => 'Y',
        'ID' => $arCourseId,
    ),
    false,
    false,
    Array(
        'ID', 'DETAIL_PAGE_URL', 'PROPERTY_LEVEL', 'NAME', 'PROPERTY_PRICE'
    )
);

$el = $res->GetNext();
$url = $el['DETAIL_PAGE_URL'];
$level = $el['PROPERTY_LEVEL_VALUE'];
$name = strTokDot($el['NAME'],LEN_TITLE_COURSE_SCHEDULE);
$price = $el['PROPERTY_PRICE_VALUE'];


$sendRes = [];
$count;

for ($i = $_POST['count_elems'] + 1; $i <= $_POST['count_elems'] + COUNT_ELEMENT_IN_SET + 1; ++$i) {

    if (empty($arResult['ITEMS'][$i])) {
        break;
    }
    $daysLessons = $arResult['ITEMS'] [$i] ['PROPERTY_DAY_VALUE'];
    $arDate = explode('.', explode(' ', $arResult['ITEMS'] [$i] ['DATE_ACTIVE_TO'])[0]);
    $day = intval($arDate[0]);
    $month = $arResult['MONTHS'][intval($arDate[1])];
    $year = $arDate[2];
    $fraseBtn = \Bitrix\Main\Localization\Loc::getMessage('BTN');
    $frase = \Bitrix\Main\Localization\Loc::getMessage('PRICE');

        $sendRes['ITEMS'][] = <<<TAG
                                <li>
                                <span class="btn__close"></span>
                                <ul>
                                    <li>
                                       
                                        <div class="box__date-schedule"><i>$day</i>
                                        <span class="wrapper-dates">
                                            $month
                                            <span>$year</span>
                                            </span>
                                            </div>
                                    </li>
                                    <li>
                                        <div class="box__course-schedule"><a href="$url">
                                               $name
                                                <span>$level</span></a></div>
                                    </li>
                                    <li>
                                       $daysLessons
                                    </li>
                                    <li>
                                        <div class="box__price-schedule">
                                            <div class="box__title-hidden">$frase</div>
                                            $price
                                        </div>
                                    </li>
                                    <li>
    <div class="btn" data-course-open><button>$fraseBtn</<button></div>
</li>
                                </ul>
                            </li>
TAG;

    $count=$i;

}

//// для удаления кнопки
if(count($sendRes)==0 || $count==count($arResult['ITEMS'])-1){
    $sendRes ['status']='empty';
}
else{
    $sendRes ['status']='ok';
}
$sendRes['len']=count($sendRes['ITEMS']);
echo json_encode($sendRes);
//p_f($sendRes);
die();
