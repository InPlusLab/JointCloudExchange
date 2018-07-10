<?php session_start();
  require_once("../../config.php");

  $miaomi = $_SERVER['QUERY_STRING'];

  $jiekou = "/api/getcloud" ;
  $url = $fuwuduan.$jiekou."?cid=$miaomi";
  $html = file_get_contents($url);
  $cloud = json_decode($html);

  if (count($cloud)==0) {
    header('Location: /notfound/'); 
    return;
  }


    $cid = $cloud[0];
    $ctime = date("Y-m-d H:i:s",$cloud[1]);
    $jsoninfostr = $cloud[2];
    $owner_address = $cloud[3];
    $owner_name = $cloud[4];

    $jsoninfo = json_decode($jsoninfostr);

    $bandwidth = $jsoninfo->bandwidth;
    $cpu = $jsoninfo->cpu;
    $ip = $jsoninfo->ip;
    $hash = $jsoninfo->hash;

    $tu0=$tu1=$tu2=$tu3="../list/fuwuqi.jpg"
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
<title>云际 | 云资源</title>

<?php require_once("../../lianjie.php") ?>

<body class="cms-index-index cms-home-page">
     



<div id="page"> 
  
<?php require_once("../../dingbu.php") ?>  
<?php require_once("../../daohang.php") ?>
  
<div class="main-container col1-layout">
  <div class="container">
    <div class="row">
      <div class="col-main">
        <div class="product-view-area">
          <div class="container">
            <div class="product-big-image col-xs-5">
              <div class="large-image"> <a href="../list/fuwuqi.jpg" class="cloud-zoom" id="zoom1" rel="useWrapper: false, adjustY:0, adjustX:20" style="position: relative; display: block;"> <img class="zoom-img" src="../list/fuwuqi.jpg" alt="products" style="display: block; visibility: visible;"> </a> </div>
              <div class="flexslider flexslider-thumb">
                
              <div class="flex-viewport" style="overflow: hidden; position: relative;"><ul class="previews-list slides" style="width: 800%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
                  <li style="width: 100px; float: left; display: block;"><a href="../list/fuwuqi.jpg" class="cloud-zoom-gallery" rel="useZoom: 'zoom1', smallImage: '../list/fuwuqi.jpg' "><img src="../list/fuwuqi.jpg" alt="Thumbnail 2" draggable="false"></a></li>
                  <li style="width: 100px; float: left; display: block;"><a href="../list/fuwuqi.jpg" class="cloud-zoom-gallery" rel="useZoom: 'zoom1', smallImage: '../list/fuwuqi.jpg' "><img src="../list/fuwuqi.jpg" alt="Thumbnail 2" draggable="false"></a></li>
                  <li style="width: 100px; float: left; display: block;"><a href="../list/fuwuqi.jpg" class="cloud-zoom-gallery" rel="useZoom: 'zoom1', smallImage: '../list/fuwuqi.jpg' "><img src="../list/fuwuqi.jpg" alt="Thumbnail 2" draggable="false"></a></li>
                  <li style="width: 100px; float: left; display: block;"><a href="../list/fuwuqi.jpg" class="cloud-zoom-gallery" rel="useZoom: 'zoom1', smallImage: '../list/fuwuqi.jpg' "><img src="../list/fuwuqi.jpg" alt="Thumbnail 2" draggable="false"></a></li>
                </ul></div><ul class="flex-direction-nav"><li><a class="flex-prev flex-disabled" href="#" tabindex="-1"></a></li><li><a class="flex-next" href="#"></a></li></ul></div>
              
              <!-- end: more-images --> 
              
            </div>
            <div class="col-xs-7 product-details-area">
         
                <div class="product-name">
                  <h1><?php echo $cid; ?></h1>
                </div>
                <div class="price-box">
                  <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> 10 YJC </span> </p>
                </div>
                <div class="ratings">
                  <p class="rating-links">发布者：<?php echo $owner_name; ?></p><br>
                  <p class="rating-links">云资源ID：<?php echo $cid; ?></p><br>
                  <p class="rating-links">描述MD5：<?php echo $hash; ?></p>
                  <p class="availability in-stock">状态: <span>在售</span></p>
                </div>
                <div class="short-description">
                  <h2>云资源带宽</h2>
                  <p><?php echo $bandwidth; ?></p>
                </div>
                <div class="short-description">
                  <h2>云资源CPU</h2>
                  <p><?php echo $cpu; ?>(核)</p>
                </div>

                <div class="short-description">
                  <h2>云资源IP</h2>
                  <p><?php echo $ip; ?></p>
                </div>

                <div class="product-variation" style="border: none;">
                  <form action="miaomi.php?cid=<?php echo $cid; ?>&ctype=1&tvalue=10" method="post">
                    <button class="button pro-add-to-cart" title="10 YJC" type="submit" style="margin-right:5px;"><span><i class="fa fa-shopping-cart"></i> 购买</span></button>
                  </form>
                </div>

            </div>
          </div>
        </div>
      </div>
      <div class="product-overview-tab">
        <div class="container">
          <div class="row">
            <div class="col-xs-12"><div class="product-tab-inner"> 
              <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                <li class="active"> <a href="#description" data-toggle="tab"> 资源描述 </a> </li>                
                <li> <a href="#reviews" data-toggle="tab">资源评论</a> </li>
                 <li><a href="#product_tags" data-toggle="tab">流转溯源</a></li>
              </ul>
              <div id="productTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  <div class="std">
                    <div class="ratings">
                      <p class="rating-links">发布者：<?php echo $owner_name; ?></p>
                      <p class="rating-links">发布者地址：<?php echo $owner_address; ?></p>
                      <p class="rating-links">资源ID：<?php echo $cid; ?></p>
                      <p class="rating-links">云资源带宽：<?php echo $bandwidth; ?></p>
                      <p class="rating-links">云资源CPU：<?php echo $cpu; ?></p>
                      <p class="rating-links">云资源IP：<?php echo $ip; ?></p>                    
                      <p class="availability in-stock">状态: <span>在售</span></p>
                    </div>
                  </div>
                </div>
                
                
                  <div id="reviews" class="tab-pane fade">
              <div class="col-sm-7 col-lg-7 col-md-7">
                <div class="reviews-content-right">
                  <h2>资源评论</h2>
                  <form>
                    <h4>为资源星级评分<em>*</em></h4>
                                        <div class="table-responsive reviews-table">
                    <table>
                      <tbody><tr>
                        <th></th>
                        <th>1星</th>
                        <th>2星</th>
                        <th>3星</th>
                        <th>4星</th>
                        <th>5星</th>
                      </tr>
                      <tr>
                        <td>质量</td>
                        <td><input type="radio"></td>
                        <td><input type="radio"></td>
                        <td><input type="radio"></td>
                        <td><input type="radio"></td>
                        <td><input type="radio"></td>
                      </tr>
                      <tr>
                        <td>价格</td>
                        <td><input type="radio"></td>
                        <td><input type="radio"></td>
                        <td><input type="radio"></td>
                        <td><input type="radio"></td>
                        <td><input type="radio"></td>
                      </tr>
                      <tr>
                        <td>发布者</td>
                        <td><input type="radio"></td>
                        <td><input type="radio"></td>
                        <td><input type="radio"></td>
                        <td><input type="radio"></td>
                        <td><input type="radio"></td>
                      </tr>
                    </tbody></table></div>
                    <div class="form-area">
                      <div class="form-element">
                        <label>匿名评价 <em>*</em></label>
                        <input type="text">
                      </div>
                      <div class="form-element">
                        <label>内容 <em>*</em></label>
                        <textarea></textarea>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            
                <div class="tab-pane fade" id="product_tags">
                  <div class="box-collateral box-tags">
                    <div class="tags">
                                
