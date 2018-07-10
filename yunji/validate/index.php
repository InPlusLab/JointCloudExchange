<?php 
	session_start();
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
<title>云际 | 资源验证</title>

<?php require_once("../lianjie.php") ?>

<body class="cms-index-index cms-home-page">
     



<div id="page"> 
  
<?php require_once("../dingbu.php") ?>  
<?php require_once("../daohang.php") ?>

<script type="text/javascript">
function search() {
  id = document.getElementById("shuru2").value;
  location.href="/art/detail/?"+id;
}
</script>
<section class="main-container col1-layout">
    <div class="main container">
      <div class="row">
        <section class="col-main col-sm-12">
          
          <div id="contact" class="page-content page-contact">
          <div class="page-title">
            <h2>资源验证</h2>
          </div>

				<div class="tab-pane fade active in" id="product_tags">
                  <div class="box-collateral box-tags">
                    <div class="tags">
                                
                        
                      <form id="addTagForm" action="#" method="get">
                        <div class="form-add-tags">

                          
                          <div class="input-box"><label for="productTagName">资源验证：</label>
                            <input class="input-text" name="productTagName" id="shuru2" type="text">
                            <button type="button" title="Add Tags" onClick="search()" class="button add-tags"><i class="fa fa-search-plus"></i> &nbsp;<span>验证</span> </button>
                          </div>
                          <!--input-box--> 
                        </div>
                      </form>
                    </div>
                    <!--tags-->
                    <p class="note">输入版权ID进行链上资源确权查询</p>
                  </div>
                </div>
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
