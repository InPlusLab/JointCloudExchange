<?php 
session_start();
require_once("../config.php");

$user = $_POST['user'];
$pwd = $_POST['pwd'];


$jiekou = "/api/check/";
$userurl = urlencode($user);
$url = $fuwuduan.$jiekou."?&name=$userurl&password=$pwd";
$html = file_get_contents($url);
$err = json_decode($html)->err;
$msg = json_decode($html)->msg;


if ($err==0) {
	$_SESSION['user']=$user;
	$_SESSION['address']=$msg;
	header('Location: /my/overview'); 
}
else {
	echo '<script type="text/javascript">alert("用户名或密码错误！"); location.href="/login/"; </script> ';
}



 ?> 