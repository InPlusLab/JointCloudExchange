<?php session_start(); ?>
<?php 
	require_once("../../config.php");

	$jiekou = "/api/getblocktxs/" ;
	$url = $fuwuduan.$jiekou;
	$html = file_get_contents($url);
	//echo $html;
	$blockTx = json_decode($html);

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
				  区块链交易
				</div>

				<div>
				  <table class="table m-b-none" ui-jq="footable" data-filter="#filter" data-page-size="5">
				    <thead>
				      <tr>
				          <th data-toggle="true">
				              高度
				          </th>
				          <th>
				              时间
				          </th>
				          <th data-hide="phone,tablet">
				              哈希值
				          </th>
				          <th data-hide="phone,tablet" data-name="Date Of Birth">
				              来源
				          </th>
				          <th data-hide="phone">
				              Gas
				          </th>
				      </tr>
				    </thead>
				    <tbody ui-sref="app.xiangxi">
				     <?php 
				     	for ($i=count($blockTx)-1;$i>=0;$i--) {
				     	   $miaomi = $blockTx[$i];

				     	   $height = $miaomi->height;
				     	   $time = date("Y-m-d H:i:s",$miaomi->time);
				     	   $hash = $miaomi->hash;
				     	   $from = $miaomi->from;
				     	   $gas = $miaomi->gas;

				     	   
				           echo 
				           "<tr>
				                <td><a href>$height</a></td>
				                <td><a href>$time</a></td>
				                <td>$hash</td>
				                <td>$from</td>
				                <td><span class='label bg-light' title='Active'>$gas</span></td>
				           </tr>";
				     	}

				     ?>
				    </tbody>
				  </table>
				</div>
			</div>
            
        </div>
        <!-- ./ Center colunm --> 
   
    </div>
  </section>

<?php require_once("../../dibu.php") ?>


</body>
</html>
