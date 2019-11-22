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
    <title>空气质量监控系统-数据设置（操作人员）</title>
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
        .air-center .date{width: 1442px;height: 78px;font-size: 24px}
        .air-center .date ul{width: 1316px;height: 48px;margin:52px auto 0 }
        .air-center .date>ul>li{width: 130px;height: 48px;background:url(<?php echo STATIC_IMG?>dataIndex/air-btn-bg.png) left top no-repeat;background-size: 130px 48px;float: left;margin-left: 60px;text-align: center;line-height: 45px;color: #b8c5c8}
        .air-center .date>ul>.active{background:url(<?php echo STATIC_IMG?>dataIndex/air-btn-bg-active.png) left top no-repeat;background-size: 130px 48px;color: #fff363}
        .air-center .date>ul>li:nth-child(1){margin-left: 0;}
        .plane-person{width: 1177px;margin:70px 0 0 120px ;font-size: 18px}
        .plane-person .person{display: inline-block;}
        .plane-person .active{background:url(<?php echo STATIC_IMG?>dataIndex/person-check.png) no-repeat;background-size: 62px 34px;background-position: 148px 220px }
        .plane-person .active img{ box-shadow: 0 0 10px #fcea00 }
        .plane-person .person2{margin-left: 48px}
        .plane-person .person img{width: 207px;height: 253px;border: 1px solid #00679c;margin-bottom: 20px}
        .plane-person .person p{line-height: 30px}

        .air-bottom {width: 1442px;margin-top: 102px}
        .air-bottom .air-title{width: 699px;height: 37px;margin: 20px 0 0 30px;display: inline-block;font-size: 18px;background: url(<?php echo STATIC_IMG?>dataIndex/set-bottom-title.png) left top no-repeat;background-size: contain;padding-left: 50px;color: #cff7ff }
        .air-bottom .plane-form{width: 1207px;margin: 50px 0 0 110px;display: inline-block;font-size: 22px; }
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
            <li class="air-date"><a href="<?php echo base_url()?>index/dataSet"><img src="<?php echo STATIC_IMG?>dataIndex/set-plane.png" alt="">无人机</a></li>
            <li class="air-date active"><a href="<?php echo base_url()?>index/personSet"><img src="<?php echo STATIC_IMG?>dataIndex/set-person.png" alt="">操作人员</a></li>
        </ul>
    </div>
    <div class="air-center">
        <div class="date week" >
            <ul>
                <li class="active" data-id="1">星期一</li>
                <li data-id="2">星期二</li>
                <li data-id="3">星期三</li>
                <li data-id="4">星期四</li>
                <li data-id="5">星期五</li>
                <li data-id="6">星期六</li>
                <li data-id="7">星期日</li>
            </ul>
        </div>
        <div class="plane-person">
            <div class="person">
                <img src="<?php echo STATIC_IMG?>dataIndex/person.png" alt="">
                <p>姓名：<span class="choseName">张三</span></p>
                <p>负责内容：无人机清点</p>
                <p>联系方式：<span class="closeIphone">18611631111</span></p>
            </div>
            <div class="person person2">
                <img src="<?php echo STATIC_IMG?>dataIndex/person.png" alt="">
                <p>姓名：<span class="choseName">李四</span></p>
                <p>负责内容：无人机清点</p>
                <p>联系方式：<span class="closeIphone">18611632222</span></p>
            </div>
        </div>
        <div class="air-bottom">
            <p class="air-title">
                操作人员信息添加
            </p>
            <form class="plane-form" method="post">
                <span style="margin-right: 0.8rem">姓名：<input type="text" class="plane-name" name="username" id="username" readonly></span>
                <span>电话：<input type="text" class="plane-number" name="iphone" id="iphone" readonly></span>
                <button class="submit" id="submit" type="button" >提交</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo STATIC_?>jquery.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/rollSlide.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/common.js"></script>
<script>
    //默认当天的星期选中
    var show_day=new Array('星期日','星期一','星期二','星期三','星期四','星期五','星期六');
    var time=new Date();
    var day=time.getDay();
    var week=show_day[day];
    $('.week>ul>li').each(function (index,value) {
        if($(this).text() == week){
            $(this).addClass('active').siblings().removeClass('active');
        }
        if($(this).data('id') < day){
            $(this).css('color','#2c2f2f')
        }
    });
    //选择
    $('.week>ul>li').click(function () {
        if($(this).data('id') < day){
            alert('不可选择已过期的星期');
        }else{
            $(this).addClass('active').siblings().removeClass('active');
        }
    });
    $('.person').click(function () {
        $(this).addClass('active').siblings().removeClass('active');
        var username = $(this).find('.choseName').text();
        var iphone = $(this).find('.closeIphone').text();
        $('#username').val(username);
        $('#iphone').val(iphone);
    });
    //提交
    $('#submit').click(function () {
        var week = $('.week>ul>.active').text();
        var url="<?php echo base_url() ?>index/personSet";
        var username=$("#username").val();
        var iphone=$("#iphone").val();
        var time=new Date();
        var year=time.getFullYear();
        var month=time.getMonth()+1;
        var date=time.getDate();
        var urlData={username:username,iphone:iphone,week:week,time:year+'-'+month+'-'+date};
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
</script>
</body>
</html>