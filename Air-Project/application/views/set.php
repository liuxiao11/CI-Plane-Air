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
    <title>空气质量监控平台-数据设置（无人机）</title>
    <link rel="icon" href="<?php echo STATIC_IMG?>/favicon.ico"/>
    <link href="<?php echo STATIC_CSS?>dataIndex/common.css" rel="stylesheet" type="text/css" >
<!--    <script type="text/javascript" src="--><?php //echo STATIC_JS?><!--dataIndex/px2rem.js"></script>-->
    <style>
        .air-top{position:absolute;width:100%;height:93px;background:url(<?php echo STATIC_IMG?>dataIndex/top.png) left top no-repeat;background-size: 100% 100%;font-size: 37px;line-height: 93px;text-align: center}
        .air-left{display: inline-block;width:384px;position: absolute;left: 30px;top: 64px;}
        .air-left .back{padding-left: 60px;line-height: 40px;background:url(<?php echo STATIC_IMG?>dataIndex/back.png) left top no-repeat;background-size: 40px 40px;font-size: 30px;color: #29c4fd}
        .air-left ul li:nth-child(1){margin-top: 60px}
        .air-date{width: 260px;height: 60px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) left top no-repeat;background-size: 260px 60px;font-size: 20px;line-height: 60px;margin-top:40px;}
        .air-date img{width: 28px;height: 28px;vertical-align: sub;margin-left: 20px;margin-right: 20px}
        .air-date a{color: #b8c5c8}
        .air-left .active{color: #fff363;background:url(<?php echo STATIC_IMG?>dataIndex/date-active.png) left top no-repeat;background-size: 260px 60px;}
        .air-left .active a{color: #fff363}
        .air-center{width: 1442px;height: 930px;background:url(<?php echo STATIC_IMG?>dataIndex/center-border.png) left top no-repeat;background-size: 1442px 928px;top: 150px;position: absolute;right: 50px}
        .air-center .plane-data{width: 1442px;overflow: hidden;position: relative;font-size: 16px;}
        .air-center .plane-data ul{width: 1218px;height: 526px;margin:70px auto 0;overflow-y: auto}
        .air-center .plane-data>ul>li{width: 360px;height: 178px;background:url(<?php echo STATIC_IMG?>dataIndex/plane-border.png) left top no-repeat;background-size: 360px 178px;float: left;margin-right: 40px;margin-top: 50px}
        .air-center .plane-data>ul>li:nth-child(1){margin-top: 0}
        .air-center .plane-data>ul>li:nth-child(2){margin-top: 0}
        .air-center .plane-data>ul>li:nth-child(3){margin-top: 0}
        .air-center .plane-data>ul>li img{width: 63px;height: 29px;margin-left: 35px;vertical-align: top;margin-top: 20px;animation:pulse 1s infinite;-moz-animation:pulse 1s infinite;-webkit-animation:pulse 1s infinite;-o-animation:pulse 1s infinite;}
        .air-center .plane-data>ul>li .carPlane{width: 63px;height: 63px;vertical-align: top;margin-top: 5px;animation:pulse 1s infinite;-moz-animation:pulse 1s infinite;-webkit-animation:pulse 1s infinite;-o-animation:pulse 1s infinite;}
        .air-center .plane-data>ul>li .close-btn{width: 20px;height: 20px;background:url(<?php echo STATIC_IMG?>dataIndex/close-btn.png) center no-repeat;background-size: 20px 20px;float: right;margin-top: 15px;margin-right: 10px}
        .air-center .plane-data .plane-title{margin-top:40px;margin-left: 35px}
        .air-center .plane-data .plane-content{margin-top:10px;display: inline-block;}
        .air-center .plane-data .plane-content .plane-text{display: inline-block;margin-left: 70px}
        .air-bottom {width: 1442px;position: absolute;top: 659px;}
        .air-bottom .air-title{width: 699px;height: 37px;margin: 20px 0 0 30px;display: inline-block;font-size: 18px;background: url(<?php echo STATIC_IMG?>dataIndex/set-bottom-title.png) left top no-repeat;background-size: contain;padding-left: 50px;color: #cff7ff }
        .air-bottom .plane-form{margin: 0 0 0 50px;display: inline-block;font-size: 22px; }
        .air-bottom .plane-form ul li{display: inline-block;margin-right: 50px;margin-top: 10px}
        .air-bottom .plane-form input,select{width: 275px;height: 48px;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;padding-left: 20px;font-size: 20px;}
        .air-bottom .plane-form ul select{width: 275px}
        .air-bottom .plane-form .submit{width: 180px;height: 48px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) center no-repeat;background-size: 180px 48px;font-size: 24px;display: block;float: right;padding: 0;color: #d9d9d9;margin-left: 166px}
        .form-error{color: red;font-size: 16px;display: table-cell;}
    </style>
</head>
<body>
<div id="container">
    <div class="air-top">空气质量监控平台-数据设置</div>
    <div class="air-left">
        <a href="<?php echo base_url()?>index/indexPage" class="back">返回首页</a>
        <ul>
            <li class="air-date active"><a href="<?php echo base_url()?>index/dataSet"><img src="<?php echo STATIC_IMG?>dataIndex/set-plane.png" alt="">无人机</a></li>
            <li class="air-date"><a href="<?php echo base_url()?>index/personSet"><img src="<?php echo STATIC_IMG?>dataIndex/set-person.png" alt="">操作人员</a></li>
            <li class="air-date"><a href="<?php echo base_url()?>index/airSet"><img src="<?php echo STATIC_IMG?>dataIndex/air.png" alt="">气体阈值</a></li>

        </ul>
    </div>
    <div class="air-center">
        <div class="plane-data" id="plane-data">
            <ul>
                <?php if(!empty($plane) && isset($plane))  foreach ($plane as $k => $v){?>
                <li>
                    <a class="close-btn" id="<?php echo $v['id']?>" href="javascript:void (0)"></a>
                    <div class="plane-title">无人机<?php echo $v['productId']?></div>
                    <div class="plane-content">
                        <?php if($v['productType'] == '0'){ echo "<img src='".STATIC_IMG."dataIndex/plane.png'>";}else{ echo "<img class='carPlane' src='".STATIC_IMG."dataIndex/carPlane.png'>";} ?>
                        <div class="plane-text">
                            <p>设备类型：<?php if($v['productType'] == 1){ echo '车载';}else{ echo '无人机';} ?></p>
                            <p>飞行速度：<?php echo $v['speed']?>m/s</p>
                            <p>飞行高度：<?php echo $v['alt']?>m</p>
                        </div>
                    </div>
                </li>
                <?php }?>
            </ul>
        </div>
        <div class="air-bottom">
            <p class="air-title">
                无人机信息添加
            </p>
<!--            --><?php //echo form_open('index/dataSet', 'class="plane-form"');?>
            <form class="plane-form" method="post" id="userForm" onsubmit="return false;">
                <ul>
                    <li>产品编号：<input type="text" class="plane-number" name="productId" id="productId" data-validation="length" data-validation-length="2-10" data-validation-error-msg="产品编号须为2至10个字符"></li>
                    <li>产品类型：<select name="status" id="status">
                        <option value="1">车载</option>
                        <option value="0">无人机</option></select>
                    </li>
                    <li>平均速度：<input type="text" class="plane-number" name="speed" id="speed"  data-validation="number" data-validation-allowing="float"  data-validation-error-msg="速度须为数字"></li>
                    <li>平均高度：<input type="text" class="plane-number" name="alt" id="alt"  data-validation="number" data-validation-allowing="float"  data-validation-error-msg="高度须为数字"></li>
                    <li>视频源：<input type="text" class="plane-video" name="video" id="video" placeholder="rtsp(多个用英文逗号分隔)">
                        <input class="submit" id="submit" type="submit" value="提交"></li>
                </ul>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo STATIC_?>jquery.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/jquery.form-validator.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/common.js"></script>
<script>
    $.validate({form: '#userForm'});
    $('#submit').click(function () {
        if ($('#userForm ul li').hasClass('has-error')){
            alert('提交有误');
        }else{
            var url="<?php echo base_url() ?>index/dataSet";
            var productId=$("#productId").val();
            var status=$("#status").val();
            var speed=$("#speed").val();
            var alt=$("#alt").val();
            var video=$("#video").val();
            var urlData={productId:productId,status:status,speed:speed,alt:alt,video:video};
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
    $('.close-btn').click(function () {
        var r = confirm("确认删除嘛?");
        if(r == true){
            var url="<?php echo base_url() ?>index/delPlane";
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
</script>
</body>
</html>