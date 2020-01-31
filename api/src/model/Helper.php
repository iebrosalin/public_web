<?php
/**
 * Created by PhpStorm.
 * User: Akva
 * Date: 14.04.2019
 * Time: 13:04
 */

namespace Model;


class Helper extends AbsModel
{
    public static function generateUsers()
    {

        $db = self::getConnection();
        $password=password_hash("12345678", PASSWORD_DEFAULT);
        for ($i = 0; $i != 100; ++$i) {
            $user='user'.$i;
            $name='User'.$i;
            $soname='UserSoname'.$i;
            $sql=<<<QUERY
                INSERT INTO users
                    (id, login, password, role, name, `soname`, burthday, gender)
                VALUES (NULL, :login, :password, 'user', :uname, :UserSoname, '2019-12-11', 'F')
QUERY;

            $result = $db->prepare($sql);
            $result->bindParam(':login', $user, \PDO::PARAM_STR);
            $result->bindParam(':password', $password, \PDO::PARAM_STR);
            $result->bindParam(':uname', $name, \PDO::PARAM_STR);
            $result->bindParam(':UserSoname',$soname , \PDO::PARAM_STR);

            $result->execute();
        }
    }

    public static function generateAdmin()
    {

        $db = self::getConnection();
        $password=password_hash("12345678", PASSWORD_DEFAULT);
            $user='admin';
            $name='Admin_Name';
            $soname='Admin_Soname';
            $sql=<<<QUERY
                INSERT INTO users
                    (id, login, password, role, name, `soname`, burthday, gender)
                VALUES (NULL, :login, :password, 'admin', :uname, :UserSoname, '2019-12-11', 'F')
QUERY;

            $result = $db->prepare($sql);
            $result->bindParam(':login', $user, \PDO::PARAM_STR);
            $result->bindParam(':password', $password, \PDO::PARAM_STR);
            $result->bindParam(':uname', $name, \PDO::PARAM_STR);
            $result->bindParam(':UserSoname',$soname , \PDO::PARAM_STR);

            $result->execute();
    }

    public static function sanitize($string)
    {
        return htmlspecialchars(strip_tags($string));
    }

    public static function p($data){
        file_put_contents('log.txt', print_r($data,true));
    }

    public static function sendMail($code){
        // Create the Transport
        $transport = (new \Swift_SmtpTransport('smtp.yandex.ru', 465,'ssl'))
            ->setUsername('1111@yandex.ru')
            ->setPassword('11111')
        ;

        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        // Create a message
        $message = (new \Swift_Message('Authentication'))
            ->setFrom(['11111@yandex.ru' => 'Admin'])
            ->setTo(['11111@yandex.ru'])
            ->setBody('Code for authentication '.$code)
        ;
        // Send the message
        $result = $mailer->send($message);
    }

    public  static function jsonError( $sMessage ) {
        $arRes = array(
            'status'  => 'error',
            'message' => $sMessage
        );
        echo json_encode( $arRes );
        die();
    }
}