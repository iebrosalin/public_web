<?php
//Код для получения контента страница и регулярное выражение для вытаскивания значения из тегов
file_get_contents('http://stile-n.ru/products/plate-001a-10-56-66rr');
preg_match_all('#<p class="values">(.+?)</p></li>#su',$html, $res);