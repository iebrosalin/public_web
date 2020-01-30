<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use \Bitrix\Main\Loader;
if (!Loader::IncludeModule('iblock')) {
    jsonError('Ошибка подключения модуля инфоблоков');
}

if(checkForm($_POST)) die();

$arFields = array (
    'IBLOCK_ID' => intval($_POST['iblock_id']),
    'NAME' => 'Фрагмент курса получил ' . htmlspecialchars($_POST['email']),
    'PROPERTY_VALUES' => array (
        'EMAIL' => $_POST['email'],
    )
);

$oEl = new CIBlockElement();
$ID = $oEl->Add($arFields);
if (0 >= $ID) {
    jsonError(ERROR_MESSAGE_BITRIX_FAIL );
}

echo json_encode([
    'message'=>'Регистрация для просмотра бесплатного занятия пройдена. Приятного просмотра)',
    'header'=>'Cпасибо за подписку!',
]);

$arFields = array(
    'EMAIL' => $arFields ['PROPERTY_VALUES'] ['EMAIL'],
);

$ID = CEvent::Send("BR_GET_FRAGMANT_LESSON", SITE_ID, $arFields);

if (0 >= $ID) {
    jsonError( ERROR_MESSAGE_BITRIX_FAIL );
}

die();
