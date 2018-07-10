<?php 
$list = array(
  array(
    "name"=>"账户概览",
    "url"=>"overview"
  ),
  array(
    "name"=>"发布的云资源",
    "url"=>"copyright_upload"
  ),
  array(
    "name"=>"购买的云资源",
    "url"=>"copyright_buy"
  ),
  array(
    "name"=>"我的Token",
    "url"=>"token"
  ),
  array(
    "name"=>"充值Token",
    "url"=>"recharge_token"
  ),
  array(
    "name"=>"相关区块链交易",
    "url"=>"transaction"
  )
);
 ?>

        <aside class="left sidebar col-sm-3 col-xs-12">
          <div class="sidebar-account block">
            <div class="sidebar-bar-title">
              <h3>个人中心</h3>
            </div>
            <div class="block-content">
              <ul>
                <?php 
                  for ($i=0;$i<count($list);++$i) {
                    $name = $list[$i]["name"];
                    $url = $list[$i]["url"];
                    if ($active==$url)
                      echo "<li class=\"current\"><a href=\"/my/$url\">$name</a></li>";
                    else
                      echo "<li><a href=\"/my/$url\">$name</a></li>";
                  }
                 ?>

                <li class="last"><a href="/exit/">退出</a></li>
              </ul>
            </div>
          </div>
        </aside>