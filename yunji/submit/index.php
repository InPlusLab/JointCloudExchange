<?php 
	session_start();
	if (!isset($_SESSION['user']))
		header('Location: /login/'); 
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
<title>云际 | 提交云资源</title>

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
            <h2>提交资源 ( 用户:<?php echo $_SESSION['user']; ?> )</h2>
          </div>
            <form action="miaomi.php" method="post" enctype="multipart/form-data">
	            <div class="row" >
					<div class="col-sm-6">

						<div class="contact-form-box">
						  <div class="form-selector">
						    <label>用户名</label>
						    <input type="text" class="form-control input-sm" name="cname">
						  </div>
						  <div class="form-selector">
						    <label>CPU数</label>
						    <input type="text" class="form-control input-sm" name="cpu">
						  </div>
							<div class="form-selector">
						    <label>密码</label>
						    <input type="password" class="form-control input-sm" name="password">
						  </div>
						  <div class="form-selector">
						    <button type="submit" class="button"><i class="fa fa-send"></i>&nbsp; <span>提交</span></button>
						    &nbsp; <a href="/submit/" class="button">清空</a> 
								</div>
								
						</div>
					</div>
					<div class="col-sm-6">

						<div class="contact-form-box">
						  <div class="form-selector">
						    <label>带宽</label>
						    <input type="text" class="form-control input-sm" name="tape">
						  </div>
							<div class="form-selector">
						    <label>IP地址</label>
						    <input type="text" class="form-control input-sm" name="ip">
						  </div>
							<div class="form-selector">
						    <label>定价</label>
						    <input type="text" class="form-control input-sm" name="value">
						  </div>
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

<script type="text/javascript">
function jianting(dianjiid, lookid) {
	$('#'+dianjiid).change(function() {
	    //获取到file的文件
	    var docObj = document.getElementById(dianjiid);
	    //获取到预览框的文件
	    var imgObjPreview = document.getElementById(lookid);
	    //获取到文件名和类型
	    if(docObj.files && docObj.files[0]) {
	        console.log(docObj.files)
	        //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
	        imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
	    } else {
	        //IE下，使用滤镜
	        docObj.select();
	        var imgSrc = document.selection.createRange().text;
	        var localImagId = document.getElementById("localImag");
	        //图片异常的捕捉，防止用户修改后缀来伪造图片
	        try {
	            localImagId.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
	            localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
	        } catch(e) {
	            alert("您上传的图片格式不正确，请重新选择!");
	            return false;
	        }
	        document.selection.empty();
	    }
	    return true;
	});
}
jianting("dianji0","look0");
jianting("dianji1","look1");
jianting("dianji2","look2");
jianting("dianji3","look3");
</script>
<?php require_once("../dibu.php") ?>


</body>
</html>
