<?php session_start();
  if (!isset($_SESSION['user']))
    header('Location: /login/'); 


  require_once("../../config.php");
  $user = $_SESSION['user'];
  $address = $_SESSION['address'];

  $jiekou = "/api/getUserTx" ;
  $url = $fuwuduan.$jiekou."?address=$address";
  $html = file_get_contents($url);
  $txSet = json_decode($html);

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
        <?php $active="token"; require_once("../aside.php"); ?>

        <div class="col-main col-sm-9 col-xs-12">
          <div class="my-account">
            <div class="page-title">
              <h2>我的Token</h2>
            </div>
            <div class="panel panel-default" style="margin-top:15px;">
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
                            方向
                        </th>
                        <th>
                            对方地址
                        </th>
                        <th>
                            数量
                        </th>
                    </tr>
                  </thead>
                  <tbody ui-sref="app.xiangxi">
                   <?php 
                    for ($i=count($txSet)-1;$i>=0;$i--) {
                      //txSet.push([result.args.time, result.args.from, result.args.to, result.args.cid, result.args.value, result.args.ctype, result.args.remark]);
                      if ($txSet[$i][0]==$address && $txSet[$i][1]!=$address ) {
                         $time = date("Y-m-d H:i:s",$txSet[$i][5]);
                         $duifang = $txSet[$i][1];
                         $tvalue = $txSet[$i][4];
                         echo 
                         "<tr>
                              <td><a href>$time</a></td>
                              <td><span class='label bg-danger' title='Active'>流入</span></td>
                              <td>$duifang</td>
                              <td>$tvalue YWC</td>
                         </tr>";
                      }
                      if ($txSet[$i][0]!=$address && $txSet[$i][1]==$address ) {
                         $time = date("Y-m-d H:i:s",$txSet[$i][5]);
                         $duifang = $txSet[$i][0];
                         $tvalue = $txSet[$i][4];
                         echo 
                         "<tr>
                              <td><a href>$time</a></td>
                              <td><span class='label bg-success' title='Active'>流出</span></td>
                              <td>$duifang</td>
                              <td>$tvalue YWC</td>
                         </tr>";
                      }
                      if ($txSet[$i][0]==$address && $txSet[$i][1]==$address ) {
                         $time = date("Y-m-d H:i:s",$txSet[$i][5]);
                         $duifang = $txSet[$i][2];
                         $tvalue = $txSet[$i][4];
                         echo 
                         "<tr>
                              <td><a href>$time</a></td>
                              <td><span class='label bg-warning' title='Active'>自己</span></td>
                              <td>自己</td>
                              <td>$tvalue YWC</td>
                         </tr>";
                      }

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
