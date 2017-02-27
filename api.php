<?php
require('./tokens.php');

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

$url = 'http://10.8.0.8/sms.php';
$number = "+33600000000";
$message = "Hello";
$token = "0";

if (isset($_GET['token'])) { $token = $_GET['token'];}
if (isset($_GET['message'])) { $message = $_GET['message'];}
if (isset($_GET['number'])) { $number = $_GET['number'];}
if (isset($_POST['token'])) { $token = $_POST['token'];}
if (isset($_POST['message'])) { $message = $_POST['message'];}
if (isset($_POST['number'])) { $number = $_POST['number'];}

if (!in_array($token, $authorized_tokens)){
  http_response_code(403);
} else {
    $data = array('number' => $number, 'message' => $message);
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { http_response_code(500); }
    else {
      echo $result;
    }
}
 ?>
