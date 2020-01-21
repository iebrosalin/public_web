<?php


namespace app\controllers;


use app\models\Category;
use Yii;
use app\models\TestForm;
use yii\db\Exception;

class DemoController extends AppController
{
    public $layout='basic';

//    public function beforeAction($action)
//    {
////        if($action->id==='index')
////        {
////            $this->enableCsrfValidation=false;
////        }
//        return parent::beforeAction($action);
//    }

    public function actionShow()
    {
        $this->view->title='Show all demo';
        $this->view->registerMetaTag(['name'=>'description','content'=>"Create page"]);
        $this->layout='basic';

        /**
         * Удаление, редактирование, сохранение данных из базы
         */

        //       $post=TestForm::findOne(1);
//        $post->email='2@2.com';
//        $post->save();
//        $post->delete();
//        TestForm::deleteAll(['>','id',3]);

        /**
         * Выборка категорий
         */

//        $cats= Category::find()->asArray()->where('parent=691')->orderBy(['id'=>SORT_DESC])->all();
//        $cats= Category::find()->asArray()->where( ['parent'=>691])->orderBy(['id'=>SORT_DESC])->all();
//        $cats= Category::find()->asArray()->where( ['like','title','pp'])->orderBy(['id'=>SORT_DESC])->all();
//        $cats= Category::find()->asArray()->where( ['<=','id','691'])->orderBy(['id'=>SORT_DESC])->all();
//        $cats= Category::find()->asArray()->where( ['<=','id','695'])->orderBy(['id'=>SORT_DESC])->limit(1)->all();
//        $cats= Category::find()->asArray()->where( ['<=','id','695'])->orderBy(['id'=>SORT_DESC])->one();
//        $cats= Category::find()->asArray()->where( ['<=','id','695'])->orderBy(['id'=>SORT_DESC])->count();
//        $cats= Category::findOne(['parent'=>691]);
//        $cats= Category::findAll(['parent'=>691]);

//        $query= <<<SQL
// select * from categories where parent=691
//SQL;
//        $cats= Category::findBySql($query)->asArray()->all();

//        $query= <<<SQL
// select * from categories where parent=:search
//SQL;
//        $cats= Category::findBySql($query,[':search'=>691])->asArray()->all();

//        $cats= Category::findOne('694');
//        $cats=$cats->products;

//        $cats= Category::find()->all();
//        foreach ($cats as $k=>$v)
//        {
//            $cats[$k]=$v->products;
//        }




        try {
            $cats= Category::find()->all();
        } catch (Exception $error) {
            if(count(checkExistDb()) === 0){
                importDefaultDb();
                $cats= Category::find()->all();
            }
        }


        return $this->render('show',compact('cats'));
    }
    public function actionIndex()
    {

        $model=new TestForm();

        if($model->load(Yii::$app->request->post()))
        {
            if($model->save())
            {
                Yii::$app->session->setFlash('success','Success');
                return $this->refresh();
            }
            else
            {
                Yii::$app->session->setFlash('error','Error');
            }
        }

        return $this->render('test_form',compact('model'));    }

    public function actionDemoAjax()
    {
        if (Yii::$app->request->isAjax) {
            return "Demo ajax";
        }
    }
}