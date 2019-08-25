<?php


namespace app\controllers;


use yii\web\Controller;

class AppController extends Controller
{
    public function ebug($attr)
    {
        echo '<pre>'.print_r($attr,true).'</pre>';
    }
}

