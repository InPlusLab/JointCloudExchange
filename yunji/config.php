<?php 
$fuwuduan = "http://localhost:8889";
date_default_timezone_set("PRC");

function shortaddress($address) {
	return substr($address,0,30)."...";
}

function tooshortaddress($address) {
	return substr($address,0,10)."...";
}

function addressmod4($address) {
	return intval(substr($address,6,2))%4+1;
}

function ctype2str($ctype) {
	if ($ctype==1)
		return "一次性使用权";
	else if ($ctype==2)
		return "衍生品开发权";
	else if ($ctype==3)
		return "出版传播权";
	else
		return "其他权限";
}
?>