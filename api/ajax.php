<?
session_start();
require_once("vendor/autoload.php");

switch($_POST['type']){
    case 'login':
        \Controller\User::login($_POST);
        break;
    case 'auth':
        \Controller\User::auth($_POST);
        break;
    case 'pagination':
        \Controller\User::pagination($_POST);
        break;
    case 'userDetail':
        \Controller\User::userDetail($_POST);
        break;
    case 'userEdit':
        \Controller\User::userEdit($_POST);
        break;
    case 'userDelete':
        \Controller\User::userDelete($_POST);
        break;
    default:
}