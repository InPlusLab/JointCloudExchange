<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Basic page needs -->
<meta charset="utf-8">
<!--[if IE]>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <![endif]-->
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>云际 | 用户登录</title>

<?php require_once("../lianjie.php") ?>

<body class="cms-index-index cms-home-page">
     



<div id="page"> 
  
<?php require_once("../dingbu.php") ?>  
<?php require_once("../daohang.php") ?>
  
<section class="main-container col1-layout">
    <div class="main container">
      <div class="row">
        <section class="col-main col-sm-12">
          
          <div id="contact" class="page-content page-contact">
          <div class="page-title">
            <h2>用户登录</h2>
          </div>
            <form id="form1" name="form1" method="post" action="miaomi.php"> 
	            <div class="row">
					<div class="col-sm-6">

						<div class="contact-form-box">
						  <div class="form-selector">
						    <label>用户名</label>
						    <input type="text" class="form-control input-sm" name="user">
						  </div>
						  
						  <div class="form-selector">
						    <label>密码</label>
						    <input type="password" class="form-control input-sm" name="pwd">
						  </div>
						  
						  <div class="form-selector">
						    <button type="submit" class="button"><i class="fa fa-send"></i>&nbsp; <span>登录</span></button>
						    &nbsp; <a href="/reg/" class="button">注册</a> </div>
						</div>
					</div>
					<div class="col-sm-6">
						<center><img src="/img/reg.png" width="80%"/></center>
					</div>
	            </div>
	        </form>
          </div>
        </section>
      </div>
    </div>
  </section>
      
    </div>
  </div>
  <!-- Container End -->


<?php require_once("../dibu.php") ?>


</body>
</html>
