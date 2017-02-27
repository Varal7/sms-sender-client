<?php
//Do not keep in PROD
$authorized_tokens = [
      '710b20a3f20e1176e7f5f955cea40ca3',
      '716beb46827c628ae1fe394f3b8713a9',
      'd651ee28abd78ffe4fcec190afa09458',
      '02b82b5f386b53057eaec3736c72a071'
  ];

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

if ((!isset($_GET['token'])) || (!in_array($_GET['token'], $authorized_tokens))){
  http_response_code(403);
} else {
    if ((!isset($_POST['message'])) || (!isset($_POST['number'])) ) {
      $number = $_GET['number'];
      $message = $_GET['message'];
    } else {
      $number = $_POST['number'];
      $message = $_POST['message'];
    }
    $url = 'http://10.8.0.8/sms.php';
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
