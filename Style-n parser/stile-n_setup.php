<?
//use Bitrix\Main;
use Bitrix\Main\Loader;
/** @global string $ACTION */
/** @global string $URL_DATA_FILE */
/** @global string $DATA_FILE_NAME */


global $APPLICATION, $USER;


/**
 * This block include file
 */
$strPatch = "classes/assg/import/";
$arIncludeFile = array (
    "helper.php",
    "abstractElement.php"
);
foreach ($arIncludeFile as $strFileName)
{
    if (file_exists(Loader::getLocal($strPatch).$strFileName))
        include(Loader::getLocal($strPatch).$strFileName);
}

/**
 * This block checked requried class
 */

$arRequiredClass = array (
    "SimpleXMLElement",
    "Assg\Import\Helper",
    "Assg\Import\Element"
);
foreach ($arRequiredClass as $strClassName)
{
    if (!class_exists($strClassName))
    {
        throw new Exception("Нет библиотеки {$strClassName}, дальнейшая работа импорта не возможна");
    }
}

///**
// * Develop imports
// * @var array $arSitesImport
// */
//$arSitesImport = array (
//    "PR" => "primalinea",
//    "LX" => "luxury-moda",
//    "AV" => "avigal",
//    "ST" => "stile-n",
//);

$arVars = array (
    "LOCAL_FILE",
    "LINK_FILE",
    "IBLOCK_ID",
    "SITE_NAME_ABBR",
    "CONVERT_UTF8",
    "SETUP_PROFILE_NAME",
    "URL_DATA_FILE",
    "MARKUP"
);
//********************  ACTIONS  **************************************//
if (($ACTION == 'IMPORT_EDIT' || $ACTION == 'IMPORT_COPY'))
{

    {
        foreach ($arVars as $strNameVar) {
            switch ($strNameVar) {
                case "LOCAL_FILE":
                    if ($STEP == 1)
                        ${$strNameVar} = $arOldSetupVars[$strNameVar];
                    break;
                case "LINK_FILE":
                    if ($STEP == 1)
                        ${$strNameVar} = $arOldSetupVars[$strNameVar];
                    break;

                default:
                    if ($STEP == 2)
                        ${$strNameVar} = $arOldSetupVars[$strNameVar];
                    break;
            }
        }
    }
}
//if ($STEP == 2)
//{
//    if (0 < strlen($LOCAL_FILE) && file_exists($_SERVER["DOCUMENT_ROOT"].$LOCAL_FILE)
//        && is_file($_SERVER["DOCUMENT_ROOT"].$LOCAL_FILE)
//        && $APPLICATION->GetFileAccessPermission($LOCAL_FILE)>="R")
//    {
//        $DATA_FILE_NAME = $LOCAL_FILE;
//    }
//    elseif (0 < strlen($LINK_FILE) && $STEP == 2)
//    {
//
//        $strRequestTime = time();
//        $strPath = '/upload/catalog/'.$strRequestTime.'_catalog.xml';
//        $strFullPath = $_SERVER['DOCUMENT_ROOT'] . $strPath;
//        //var_dump(file_get_contents($LINK_FILE));
//
//        if (!$file = file_get_contents($LINK_FILE))
//        {
//            $arSetupErrors[] = "Не удалось получить файл";
//            $STEP = 1;
//        }
//        else
//        {
//            file_put_contents($strFullPath, file_get_contents($LINK_FILE));
//            if (file_exists($strFullPath) && is_file($strFullPath) && $APPLICATION->GetFileAccessPermission($strFullPath)>="R")
//            {
//                $DATA_FILE_NAME = $strPath;
//            }
//            else
//            {
//                $arSetupErrors[] = "Файл не обработан";
//                $STEP = 1;
//            }
//        }
//    }
//    else
//    {
//        $arSetupErrors[] = "Не удалось обнаружить файл";
//        $STEP = 1;
//    }
//
//
//    /* 	if (strlen($URL_DATA_FILE) > 0 && file_exists($_SERVER["DOCUMENT_ROOT"].$URL_DATA_FILE) && is_file($_SERVER["DOCUMENT_ROOT"].$URL_DATA_FILE) && $APPLICATION->GetFileAccessPermission($URL_DATA_FILE)>="R")
//            $DATA_FILE_NAME = $URL_DATA_FILE; */
//}

$aMenu = array(
    array(
        "TEXT"=>"Обратно к списку",
        "TITLE"=>"Обратно к списку",
        "LINK"=>"/bitrix/admin/cat_import_setup.php?lang=".LANGUAGE_ID,
        "ICON"=>"btn_list",
    )
);

$context = new CAdminContextMenu($aMenu);

