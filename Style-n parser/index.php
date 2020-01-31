<?php

require 'vendor/autoload.php';
require_once 'help.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use  PhpOffice\PhpSpreadsheet\IOFactory;

function prepare(){
//    $res=scandir('content/');
    $spreadsheet = IOFactory::load("content/homewear.xlsx");
    $sheet = $spreadsheet->getActiveSheet();
    $res=$sheet->toArray();
//    $html=file_get_contents('http://stile-n.ru/products/plate-001a-10-56-66rr');
//    preg_match_all('#<p class="values">(.+?)</p></li>#su',$html, $res);
    _p($res);
}
echo file_get_contents('http://stile-n.ru/products/bryuki-18-611-56-66rr');
//prepare();

//require_once ('vendor/autoload.php');
//
//use PHPHtmlParser\Dom;брюки
//$url = "http://stile-n.ru/products/plate-001a-10-56-66rr";
//$curl = curl_init($url);
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //Записать http ответ в переменную, а не выводить в буфер
//$page = curl_exec($curl);
//    $dom = new Dom;
//
//    $dom->load($page);
//    $contents = $dom->find('p');
//    echo count($contents);
//require_once ("include/simple_html_dom.php");

//$html = file_get_html('http://stile-n.ru/products/plate-001a-10-56-66rr');
//foreach($html->find('p') as $element)
//    echo $element->class . '<br>';
//$dom = new DOMDocument;
//$dom->loadHTML(file_get_contents('http://stile-n.ru/products/plate-001a-10-56-66rr'));
//$images = $dom->getElementsByTagName('p');
//foreach ($images as $image) {
//    var_dump($image);
//}


//require_once ('vendor/autoload.php');
//Получаем http страницу:


//foreach($doc->find('.articles-container .post-excerpt') as $article){
//$article = pq($article);
//$pq=phpQuery::newDocument(file_get_contents('http://stile-n.ru/products/plate-001a-10-56-66rr'));
////    foreach($pq->find('.values') as $elem){
////    $elem=pq($elem);}
////}
//
//var_dump(pq('body')->find('p.values'));


//$dom = new DOMDocument;
//$dom->loadHTML(file_get_contents('http://stile-n.ru/products/plate-001a-10-56-66rr'));
//var_dump($dom->firstChild(""));
////$str=file_get_contents('http://stile-n.ru/products/plate-001a-10-56-66rr');
//$data = str_get_html($page);
//// $data->dump();
//if($data->innertext!='' and count($data->find('a'))){
//    foreach($data->find('a') as $a){
//        echo '<a href="http://xdan.ru/'.$a->href.'">'.$a->plaintext.'</a></br>';
//    }
//}

//$html= file_get_html('http://stile-n.ru/products/plate-001a-10-56-66rr');
//foreach($html->find('.values') as $element)
//    var_dump( $element);
//$arr=$html->find('div');
//var_dump($arr);
//echo file_get_contents('http://stile-n.ru/products/plate-001a-10-56-66rr');
//$xml=new SimpleXMLElement(file_get_contents('http://stile-n.ru/products/plate-001a-10-56-66rr'));
//var_dump($xml);
