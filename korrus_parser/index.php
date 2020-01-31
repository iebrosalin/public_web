<?php
require_once 'phpQuery/phpQuery.php';


$count=0;
//function parse_proj($adress)
//{
$adress="/realizovannye-proekty/asfaltobetonnye-zavody-bernardi-italiya/asfalto-betonnyy-zavod-bernardi-mic125-e220-proizvoditelnost-180-t-ch-tyumenskaya-obl-may-2014-goda/#ankor";
    global $count;
    ++$count;
//    if()
    $SITE = "https://www.korrus.ru";
   // echo '</br>'."Hello ". $SITE.$adress .'</br>';


    $str = file_get_contents($SITE.$adress);
    $pq = phpQuery::newDocument($str);


    $h2 = $pq->find('div.col-xs-12 > h2');

   // var_dump(iconv('windows-1251', 'UTF-8', $h2->html()));

    $h2 = iconv('windows-1251', 'UTF-8', $h2->html());
    //echo '</br>';

    $elems = $pq->find('a[rel="gallery1"]');

    $arImgs = [];
    foreach ($elems as $elem) {
       // echo '</br>';
        $pqElem = pq($elem);
       // var_dump($pqElem->attr('href'));
        $arImgs[] = $pqElem->attr('href');
    }

    $i = 0;
    foreach ($arImgs as $href) {
        $data = file_get_contents($SITE.$adress);
        $extension = 0;
        preg_match('/[.]\w+/', $href, $extension);
        ++$i;
        /*Добавить*/
        //echo '</br>'."img_proj/img_all/" . $h2 . '#' . $i . $extension[0];
        file_put_contents("img_proj/img_all/".time().rand(1,1000).$extension[0], $data);
    }

//if(is_dir("img_proj")){
//
//    if (is_dir("img_all")){
//
//    }
//
//    if(is_dir("img_with_folders")){
//
//    }
//}
//}

////function main(){
//    $SITE = "https://www.korrus.ru";
//    $PAGINATION="?PAGEN_1=";
//
//    $str = file_get_contents("https://www.korrus.ru/realizovannye-proekty/");
//    $pq = phpQuery::newDocument($str);
//
//
//    $elems = $pq->find('.item a');
//
//    $arHrefMain = [];
//
//    foreach ($elems as $elem) {
//       // echo '</br>';
//        $pqElem = pq($elem);
//       // $pqElem->remove('img');
//       // var_dump($pqElem->attr('href'));
//       // echo '</br>';
//     //   var_dump($pqElem->text());
//        $href = $pqElem->attr('href');
//
//        $str = file_get_contents("https://www.korrus.ru".$href);
//        $pq = phpQuery::newDocument($str);
////        $pq->remove('li.bx-pag-next');
//        $elems = $pq->find('div.bx-pagination-container.row > ul li a span');
//        echo '</br>'."Check pagination".'</br>';
////        var_dump();
//        if(count($elems)>0){
//            $arPages=[];
//            foreach ($elems as $elem) {
//               // echo '</br>';
//                $pqElem = pq($elem);
//                if($pqElem->text()!="Вперед "){
////                    var_dump((int)$pqElem->text());
//                    $arPages[]=(int)$pqElem->text();
//                }
//            }
//            $maxPage=intval($arPages[count($arPages)-2]);
//            echo '</br>'."Max pages all: ".$maxPage;
//
//            for($i=1; $i<= $maxPage;++$i){
//                $clearHref=explode('#ankor',  $href);
//
//                if($i!=1)  $hrefList=$SITE.$clearHref[0].$PAGINATION.$i;
//                else $hrefList=$SITE.$clearHref[0];
//                echo '</br>Page: ';
//                var_dump($hrefList);
//                echo '</br>';
//                $str = file_get_contents($hrefList);
//                $pq = phpQuery::newDocument($str);
//
//                $elems = $pq->find('.item a');
//
//                foreach ($elems as $elem) {
//                    echo '</br>';
//                    $pqElem = pq($elem);
//                    // $pqElem->remove('img');
//                    var_dump($pqElem->attr('href'));
////                    echo '</br>';
////                    var_dump($pqElem->text());
//                    $href_elem = $pqElem->attr('href');
//                    parse_proj( $href_elem);
//                }
//            }
//        }
//        else{
//            $clearHref=explode('#ankor',$href);
//            $hrefList=$SITE.$clearHref[0];
//
//            echo '</br>Page: ';
//            var_dump($hrefList);
//            echo '</br>';
//
//            $str = file_get_contents($hrefList);
//            $pq = phpQuery::newDocument($str);
//
//            $elems = $pq->find('.item a');
//
//            foreach ($elems as $elem) {
//                echo '</br>';
//                $pqElem = pq($elem);
//                // $pqElem->remove('img');
//                var_dump($pqElem->attr('href'));
////                    echo '</br>';
////                    var_dump($pqElem->text());
//                $href_elem = $pqElem->attr('href');
//                parse_proj( $href_elem);
//            }
//        }
//
//    }
//
//    echo '</br>';
//    echo "######################################## Total=".$count;
//    echo '</br>';
//}

