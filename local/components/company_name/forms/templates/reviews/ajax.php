<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use \Bitrix\Main\Loader;
if (!Loader::IncludeModule('iblock')) {
    jsonError('Ошибка подключения модуля инфоблоков');
}

if(checkForm($_POST)) die();

$arFields = array (
    'IBLOCK_ID' => intval($_POST['iblock_id']),
    'NAME' => 'Отзыв от ' . htmlspecialchars($_POST['name']),
    'PROPERTY_VALUES' => array (
        'NAME' => $_POST['name'],
        'EMAIL' => $_POST['email'],
        'REVIEW_TEXT'=>$_POST['review'],
    )
);
$oEl = new CIBlockElement();
$ID = $oEl->Add($arFields);
if (0 >= $ID) {
    jsonError(ERROR_MESSAGE_BITRIX_FAIL);
}

echo json_encode([
    'message'=>'Форма успешно отправлена.',
    'header'=>'Форма отзыва',
]);

$arFields = array(
    'NAME' => $arFields ['PROPERTY_VALUES'] ['NAME'],
    'EMAIL' => $arFields ['PROPERTY_VALUES'] ['EMAIL'],
    'REVIEW_TEXT' => $arFields ['PROPERTY_VALUES'] ['REVIEW_TEXT'],
);

$ID = CEvent::Send("NEW_REVIEW", SITE_ID, $arFields);

if (0 >= $ID) {
    jsonError( ERROR_MESSAGE_BITRIX_FAIL );
}

die();
