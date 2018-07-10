  <!-- Header -->
  <header>
<script type="text/javascript">
function search() {
  id = document.getElementById("shuru").value;
  location.href="/art/detail/?"+id;
}
</script>
    <div class="header-container">
      <div class="container">
        <div class="row">
          <div class="col-sm-3 col-md-3 col-xs-12"> 
            <!-- Header Logo -->
            <div class="logo"><a title="e-commerce" href="/"><img alt="e-commerce" src="/images/logo.png"></a> </div>
            <!-- End Header Logo --> 
          </div>
          <div class="col-xs-9 col-sm-6 col-md-6"> 
            <!-- Search -->
            
            <div class="top-search">
              <div id="search">
                <form>
                  <div class="input-group">
                    <select class="cate-dropdown hidden-xs" name="category_id" style="width:95px">
                      <option>云资源ID</option>
                    </select>
                    <input type="text" class="form-control" placeholder="搜索" id="shuru">
                    <button class="btn-search" onClick="search()" type="button"><i class="fa fa-search"></i></button>
                  </div>
                </form>
              </div>
            </div>
            
            <!-- End Search --> 
          </div>
          <!-- top cart -->
          
          <div class="col-lg-3 col-xs-3 top-cart">
            <div class="top-cart-contain">
              <div class="mini-cart">
<?php 
          if (isset($_SESSION['user'])) {
              require_once("config.php");
              $user = $_SESSION['user'];
              $address = $_SESSION['address'];
              
              $jiekou = "/api/getUserInfo" ;
              $url = $fuwuduan.$jiekou."?address=$address";
              $html = file_get_contents($url);
              $yue = json_decode($html)->balance;
              echo '
                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"><a>
                  <div class="cart-icon"><i class="fa fa-user"></i></div>
                  <div class="shoppingcart-inner hidden-xs"><span class="cart-title">';
              echo $_SESSION['user'];

              echo '
                  </span> <span class="cart-total">';

              echo $yue;

              echo' YJC</span></div>
                  </a>
                </div>
                <div>
                  <div class="top-cart-content" style="width:150px; background:none; border:none;">
                    <div class="actions">
                      <a href="/my/overview/"><button class="btn-checkout" type="button"><i class="fa fa-check"></i><span>我的账户</span></button></a>
                    </div>
                  </div>
                </div>
              ';
          }
          else {
              echo '
                <div class="basket dropdown-toggle">
                  <a href="/login">
                  <div class="cart-icon"><i class="fa fa-user"></i></div>
                  <div class="shoppingcart-inner hidden-xs"><span class="cart-title">
                    未登录
                  </span> <span class="cart-total">0 YJC</span></div>
                  </a>
                </div>
              ';
          }

 ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end header --> 