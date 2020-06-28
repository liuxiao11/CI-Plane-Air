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
    <title>大气环境综合监测平台-数据设置（航线）</title>
    <link rel="icon" href="<?php echo STATIC_IMG?>/favicon.ico"/>
    <link href="<?php echo STATIC_CSS?>dataIndex/jquery.datetimepicker.min.css" rel="stylesheet">
    <link href="<?php echo STATIC_CSS?>dataIndex/bootstrap.min.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo STATIC_CSS?>dataIndex/bootstrap-select.min.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo STATIC_CSS?>dataIndex/common.css" rel="stylesheet" type="text/css" >
<!--    <script type="text/javascript" src="--><?php //echo STATIC_JS?><!--dataIndex/px2rem.js"></script>-->
    <style>
        .top{position:absolute;width:100%;height:93px;font-size: 37px;line-height: 93px;text-align: center;letter-spacing: 10px}
        .air-top{position:absolute;width:100%;height:93px;background:url(<?php echo STATIC_IMG?>dataIndex/top22.png) left top no-repeat;background-size: 100% 100%;}
        .air-left{display: inline-block;width:384px;position: absolute;left: 30px;top: 64px;}
        .air-left .back{padding-left: 60px;line-height: 40px;background:url(<?php echo STATIC_IMG?>dataIndex/back.png) left top no-repeat;background-size: 40px 40px;font-size: 30px;color: #29c4fd}
        .air-left ul li:nth-child(1){margin-top: 60px}
        .air-date{width: 260px;height: 60px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) left top no-repeat;background-size: 260px 60px;font-size: 20px;line-height: 60px;margin-top:40px;}
        .air-date img{width: 28px;height: 28px;vertical-align: sub;margin-left: 20px;margin-right: 20px}
        .air-date a{color: #b8c5c8}
        .air-left .active{color: #fff363;background:url(<?php echo STATIC_IMG?>dataIndex/date-active.png) left top no-repeat;background-size: 260px 60px;}
        .air-left .active a{color: #fff363}
        .air-center{width: 1442px;height: 930px;background:url(<?php echo STATIC_IMG?>dataIndex/center-border.png) left top no-repeat;background-size: 1442px 928px;top: 150px;position: absolute;right: 50px}
        .air-center .date{width: 1442px;height: 653px;font-size: 24px;overflow-y: auto}
        .air-center .date ul{width: 1256px;height: 595px;margin:52px auto 0 }
        .air-center .date>ul>li{width: 177px;height: 48px;background:url(<?php echo STATIC_IMG?>dataIndex/air-btn-bg.png) left top no-repeat;background-size:contain;float: left;margin-left: 60px;text-align: center;line-height: 45px;color: #b8c5c8;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;cursor: pointer;margin-bottom: 50px;}
        .air-center .date>ul>li.active{width: 177px;height: 48px;background:url(<?php echo STATIC_IMG?>dataIndex/air-btn-bg-active.png) left top no-repeat;background-size: cover;color: #fff363}
        .air-bottom {width: 1307px;position: absolute;top: 659px}
        .air-bottom .air-title{width: 699px;height: 37px;margin: 20px 0 0 30px;display: inline-block;font-size: 18px;background: url(<?php echo STATIC_IMG?>dataIndex/set-bottom-title.png) left top no-repeat;background-size: contain;padding-left: 50px;color: #cff7ff }
        .air-bottom .plane-form{margin: 20px 0 0 90px;font-size: 22px;}
        .air-bottom .plane-form p{margin: 12px;display: inline-block}
        .air-bottom .plane-form .bootstrap-select{width: 280px !important;font-size: 20px !important;}
        .air-bottom .plane-form .bootstrap-select button{font-size: 18px !important;}
        .air-bottom .plane-form .bootstrap-select .dropdown-menu{font-size: 18px !important;}
        .air-bottom .plane-form .btn-default{height: 48px!important;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;}
        .air-bottom .plane-form .btn-default:focus{border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;}
        .air-bottom .plane-form .btn-default:hover{border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;}
        .air-bottom .plane-form select,input{width: 280px;height: 48px;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;padding-left: 20px;font-size: 20px;}
        .form-error{color: red;font-size: 16px;display: table-cell;border-radius: 4px}
        .air-bottom .plane-form .submit{width: 100px;height: 48px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) center no-repeat;background-size: 280px 48px;font-size: 24px;padding: 0;color: #d9d9d9;margin-left: 10px}
        .air-bottom .plane-form .del{width: 100px;height: 48px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) center no-repeat;background-size: 280px 48px;font-size: 24px;padding: 0;color: #d9d9d9;margin-left: 10px}
    </style>
</head>
<body>
<div id="container">
        <div class="top"><div class="air-top" id="upload-img"></div>大气环境综合监测平台</div>
    <div class="air-left">
        <a href="<?php echo base_url()?>index/indexPage" class="back">返回首页</a>
        <ul>
            <li class="air-date"><a href="<?php echo base_url()?>index/dataSet"><img src="<?php echo STATIC_IMG?>dataIndex/set-plane.png" alt="">无人机</a></li>
            <li class="air-date"><a href="<?php echo base_url()?>index/personSet"><img src="<?php echo STATIC_IMG?>dataIndex/set-person.png" alt="">操作人员</a></li>
            <li class="air-date"><a href="<?php echo base_url()?>index/airSet"><img src="<?php echo STATIC_IMG?>dataIndex/air.png" alt="">气体阈值</a></li>
            <li class="air-date active"><a href="<?php echo base_url()?>index/lineSet"><img src="<?php echo STATIC_IMG?>dataIndex/line.png" alt="">航线</a></li>
        </ul>
    </div>
    <div class="air-center">
        <div class="date" >
            <ul>
                <?php  if(!empty($lineList) && isset($lineList))  foreach ($lineList as $k => $v){?>
                    <li data-id="<?php echo $v['id']?>"><?php echo $v['lineName']?></li>
                <?php }?>
            </ul>
        </div>
        <div class="air-bottom">
            <p class="air-title">
                航线详情
            </p>
            <div class="plane-form"  >
                <p>航线名称：<input type="text" id="lineName"  data-validation="length" data-validation-length="2-6" data-validation-error-msg="名称须为2至6个字符"></p>
                <p id="btn"><button class="submit" id="submit">添加</button></p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo STATIC_?>jquery.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/jquery.form-validator.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/common.js"></script>

<script>
    //选择航线
    $('.date>ul>li').click(function () {
        $(this).addClass('active').siblings().removeClass('active');
        var url="/index/lineSet";
        var date = $('.date ul li.active').data('id');
        var urlData={id:date};
        $.post(url,urlData,function(result){
            var res = result.data.lineOne;
            if(result.status == 'true'){
                $('#lineName').val('');
                $('#lineName').val(res.lineName);
                $('#btn').html('');
                $('#btn').append('<button class="submit" id="submit">修改</button><button class="del" id="del">删除</button>')
            }else if(result.status == 'false'){
                alert(result.tips);
            }
        },"json");
    });
    $(document).on('click','#submit',function () {
        if ($('#userForm p').hasClass('has-error')){
            alert('提交有误');
        }else{
            var url="/index/lineAdd";
            var id = $('.date ul li.active').data('id');
            if(id){
                id = id;
            }else{
                id = 0;
            }
            var lineName = $('#lineName').val();
            var urlData={lineName:lineName,id:id};
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
    $(document).on('click','#del',function () {
        var r = confirm("确认删除嘛?");
        if(r == true){
            var url="/index/delLine";
            var id = $('.date ul li.active').data('id');
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
</script>
</body>
</html>