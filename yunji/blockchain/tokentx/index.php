<?php session_start(); ?>
<?php 
	require_once("../../config.php");

	$jiekou = "/api/gettxs/" ;
	$url = $fuwuduan.$jiekou;
	$html = file_get_contents($url);
	$tokenTX = json_decode($html);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Basic page needs -->
<meta charset="utf-8">
<!--[if IE]>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <![endif]-->
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>云际 | 区块链</title>

<?php require_once("../../lianjie.php") ?>

<body class="cms-index-index cms-home-page">
     



<div id="page"> 
  
<?php require_once("../../dingbu.php") ?>  
<?php require_once("../../daohang.php") ?>
  
  <section class="blog_post">
    <div class="container"> 
      
    
       
        <!-- Center colunm-->
        <div class="blog-wrapper">
      
			<div class="page-title">
				<h2>区块链</h2>
			</div>
			<div class="panel panel-default" style="margin:15px;">
				<div class="panel-heading">
				  Token交易
				</div>

				<div>
				  <table class="table m-b-none" ui-jq="footable" data-filter="#filter" data-page-size="5">
				    <thead>
				      <tr>
				          <th>
				              时间
				          </th>
				          <th>
				              流出方
				          </th>
				          <th>
				              流入方
				          </th>
				          <th>
				              数量
				          </th>
				          <th>
				              资源ID
				          </th>
				          <!-- <th>
				              授权类型
				          </th> -->
				      </tr>
				    </thead>
				    <tbody ui-sref="app.xiangxi">
				     <?php 
				     	for ($i=count($tokenTX)-1;$i>=0;$i--) {
				     		//资源与token方向相反
				     	   $time = date("Y-m-d H:i:s",$tokenTX[$i][5]);
				     	   $from = $tokenTX[$i][1];
				     	   $to = $tokenTX[$i][0];
				     	   $cid = $tokenTX[$i][2];
				     	   $tvalue = intval($tokenTX[$i][4]);
				     	   // $ctype = intval($tokenTX[$i][3]);
				     	   // $ctype = ctype2str($ctype);
if($cid == 0) {
echo 
				           "<tr>
				                <td>$time</td>
				                <td>充值</td>
				                <td>$from</td>
				                <td>$tvalue YJC</td>
				                <td>$cid</td>
				           </tr>";

}
else {
echo 
				           "<tr>
				                <td>$time</td>
				                <td>$to</td>
				                <td>$from</td>
				                <td>$tvalue YJC</td>
				                <td>$cid</td>
				           </tr>";
}
				           
				     	}

				     ?>
				    </tbody>
				  </table>
				</div>
			</div>
            
          </div>
        </div>
        <!-- ./ Center colunm --> 
   
    </div>
  </section>

<?php require_once("../../dibu.php") ?>


</body>
</html>
