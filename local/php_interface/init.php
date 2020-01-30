<?

define("SHOW_SCHEDULE", 3);
define("SHOW_COURSE_TEACHER", 3);
define("LEN_TITLE_COURSE_SCHEDULE", 21);
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");
define("ERROR_MESSAGE_BITRIX_FAIL",'Упс! Что-то пошло не так. Отправьте ваше сообщение ещё раз.');
function p( $data, $bAdminOnly = false ) {
    global $USER;
    if ( ! $bAdminOnly || $USER->IsAdmin() ) {
        echo "<pre>";
        print_r( $data );
        echo "</pre>";
    }
}
define('MONTHS', [
    'Нулевой',
    'Января',
    'Февраля',
    'Марта',
    'Апреля',
    'Мая',
    'Июня',
    'Июля',
    'Августа',
    'Сентября',
    'Октября',
    'Ноября',
    'Декабря',
]);
define('LAST_DAY', [
    0,
    31,
    28,
    31,
    30,
    31,
    30,
    31,
    31,
    30,
    31,
    30,
    31,
]);
function strTokDot($text,$len){

    return (strlen($text)>$len)?(substr($text, 0, $len) . '...'):$text;
};
function p_f( $data, $type = "w+", $file = "data.txt" ) {
    $fp = fopen( $_SERVER["DOCUMENT_ROOT"] . '/' . $file, $type );
    ob_start();

    print_r( $data );

    $out = ob_get_clean();
    fwrite( $fp, $out );
    fclose( $fp );
}
function humanBytes($size) {
    $filesizename = array(" байт", " кб", " Мб", " Гб");
    return $size ? round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i] : '0 Bytes';
}
// Check AJAX-request
function isAjax() {
    $isAjax = false;
    if (
        isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )
        && ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] )
        && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest'
    ) {
        $isAjax = true;
    }

    return $isAjax;
}

// echo json error message
function jsonError( $sMessage ) {
    $arRes = array(
        'status'  => 'ERROR',
        'message' => $sMessage
    );
    echo json_encode( $arRes );
    die();
}

function nextDateSchedule($item, $flagNextDate=false){

    $arDate = explode('.', explode(' ',  $item['DATE_ACTIVE_TO'])[0]);
    $d = intval($arDate[0]);
    $m = intval($arDate[1]);
    $y = intval($arDate[2]);
    if(date('Y', time()) != $y ){

            if (LAST_DAY[$m] == $d) {
                if ($m == 1) {
                    if (date('L', time())) {
                        $d = LAST_DAY[$m + 1] + 1;
                        ++$m;
                    }
                    else{
                        $d = LAST_DAY[$m + 1] ;
                        ++$m;
                    }
                } else if ($m == 12) {
                    $d = LAST_DAY[1];
                    $m = 1;
                    ++$y;
                } else {
                    $d = LAST_DAY[$m + 1];
                    ++$m;
                }

            } else {
                if ($m == 12) {
                    $m = 1;
                    ++$y;
                }
                else if($m == 1){
                    if($d>=28 && $d<=31){
                        if (date('L', time())) {
                            $d = LAST_DAY[$m + 1] + 1;
                            ++$m;
                        }
                        else{
                            $d = LAST_DAY[$m + 1] ;
                            ++$m;
                        }
                    }
                    else{
                        ++$m;
                    }
                }
                else {
                    ++$m;
                }
            }

    }
    else {
        if ( date('n', time()) != $m  || $flagNextDate) {

            if (LAST_DAY[$m] == $d) {
                if ($m == 1) {
                    if (date('L', time())) {
                        $d = LAST_DAY[$m + 1] + 1;
                        ++$m;
                    }
                    else{
                        $d = LAST_DAY[$m + 1] ;
                        ++$m;
                    }
                } else if ($m == 12) {
                    $d = LAST_DAY[1];
                    $m = 1;
                    ++$y;
                } else {
                    $d = LAST_DAY[$m + 1];
                    ++$m;
                }

            } else {
                if ($m == 12) {
                    $m = 1;
                    ++$y;
                }
                else if($m == 1){
                    if($d>=28 && $d<=31){
                        if (date('L', time())) {
                            $d = LAST_DAY[$m + 1] + 1;
                            ++$m;
                        }
                        else{
                            $d = LAST_DAY[$m + 1] ;
                            ++$m;
                        }
                    }
                    else{
                        ++$m;
                    }
                }
                else {
                    ++$m;
                }
            }
        }
    }
    $res=intval($d).'.'.strval($m).'.'.strval($y);
    return $res;
}
function cmp_date($a, $b)
{

    if ($a['DATE_ACTIVE_TO'] == $b['DATE_ACTIVE_TO']) {
        return 0;
    }
    return (strtotime($a['DATE_ACTIVE_TO']) < strtotime($b['DATE_ACTIVE_TO'])) ? -1 : 1;
}
function sortSchedule(&$ar){
    usort(  $ar, "cmp_date");
}


