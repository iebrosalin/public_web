<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Main/load.php');

use App\Main\Helper as Helper;
use App\Main\Ajax as Ajax;

//echo json_encode($_FILES);
switch ($_POST ['type']) {
    case 'htmlCapture':
        $resExplode = explode('.', $_FILES['file-images'] ['name']);
        $_FILES['file-images'] ['name'] = Helper::translit($resExplode[0]) . '.' . strtolower($resExplode[1]);

        $res = Ajax::detectFaces($_FILES['file-images'] ['tmp_name'], $_POST ['type'], $_FILES['file-images'] ['name']);
        $send = [
            'src' => $res['src'],
            'countFaces' => $res['countFaces'],
        ];
        echo json_encode($send);
        break;
    case'snapshotFaceDetect':
    case'snapshotFaceDetectHidden':
        // Extract base64 file for standard data
//        $fileBin = file_get_contents($_POST['data']);
//        $mimeType = mime_content_type($_POST['data']);
//
    // Check allowed mime type
        $data=$_POST['data'];
        if(preg_match('/^data:image\/(\w+);base64,/', $data, $type)){
            $data = substr($data, strpos($data, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }

            $data = base64_decode($data);

            if ($data === false) {
                throw new \Exception('base64_decode failed');
            }
        }
        else {
            throw new \Exception('did not match data URI with image data');
        }
    $name = time() . '.' . $type;
    $path = $_SERVER['DOCUMENT_ROOT'] . '/results/tmp/' . $name;
file_put_contents($path , $data);

//$fileBin=str_replace('data:'.$mimeType.';base64,', '', $fileBin);

// $fid=fopen($path,'wb');
// fclose($fid);
//file_put_contents($path, base64_decode($_POST['data']));
$res = Ajax::detectFaces($path, $_POST ['type'], $name);
$send = [
    'src' => $res['src'],
    'countFaces' => $res['countFaces'],
    '$mimeType' => $_FILES,
];
echo json_encode($send);
break;
}
die();