<?php session_start();
  if (!isset($_SESSION['user']))
    header('Location: /login/'); 


  require_once("../../config.php");

  $user = $_SESSION['user'];
  $address = $_SESSION['address'];

  $jiekou = "/api/getUserBuy" ;
  $url = $fuwuduan.$jiekou."?address=$address";
  $html = file_get_contents($url);
  $cloudSet = json_decode($html);

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
<title>云际 | 个人中心</title>

<?php require_once("../../lianjie.php") ?>

<body class="cms-index-index cms-home-page">
     



<div id="page"> 
  
<?php require_once("../../dingbu.php") ?>  
<?php require_once("../../daohang.php") ?>
  
<section class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <?php $active="cloud_buy"; require_once("../aside.php"); ?>
        <div class="col-main col-sm-9 col-xs-12">
          <div class="my-account">
            <div class="page-title">
              <h2>购买的云资源</h2>
            </div>
            <div class="wishlist-item table-responsive">
              <table class="col-md-12">
                <thead>
                  <tr>
                    <th>购买时间</th>
                    <th>云资源ID</th>
                    <th class="th-total th-add-to-cart">详情</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                for ($i=count($cloudSet)-1;$i>=0;--$i) {
                  $cid = $cloudSet[$i][1][2];
                  $time = date("Y-m-d H:i:s",$cloudSet[$i][1][5]);
                  $jsonstr = $cloudSet[$i][0][2];
                  $owner_address = $cloudSet[$i][0][3];
                  $owner_name = $cloudSet[$i][0][4];
		  if($cid != 0) {
$jsoninfo = json_decode($jsonstr);

               

                    echo '
                      <tr>
                        <td>'.$time.'</td>
                        <td>'.$cid.'</td>
                        <th class="td-add-to-cart"><a href="/art/detail?'.$cid.'"> 查看详情</a></th>
                      </tr>
                    ';

}
                                   }

                 ?>
              </table>
          </div>
        </div>

      </div>
    </div>
</section>

<?php require_once("../../dibu.php") ?>


</body>
</html>
