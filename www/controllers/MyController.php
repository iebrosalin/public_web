<?php


namespace app\controllers;


use yii\web\Controller;

class MyController extends AppController
{
    public function actionIndex($id=null){
        $hi="Hello World!";
        $names=['Ivanov','Petrov','Sidorov'];
        //return $this->render('index',['hello'=>$hi,'names'=>$names]);
        return $this->render('index',compact('hi','names','id'));
    }
    public function actionLogPost($id=null){
        return 'Log post';
    }
}