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
    <title>空气质量监控系统-数据设置（无人机）</title>
    <link rel="icon" href="<?php echo STATIC_IMG?>/favicon.ico"/>
    <link href="<?php echo STATIC_CSS?>dataIndex/common.css" rel="stylesheet" type="text/css" >
<!--    <script type="text/javascript" src="--><?php //echo STATIC_JS?><!--dataIndex/px2rem.js"></script>-->
    <style>
        .air-top{position:absolute;width:100%;height:93px;background:url(<?php echo STATIC_IMG?>dataIndex/top.png) left top no-repeat;background-size: 100% 100%;font-size: 37px;line-height: 93px;text-align: center}
        .air-left{display: inline-block;width:384px;margin-left: 30px;margin-top: 64px;float: left}
        .air-left .back{padding-left: 60px;line-height: 40px;background:url(<?php echo STATIC_IMG?>dataIndex/back.png) left top no-repeat;background-size: 40px 40px;font-size: 30px;color: #29c4fd}
        .air-left ul li:nth-child(1){margin-top: 60px}
        .air-date{width: 260px;height: 60px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) left top no-repeat;background-size: 260px 60px;font-size: 20px;line-height: 60px;margin-top:40px;}
        .air-date img{width: 28px;height: 28px;vertical-align: sub;margin-left: 20px;margin-right: 20px}
        .air-date a{color: #b8c5c8}
        .air-left .active{color: #fff363;background:url(<?php echo STATIC_IMG?>dataIndex/date-active.png) left top no-repeat;background-size: 260px 60px;}
        .air-left .active a{color: #fff363}
        .air-center{width: 1442px;min-height: 86%;background:url(<?php echo STATIC_IMG?>dataIndex/center-border.png) left top no-repeat;background-size: 1442px 928px;margin-top: 150px;float: left}
        .air-center .plane-data{width: 1442px;height: 554px;overflow: hidden;position: relative;font-size: 16px}
        .air-center .plane-data ul{width: 1218px;height: 178px;margin: 0 auto}
        .air-center .plane-data>ul>li{width: 360px;height: 178px;background:url(<?php echo STATIC_IMG?>dataIndex/plane-border.png) left top no-repeat;background-size: 360px 178px;float: left;margin-left: 60px;margin-top: 80px}
        .air-center .plane-data>ul>li:nth-child(1){margin-left: 0;}
        .air-center .plane-data>ul>li:nth-child(4){margin-left: 0}
        .air-center .plane-data>ul>li img{width: 63px;height: 29px;margin-left: 35px;vertical-align: top;margin-top: 20px;animation:pulse 1s infinite;-moz-animation:pulse 1s infinite;-webkit-animation:pulse 1s infinite;-o-animation:pulse 1s infinite;}
        .air-center .plane-data>ul>li .close-btn{width: 20px;height: 20px;background:url(<?php echo STATIC_IMG?>dataIndex/close-btn.png) center no-repeat;background-size: 20px 20px;float: right;margin-top: 15px;margin-right: 10px}
        .air-center .plane-data .plane-title{margin-top:40px;margin-left: 35px}
        .air-center .plane-data .plane-content{margin-top:10px;display: inline-block;}
        .air-center .plane-data .plane-content .plane-text{display: inline-block;margin-left: 70px}
        .roll_row .roll__list::before, .roll_row .roll__list::after {content: "";display: table;line-height: 0;}
        .roll_row .roll__list::after {clear: both;}
        .roll_row .roll__list{width: 9999px;}
        .roll_col .roll__list{width: 100%;}
        .air-bottom {width: 1442px;margin-top: 102px}
        .air-bottom .air-title{width: 699px;height: 37px;margin: 20px 0 0 30px;display: inline-block;font-size: 18px;background: url(<?php echo STATIC_IMG?>dataIndex/set-bottom-title.png) left top no-repeat;background-size: contain;padding-left: 50px;color: #cff7ff }
        .air-bottom .plane-form{width: 1207px;height: 167px;margin: 50px 0 0 110px;display: inline-block;font-size: 22px; }
        .air-bottom .plane-form input{width: 360px;height: 48px;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;padding-left: 20px;font-size: 20px}
        .air-bottom .plane-form .submit{width: 180px;height: 48px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) center no-repeat;background-size: 180px 48px;font-size: 24px;display: block;float: right;padding: 0;color: #d9d9d9}
    </style>
</head>
<body>
<div id="container">
    <div class="air-top">空气质量监控系统-数据设置</div>
    <div class="air-left">
        <a href="<?php echo base_url()?>index/indexPage" class="back">返回首页</a>
        <ul>
            <li class="air-date active"><a href="<?php echo base_url()?>index/dataSet"><img src="<?php echo STATIC_IMG?>dataIndex/set-plane.png" alt="">无人机</a></li>
            <li class="air-date"><a href="<?php echo base_url()?>index/personSet"><img src="<?php echo STATIC_IMG?>dataIndex/set-person.png" alt="">操作人员</a></li>
        </ul>
    </div>
    <div class="air-center">
        <div class="plane-data roll-wrap roll_row" id="plane-data">
            <ul class="roll__list">
                <li>
                    <a class="close-btn" href="#"></a>
                    <div class="plane-title">无人机一号</div>
                    <div class="plane-content">
                        <img src="<?php echo STATIC_IMG?>dataIndex/plane.png" alt="无人机">
                        <div class="plane-text">
                            <p>飞行状态：正常</p>
                            <p>飞行速度：6m/s</p>
                            <p>飞行高度：500m</p>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="close-btn" href="#"></a>
                    <div class="plane-title">无人机二号</div>
                    <div class="plane-content">
                        <img src="<?php echo STATIC_IMG?>dataIndex/plane.png" alt="无人机">
                        <div class="plane-text">
                            <p>飞行状态：正常</p>
                            <p>飞行速度：6m/s</p>
                            <p>飞行高度：500m</p>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="close-btn" href="#"></a>
                    <div class="plane-title">无人机三号</div>
                    <div class="plane-content">
                        <img src="<?php echo STATIC_IMG?>dataIndex/plane.png" alt="无人机">
                        <div class="plane-text">
                            <p>飞行状态：正常</p>
                            <p>飞行速度：6m/s</p>
                            <p>飞行高度：500m</p>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="close-btn" href="#"></a>
                    <div class="plane-title">无人机四号</div>
                    <div class="plane-content">
                        <img src="<?php echo STATIC_IMG?>dataIndex/plane.png" alt="无人机">
                        <div class="plane-text">
                            <p>飞行状态：正常</p>
                            <p>飞行速度：6m/s</p>
                            <p>飞行高度：500m</p>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="close-btn" href="#"></a>
                    <div class="plane-title">无人机五号</div>
                    <div class="plane-content">
                        <img src="<?php echo STATIC_IMG?>dataIndex/plane.png" alt="无人机">
                        <div class="plane-text">
                            <p>飞行状态：正常</p>
                            <p>飞行速度：6m/s</p>
                            <p>飞行高度：500m</p>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="close-btn" href="#"></a>
                    <div class="plane-title">无人机七号</div>
                    <div class="plane-content">
                        <img src="<?php echo STATIC_IMG?>dataIndex/plane.png" alt="无人机">
                        <div class="plane-text">
                            <p>飞行状态：正常</p>
                            <p>飞行速度：6m/s</p>
                            <p>飞行高度：500m</p>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="close-btn" href="#"></a>
                    <div class="plane-title">无人机八号</div>
                    <div class="plane-content">
                        <img src="<?php echo STATIC_IMG?>dataIndex/plane.png" alt="无人机">
                        <div class="plane-text">
                            <p>飞行状态：正常</p>
                            <p>飞行速度：6m/s</p>
                            <p>飞行高度：500m</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="air-bottom">
            <p class="air-title">
                无人机信息添加
            </p>
<!--            --><?php //echo form_open('index/dataSet', 'class="plane-form"');?>
            <form class="plane-form" method="post">
                <span style="margin-right: 80px">名称：<input type="text" class="plane-name" name="name" id="name"></span>
                <span>编号：<input type="text" class="plane-number" name="number" id="number"></span>
                <button class="submit" id="submit" type="button" >提交</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo STATIC_?>jquery.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/rollSlide.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/common.js"></script>
<script>
    $('#submit').click(function () {
        var url="<?php echo base_url() ?>index/dataSet";
        var name=$("#name").val();
        var number=$("#number").val();
        var urlData={name:name,number:number};
        $.post(url,urlData,function(result){
           console.log(result.status);
           if(result.status == 'true'){
               alert(result.tips);
               window.location.reload();
           }else if(result.status == 'false'){
               alert(result.tips);
           }
        },"json");
    });
    $('#plane-data').rollSlide({
        orientation: 'left',
        num: 1,
        v: 1000,
        space: 1000,
        isRoll: true
    });
</script>
</body>
</html>