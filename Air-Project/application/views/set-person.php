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
        .plane-person{width: 1177px;height:370px;margin:50px 0 0 120px ;font-size: 18px;overflow-y: auto}
        .plane-person .person{display: inline-block;margin-right: 48px}
        .plane-person .active{background:url(<?php echo STATIC_IMG?>dataIndex/person-check.png) no-repeat;background-size: 62px 34px;background-position: 148px 220px }
        .plane-person .active img{ box-shadow: 0 0 10px #fcea00 }
        .plane-person .person img{width: 207px;height: 253px;border: 1px solid #00679c;margin-bottom: 20px}
        .plane-person .person p{line-height: 30px}
        .plane-person .person .close-btn{width: 20px;height: 20px;background:url(<?php echo STATIC_IMG?>dataIndex/close-btn.png) center no-repeat;background-size: 20px 20px;float: right;margin-left: 5px;}
        .air-bottom {width: 1442px;position: absolute;top: 812px;}
        .air-bottom .air-title{width: 699px;height: 37px;margin: 20px 0 0 30px;display: inline-block;font-size: 18px;background: url(<?php echo STATIC_IMG?>dataIndex/set-bottom-title.png) left top no-repeat;background-size: contain;padding-left: 50px;color: #cff7ff }
        .air-bottom .plane-form{margin: 0 0 0 110px;display: inline-block;font-size: 22px; }
        .air-bottom .plane-form ul li{display: inline-block;margin-right: 50px;margin-top: 10px}
        .air-bottom .plane-form input,select{width: 320px;height: 48px;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;padding-left: 20px;font-size: 20px;}
        .air-bottom .plane-form .submit{width: 180px;height: 48px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) center no-repeat;background-size: 180px 48px;font-size: 24px;display: block;padding: 0;color: #d9d9d9;margin-left: 107px}
        .form-error{color: red;font-size: 16px;display: table-cell;}
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
            <li class="air-date"><a href="<?php echo base_url()?>index/airSet"><img src="<?php echo STATIC_IMG?>dataIndex/air.png" alt="">气体阈值</a></li>
        </ul>
    </div>
    <div class="air-center">
        <div class="date week" >
            <ul>
                <?php  if(!empty($week) && isset($week))  foreach ($week as $k => $v){?>
                    <li data-id="<?php echo $k?>" data-date="<?php echo $v?>"><?php if($k == 1){echo '星期一';}elseif($k == 2){echo '星期二';}elseif($k == 3){echo '星期三';}elseif($k == 4){echo '星期四';}elseif($k == 5){echo '星期五';}elseif($k == 6){echo '星期六';}elseif($k == 0){echo '星期日';}else{echo "未知";} ?></li>
                <?php }?>
            </ul>
        </div>

        <div class="plane-person" id="plane-person">
            <?php if(!empty($user) && isset($user)) foreach ($user as $key => $value){?>
                <div class="person" >
                    <a class="close-btn" id="<?php echo $value['id']?>" href="javascript:void (0)"></a>
                    <img src="<?php echo STATIC_IMG?>dataIndex/person.png" alt="">
                    <p>姓名：<span class="choseName"><?php echo $value['username']?></span></p>
                    <p>负责内容：<span class="choseCharge"><?php echo $value['charge']?></span></p>
                    <p>联系方式：<span class="closeIphone"><?php echo $value['iphone']?></span></p>
                </div>
            <?php }?>
        </div>

        <div class="air-bottom">
            <p class="air-title">
                操作人员信息添加
            </p>
            <form action="" class="plane-form" method="post" id="userForm" >
                <ul>
                    <li>
                        姓名：<input type="text" class="plane-name" name="username" id="username" data-validation="length" data-validation-length="2-4" data-validation-error-msg="姓名须为2至4个字符"></li>
                    <li>负责内容：<input type="text" class="plane-number" name="charge" id="charge" data-validation="length" data-validation-length="2-8" data-validation-error-msg="负责内容须为2至8个字符"></li>
                    <li>电话：<input type="text" class="plane-number" name="iphone" id="iphone" data-validation="custom" data-validation-regexp="^1[345789]\d{9}$" data-validation-error-msg="手机号格式不正确"></li>
                    <li><input type="hidden" name="id" id="id"><input class="submit" id="submit" type="submit" value="提交"></li>
                </ul>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo STATIC_?>jquery.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/rollSlide.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/jquery.form-validator.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/common.js"></script>
<script>
    //默认当天的星期选中
    var time=new Date();
    var day=time.getDay();
    $('.week>ul>li').each(function (index,value) {
        if($(this).data('id') == day){
            $(this).addClass('active').siblings().removeClass('active');
        }
        // if($(this).data('id') < day){
        //     $(this).css('color','#2c2f2f')
        // }
    });
    //页面一开始获取当天负责人
    var url="<?php echo base_url() ?>index/personSet";
    var week = $('.week ul .active').data('date');
    console.log(week)
    var urlData={week1:week};
    $.post(url,urlData,function(result){
        $('#plane-person').html('');
        if(result.status == 'true'){
            for (var i=0;i<result.data.length;i++) {
                var html= '<div class="person" >' +
                    '<a class="close-btn" id="'+result.data[i].id+'" href="javascript:void (0)"></a>' +
                    '<img src="<?php echo STATIC_IMG?>dataIndex/person.png" alt="">' +
                    '<p>姓名：<span class="choseName">'+result.data[i].username+'</span></p>' +
                    '<p>负责内容：<span class="choseCharge">'+result.data[i].charge+'</span></p>' +
                    '<p>联系方式：<span class="closeIphone">'+result.data[i].iphone+'</span></p>' +
                    '</div>';
                $('#plane-person').append(html);
            }
        }else if(result.status == 'false'){
            alert(result.tips);
        }
    },"json");
    //选择星期
    $('.week>ul>li').click(function () {
        // if($(this).data('id') < day){
        //     alert('不可选择已过期的星期');
        // }else{
            $(this).addClass('active').siblings().removeClass('active');
            var url="<?php echo base_url() ?>index/personSet";
            var week = $('.week ul .active').data('date');
            console.log(week)
            var urlData={week1:week};
            $.post(url,urlData,function(result){
                $('#plane-person').html('');
                if(result.status == 'true'){
                    for (var i=0;i<result.data.length;i++) {
                        var html= '<div class="person" >' +
                            '<a class="close-btn" id="'+result.data[i].id+'" href="javascript:void (0)"></a>' +
                            '<img src="<?php echo STATIC_IMG?>dataIndex/person.png" alt="">' +
                            '<p>姓名：<span class="choseName">'+result.data[i].username+'</span></p>' +
                            '<p>负责内容：<span class="choseCharge">'+result.data[i].charge+'</span></p>' +
                            '<p>联系方式：<span class="closeIphone">'+result.data[i].iphone+'</span></p>' +
                            '</div>';
                        $('#plane-person').append(html);
                    }
                }else if(result.status == 'false'){
                    alert(result.tips);
                }
            },"json");
        // }
    });
    $(document).on('click','.close-btn',function () {
        var r = confirm("确认删除嘛?");
        if(r == true){
            var url="<?php echo base_url() ?>index/delPerson";
            var id = $(this).attr('id');
            var urlData={id:id};
            $.post(url,urlData,function(result){
                console.log(result.status);
                if(result.status == 'true'){
                    alert(result.tips);
                    window.location.reload();
                }else if(result.status == 'false'){
                    alert(result.tips);
                }
            },"json");
        }

    });
    $(document).on('click','.person',function () {
        var username = $(this).find('.choseName').text();
        var charge = $(this).find('.choseCharge').text();
        var iphone = $(this).find('.closeIphone').text();
        var close = $(this).find('.close-btn').attr('id');
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $('#username').val('');
            $('#iphone').val('');
            $('#charge').val('');
            $('#id').val('');
        }else{
            $(this).addClass('active').siblings().removeClass('active');
            $('#username').val(username);
            $('#iphone').val(iphone);
            $('#charge').val(charge);
            $('#id').val(close);
        }

    });
    $.validate({form: '#userForm'});
    console.log();
    //提交
    $('#submit').click(function () {
        if ($('#userForm ul li').hasClass('has-error')){
            alert('提交有误');
        }else{
            var url="<?php echo base_url() ?>index/personSet";
            var username=$("#username").val();
            var id=$("#id").val();
            var charge=$("#charge").val();
            var iphone=$("#iphone").val();
            var time=$('.week ul .active').data('date');
            var week = $('.week ul .active').text();
            console.log(week);
            var urlData={username:username,iphone:iphone,week:week,time:time,charge:charge,id:id};
            $.post(url,urlData,function(result){
                console.log(result.status);
                if(result.status == 'true'){
                    alert(result.tips);
                    window.location.reload();
                }else if(result.status == 'false'){
                    alert(result.tips);
                }
            },"json");
        }
    });
</script>
</body>
</html>