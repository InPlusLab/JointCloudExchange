<?php session_start();
  if (!isset($_SESSION['user']))
    header('Location: /login/'); 


  require_once("../../config.php");
  $user = $_SESSION['user'];
  $address = $_SESSION['address'];

  $jiekou = "/api/getUserBlocktx" ;
  $url = $fuwuduan.$jiekou."?address=$address";
  $html = file_get_contents($url);
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
<title>云际 | 个人中心</title>

<?php require_once("../../lianjie.php") ?>

<body class="cms-index-index cms-home-page">
     



<div id="page"> 
  
<?php require_once("../../dingbu.php") ?>  
<?php require_once("../../daohang.php") ?>
  
<section class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <?php $active="transaction"; require_once("../aside.php"); ?>

        <div class="col-main col-sm-9 col-xs-12">
          <div class="my-account">
            <div class="page-title">
              <h2>相关区块链交易</h2>
            </div>
            <div class="panel panel-default" style="margin-top:15px;">
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
                              <td><span class='label bg-light' title='Active'>$gas</span></td>
                         </tr>";
                    }

                   ?>
                  </tbody>
                <tfoot class="hide-if-no-paging">
                  <tr>
                      <td colspan="5" class="text-center footable-visible">
                          <ul class="pagination"><li class="footable-page-arrow disabled"><a data-page="first" href="#first">«</a></li><li class="footable-page-arrow disabled"><a data-page="prev" href="#prev">‹</a></li><li class="footable-page active"><a data-page="0" href="#">1</a></li><li class="footable-page"><a data-page="1" href="#">2</a></li><li class="footable-page"><a data-page="2" href="#">3</a></li><li class="footable-page-arrow"><a data-page="next" href="#next">›</a></li><li class="footable-page-arrow"><a data-page="last" href="#last">»</a></li></ul>
                      </td>
                  </tr>
                </tfoot>
                </table>
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