function repeatSchedule(&$arItem, $flag=false){

    //$res=[];
    $resT=[];
    // for ($i = 0; $i != count($arItem); ++$i) {
    //     if ($arItem [$i]['PROPERTIES'] ['REPEAT'] ['VALUE'] == 'Y') {

    //         $res []=$arItem [$i];
    //         $firstRepeat=count($res )-1;
    //         $res  [$firstRepeat] ['DATE_ACTIVE_TO']  = nextDateSchedule(['DATE_ACTIVE_TO'=>$arItem[$i] ['DATE_ACTIVE_TO']], $flag);

    //         $res  []=$arItem[$i];
    //         $res [count($res)-1] ['DATE_ACTIVE_TO'] =nextDateSchedule(['DATE_ACTIVE_TO'=>$res  [$firstRepeat] ['DATE_ACTIVE_TO']],$flag);
    //     }
    // }
    foreach ($arItem as $item) {
    	if ($item['PROPERTIES'] ['REPEAT'] ['VALUE'] == 'Y') {

	    	$resT[]=$item;
	    	$resT[count($resT)-1] ['DATE_ACTIVE_TO']  = nextDateSchedule(['DATE_ACTIVE_TO'=>$item ['DATE_ACTIVE_TO']], $flag);
	    	$prevDate= $resT[count($resT)-1] ['DATE_ACTIVE_TO'];
	    	$resT[]=$item;
	    	$resT[count($resT)-1] ['DATE_ACTIVE_TO']  = nextDateSchedule(['DATE_ACTIVE_TO'=>$prevDate], $flag);
	    }
    }
    //p_f($resT);
    return $resT;
}

function existImage($src){
    return (null==CFile::GetPath($src))?SITE_TEMPLATE_PATH."/img/image/empty.jpg":CFile::GetPath($src);
}
function existImageFile($src){
//    define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");
//    AddMessage2Log($src, "my_module_id");
//    clearstatcache();
    //return (false==file_exists($src))?SITE_TEMPLATE_PATH."/img/image/empty.jpg":$src;
    if($src!=null)
        return (false==file_exists($_SERVER["DOCUMENT_ROOT"].$src))?SITE_TEMPLATE_PATH."/img/image/empty.jpg":$src;
    else
    return SITE_TEMPLATE_PATH."/img/image/empty.jpg";
}

