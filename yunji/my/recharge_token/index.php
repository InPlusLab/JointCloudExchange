<?php 
  session_start();
  if (!isset($_SESSION['user']))
    header('Location: /login/'); 


  require_once("../../config.php");

  $user = $_SESSION['user'];
  $address = $_SESSION['address'];

  $jiekou = "/api/getUserInfo" ;
  $url = $fuwuduan.$jiekou."?address=$address";
  $html = file_get_contents($url);
  $userinfo = json_decode($html);

  // $copyRightNum = $userinfo->all;
  // $transfer = $userinfo->txcount;
  $yue = $userinfo->balance;
  // $buy = $userinfo->buy;
  // $upload = $userinfo->upload;

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
<title>云际 | 充值Token</title>

<?php require_once("../../lianjie.php") ?>

<body class="cms-index-index cms-home-page">

<div id="page"> 
  
<?php require_once("../../dingbu.php") ?>  
<?php require_once("../../daohang.php") ?>
<section class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <?php $active="recharge_token"; require_once("../aside.php"); ?>

        <div class="col-main col-sm-9 col-xs-12">
          <div class="my-account">
            <div class="page-title">
              <h2>充值Token</h2>
            </div>
            <form action="miaomi.php" method="post" enctype="multipart/form-data">
              <div class="row" >
                <div class="col-sm-6">

                  <div class="contact-form-box">
                    <div class="form-selector">
                      <label>充值Token数：</label>
                      <input type="token_num" class="form-control input-sm" name="tn">
                    </div>
                    <br>
                    <div class="form-selector">
                      <button type="submit" class="button"><i class="fa fa-send"></i>&nbsp; <span>充值</span></button>
                      &nbsp; <a href="/my/recharge_token/" class="button">清空</a> 
                      </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
</section>
<?php require_once("../../dibu.php") ?>


</body>
</html>
     