$context->Show();

if (!empty($arSetupErrors))
    ShowError(implode('<br />', $arSetupErrors));
?>
    <form method="POST" action="<? echo $APPLICATION->GetCurPage(); ?>" ENCTYPE="multipart/form-data" name="dataload">
        <?
        $aTabs = array(
            array("DIV" => "edit1", "TAB" => "Файл импорта", "ICON" => "store", "TITLE" => "Основные настройки"),
           // array("DIV" => "edit2", "TAB" => "Настройка импорта", "ICON" => "store", "TITLE" => GetMessage("CAT_ADM_CML1_IMP_TAB2_TITLE")),
        );

        $tabControl = new CAdminTabControl("tabControl", $aTabs, false, true);

        $tabControl->Begin();

        $tabControl->BeginNextTab();
        if ($STEP == 1)
        {
            ?><tr class="heading">
            <td colspan="2"><? echo GetMessage("CICML_DATA_IMPORT"); ?></td>
            </tr>
            <tr>
                <td valign="top" width="40%"><p style="margin-top: 20px;">Выберите папку с csv файлами</p></td>
                <td valign="top" width="60%">
                     </br>
                    <input type="text" name="LOCAL_FILE" size="40" value="<? echo htmlspecialcharsbx($LOCAL_FILE); ?>">
                    <input type="button" value="Выберите файл" onclick="cmlBtnSelectClick();"><?
                    CAdminFileDialog::ShowScript(
                        array(
                            "event" => "cmlBtnSelectClick",
                            "arResultDest" => array("FORM_NAME" => "dataload", "FORM_ELEMENT_NAME" => "LOCAL_FILE"),
                            "arPath" => array("PATH" => "/upload/catalog", "SITE" => SITE_ID),
                            "select" => 'F',// F - file only, D - folder only, DF - files & dirs
                            "operation" => 'O',// O - open, S - save
                            "showUploadTab" => true,
                            "showAddToMenuTab" => false,
                            "fileFilter" => 'csv',
                            "allowAllFiles" => true,
                            "SaveConfig" => true
                        )
                    );?>
<!--                    </br>или укажите ссылку:</br>-->
<!--                    <input type="text" name="LINK_FILE" size="40" value="--><?// echo htmlspecialcharsbx($LINK_FILE); ?><!--">-->
                </td>
            </tr>
            <tr>
                <td valign="top" width="40%"><p style="margin-top: 3px;">Наценка</p></td>
                <td valign="top" width="60%">
                    <input type="text" name="MARKUP" size="40" value="<? echo htmlspecialcharsbx($MARKUP);?>">
                </td>
            </tr>
            <?
        }
        $tabControl->EndTab();

        $tabControl->BeginNextTab();

        if ($STEP == 2)
        {
            $FINITE = true;
        }

        $tabControl->EndTab();

        $tabControl->Buttons();

        ?>
        <? echo bitrix_sessid_post(); ?>
        <?
        if ($ACTION == 'IMPORT_EDIT' || $ACTION == 'IMPORT_COPY')
        {
            ?><input type="hidden" name="PROFILE_ID" value="<? echo intval($PROFILE_ID); ?>"><?
        }

        if ($STEP < 3)
        {
            if ($STEP == 1)
            {
                ?>
                <input type="hidden" name="LINK_FILE" value="<?echo $LINK_FILE?>">
                <input type="hidden" name="LOCAL_FILE" value="<?echo $LOCAL_FILE?>">

                <input type="hidden" name="URL_DATA_FILE" value="<? echo htmlspecialcharsbx($DATA_FILE_NAME); ?>">
                <?
            }
            ?>
            <input type="hidden" name="STEP" value="<?echo intval($STEP) + 1;?>">
            <input type="hidden" name="lang" value="<?echo LANGUAGE_ID; ?>">
            <input type="hidden" name="ACT_FILE" value="<?echo htmlspecialcharsbx($_REQUEST["ACT_FILE"]) ?>">
            <input type="hidden" name="ACTION" value="<?echo htmlspecialcharsbx($ACTION) ?>">
            <input type="hidden" name="SETUP_FIELDS_LIST" value="<?=implode(',', $arVars)?>">
            <?if ($STEP > 1):?>
            <input type="submit" name="backButton" value="&lt;&lt; На предыдущий шаг">
        <?endif;?>
            <input type="submit" value="<?echo (($ACTION=="IMPORT")?"Импорт":"Сохранить")." &gt;&gt;" ?>" name="submit_btn"><?
        }?>

        <?
        $tabControl->End();

        ?></form>

<?
//p (spl_classes());
//p (get_declared_classes());
