<?php
require './src/vendor/autoload.php';

use Api\App;

$app=new App($_POST);
switch ($_POST['type']) {
    case 'create':
        $app->sendMail();
        break;
    case 'check':
       $app->getLetters();
        break;
    case 'webhook':
        $app->webhook();
        break;
    default:
        break;
}
