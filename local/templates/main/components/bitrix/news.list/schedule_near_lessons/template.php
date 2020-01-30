<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);

define('COUNT_ELEMENT_IN_SET',6); //Кол-во подгружаемых элементов
if ( 0 >= count( $arResult['ITEMS'] ) ) {
    return;
}
//?>
      <span><?= Loc::getMessage('NEAR_LESSONS')?><i><?= count($arResult["ITEMS"]); ?></i></span>
                            <ul>
                           <? $count_el=0;
                           foreach($arResult["ITEMS"] as $key=>$arItem):
                           	$arTime=explode('.',explode (' ',$arItem["DATE_ACTIVE_TO"])[0]);
                            if( date('j', time())<=intval($arTime[0]) && date('n', time())==intval($arTime[1]) ) continue;
                           	?>
                            <li>
                                <a href="<?= $arItem ['DISPLAY_PROPERTIES']['COURSE']['LINK_ELEMENT_VALUE']
                            [$arItem ['DISPLAY_PROPERTIES']['COURSE']['VALUE']] ['DETAIL_PAGE_URL']?>">
                                    <?= $arItem ['DISPLAY_PROPERTIES']['COURSE']['LINK_ELEMENT_VALUE']
                                    [$arItem ['DISPLAY_PROPERTIES']['COURSE']['VALUE']] ['NAME']
                                    ?><span><?= $arItem ['COURSE_LEVEL'] ?></span>
                                </a>
                            </li>
                            <?
                            unset($arResult['ITEMS'][$key]);
                            ++$count_el;
                               if($count_el==COUNT_ELEMENT_IN_SET) break;
                            endforeach;?>
                                <li class="last-link"><a href="/#schedule"><?= Loc::getMessage('ALL_NEAR_LESSONS')?></a></li>
                            </ul>






