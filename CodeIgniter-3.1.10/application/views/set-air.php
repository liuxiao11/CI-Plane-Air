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
    <title>空气质量监控系统-数据设置（气体阈值）</title>
    <link rel="icon" href="<?php echo STATIC_IMG?>/favicon.ico"/>
    <link href="<?php echo STATIC_CSS?>dataIndex/bootstrap.min.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo STATIC_CSS?>dataIndex/bootstrap-select.min.css" rel="stylesheet" type="text/css" >
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
        .air-table{width: 1218px;height: 526px;margin:70px auto 0;font-size: 20px;overflow-y: auto;}
        .air-table table{width: 95%;text-align: center;border-spacing: 0;border-collapse: collapse;}
        .air-table table th,td{text-align: center;padding: 8px}
        .air-table table thead tr{background-color: rgba(78,166,255,0.3)}
        .air-table table tbody tr:nth-child(even){background-color: rgba(78,166,255,0.1)}
        .air-bottom {width: 1442px;position: absolute;top: 812px}
        .air-bottom .air-title{width: 699px;height: 37px;margin: 20px 0 0 30px;display: inline-block;font-size: 18px;background: url(<?php echo STATIC_IMG?>dataIndex/set-bottom-title.png) left top no-repeat;background-size: contain;padding-left: 50px;color: #cff7ff }
        .air-bottom .plane-form{margin: 20px 0 0 90px;font-size: 22px;}
        .air-bottom .plane-form p{margin: 30px;display: inline-block}
        .air-bottom .plane-form .bootstrap-select{width: 280px !important;}
        .air-bottom .plane-form .btn-default{height: 48px!important;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;}
        .air-bottom .plane-form .btn-default:focus{border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;}
        .air-bottom .plane-form .btn-default:hover{border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;}
        .air-bottom .plane-form select,input{width: 280px;height: 48px;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;padding-left: 20px;font-size: 20px;}
        .form-error{color: red;font-size: 16px;display: table-cell;border-radius: 4px}
        .air-bottom .plane-form .submit{width: 180px;height: 48px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) center no-repeat;background-size: 280px 48px;font-size: 24px;padding: 0;color: #d9d9d9;margin-left: 72px}
    </style>
</head>
<body>
<div id="container">
    <div class="air-top">空气质量监控系统-数据设置</div>
    <div class="air-left">
        <a href="<?php echo base_url()?>index/indexPage" class="back">返回首页</a>
        <ul>
            <li class="air-date"><a href="<?php echo base_url()?>index/dataSet"><img src="<?php echo STATIC_IMG?>dataIndex/set-plane.png" alt="">无人机</a></li>
            <li class="air-date"><a href="<?php echo base_url()?>index/personSet"><img src="<?php echo STATIC_IMG?>dataIndex/set-person.png" alt="">操作人员</a></li>
            <li class="air-date active"><a href="<?php echo base_url()?>index/airSet"><img src="<?php echo STATIC_IMG?>dataIndex/air.png" alt="">气体阈值</a></li>
        </ul>
    </div>
    <div class="air-center">
        <div class="air-table">
            <table>
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>气体名称</th>
                        <th>气体阈值</th>
                        <th>更新时间</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(isset($airList) && !empty($airList)) foreach ($airList as $k => $v){?>
                    <tr>
                        <td><?php echo $v['id']?></td>
                        <td><?php echo $v['field']?></td>
                        <td><?php echo $v['threshold']?></td>
                        <td><?php echo $v['datetime']?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
        <div class="air-bottom">
            <p class="air-title">
                气体阈值添加
            </p>
            <form action="" class="plane-form" method="post" id="userForm" >
                <p>
                    气体：
                    <select  id="main_air" name="main_air" data-placeholder="请输入选择"
                         class="selectpicker show-tick "  data-size="10"
                         data-live-search="true" data-validation="selectRequire" title="请输入选择">
                        <?php if(isset($airList) && !empty($airList)) foreach ($airList as $k => $v){?>
                        <option value="<?php echo $v['id']?>"><?php echo $v['field']?></option>
                        <?php }?>
                    </select>
                </p>
                <p>阈值：
                    <input type="text" id="tsh" data-validation="number" data-validation-allowing="float"  data-validation-error-msg="阈值须为数字">
                </p>
                <p>
                    <input class="submit" id="submit" type="submit" value="更新">
                </p>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo STATIC_?>jquery.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/rollSlide.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/jquery.form-validator.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/bootstrap-select.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/common.js"></script>
<script>
    $.validate({form: '#userForm'});
    $('.selectpicker').selectpicker();
    $('#submit').click(function () {
        var url="<?php echo base_url() ?>index/airSet";
        var air=$("#main_air").val();
        var tsh=$("#tsh").val();
        var urlData={air:air,tsh:tsh};
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