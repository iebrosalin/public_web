<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;

if (!Loader::IncludeModule('iblock')) {
    jsonError('Ошибка подключения модуля инфоблоков');
}
define('COUNT_ELEMENT_IN_SET', 6); //Кол-во подгружаемых элементов
define('ALL_ELEMENT_IN_SET', 12); //Кол-во элементов через которое идёт чередование в вёрстке
$arResult["MONTHS"] = [
    'Нулевой',
    'Января',
    'Февраля',
    'Марта',
    'Апреля',
    'Мая',
    'Июня',
    'Июля',
    'Августа',
    'Сентября',
    'Октября',
    'Ноября',
    'Декабря',
];
//p_f($_POST);
$arSelect = ['ID', 'PROPERTY_DAY', 'PROPERTY_COURSE', 'DATE_ACTIVE_TO', 'PROPERTY_REPEAT'];
$res = CIBlockElement::GetList(
    [
        'DATE_ACTIVE_TO' => 'DESC',
    ],
    [
        'IBLOCK_ID' => $_POST['iblock_id'],
        'ACTIVE' => 'Y',
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
    $arResult['ITEMS'] [$i] ['PROPERTIES'] ['REPEAT'] ['VALUE'] = $arItem['PROPERTY_REPEAT_VALUE'];
}

$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    Array(
        'IBLOCK_ID' => $_POST['course_iblock_id'],
        'ACTIVE' => 'Y',
    ),
    false,
    false,
    Array(
        'ID', 'DETAIL_PAGE_URL', 'PROPERTY_LEVEL', 'NAME', 'PROPERTY_PRICE'
    )
);

while ($el = $res->GetNext()) {
    $arResult['COURSE'][$el['ID']] ['DETAIL_PAGE_URL'] = $el['DETAIL_PAGE_URL'];
    $arResult['COURSE'][$el['ID']] ['PROPERTY_LEVEL_VALUE'] = $el['PROPERTY_LEVEL_VALUE'];
    $arResult['COURSE'][$el['ID']] ['NAME'] = $el['NAME'];
    $arResult['COURSE'][$el['ID']] ['PROPERTY_PRICE_VALUE'] = $el['PROPERTY_PRICE_VALUE'];
}

$res = repeatSchedule($arResult['ITEMS'], true);
if (isset($res)) {
    foreach ($res as $item) {
        $arResult ['ITEMS'] [] = $item;
    }
    sortSchedule($arResult['ITEMS']);
}

$sendRes = [];
$count;
for ($i = $_POST['count_elems']; $i != $_POST['count_elems'] + COUNT_ELEMENT_IN_SET + 1; ++$i) {

    if (empty($arResult['ITEMS'][$i])) {
        break;
    }

    $url = $arResult['COURSE'][$arResult['ITEMS'] [$i] ['PROPERTY_COURSE_VALUE']] ['DETAIL_PAGE_URL'];
    $level = $arResult['COURSE'][$arResult['ITEMS'] [$i] ['PROPERTY_COURSE_VALUE']] ['PROPERTY_LEVEL_VALUE'];
    $name =  strTokDot($arResult['COURSE'][$arResult['ITEMS'] [$i] ['PROPERTY_COURSE_VALUE']] ['NAME'],LEN_TITLE_COURSE_SCHEDULE);
    $price = $arResult['COURSE'][$arResult['ITEMS'] [$i] ['PROPERTY_COURSE_VALUE']] ['PROPERTY_PRICE_VALUE'];

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

    $count = $i;
}
//// для удаления кнопки
if (count($sendRes) == 0 || $count == count($arResult['ITEMS']) - 1) {
    $sendRes ['status'] = 'empty';
} else {
    $sendRes ['status'] = 'ok';
}
$sendRes['len'] = count($sendRes['ITEMS']);
echo json_encode($sendRes);
//p_f($sendRes);
die();