<?php session_start();
  require_once("../../config.php");

  $jiekou = "/api/getclouds" ;
  $url = $fuwuduan.$jiekou;
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
<title>云际 | 云资源</title>

<?php require_once("../../lianjie.php") ?>

<body class="cms-index-index cms-home-page">
     



<div id="page"> 
  
<?php require_once("../../dingbu.php") ?>  
<?php require_once("../../daohang.php") ?>
  
  <section class="blog_post">
    <div class="container"> 
      
    
        <div class="blog-wrapper">
      
          <div class="page-title">
            <h2>所有云资源</h2>
          </div>
          <ul class="blog-posts">  

                <?php 
                for ($i=count($cloudSet)-1;$i>=0;--$i) {
                  $cid = $cloudSet[$i][0];
                  $ctime = date("Y-m-d",$cloudSet[$i][1]);
                  $jsonstr = $cloudSet[$i][2];
                  $owner_address = $cloudSet[$i][3];
                  $owner_name = $cloudSet[$i][4];

                  $jsoninfo = json_decode($jsonstr);

                  $bandwidth = $jsoninfo->bandwidth;
                  $cpu = $jsoninfo->cpu;
                  $ip = $jsoninfo->ip;
                  $hash = $jsoninfo->hash;

                    echo '
                      <li class="post-item col-lg-4">
                        <article class="entry"> 
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="entry-thumb image-hover2"> <a href="/art/detail?'.$cid.'"> <figure><img src="fuwuqi.jpg" alt="Blog" width="340px" height="191px"></figure> </a> </div>
                            </div>
                            <div class="col-sm-12">
                          
                                <h3 class="entry-title"><a href="/art/detail?'.$cid.'">'.$cpu.' 核心 云主机'.'</a></h3>
                                <div class="entry-meta-data"> <span class="author"> <i class="fa fa-user"></i>&nbsp; by: <a href="#">'.$owner_name.'</a></span>  <span class="comment-count"> <i class="fa fa-comment"></i>&nbsp; '.$bandwidth.' </span> <span class="date"><i class="fa fa-calendar"></i>&nbsp; '.$ctime.'</span> </div>
                                <div class="rating">'.$owner_address.'</div>
                                
                                <div class="entry-excerpt">'.$cid.'</div>
                                <div class="entry-more"> <a href="/art/detail?'.$cid.'" class="button">查看详情&nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
                          
                            </div>
                          </div>
                        </article>
                      </li>
                    ';
                  }

                 ?>
          </ul>
          <div class="sortPagiBar"><div class="pagination-area" style="visibility: visible;">

          </div>
            
          </div>
        </div>
   
    </div>
  </section>

<?php require_once("../../dibu.php") ?>


</body>
</html>
