<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <!-- 指定多核浏览器用webkit模式 -->
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>空气质量监控系统-首页</title>
    <link rel="icon" href="<?php echo STATIC_IMG?>/favicon.ico"/>
    <link href="<?php echo STATIC_CSS?>dataIndex/easyui.css" rel="stylesheet" type="text/css" >
<!--    <link rel="stylesheet" href="https://a.amap.com/jsapi_demos/static/demo-center/css/demo-center.css" />-->
    <link href="<?php echo STATIC_CSS?>dataIndex/common.css" rel="stylesheet" type="text/css" >
<!--    <script type="text/javascript" src="--><?php //echo STATIC_JS?><!--dataIndex/px2rem.js"></script>-->
    <style>
        #refresh{position:absolute;top:0;font-size:20px;}
        .air-top{position:absolute;width:100%;height:93px;background:url(<?php echo STATIC_IMG?>dataIndex/top.png) left top no-repeat;background-size: 100% 100%;font-size: 37px;line-height: 93px;text-align: center}
        .air-left{display: inline-block;width:420px;margin-left: 0.1rem;margin-top: 64px;float: left;}
        .air-date{width: 388px;height: 59px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) left top no-repeat;background-size: contain;font-size: 22px;line-height: 59px;margin: 0 auto}
        .air-left .air-date .air-icon{width: 11px;height: 11px;background:url(<?php echo STATIC_IMG?>dataIndex/icon.png) left top no-repeat;background-size: contain;vertical-align:middle;margin-left: 11px}
        .air-left .air-date .air-weather-icon{width: 47px;height: 37px;background:url(<?php echo STATIC_IMG?>dataIndex/weather-icon.png) left top no-repeat;background-size: contain;vertical-align:middle;margin-left: 35px}
        .air{width: 420px;height: 231px;background:url(<?php echo STATIC_IMG?>dataIndex/air-border.png) left top no-repeat;background-size: contain;margin: 15px 0;overflow:hidden }
        .air-chart{margin: 0 auto}
        .air .air-title{margin: 11px 0 0 30px;display: inline-block;font-size: 12px}
        .air-center{position: absolute;width: 1033px;height: 928px;background:url(<?php echo STATIC_IMG?>dataIndex/center-border.png) left top no-repeat;background-size: contain;margin-top: 150px;left: 50%;margin-left: -516.5px}
        .air-center .plane-data{width: 1033px;height: 155px;overflow: hidden;position: relative;}
        .air-center .plane-data ul{width: 918px;height: 150px;margin: 0 auto}
        .air-center .plane-data>ul>li{width: 274px;height: 130px;background:url(<?php echo STATIC_IMG?>dataIndex/plane-border.png) left top no-repeat;background-size: 247px 130px;float: left;margin-left: 40px;margin-top: 22px}
        .air-center .plane-data>ul>li:nth-child(1){margin-left: 0}
        .air-center .plane-data>ul>li img{width: 63px;height: 29px;margin-left: 15px;vertical-align: top;margin-top: 20px ;animation:pulse 1s infinite;-moz-animation:pulse 1s infinite;-webkit-animation:pulse 1s infinite;-o-animation:pulse 1s infinite;}
        .air-center .plane-data .plane-title{margin-top:20px;margin-left: 15px}
        .air-center .plane-data .plane-content{margin-top:8px;display: inline-block;}
        .air-center .plane-data .plane-content .plane-text{display: inline-block;margin-left: 30px}
        .roll_row .roll__list::before, .roll_row .roll__list::after {content: "";display: table;line-height: 0;}
        .roll_row .roll__list::after {clear: both;}
        .roll_row .roll__list{width: 9999px;}
        .roll_col .roll__list{width: 100%;}
        .air-center .map-border{width: 950px;height: 466px;position: absolute;z-index:1;background:url(<?php echo STATIC_IMG?>dataIndex/map-border.png) left top no-repeat;    background-size: 950px 466px;left: 41px;}
        .air-center .plane-map{width: 920px;height: 465px;margin:20px auto 0; border-radius: 25px;}
        .air-bottom {width: 1033px;height: 250px;margin-top: 25px}
        .air-bottom .air-title{margin: 11px 0 0 30px;display: inline-block;font-size: 12px}
        .air-bottom .air-title .title-icon{width: 12px;height: 9px;background: url(<?php echo STATIC_IMG?>dataIndex/title-icon.png) left top no-repeat;background-size: contain}
        .air-right {display: inline-block;width:420px;margin-right: 10px;margin-top: 64px;float: right}
        .air-right .air-btn{text-align: center}
        .air-right .air-btn-border{width: 121px;height: 33px;background:url(<?php echo STATIC_IMG?>dataIndex/air-btn-bg.png) left top no-repeat;background-size: contain;font-size: 16px;color: #fff363;text-align: center;line-height: 33px;display: inline-block}
        .air-right .air-btn-first{margin-right: 50px}
        .air-right .air-btn-border img{width: 22px;height: 22px;vertical-align: sub;margin-right: 5px}
        .air-right .info1{width: 420px;height: 332px;background:url(<?php echo STATIC_IMG?>dataIndex/b-air-border.png) left top no-repeat;background-size: contain;margin: 25px 0}
        .info1 .air-title{margin: 15px 0 0 30px;display: inline-block;font-size: 12px}
        .air-right .number{width: 318px;height: 80px;margin:10px auto 0 ;display: block;}
        .air-right .num-btn{width: 139px;height: 65px;font-size: 15px;text-align: center;border: 1px solid #00679c;transition: ease-in .3s;background: linear-gradient(0, #00679c 2px, #00679c 2px) no-repeat, linear-gradient(-90deg, #00679c 2px, #00679c 2px) no-repeat, linear-gradient(-180deg, #00679c 2px, #00679c 2px) no-repeat, linear-gradient(-270deg, #00679c 2px, #00679c 2px) no-repeat;background-size: 0 2px, 2px 0, 0 2px, 2px 0;background-position: left top, right top, right bottom, left bottom;display: inline-block;box-shadow: 0 0 8px #00679c;}
        /*.air-right .num-btn{background-size: 100% 2px,  2px 100%, 100% 2px, 2px 100%;animation:play 3s linear  infinite;-moz-animation:play 3s  linear  infinite;-webkit-animation:play 3s linear  infinite;-o-animation:play 3s linear  infinite;}*/
        .air-right .num-btn:hover{background-size: 100% 2px,  2px 100%, 100% 2px, 2px 100%;}
        .air-right .num-btn span{font-size: 26px}
        .air-right .air-btn2{margin-left: 30px}
        .air-right .plane-person{width: 96%;height: 263px;margin:20px auto 0 ;font-size: 14px;overflow-y: auto;}
        .air-right .plane-person .person{display: inline-block;margin-left: 25px;}
        .air-right .plane-person .person img{width: 160px;height: 200px;border: 1px solid #00679c}
        .air-right .plane-stock .stock{width: 153px;height: 62px;background:url(<?php echo STATIC_IMG?>dataIndex/plane1-border.png) left top no-repeat;background-size: contain;display: inline-block;float: left;overflow: hidden;margin-left: 45px;margin-bottom: 20px}
        .air-right .plane-stock {width: 98%;height: 162px;overflow-y: auto;}
        .air-right .plane-stock>li:nth-of-type(odd){margin-left: 33px}
        .air-right .plane-stock .stock img{width: 37px;height: 37px;float: left;margin: 10px 12px}
        .air-right .plane-stock .stock p{float: left;margin: 10px 0 2px 15px}
        .air-right .plane-stock .stock button{float: left;width: 60px;margin-left: 15px;font-size:11px;background-color: #e9873e;border: none;color: #ffffff}

    </style>
</head>
<body>
<div id="container">
    <!-- 刷新 -->
    <div id="refresh">
        <span id="refreshTime">最后刷新时间：2019-11-06 23:13:24</span>
    </div>
    <div class="air-top">空气质量监控系统</div>
    <div class="air-left">
        <div class="air-date">
            <i class="air-icon"></i>
            <span id="date">2019年10月26日 星期六</span>
        </div>
        <div class="air air-SO2">
            <p class="air-title">SO2</p>
            <div class="air-chart" id="SO2" style="width: 95%;height: 85%"></div>
        </div>
        <div class="air air-NO2">
            <p class="air-title">NO2</p>
            <div class="air-chart" id="NO2" style="width: 95%;height: 85%"></div>
        </div>
        <div class="air air-PM10">
            <p class="air-title">PM10/PM2.5</p>
            <div class="air-chart"  id="PM" style="width: 95%;height: 85%"></div>
        </div>
        <div class="air air-CO">
            <p class="air-title">CO/O3</p>
            <div class="air-chart" id="CO-O3" style="width: 95%;height: 85%"></div>
        </div>
    </div>
    <div class="air-center">
        <div class="plane-data roll-wrap roll_row" id="plane-data">
            <ul class="roll__list">
            </ul>
        </div>
        <div><div id="allmap" class="plane-map" ></div></div>
        <div class="air-bottom">
            <p class="air-title">
                <i class="title-icon"></i>
                CH4/SF6/H2O2/COCL2
            </p>
            <div class="air-chart" id="CH4" style="width: 100%;height: 85%"></div>
        </div>
    </div>
    <div class="air-right">
        <div class="air-date air-btn">
            <a href="<?php echo base_url()?>index/dataSet" class="air-btn-border air-btn-first"><img src="<?php echo STATIC_IMG?>dataIndex/btn-set.png">数据设置</a>
            <a href="<?php echo base_url()?>index/planeHis" class="air-btn-border"><img src="<?php echo STATIC_IMG?>dataIndex/btn-history.png">历史记录</a>
        </div>
        <div class="info1 air-warning">
            <p class="air-title">气体预警和风险数量</p>
            <div class="number">
                <i class="num-btn air-btn1"><span>128</span><br>今日预警总数</i>
                <i class="num-btn air-btn2"><span>166</span><br>今日查阅总数</i>
            </div>
            <div class="air-chart" id="warning" style="width: 95%;height: 63%"></div>
        </div>
        <div class="info1">
            <p class="air-title">无人机负责人</p>
            <div class="plane-person">
                <?php if(isset($user) && !empty($user)) foreach ($user as $kk => $vv){?>
                <div class="person">
                    <img src="<?php echo STATIC_IMG?>dataIndex/person.png" >
                    <p>姓名：<?php echo $vv['username']?></p>
                    <p>负责内容：<?php echo $vv['charge']?></p>
                    <p>联系方式：<?php echo $vv['iphone']?></p>
                </div>
                <?php }?>
            </div>
        </div>
        <div class="air">
            <p class="air-title">无人机库存</p>
            <ul class="plane-stock">
                <?php foreach ($planeStock as $k => $v){?>
                <li class="stock">
                    <img src="<?php echo STATIC_IMG?>dataIndex/plane1.png" >
                    <i class="shu"></i>
                    <p><?php echo $v['productId'] ?><br>
                        <?php if($v['status'] == 1){ echo '状态:正常';}else{ echo '状态:异常';} ?></p>
                </li>
                <?php }?>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo STATIC_?>jquery.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/echarts.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/echarts-wordcloud.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/china.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/rollSlide.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/jquery.cookie.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=nVzaOG4nXU266Xgw2HZZvEyvfHIGlsmm"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/air.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/common.js"></script>
<script type="text/javascript">
    WIDGET = {FID: 'jyA2dogNAb'}
</script>
<script type="text/javascript" src="https://apip.weatherdt.com/float/static/js/r.js?v=1111"></script>
<script>
</script>
</body>
</html>