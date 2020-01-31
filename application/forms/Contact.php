<?php

class Application_Form_Contact extends Zend_Form
{

    public function init()
    {
        $this->setAttrib('enctype','multipart/form-data');

        $email = new Zend_Form_Element_Text('email',[
            'label'=>'Email:',
            'required'=>true,
        ]);
        $email->addValidator('NotEmpty',true,[
            'messages'=>[
                'isEmpty'=>'Введите email',
            ]
        ])->addValidator('EmailAddress',true,[
        '   messages'=>[
                'emailAddressInvalidFormat'=>'Введите корректный email',
            ]
        ]);

        $text = new Zend_Form_Element_Textarea('message',[
            'label'=>'Сообщение:',
            'required'=>true,
        ]);
        $text->addValidator('NotEmpty',true,[
            'messages'=>[
                'isEmpty'=>'Введите сообщение',
            ]
        ]);

        $file = new Zend_Form_Element_File('file',[
            'label'=>'Файл расширения jpg',
            'destination'=>'files',
        ]);
        $file->addValidator('Extension',true,[
            'extension'=>'jpg',
            'messages'=>[
                'fileExtensionFalse'=>'Загрузить можно только jpeg',
            ]
        ]);

        $submit = new Zend_Form_Element_Submit('submit',[
            'label'=>'Отправить'
        ]);

        $arEl=[$email,$text,$file,$submit];

        $this->addElements($arEl);
    }


}

