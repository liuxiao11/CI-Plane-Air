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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" rel="stylesheet">
<!--    <script type="text/javascript" src="--><?php //echo STATIC_JS?><!--dataIndex/px2rem.js"></script>-->
    <style>
        /*#container{position:relative;width:100%;height:100%;min-width:1200px;max-width:3840px;min-height:720px;max-height:2160px;}*/
        .air-top{position:absolute;width:100%;height:93px;background:url(<?php echo STATIC_IMG?>dataIndex/top.png) left top no-repeat;background-size: 100% 100%;font-size: 37px;line-height: 93px;text-align: center}
        .air-left{display: inline-block;width:384px;margin-left: 30px;margin-top: 64px;float: left}
        .air-left .back{padding-left: 60px;line-height: 40px;background:url(<?php echo STATIC_IMG?>dataIndex/back.png) left top no-repeat;background-size: 40px 40px;font-size: 30px;color: #29c4fd}
        .air-left ul li:nth-child(1){margin-top: 60px}
        .air-date{width: 260px;height: 60px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) left top no-repeat;background-size: 260px 60px;font-size: 20px;line-height: 60px;margin-top:40px;}
        .air-date img{width: 28px;height: 28px;vertical-align: sub;margin-left: 20px;margin-right: 20px}
        .air-date a{color: #b8c5c8}
        .air-left .active{color: #fff363;background:url(<?php echo STATIC_IMG?>dataIndex/date-active.png) left top no-repeat;background-size: 260px 60px;}
        .air-left .active a{color: #fff363}
        .air-center{width: 1442px;height: 928px;background:url(<?php echo STATIC_IMG?>dataIndex/history-border.png) left top no-repeat;background-size: 1442px 928px;margin-top: 150px;float: left}
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
        .date-chose{margin-top: 15px;font-size: 18px}
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
                    <li>开始时间：<input type="text" class="datetimepicker" name="time" id="startTime" readonly value="2019-11-02"></li>
                    <li>结束时间：<input type="text" class="datetimepicker" name="time" id="endTime" readonly value="2019-11-08"></li>
                    <li>区域筛选：<select name="area" id="area">
                            <option value="1">未央区</option>
                            <option value="2">雁塔区</option>
                            <option value="3">碑林区</option>
                            <option value="4">长安区</option>
                        </select></li>
                    <li>气体：
                        <button type="button" class="button active" data-id="SO2">SO2</button>
                        <button type="button" class="button active" data-id="NO2">NO2</button>
                        <button type="button" class="button active" data-id="PM10">PM10</button>
                        <button type="button" class="button active" data-id="PM2.5">PM2.5</button>
                        <button type="button" class="button active" data-id="CO">CO</button>
                        <button type="button" class="button active" data-id="O3">O3</button>
                        <button class="button" type="button" data-id="CH4">CH4</button>
                        <button class="button" type="button" data-id="SF6">SF6</button>
                        <button class="button" type="button" data-id="H2O2">H2O2</button>
                        <button class="button" type="button" data-id="COCL2">COCL2</button>
                        <button class="submit" id="submit" type="button" >搜索</button>
                    </li>
                </ul>
            </form>
        </div>
        <div class="air-bottom">
            <div id="airList">
                <div class="date-chose" id="date">2019-11-02</div>
                <div id="airData">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo STATIC_?>jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js
"></script>
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
            var actLen = $('.plane-form .active').length;
            if(actLen > 6){
                $(this).removeClass('active');
                alert('一次最多可选6项')
            }
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
            console.log(result);
            if(result.status == 'true'){
                for (var i=0;i<result.data.time.length;i++){
                    $('#airList #date').eq(i).text(result.data.time[i])
                }
                for (var i=0;i<result.data.air.length;i++){
                    var html ='<div class="air air-SO2">' +
                        '<p class="air-title">SO2</p>' +
                        '<div class="air-chart" id="SO2" style="width: 95%;height: 88%"></div>' +
                        '</div>';
                    $('#airData').append(html)
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

    //柱状图SO2/NO2
    var myChartSO2 = echarts.init(document.getElementById("SO2"));
    var myChartNO2 = echarts.init(document.getElementById("NO2"));
    var myChartPM = echarts.init(document.getElementById("PM"));
    var myChartSO21 = echarts.init(document.getElementById("SO21"));
    var myChartNO21 = echarts.init(document.getElementById("NO21"));
    var myChartPM1 = echarts.init(document.getElementById("PM1"));
    var optionPM = {
        textStyle: {
            color: '#f9fbfb',
        },
        tooltip : {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                label: {
                    backgroundColor: '#6a7985'
                }
            }
        },
        legend: {
            itemWidth: 13,
            itemHeight: 10,
            top: 10,
            textStyle:{
                fontSize:10,
                color: '#ffffff'
            },
            data:['PM10']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                data : ['0:00', '02:00', '04:00', '06:00', '08:00', '10:00', '12:00'],
                axisLine:{
                    lineStyle: {
                        color: '#041530',
                        width: 1,
                    }
                }
            }
        ],
        yAxis : [
            {
                type : 'value',
                axisLine:{
                    lineStyle: {
                        color: '#041530',
                        width: 1,
                    }
                },
                splitLine: {
                    show: true,
                    lineStyle:{
                        color: ['#041530'],
                        width: 1,
                        type: 'solid'
                    }
                }
            }
        ],
        series : [
            {
                name:'PM10',
                type:'line',
                stack: '总量',
                areaStyle: {
                    normal:{
                        color : 'rgba(118,234,255,0.5)'
                    }
                },
                itemStyle:{
                    color : '#76eaff'
                },
                lineStyle:{
                    color : new echarts.graphic.LinearGradient(
                        0, 0, 0, 1,
                        [
                            {offset: 0, color: '#12c0bc'},
                            {offset: 1, color: '#76eaff'},
                        ])
                },
                data:[120, 132, 101, 134, 90, 230, 210]
            }
        ]
    };
    var optionSO2 = {
        textStyle: {
            color: '#f9fbfb',
        },
        color: new echarts.graphic.LinearGradient(
            0, 0, 0, 1,
            [
                {offset: 0, color: '#00e3fc'},
                {offset: 1, color: 'rgba(0,105,255,0.1)'}
            ]),
        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            },
        },
        legend: {
            itemWidth: 13,
            itemHeight: 10,
            left: 210,
            top: 25,
            textStyle:{
                fontSize:10,
                color: '#ffffff'
            },
            data:['SO2']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                data : ['0:00', '02:00', '04:00', '06:00', '08:00', '10:00', '12:00'],
                axisTick: {
                    alignWithLabel: true,
                },
                axisLine:{
                    lineStyle: {
                        color: ['#041530'],
                        width: 1,
                    }
                }
            }
        ],
        yAxis : [
            {
                type : 'value',
                axisLine:{
                    lineStyle: {
                        color: ['#041530'],
                        width: 1,
                    }
                },
                splitLine: {
                    show: true,
                    lineStyle:{
                        color: ['#041530'],
                        width: 1,
                        type: 'solid'
                    }
                }
            }
        ],
        series : [
            {
                name:'SO2',
                type:'bar',
                barWidth: '40%',
                data:[60, 300, 12, 200, 309, 390, 220]
            }
        ]
    };
    var optionNO2 = {
        textStyle: {
            color: '#f9fbfb',
        },
        color: new echarts.graphic.LinearGradient(
            0, 0, 0, 1,
            [
                {offset: 0, color: '#ffdf81'},
                {offset: 1, color: 'rgba(255,223,129,0.1)'}
            ]),
        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            },
        },
        legend: {
            itemWidth: 13,
            itemHeight: 10,
            left: 210,
            top: 25,
            textStyle:{
                fontSize:10,
                color: '#FFFFFF'
            },
            data:['NO2']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                data : ['0:00', '02:00', '04:00', '06:00', '08:00', '10:00', '12:00'],
                axisTick: {
                    alignWithLabel: true,
                },
                axisLine:{
                    lineStyle: {
                        color: ['#041530'],
                        width: 1,
                    }
                }
            }
        ],
        yAxis : [
            {
                type : 'value',
                axisLine:{
                    lineStyle: {
                        color: ['#041530'],
                        width: 1,
                    }
                },
                splitLine: {
                    show: true,
                    lineStyle:{
                        color: ['#041530'],
                        width: 1,
                        type: 'solid'
                    }
                }
            }
        ],
        series : [
            {
                name:'NO2',
                type:'bar',
                barWidth: '40%',
                data:[10, 52, 200, 334, 390, 330, 220]
            }
        ]
    };
    myChartSO2.setOption(optionSO2, true);
    myChartNO2.setOption(optionNO2, true);
    myChartPM.setOption(optionPM, true);
    myChartSO21.setOption(optionSO2, true);
    myChartNO21.setOption(optionNO2, true);
    myChartPM1.setOption(optionPM, true);
    window.onresize = function(){
        myChartSO2.resize();
        myChartNO2.resize();
        myChartPM.resize();
        myChartSO21.resize();
        myChartNO21.resize();
        myChartPM1.resize();
    };
</script>
</body>
</html>