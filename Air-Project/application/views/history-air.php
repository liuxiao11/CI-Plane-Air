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
    <title>空气质量监控系统-历史数据（气体）</title>
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
        .air-date{width: 260px;height: 60px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) left top no-repeat;background-size: 260px 60px;font-size: 20px;line-height: 60px;margin-top:40px;}
        .air-date img{width: 28px;height: 28px;vertical-align: sub;margin-left: 20px;margin-right: 20px}
        .air-date a{color: #b8c5c8}
        .air-left .active{color: #fff363;background:url(<?php echo STATIC_IMG?>dataIndex/date-active.png) left top no-repeat;background-size: 260px 60px;}
        .air-left .active a{color: #fff363}
        .air-center{width: 1442px;height: 928px;background:url(<?php echo STATIC_IMG?>dataIndex/history-border.png) left top no-repeat;background-size: 1442px 928px;    position: absolute;top: 170px;right: 50px;}
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
        .air{width: 420px;height: 231px;background:url(<?php echo STATIC_IMG?>dataIndex/air-border.png) left top no-repeat;background-size: contain;margin-top: 15px;display: inline-block; margin-right: 10px}
        .air-chart{margin: 0 auto}
        .air .air-title{margin: 11px 0 0 30px;display: inline-block;font-size: 12px}
        .date-chose{margin-top: 15px;font-size: 18px;color: khaki;}
        .air-list{height: 111px;overflow-y: auto;padding-top: 5px;}
    </style>
</head>
<body>
<div id="container">
    <div class="air-top">空气质量监控系统-历史数据</div>
    <div class="air-left">
        <a href="<?php echo base_url()?>index/indexPage" class="back">返回首页</a>
        <ul>
            <li class="air-date"><a href="<?php echo base_url()?>index/planeHis"><img src="<?php echo STATIC_IMG?>dataIndex/set-plane.png" alt="">无人机</a></li>
            <li class="air-date active"><a href="<?php echo base_url()?>index/airHis"><img src="<?php echo STATIC_IMG?>dataIndex/air.png" alt="">气体</a></li>
        </ul>
    </div>
    <div class="air-center">
        <div class="center-top">
            <p class="air-title">
                无人机历史数据查看
            </p>
            <form action="" class="plane-form">
                <ul>
                    <li>开始时间：<input type="text" class="datetimepicker" name="time" id="startTime" readonly value="<?php echo date('Y-m-d')?>"></li>
                    <li>结束时间：<input type="text" class="datetimepicker" name="time" id="endTime" readonly value="<?php echo date('Y-m-d')?>"></li>
                    <li>区域筛选：<select name="area" id="area">
                            <option value="1">未央区</option>
                        </select></li>
                    <li class="air-list">气体：
                        <?php if(isset($airList) && !empty($airList)) foreach ($airList as $k => $v){?>
                            <button type="button" class="button" data-id="<?php echo $v['field']?>"><?php echo $v['field']?></button>
                        <?php }?>
                        <button class="submit" id="submit" type="button" >搜索</button>
                    </li>
                </ul>
            </form>
        </div>
        <div class="air-bottom">
            <div id="airList">
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
        if ($(this).hasClass('active')){
            $(this).removeClass('active');
        } else{
            $(this).addClass('active');
            // var actLen = $('.plane-form .active').length;
            // if(actLen > 6){
            //     $(this).removeClass('active');
            //     alert('一次最多可选6项')
            // }
        }
    });
    //提交
    $('#submit').click(function () {
        var url="<?php echo base_url() ?>index/airHis";
        var startTime=$("#startTime").val();
        var endTime=$("#endTime").val();
        var area=$("#area").val();
        var air = [];
        $('.plane-form .active').each(function () {
            air.push($(this).data('id'));
        });
        var urlData={startTime:startTime,endTime:endTime,area:area,air:air};
        $.post(url,urlData,function(result){
            console.log(result.status);
            if(result.status == 'true'){
                console.log(111)
                $('#airList').html('');
                for (var i=0;i<result.data.length;i++){
                    var str = '<div class="date-chose" id="date">'+result.data[i].time+'</div>';
                    $('#airList').append(str);
                    for (var j=0;j<air.length;j++){
                        var html ='<div class="air air-'+air[j]+'">' +
                            '<p class="air-title">'+air[j]+'</p>' +
                            '<div class="air-chart" id="'+air[j]+'-'+[i]+'" style="width: 95%;height: 88%"></div>' +
                            '</div>';
                        $('#airList').append(html);
                        var airData = [];
                        for (var x=0;x<result.data[i].air.air.length;x++){
                            airData.push(result.data[i].air.air[x][air[j]]);
                            bluetable(air[j]+'-'+[i],air[j],result.data[i].air.Time,airData);
                        }
                    }
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