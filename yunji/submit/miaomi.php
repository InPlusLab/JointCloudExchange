<?php
session_start();
require_once("../config.php");

$str="";

$user = $_SESSION['user'];
$address = $_SESSION['address'];
$cname = $_POST['cname'];
$cpu = $_POST['cpu'];
$password = $_POST['password'];
$tape = $_POST['tape'];
$ip = $_POST['ip'];
$value = $_POST['value'];

//转url
$user = urlencode($user);
$cname = urlencode($cname);
$cpu = urlencode($cpu);
$password = urlencode($password);
$tape = urlencode($tape);
$ip = urlencode($ip);
$value = urlencode($value);

//计算md5
$md5 = md5($cname.$password);

$jiekou = "/api/addCloud/" ;
$url = $fuwuduan.$jiekou."?ac=$address&uname=$user&bandwidth=$tape&cpu=$cpu&ip=$ip&hash=$md5&value=$value";
$html = file_get_contents($url);
$hash = json_decode($html)->hash;
$err = json_decode($html)->err;

if ($err==null)
	require_once("ok.php");
else
	header('Location: /404'); 
?>