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

  $copyRightNum = $userinfo->all;
  $transfer = $userinfo->txcount;
  $yue = $userinfo->balance;
  $buy = $userinfo->buy;
  $upload = $userinfo->upload;

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
        <?php $active="overview"; require_once("../aside.php"); ?>

        <div class="col-main col-sm-9 col-xs-12">
          <div class="my-account">
            <div class="page-title">
              <h2>账户概览</h2>
            </div>
            <div class="row" style="margin-top:15px; margin-right:5px;">

              <div class="col-md-8">
                  <div class="row row-sm text-center">

                    <div class="col-xs-6">
                      <div class="panel padder-v item" style="background:#45ea26;">
                        <div class="font-thin h1"><?php echo $yue; ?></div>
                        <span class="">账户余额</span>
                        <div class="bottom text-left">
                          <i class="fa fa-caret-up text-warning m-l-sm"></i>
                        </div>
                      </div>
                    </div>

                    <div class="col-xs-6">
                      <div class="panel padder-v item" style="background:#f6f8f8;">
                        <div class="font-thin h1"><?php echo $transfer; ?></div>
                        <span class="">交易次数</span>
                        <div class="bottom text-left">
                          <i class="fa fa-caret-up text-warning m-l-sm"></i>
                        </div>
                      </div>
                    </div>

                    <div class="col-xs-6">
                      <div class="panel padder-v item" style="background:#f6f8f8;">
                        <div class="font-thin h1"><?php echo $upload; ?></div>
                        <span class="">发布云资源</span>
                        <div class="bottom text-left">
                          <i class="fa fa-caret-up text-warning m-l-sm"></i>
                        </div>
                      </div>
                    </div>

                    <div class="col-xs-6">
                      <div class="panel padder-v item" style="background:#f6f8f8;">
                        <div class="font-thin h1"><?php echo $buy; ?></div>
                        <span class="">购买云资源</span>
                        <div class="bottom text-left">
                          <i class="fa fa-caret-up text-warning m-l-sm"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 m-b-md">
                      <div class="panel padder-v item" style="background:#f6f8f8;">
                        <div class="font-thin h1"><?php echo $copyRightNum; ?></div>
                        <span class="">总云资源数</span>
                        <div class="bottom text-left">
                          <i class="fa fa-caret-up text-warning m-l-sm"></i>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-md-4" style="background:#f6f8f8; height:315px;">
                <div class="wow bounceInUp" data-wow-delay="0.2s">
                  <div class="team">
                    <div class="inner">
                    <?php $shortaddress=shortaddress($address);
                          $img = "/images/team-img0".addressmod4($address).".jpg";
                     ?>
                      <div class="avatar"><img src=<?php echo '"'.$img.'"'; ?> alt="" class="img-responsive img-circle"></div>
                      <center>
                        <h5><?php echo $user; ?></h5>
                        <p class="subtitle"><?php echo $shortaddress ?>...</p>
                      </center>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
</section>

<?php require_once("../../dibu.php") ?>


</body>
</html>