<?php 
  $jiekou = "/api/gettxs/" ;
  $url = $fuwuduan.$jiekou;
  $html = file_get_contents($url);
  $tokenTX = json_decode($html);
 ?>
                      <div class="panel panel-default" style="margin:15px;">
                        <div class="panel-heading">
                          流转溯源
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
                                      授权类型
                                  </th>
                              </tr>
                            </thead>
                            <tbody ui-sref="app.xiangxi">
                             <?php 
                              for ($i=count($tokenTX)-1;$i>=0;$i--) {
                                //版权与token相反
                                 $thiscid = $tokenTX[$i][2];
                                 if($thiscid!=$cid)
                                   continue;
                                 $time = date("Y-m-d H:i:s",$tokenTX[$i][5]);
                                 $from = $tokenTX[$i][1];
                                 $to = $tokenTX[$i][0];

                                 $tvalue = intval($tokenTX[$i][4]);
                                 $ctype = intval($tokenTX[$i][3]);
                                 $ctypestr = ctype2str($ctype);
                                   echo 
                                   "<tr>
                                        <td>$time</td>
                                        <td>$to</td>
                                        <td>$from</td>
                                        <td>$tvalue YJC</td>
                                        <td><span class='label bg-primary' title='Active'>$ctypestr</span></td>
                                   </tr>";
                              }
                               echo 
                               "<tr>
                                    <td>$ctime</td>
                                    <td>联盟链参与方：云际节点</td>
                                    <td>$owner_address</td>
                                    <td>100 YJC</td>
                                    <td><span class='label bg-warning' title='Active'>上传奖励</span></td>
                               </tr>";
                             ?>
                            </tbody>

                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div></div>
        </div>
      </div>
    
      
      

      
      
      
    </div>
  </div>
</div>

<?php require_once("../../dibu.php") ?>


</div>

<!--cloud-zoom js --> 
<script type="text/javascript" src="/js/cloud-zoom.js"></script> 


</body>
</html>
