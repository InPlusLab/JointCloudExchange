<?php
session_start();
if (!isset($_SESSION['user']))
	header('Location: /login/'); 


require_once("../../config.php");

$str=$_SERVER['QUERY_STRING'];

$toaddress = $_SESSION['address'];


$jiekou = "/api/getUserInfo/" ;
$url = $fuwuduan.$jiekou."?address=$toaddress";
$html = file_get_contents($url);
$balance = json_decode($html)->balance;
if ($balance<10)
	header('Location: /nomoney'); 

//?funame=zpl&cname=aaa&ctype=1&tvalue=10
$jiekou = "/api/addTx/" ;
$url = $fuwuduan.$jiekou."?".$str."&address=$toaddress";
$html = file_get_contents($url);
$hash = json_decode($html)->hash;
$err = json_decode($html)->err;

if ($err==null)
	require_once("ok.php");
else
	header('Location: /404'); 
?>