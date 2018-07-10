<?php session_start(); ?>

<?php 
require_once("../../config.php");

$jiekou = "/api/getOverview" ;
$url = $fuwuduan.$jiekou;
$html = file_get_contents($url);
$blockHeight = json_decode($html)->blockHeight;
$blockTxCount = json_decode($html)->blockTxCount;
$nodeCount = json_decode($html)->nodeCount;
$cloud_num = json_decode($html)->cloud_num;
$tx_num = json_decode($html)->tx_num;


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
<title>云际 | 区块链</title>

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
				<h2>区块链</h2>
          	</div>
			<div class="row" style="margin-left:2px; margin-top:15px;">
				<div class="col-md-5">
				  	<div class="row row-sm text-center">

					    <div class="col-xs-6">
					      <div class="panel padder-v item" style="background:#f6f8f8;">
					        <div class="font-thin h1"><?php echo $nodeCount ?></div>
					        <span class="">节点数</span>
					        <div class="bottom text-left">
					          <i class="fa fa-caret-up text-warning m-l-sm"></i>
					        </div>
					      </div>
					    </div>

					    <div class="col-xs-6">
					      <div class="panel padder-v item" style="background:#f6f8f8;">
					        <div class="font-thin h1"><?php echo $blockHeight ?></div>
					        <span class="">区块高度</span>
					        <div class="bottom text-left">
					          <i class="fa fa-caret-up text-warning m-l-sm"></i>
					        </div>
					      </div>
					    </div>

					    <div class="col-xs-6">
					      <div class="panel padder-v item" style="background:#f6f8f8;">
					        <div class="font-thin h1"><?php echo $cloud_num ?></div>
					        <span class="">链上资源数</span>
					        <div class="bottom text-left">
					          <i class="fa fa-caret-up text-warning m-l-sm"></i>
					        </div>
					      </div>
					    </div>

					    <div class="col-xs-6">
					      <div class="panel padder-v item" style="background:#f6f8f8;">
					        <div class="font-thin h1"><?php echo $blockTxCount ?></div>
					        <span class="">区块交易数</span>
					        <div class="bottom text-left">
					          <i class="fa fa-caret-up text-warning m-l-sm"></i>
					        </div>
					      </div>
					    </div>
					    <div class="col-xs-12 m-b-md">
					      <div class="panel padder-v item" style="background:#f6f8f8;">
					        <div class="font-thin h1"><?php echo $tx_num ?></div>
					        <span class="">资源交易数</span>
					        <div class="bottom text-left">
					          <i class="fa fa-caret-up text-warning m-l-sm"></i>
					        </div>
					      </div>
					    </div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="panel panel-default">
				        <div class="panel-heading">
				            链上资源数
				        </div>
						<div id="jiaoyitu" style="height:275px;"></div>
					</div>
				</div>
			</div>
        </div>
        <!-- ./ Center colunm --> 
   
    </div>
  </section>

<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts-all-3.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/dataTool.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/china.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/world.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ZUONbpqGBsYGXNIYHicvbAbM"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/bmap.min.js"></script>
<script type="text/javascript">
    var dom = document.getElementById("jiaoyitu");
    var myChart = echarts.init(dom);
    var app = {};
    option = {
        tooltip: {
            trigger: 'axis',
            position: function (pt) {
                return [pt[0], '10%'];
            }
        },
        legend: {
            top: 'bottom',
            data:['意向']
        },
        toolbox: {
            feature: {
                dataZoom: {
                    yAxisIndex: 'none'
                },
                restore: {},
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: ["20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411","20180411"]
        },
        yAxis: {
            type: 'value',
            boundaryGap: [0, '100%'],
            max: 2500
        },
        dataZoom: [{
            type: 'inside',
            start: 50,
            end: 100
        }, {
            start: 0,
            end: 10,
            handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
            handleSize: '80%',
            handleStyle: {
                color: '#fff',
                shadowBlur: 3,
                shadowColor: 'rgba(0, 0, 0, 0.6)',
                shadowOffsetX: 2,
                shadowOffsetY: 2
            }
        }],
        series: [
            {
                name:'云资源数',
                type:'line',
                smooth:true,
                symbol: 'none',
                sampling: 'average',
                itemStyle: {
                    normal: {
                        color: '#f2ab00'
                    }
                },
                areaStyle: {
                    normal: {
                        color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                            offset: 0,
                            color: '#FED700'
                        }, {
                            offset: 1,
                            color: '#ffe760'
                        }])
                    }
                },
                data: [100,125,138,150,154,164,165,167,272,280,299,300,313,725,754,775,887,1291,1312,1315,2316,2328,2334,2350]
            }
        ]
    };

    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<?php require_once("../../dibu.php") ?>


</body>
</html>