//main();

    /****<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require_once 'phpQuery/phpQuery.php';
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Highloadblock\HighloadBlockTable;
use \Bitrix\Catalog\ProductTable;
use Bitrix\Main\Type\DateTime;
use Bitrix\Catalog\GroupTable;
use Bitrix\Catalog\PriceTable;
use Bitrix\Iblock\ElementTable;


while (@ob_end_flush()) ;

if (!Loader::includeModule('iblock') || !Loader::includeModule('catalog')) {
    die('Error loading module iblock or catalog');
}
$APPLICATION->SetTitle("Новый раздел");
$count=0;
$time_st=time();
function parse_proj($adress)
{
//$adress="/realizovannye-proekty/asfaltobetonnye-zavody-bernardi-italiya/asfalto-betonnyy-zavod-bernardi-mic125-e220-proizvoditelnost-180-t-ch-tyumenskaya-obl-may-2014-goda/#ankor";
global $count;
++$count;
//    if()
$SITE = "https://www.korrus.ru";
// echo '</br>'."Hello ". $SITE.$adress .'</br>';


$str = file_get_contents($SITE.$adress);
$pq = phpQuery::newDocument($str);


$h2 = $pq->find('div.col-xs-12 > h2');

// var_dump(iconv('windows-1251', 'UTF-8', $h2->html()));

$h2 = iconv('windows-1251', 'UTF-8', $h2->html());
//echo '</br>';

$elems = $pq->find('a[rel="gallery1"]');
$h2=strip_tags($h2);
$arFields = Array(
    "IBLOCK_ID" => 8,
    "NAME" => strip_tags($h2),
    "SORT" => 999,
    "CODE" => CUtil::translit($h2,'ru'),
    "PROPERTY_VALUES" =>[
        "MORE_PHOTO"=>[],
        ],
    "ACTIVITY" => "N",
);
$arExplode=explode(" ",$h2);
$len=0;
$i=0;
$tem_h2="";
foreach ($arExplode as $item){
    ++$i;
    $len+=strlen($item);
    if($len>100){
        $len-=strlen($item);
        break;
    }
    else{
        $tem_h2=$tem_h2.$item;
    }
}
$h2=$tem_h2;
$bs=new CIBlockElement();
foreach ($elems as $elem) {
    // echo '</br>';
    $pqElem = pq($elem);
    // var_dump($pqElem->attr('href'));
    $url_image=$SITE.$pqElem->attr('href');
    echo '</br>%%% '. $url_image;
    $arFields ["PROPERTY_VALUES" ]["MORE_PHOTO"] []= CFile::MakeFileArray($url_image);
}
$bs->Add($arFields);
echo '</br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!';
echo $bs->LAST_ERROR;
echo '</br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!';

}

//function main(){
    $SITE = "https://www.korrus.ru";
    $PAGINATION="?PAGEN_1=";

    $str = file_get_contents("https://www.korrus.ru/realizovannye-proekty/");
    $pq = phpQuery::newDocument($str);


    $elems = $pq->find('.item a');


    foreach ($elems as $elem) {
       // echo '</br>';
        $pqElem = pq($elem);
       // $pqElem->remove('img');
       // var_dump($pqElem->attr('href'));
       // echo '</br>';
     //   var_dump($pqElem->text());
        $href = $pqElem->attr('href');

        $str = file_get_contents("https://www.korrus.ru".$href);
        $pq = phpQuery::newDocument($str);
//        $pq->remove('li.bx-pag-next');
        $elems = $pq->find('div.bx-pagination-container.row > ul li a span');
        echo '</br>'."Check pagination".'</br>';
//        var_dump();
        if(count($elems)>0){
            $arPages=[];
            foreach ($elems as $elem) {
               // echo '</br>';
                $pqElem = pq($elem);
                if($pqElem->text()!="Вперед "){
//                    var_dump((int)$pqElem->text());
                    $arPages[]=(int)$pqElem->text();
                }
            }
            $maxPage=intval($arPages[count($arPages)-2]);
            echo '</br>'."Max pages all: ".$maxPage;

            for($i=1; $i<= $maxPage;++$i){
                $clearHref=explode('#ankor',  $href);

                if($i!=1)  $hrefList=$SITE.$clearHref[0].$PAGINATION.$i;
                else $hrefList=$SITE.$clearHref[0];
                echo '</br>Page: ';
                var_dump($hrefList);
                echo '</br>';
                $str = file_get_contents($hrefList);
                $pq = phpQuery::newDocument($str);

                $elems = $pq->find('.item a');

                foreach ($elems as $elem) {
                    echo '</br>';
                    $pqElem = pq($elem);
                    // $pqElem->remove('img');
                    var_dump($pqElem->attr('href'));
//                    echo '</br>';
//                    var_dump($pqElem->text());
                    $href_elem = $pqElem->attr('href');
                    parse_proj( $href_elem);
                }
            }
        }
        else{
            $clearHref=explode('#ankor',$href);
            $hrefList=$SITE.$clearHref[0];

            echo '</br>Page: ';
            var_dump($hrefList);
            echo '</br>';

            $str = file_get_contents($hrefList);
            $pq = phpQuery::newDocument($str);

            $elems = $pq->find('.item a');

            foreach ($elems as $elem) {
                echo '</br>';
                $pqElem = pq($elem);
                // $pqElem->remove('img');
                var_dump($pqElem->attr('href'));
//                    echo '</br>';
//                    var_dump($pqElem->text());
                $href_elem = $pqElem->attr('href');
                parse_proj( $href_elem);
            }
        }

    }

    echo '</br>';
    echo "######################################## Total=".$count. " Time: ". (time()-$time_st);
    echo '</br>';
//}

?>
    Test<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>**