<?php 
session_start();
require_once("../../config.php");

$user = $_SESSION['user'];
$address = $_SESSION['address'];
$token_num = $_POST['tn'];


$jiekou = "/api/recharge/";
$userurl = urlencode($user);
$url = $fuwuduan.$jiekou."?ac=$address&value=$token_num";
$html = file_get_contents($url);

echo "<script type='text/javascript'>alert('充值成功！');</script>";
echo "<script>window.location.href='http://yunji.inpluslab.com/my/recharge_token/';</script>"
// if ($err==null)
// 	require_once("ok.php");
// else
// 	header('Location: /404'); 
?>
 