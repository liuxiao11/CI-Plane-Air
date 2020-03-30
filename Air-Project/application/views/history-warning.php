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
    <title>空气质量监控平台-历史数据（气体预警）</title>
    <link rel="icon" href="<?php echo STATIC_IMG?>/favicon.ico"/>
    <link href="<?php echo STATIC_CSS?>dataIndex/common.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo STATIC_CSS?>dataIndex/jquery.datetimepicker.min.css" rel="stylesheet">
<!--    <script type="text/javascript" src="--><?php //echo STATIC_JS?><!--dataIndex/px2rem.js"></script>-->
    <style>
        /*#container{position:relative;width:100%;height:100%;min-width:1200px;max-width:3840px;min-height:720px;max-height:2160px;}*/
        .air-top{position:absolute;width:100%;height:93px;background:url(<?php echo STATIC_IMG?>dataIndex/top.png) left top no-repeat;background-size: 100% 100%;font-size: 37px;line-height: 93px;text-align: center}
        .air-left{display: inline-block;width:384px;position: absolute;left: 30px;top: 64px;}
        .air-left .back{padding-left: 60px;line-height: 40px;background:url(<?php echo STATIC_IMG?>dataIndex/back.png) left top no-repeat;background-size: 40px 40px;font-size: 30px;color: #29c4fd}
        .air-left ul li:nth-child(1){margin-top: 60px}
        .air-date{width: 280px;height: 60px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) left top no-repeat;background-size: 280px 60px;font-size: 20px;line-height: 60px;margin-top:40px;}
        .air-date img{width: 28px;height: 28px;vertical-align: sub;margin-left: 20px;margin-right: 20px}
        .air-date a{color: #b8c5c8}
        .air-left .active{color: #fff363;background:url(<?php echo STATIC_IMG?>dataIndex/date-active.png) left top no-repeat;background-size: 280px 60px;}
        .air-left .active a{color: #fff363}
        .air-center{width: 1442px;height: 928px;background:url(<?php echo STATIC_IMG?>dataIndex/history-border.png) left top no-repeat;background-size: 1442px 928px;    position: absolute;top: 150px;right: 50px;}
        .air-center .center-top {width: 1442px;height: 299px}
        .air-center .center-top .air-title{width: 699px;height: 37px;margin: 30px 0 0 40px;font-size: 18px;background: url(<?php echo STATIC_IMG?>dataIndex/set-bottom-title.png) left top no-repeat;background-size: contain;padding-left: 50px;color: #cff7ff; }
        .air-center .center-top .plane-form{width: 1250px;height: 230px;margin-left:110px;display: inline-block;font-size: 22px; }
        .air-center .center-top .plane-form ul li{float: left;margin-right: 40px;margin-top: 30px}
        .air-center .center-top .plane-form input,select{width: 250px;height: 40px;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;padding-left: 20px;font-size: 20px;border-radius: 40px}
        .air-center .center-top .plane-form option{font-size: 20px;}
        .air-center .center-top .plane-form ul li button{width: 113px;height: 40px;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;font-size: 16px;border-radius: 40px;margin-right: 20px;margin-bottom: 20px}
        .air-center .center-top .plane-form ul li button:focus{outline:none}
        .air-center .center-top .plane-form ul li .active{box-shadow: 0 0 8px #fcea00;color: #fff363;}
        .air-center .center-top .plane-form .submit{width: 120px;height: 40px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) center no-repeat;background-size: 180px 48px;font-size: 22px;display: block;float: right;padding: 0;color: #d9d9d9}
        .air-bottom{padding-left: 75px;height: 555px;overflow-y: auto;margin-right: 52px;margin-top: 10px;}
        .air{width: 1290px;height: 500px;margin-top: 15px;display: inline-block; margin-right: 10px}
        .air-chart{margin: 0 auto}
        .air .air-title{margin: 11px 0 0 30px;display: inline-block;font-size: 12px}
        .date-chose{margin-top: 15px;font-size: 18px;color: khaki;}
        .air-list{height: 111px;overflow-y: auto;padding-top: 5px;}

        .air-table{width: 1218px;height: 526px;margin:0px auto 0;font-size: 20px;overflow-y: auto;}
        .air-table table{width: 95%;text-align: center;border-spacing: 0;border-collapse: collapse;}
        .air-table table th,td{text-align: center;padding: 8px}
        .air-table table thead tr{background-color: rgba(78,166,255,0.3)}
        .air-table table tbody tr:nth-child(even){background-color: rgba(78,166,255,0.1)}
    </style>
</head>
<body>
<div id="container">
    <div class="air-top">空气质量监控平台-历史数据</div>
    <div class="air-left">
        <a href="<?php echo base_url()?>index/indexPage" class="back">返回首页</a>
        <ul>
            <li class="air-date"><a href="<?php echo base_url()?>index/planeHis"><img src="<?php echo STATIC_IMG?>dataIndex/set-plane.png" alt="">无人机数据查询分析</a></li>
            <li class="air-date"><a href="<?php echo base_url()?>index/airHis"><img src="<?php echo STATIC_IMG?>dataIndex/carPlane.png" alt="">车载数据查询分析</a></li>
            <li class="air-date active"><a href="<?php echo base_url()?>index/hisWarning"><img src="<?php echo STATIC_IMG?>dataIndex/air.png" alt="">报警记录查询</a></li>
        </ul>
    </div>
    <div class="air-center">
        <div class="center-top">
            <p class="air-title">
                报警历史数据查看
            </p>
            <form action="" class="plane-form">
                <ul>
                    <li>开始时间：<input type="text" class="datetimepicker" name="time" id="startTime" readonly value="<?php echo date('Y-m-d')?>"></li>
                    <li>结束时间：<input type="text" class="datetimepicker" name="time" id="endTime" readonly value="<?php echo date('Y-m-d')?>"></li>
                    <li class="plane-list">设备：
                        <?php if(!empty($planeList) && isset($planeList)) foreach ($planeList as $k => $v){?>
                            <button class="button" type="button" data-id="<?php echo $v['productId']?>"><?php echo $v['name']?></button>
                        <?php }?>
                        <button class="submit" id="submit" type="button" >搜索</button>
                    </li>
                </ul>
            </form>
        </div>
        <div class="air-bottom">
            <div id="airList" class="air-table">
                <table>
                    <thead>
                    <tr>
                        <th>设备id</th>
                        <th>气体名称</th>
                        <th>采集值</th>
                        <th>阈值</th>
                        <th>报警时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo STATIC_?>jquery.js"></script>
<script src="<?php echo STATIC_JS?>dataIndex/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/echarts.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/echarts-wordcloud.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/china.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/rollSlide.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/common.js"></script>
<script>
    //选择
    $('.plane-form .button').click(function () {
        $(this).addClass('active').siblings().removeClass('active');
    });
    //提交
    $('#submit').click(function () {
        var url="/index/hisWarning";
        var startTime=$("#startTime").val();
        var endTime=$("#endTime").val();
        var planeId=$('.plane-form .active').data('id');
        if(!planeId){
            alert('请选择设备');
        }
        var urlData={startTime:startTime,endTime:endTime,planeId:planeId};
        $.post(url,urlData,function(result){
            var res = result.data;
            if(result.status == 'true'){
                $('#airList table tbody').html('');
                for (var i=0;i<=res.length;i++){
                    var html= '<tr>' +
                        '<td>'+res[i].productID+'</td>' +
                        '<td>'+res[i].airName+'</td>' +
                        '<td>'+res[i].airNum+'</td>' +
                        '<td>'+res[i].airTsh+'</td>' +
                        '<td>'+res[i].time+'</td>' +
                        '</tr>';
                    $('#airList table tbody').append(html);
                }

            }else if(result.status == 'false'){
                alert(result.tips);
            }
        },"json");
    });

    /*日期选择*/
    var modal = (function() {
        var initDate = function(startDateTimeId,endDateTimeId) {
            var startDate;
            var endDate;
            startDateTimeId="#"+startDateTimeId;
            endDateTimeId="#"+endDateTimeId;
            $(startDateTimeId).datetimepicker({
                lang:'ch',
                format: 'Y-m-d',
                timepicker:false,
                onChangeDateTime: function(dp, $input) {
                    startDate = $(startDateTimeId).val();
                },
                onClose: function(current_time, $input) {
                    if (startDate > endDate) {
                        $(startDateTimeId).val(endDate);
                        startDate=endDate;
                    }
                }
            });
            $(endDateTimeId).datetimepicker({
                lang:'ch',
                format: 'Y-m-d',
                timepicker:false,
                onClose: function(current_time, $input) {
                    endDate = $(endDateTimeId).val();
                    if (startDate > endDate) {
                        $(endDateTimeId).val(startDate);
                        endDate=startDate;
                    }
                }
            });
        };
        return {
            initDate: initDate
        };
    })();
    modal.initDate("startTime","endTime");
</script>
</body>
</html>