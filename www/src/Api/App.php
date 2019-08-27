<?php

namespace Api;

use PHPMailer\PHPMailer\PHPMailer;
use stdClass;

class App
{
    private $email;
    private $searchSubject;
    private $searchEmail;

    public function __construct($post)
    {
        $this->email = $post['data']['email'];
        $this->password = $post['data']['password'];
        $this->subject = $post['data']['subject'];
        $this->searchEmail = $post['data']['searchEmail'];
        $this->searchSubject=$post['data']['searchSubject'];
        $this->webhook=$post['data']['webhook'];
    }

    public function sendMail()
    {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.yandex.ru';
        $mail->SMTPAuth = true;
        $mail->Username = explode('@',$this->email)[0];
        $mail->Password = $this->password;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom($this->email);
        $mail->addAddress($this->email);

        $mail->isHTML(true);
        $mail->Subject = $this->subject;
        $code=random_int(1000,9999);
        $cardNumber=random_int(1000,9999);
        $mail->Body = "<p><span name='code'>$code</span> Ваш одноразовый код для подтверждения операции c карты ****<span name='card'>$cardNumber</span> </p>";
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Success sanded letter'.PHP_EOL;
        }
    }

    public function getLetters()
    {
        $connect_imap = imap_open("{imap.yandex.ru:993/imap/ssl}INBOX",
            $this->email,
            $this->password
        ) or die("Error:" . imap_last_error());

        $mails = imap_search($connect_imap, 'NEW');

        $res=[];

        if ($mails) {
            foreach ($mails as $num_mail) {
                $header = imap_header($connect_imap, $num_mail);
                $mail_from = $header->sender[0]->mailbox . "@" . $header->sender[0]->host;
                $subject = imap_mime_header_decode( $header->subject)[0]->text;

                if($this->searchEmail===$mail_from  && preg_match("/$this->searchSubject/u",$subject))
                {
                    echo "От кого: $mail_from <br/>";

                    echo "Тема письма: $subject <br/>";
                    $text_mail = imap_fetchbody($connect_imap, $num_mail, 1);
                    echo "Тело письма: $text_mail <br/>";
                    $match=[];
                    preg_match("/<span name='code'>(\d{4})<\/span>.*<span name='card'>(\d{4})<\/span>/",$text_mail,$match);
                    echo "Результат парсинга: одноразовый $match[1] и номер карты $match[2] <br/>";
                    echo "<hr/>";

                    $res[]=[
                        'code'=>$match[1],
                        'cardNumber'=>$match[2]
                        ];
                }
            }
        } else {
            echo "Нет новых писем";
        }
        imap_close($connect_imap);
        return $res;
    }
    public  function  webhook()
    {
        $this->sendMail();
        $arData=$this->getLetters();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->webhook);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arData));
        $output = curl_exec($ch);
        echo 'Ответ сервера'.PHP_EOL;
        var_dump(json_decode($output));
        curl_close($ch);
    }

}