function checkForm($arr)
{
    global $APPLICATION;
    foreach ($arr as $key => $value) {
        switch ($key) {
            case 'name':
                if (preg_match('/^[А-ЯёЁйЙа-яA-Za-z ]{2,100}$/u', $value) === null || preg_match('/^[А-ЯёЁйЙа-яA-Za-z]{2,50}$/u', $value) === false) {

                    $APPLICATION->RestartBuffer();
                    jsonError('Представтесь пожалуйста.');
                    return true;
                }
                break;
            case 'phone':
                if (strlen(htmlspecialcharsEx($value)) != 17) {
                    $APPLICATION->RestartBuffer();
                    jsonError('Некорректный номер телефона.');
                    return true;
                }
                break;
            case 'feedback_text':
                if (strlen(htmlspecialcharsEx($value)) < 70) {
                    $APPLICATION->RestartBuffer();
                    jsonError('Минимальное число символов в сообщении 70.');
                    return true;
                }
                if (strlen(htmlspecialcharsEx($value)) > 3000) {
                    $APPLICATION->RestartBuffer();
                    jsonError('Максимальное число символов в сообщении 3000.');
                    return true;
                }
                break;
            case 'email':
                if (preg_match('/^[0-9a-z-\.]+\@[0-9a-z-]{2,}\.[a-z]{2,}$/i', $value) === 0 || preg_match('/^[0-9a-z-\.]+\@[0-9a-z-]{2,}\.[a-z]{2,}$/i', $value) === false) {
                    $APPLICATION->RestartBuffer();
                    jsonError('Возможно вы ввели неверный emai');
                    return true;
                }
                break;
            case 'review':

                if (strlen(htmlspecialcharsEx($value)) < 70) {
                    $APPLICATION->RestartBuffer();
                    jsonError('Минимальное число символов в сообщении 70.');
                    return true;
                }
                if (strlen(htmlspecialcharsEx($value)) > 3000) {
                    $APPLICATION->RestartBuffer();
                    jsonError('Максимальное число символов в сообщении 3000.');
                    return true;
                }
                break;
        }
        $value = htmlspecialcharsEx($value);
    }
    return false;
}
require_once __DIR__.'/include/PHPMailer/src/Exception.php';
require_once  __DIR__.'/include/PHPMailer/src/PHPMailer.php';
require_once  __DIR__.'/include/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use Bitrix\Main\Diag\Debug;


/*
Отправляем почту через SMTP-сервер .
@see CEvent::HandleEvent()
@see bxmail()
@param string $to Адрес получателя.
@param string $subject Тема.
@param string $message Текст сообщения.
@param string $additionalHeaders
Дополнительные заголовки передаются Битриксом почти всегда ("FROM" передаётся здесь).
@return bool
*/
function custom_mail($to, $subject, $message, $additionalHeaders = '', $additional_parameters='')
{


//    Debug::writeToFile([
//        '$to'=>$to,
//        '$subject'=>$subject,
//        '$message'=>$message,
//        '$additionalHeaders'=>$additionalHeaders,
//        '$additional_parameters'=>$additional_parameters,
//        'clean'=>cleanBitrixMailMessage($message),
//    ],
//        '','');

    $mail = new PHPMailer;
    //логирование ошибок (0 - не выводить)
    $mail->SMTPDebug = 0;
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.yandex.ru'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'Person@yandex.ru'; // SMTP username
    $mail->Password = 'password2019'; // SMTP password
    $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465; // port to connect to

   // $d_message='';
    preg_match('/From: (.+)\n/i', $additionalHeaders, $matches);
    list(, $from) = $matches;
   // $from='Person@yandex.ru';
//    $d_message.='$from - '.$from.' +++ '; $d_message.='$to - '.$to.' +++ ';
//    $d_message.='$subject - '.$subject.' +++ ';
//    $d_message.='$message - '.$message.' +++ ';
    $mail->setFrom($from, '');
    $mail->addAddress($to, ''); // Add a recipient

    //$mail->addReplyTo($from, '');
//    $mail->addCC('mail2@mail.ru');
//    $mail->AddBCC('mail3@xmail.ru');
    // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name
    // $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = strip_tags($message);

    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    Debug::writeToFile([
        'clean'=>$mail->Body,
    ],
        '','');
    // log_message
    $addLOG='To: '.$to.PHP_EOL. 'Subject: '.$subject.PHP_EOL. 'Message: '.$message.PHP_EOL. 'Headers: '.$additionalHeaders.PHP_EOL. 'Params: '.$additional_parameters.PHP_EOL;
   // file_put_contents(__DIR__.'/include/PHPMailer/emailMessage.txt', $addLOG);
    if(!$mail->send()) {
        // log error
        //file_put_contents(__DIR__.'/include/PHPMailer/emailError.txt', 'Mailer Error: ' . $d_message.' '.$mail->ErrorInfo);
        return false;
    } else {
        return true;
    }
}
