<?php
 foreach ($arResult["ITEMS"] as $keyItem=>$arItem):
    if(in_array($arItem['ID'],$arParams['CHOOSE'])):
        $arResult["CHOOSEN_ITEMS"][]=$arItem;
        endif;
  endforeach;