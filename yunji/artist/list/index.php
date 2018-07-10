<?php session_start(); ?>

<?php 
require_once("../../config.php");

$jiekou = "/api/getusers" ;
$url = $fuwuduan.$jiekou;
$html = file_get_contents($url);
$list = json_decode($html);

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
<title>云际 | 发布者</title>

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
        <h2>所有发布者</h2>
      </div>
      <div class="our-team" style="margin-left:15px; margin-right:15px;">
        <div class="row">
        <?php 
        for ($i=0;$i<count($list);++$i) {
          $name = $list[$i][0];
          $address = $list[$i][1];
          $touxiang = addressmod4($address);
          $xianshi = substr($address,0,30);
          echo '
            <div class="col-xs-6 col-sm-3 col-md-3" style="margin-bottom:15px;">
              <div class="wow bounceInUp" data-wow-delay="0.2s">
                <div class="team">
                  <div class="inner">
                    <div class="avatar"><img src="/images/team-img0'.$touxiang.'.jpg" alt="" class="img-responsive img-circle" /></div>
                    <h5>'.$name.'</h5>
                    <p class="subtitle">'.$xianshi.'...</p>
                  </div>
                </div>
              </div>
            </div>';
        }

         ?>

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
