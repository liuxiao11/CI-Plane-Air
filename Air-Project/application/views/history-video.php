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
    <title>大气环境综合监测平台-历史数据（视频查看）</title>
    <link rel="icon" href="<?php echo STATIC_IMG?>/favicon.ico"/>
    <link href="<?php echo STATIC_CSS?>dataIndex/common.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo STATIC_CSS?>dataIndex/jquery.datetimepicker.min.css" rel="stylesheet">
<!--    <script type="text/javascript" src="--><?php //echo STATIC_JS?><!--dataIndex/px2rem.js"></script>-->
    <style>
        /*#container{position:relative;width:100%;height:100%;min-width:1200px;max-width:3840px;min-height:720px;max-height:2160px;}*/
        .top{position:absolute;width:100%;height:93px;font-size: 37px;line-height: 93px;text-align: center;letter-spacing: 10px}
        .air-top{position:absolute;width:100%;height:93px;background:url(<?php echo STATIC_IMG?>dataIndex/top22.png) left top no-repeat;background-size: 100% 100%;}
        .air-left{display: inline-block;width:384px;position: absolute;left: 30px;top: 64px;}
        .air-left .back{padding-left: 60px;line-height: 40px;background:url(<?php echo STATIC_IMG?>dataIndex/back.png) left top no-repeat;background-size: 40px 40px;font-size: 30px;color: #29c4fd}
        .air-left ul li:nth-child(1){margin-top: 60px}
        .air-date{width: 280px;height: 60px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) left top no-repeat;background-size: 280px 60px;font-size: 20px;line-height: 60px;margin-top:40px;}
        .air-date img{width: 28px;height: 28px;vertical-align: sub;margin-left: 20px;margin-right: 20px}
        .air-date a{color: #b8c5c8}
        .air-left .active{color: #fff363;background:url(<?php echo STATIC_IMG?>dataIndex/date-active.png) left top no-repeat;background-size: 280px 60px;}
        .air-left .active a{color: #fff363}
        .air-center{width: 1442px;height: 928px;background:url(<?php echo STATIC_IMG?>dataIndex/history-border1.png) left top no-repeat;background-size: 1442px 928px;    position: absolute;top: 150px;right: 50px;}
        .air-center .center-top {width: 1442px;}
        .air-center .center-top .air-title{width: 699px;height: 37px;margin: 30px 0 0 40px;font-size: 18px;background: url(<?php echo STATIC_IMG?>dataIndex/set-bottom-title.png) left top no-repeat;background-size: contain;padding-left: 50px;color: #cff7ff; }
        .air-center .center-top .plane-form{width: 1250px;margin-left:110px;display: inline-block;font-size: 22px; }
        .air-center .center-top .plane-form ul {text-align: center;}
        .air-center .center-top .plane-form ul li{margin-right: 40px;margin-top: 30px}
        .air-center .center-top .plane-form ul li p{margin-top: 30px; display: inline-block;margin-left: 30px;font-size: 16px}
        .air-bottom{height: 800px;width: 1250px;margin: 10px auto 0;text-align: center;padding-top: 32px}
        .file {height: 35px;position: relative;display: inline-block;width: 100%;background:url(<?php echo STATIC_IMG?>dataIndex/air-btn-bg.png) center center no-repeat;background-size: cover;font-size: 16px;text-align: center;padding: 4px 0;overflow: hidden;color: #1E88C7;text-decoration: none;text-indent: 0;line-height: 35px;vertical-align: middle;cursor: pointer;}
        .file input {position: absolute;font-size: 20px;right: 0;top: 0;opacity: 0;cursor: pointer;width: 100%;height: 40px }
        .file:hover {color: #004974;text-decoration: none;}
        video{display: none;margin-bottom: 64px;width: 100%;height: 83%}
    </style>
</head>
<body>
<div id="container">
        <div class="top"><div class="air-top" id="upload-img"></div>大气环境综合监测平台</div>
    <div class="air-left">
        <a href="<?php echo base_url()?>index/indexPage" class="back">返回首页</a>
        <ul>
            <li class="air-date"><a href="/index/planeHis"><img src="<?php echo STATIC_IMG?>dataIndex/set-plane.png" alt="">无人机数据查询分析</a></li>
            <li class="air-date"><a href="/index/airHis"><img src="<?php echo STATIC_IMG?>dataIndex/set-car.png" alt="">车载数据查询分析</a></li>
            <li class="air-date"><a href="/index/hisAll"><img src="<?php echo STATIC_IMG?>dataIndex/all.png" alt="">综合数据查询分析</a></li>
            <li class="air-date"><a href="/index/hisToday"><img src="<?php echo STATIC_IMG?>dataIndex/today.png" alt="">当日数据查询分析</a></li>
            <li class="air-date"><a href="/index/hisWarning"><img src="<?php echo STATIC_IMG?>dataIndex/air.png" alt="">报警记录查询</a></li>
            <li class="air-date"><a href="/index/xgData"><img src="<?php echo STATIC_IMG?>dataIndex/xgdata.png" alt="">相关数据查询</a></li>
            <li class="air-date active"><a href="/index/video"><img src="<?php echo STATIC_IMG?>dataIndex/video.png" alt="">历史视频查看</a></li>
        </ul>
    </div>
    <div class="air-center">
        <div class="center-top">
            <p class="air-title">
                历史视频查看
            </p>
        </div>
        <div class="air-bottom">
            <video id="player" autoplay="autoplay" >
            </video>
            <form action="" class="plane-form">
                <ul>
                    <li class="plane-list">
                        <a href="javascript:void (0);" class="file"><span class="showFileName">视频选择</span><input type="file" id="file" /></a>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo STATIC_?>jquery.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/common.js"></script>
<script>
    $(document).ready(function () {
        $("#file").change(function (file) {
            var filePath=$(this).val();
            if(filePath.indexOf("mp4")!=-1 ){
                var arr=filePath.split('\\');
                var fileName=arr[arr.length-1];
                $(".showFileName").html(fileName);
                $("body").append(file.target.files[0]);
                var url = window.URL.createObjectURL(file.target.files[0]);
                $("#player")[0].src = url;
                $("#player")[0].onload = function () {
                    window.URL.revokeObjectURL(src);
                };
                $('video').fadeIn();
                $("#player").attr("controls","controls");
            }else{
                $(".showFileName").html('视频选择');
                alert("您未上传文件，或者您上传文件类型有误！");
                return false
            }

        });
    });
</script>
</body>
</html>