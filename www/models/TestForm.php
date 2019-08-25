<?php


namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class TestForm extends  ActiveRecord
{
//    public $name;
//    public $text;
//    public $email;

public  static  function tableName()
{
    return 'posts';
}

    public function attributeLabels()
    {
        return [
            'name'=>'Имя',
            'email'=>'E-mail',
            'text'=>'Текст сообщения'
        ];
    }

    public function rules()
    {
        return [
//          [['name','email'],'required','message'=>'Поле обязательно'],
          [['name','email'],'required'],
            ['email','email'],
//            ['name','string','min'=>2, 'tooShort'=>'Мало символов'],
//            ['name','string','max'=>5, 'tooLong'=>'Много символов'],
        ['name','string','length'=>[2,5]],
            //Можно и свои валидаторы писать!
//            ['name','myRule'],
            ['text','trim'],
//            ['text','safe']

        ];
    }

//    public  function  myRule($attributes)
//    {
//        if(!in_array($this->$attributes,['hello','world']))
//        {
//            $this->addError($attributes,'Wrong!!');
//        }
//    }
}