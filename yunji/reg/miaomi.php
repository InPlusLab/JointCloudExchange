<?php 
session_start();
require_once("../config.php");

$user = $_POST['user'];
$pwd = $_POST['pwd'];

$jiekou = "/api/signup/newAddress" ;
$url = $fuwuduan.$jiekou;
$html = file_get_contents($url);
$address = json_decode($html)->result;

$jiekou = "/api/signup/newAccount";
$userurl = urlencode($user);
$url = $fuwuduan.$jiekou."?address=$address&name=$userurl&password=$pwd";
$html = file_get_contents($url);

if ($html!="err") {
	$_SESSION['user'] = $user;
	$_SESSION['address'] = $address;
	sleep(3);
	header('Location: /my/overview'); 
}
else {
	echo '<script type="text/javascript">alert("已存在该用户!"); location.href="/reg/";</script> ';
}



 ?>

