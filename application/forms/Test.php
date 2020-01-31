<?php

class Application_Form_Test extends Zend_Form
{
    public $elDecorator=[
        'ViewHelper',
        'Errors',
        ['HtmlTag',['tag'=>'div','class'=>'element']],
        ['label',['tag'=>'div']],
        [ ['row'=>'HtmlTag'],['tag'=>'div','class'=>'hz']],
    ];
    public $butDecorator=[
        'ViewHelper',
        ['HtmlTag',['tag'=>'div','class'=>'element']],
        [ ['row'=>'HtmlTag'],['tag'=>'div','class'=>'hz']],
    ];
    public function init()
    {
//        $this->setMethod('POST');
//        $this->setAction
        $text=new Zend_Form_Element_Text('text');
//        $text->setDecorators([
//           'ViewHelper',
//            'Errors',
//            ['HtmlTag',['tag'=>'div','class'=>'element']],
//            ['label',['tag'=>'div']],
//            [ ['row'=>'HtmlTag'],['tag'=>'div','class'=>'hz']],
//        ]);
        //$text->setDecorators($this->elDecorator);
        $text->setLabel('text:')->setRequired(true)
            ->addValidator('NotEmpty',true,[
                'messages'=>[
                    'isEmpty'=>'Empty !'
                ]
            ])
            ->addValidator('StringLength',true,[
                'min' => 10,
                'max' => 20,
                'messages'=>[
                    'stringLengthTooShort'=>'Длина введённого значения %value% меньше чем %min% символов',
                    'stringLengthTooLong'=>'Длина введённого значения %value% больше чем %max% символов'
                ],
            ]);

//        $validator =new Zend_Validate_NotEmpty();
//        $validator->setMessages([
//            'isEmpty'=>'Заполните плиз поле',
//        ]);
//        $text->addValidator($validator);
        //$this->addElement($text);

        $textarea = new Zend_Form_Element_Textarea('textarea');
        $textarea->setLabel('textarea');
        $textarea->setAttribs([
            'cols'=>30,
            'rows'=>10,
            ]);
        //$this->addElement($textarea);

        $textarea=new Zend_Form_Element_Textarea('textarea2',[
            'label'=>'textarea2',
            'attribs'=>[
                'cols'=>20,
                'rows'=>20,
            ]
        ]);
       // $textarea->setDecorators($this->elDecorator);
        //$this->addElement($textarea);

        $password=new Zend_Form_Element_Password('password',[
            'label'=>'password',
        ]);
        //$password->setDecorators($this->elDecorator);
        //$this->addElement($password);

        $hidden=new Zend_Form_Element_Hidden('hidden',[
            'value'=>'hi',
        ]);
        //$this->addElement($hidden);


        $checkbox=new Zend_Form_Element_Checkbox('checkbox',[
            'label'=>'checkbox',
            'checked'=>true,
        ]);
        //$checkbox->setDecorators($this->elDecorator);
        //$this->addElement($checkbox);


        $multiCheckbox=new Zend_Form_Element_MultiCheckbox('multiCheckbox',[
            'label'=>'MultiCheckbox',
//            'checked'=>true,
        ]);
        $multiCheckbox->addMultiOptions([
            '1'=>"Ch1",
            '2'=> "Ch2",
            '3'=> "Ch3",
            '4'=> "Ch4"
        ]);
        $multiCheckbox->setValue(['1','3']);
        //$multiCheckbox->setDecorators($this->elDecorator);
        //$this->addElement($multiCheckbox);


        $radio=new Zend_Form_Element_Radio('radio',[
            'label'=>'Radio',
//            'checked'=>true,
        ]);
        $radio->addMultiOptions([
            '1'=>"Ch1",
            '2'=> "Ch2",
            '3'=> "Ch3",
            '4'=> "Ch4"
        ]);
        $radio->setValue(['1'])->setSeparator('<h1>fuck</h1>');
        //$radio->setDecorators($this->elDecorator);
        //$this->addElement($multiCheckbox);



        $select=new Zend_Form_Element_Select('select',[
            'label'=>'select',
//            'checked'=>true,
        ]);
        $select->addMultiOptions([
            '1'=>"Ch1",
            '2'=> "Ch2",
            '3'=> "Ch3",
            '4'=> "Ch4"
        ]);
        $select->setValue(['2']);
        //$select->setDecorators($this->elDecorator);
        //$this->addElement($multiCheckbox);

        $multiSelect=new Zend_Form_Element_MultiSelect('multiSelect',[
            'label'=>'multiSelect',
//            'checked'=>true,
        ]);
        $multiSelect->addMultiOptions([
            '1'=>"Ch1",
            '2'=> "Ch2",
            '3'=> "Ch3",
            '4'=> "Ch4"
        ]);
        $multiSelect->setValue(['2','1']);
        //$multiSelect->setDecorators($this->elDecorator);


        $file=new Zend_Form_Element_File('file');
        $file->setLabel('File')->setDestination('uploads');
        //$file->setDecorators($this->butDecorator);


        $button=new Zend_Form_Element_Button('button',[
            'label'=>'button',
//            'checked'=>true,
        ]);
        //$button->setDecorators($this->butDecorator);


        $reset=new Zend_Form_Element_Reset('reset',[
            'label'=>'reset',
//            'checked'=>true,
        ]);
        //$reset->setDecorators($this->butDecorator);

        $submit=new Zend_Form_Element_Submit('submit',[
            'label'=>'submit',
//            'checked'=>true,
        ]);
        //$submit->setDecorators($this->butDecorator);

//        $this->setDecorators([
//            'FormElements',
//            [
//                'HtmlTag',
//                [
//                    'tag'=>'div',
//                    'class'=>'form',
//                    'attr'=> 'ex',
//                ]
//            ]
//        ]);
        $this->setDecorators([
            ['ViewScript',
                [
                    'viewScript'=>'myform.phtml',
                ]
            ]
        ]);
        $els=[
            $text, $textarea, $password, $hidden,
            $checkbox, $multiCheckbox, $radio, $select,
            $multiSelect, $file,$button,$reset,$submit,
        ];

        foreach($els as $el){
            $el->removeDecorator('Label');
            $el->removeDecorator('HtmlTag');
            $el->removeDecorator('DtDdwrapper');
            $el->removeDecorator('Description');
            $el->removeDecorator('Errors');
        }
        $this->addElements($els);
    }


}

