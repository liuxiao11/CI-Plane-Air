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
    <title>空气质量监控平台-历史数据（当日）</title>
    <link rel="icon" href="<?php echo STATIC_IMG?>/favicon.ico"/>
    <link href="<?php echo STATIC_CSS?>dataIndex/jquery.datetimepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://a.amap.com/jsapi_demos/static/demo-center/css/demo-center.css" />
    <link href="<?php echo STATIC_CSS?>dataIndex/common.css" rel="stylesheet" type="text/css" >
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
        .air-center .center-top .plane-form ul li{margin-right: 80px;margin-top: 30px}
        .air-center .center-top .plane-form input{width: 250px !important;height: 40px!important;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;padding:0 0 0 20px !important;font-size: 20px;border-radius: 40px}
        .air-center .center-top .plane-form ul li .button{width: 113px;height: 40px;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;font-size: 16px;border-radius: 40px;margin-right: 20px;margin-bottom: 5px}
        .air-center .center-top .plane-form ul li .button:focus{outline:none}
        .air-center .center-top .plane-form ul li .active{box-shadow: 0 0 8px #fcea00;color: #fff363;}
        .air-center .center-top .plane-form .submit{width: 120px !important;height: 40px !important;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) center no-repeat;background-size: 180px 48px;font-size: 22px;display: block;float: right;padding: 0 !important;color: #d9d9d9;margin-top: -25px;position: relative;z-index: 10;}
        .air-center .mapPlaneBox{float: left;width: 100%;}
        .plane-list{height: 50px;overflow-y: auto;padding-top: 5px;}
        .map-p{margin: 80px auto 0; font-size: 18px;text-align: center}

        .air-chart{margin: 0 auto;display: block;width: 100%;height: 550px;margin-top: 30px;}
        /*定义航线*/
        .plane-line{font-size: 20px;margin-top: 15px}
        .plane-line .button{height: 48px;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;text-align: center;vertical-align: top;}
        .plane-line input,select{width: 210px;height: 48px;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;padding-left: 20px;font-size: 20px;}
        .plane-line a{display: inline-block}
    </style>
</head>
<body>
<div id="container">
    <div class="air-top">空气质量监控平台-历史数据</div>
    <div class="air-left">
        <a href="/index/indexPage" class="back">返回首页</a>
        <ul>
            <li class="air-date"><a href="/index/planeHis"><img src="<?php echo STATIC_IMG?>dataIndex/set-plane.png" alt="">无人机数据查询分析</a></li>
            <li class="air-date"><a href="/index/airHis"><img src="<?php echo STATIC_IMG?>dataIndex/set-car.png" alt="">车载数据查询分析</a></li>
            <li class="air-date"><a href="/index/hisAll"><img src="<?php echo STATIC_IMG?>dataIndex/all.png" alt="">综合数据查询分析</a></li>
            <li class="air-date active"><a href="/index/hisToday"><img src="<?php echo STATIC_IMG?>dataIndex/today.png" alt="">当日数据查询分析</a></li>
            <li class="air-date"><a href="/index/hisWarning"><img src="<?php echo STATIC_IMG?>dataIndex/air.png" alt="">报警记录查询</a></li>
        </ul>
    </div>
    <div class="air-center">
        <div class="center-top">
            <p class="air-title">
                当日历史数据查看
            </p>
            <form class="plane-form">
                <ul>
                    <li>时间：<input type="text" class="plane-name" name="time" id="startTime" readonly value="<?php echo date('Y-m-d')?>"></li>
                    <li class="plane-list" id="plane">设备：
                        <?php if(!empty($planeList) && isset($planeList)) foreach ($planeList as $k => $v){?>
                            <button class="button" type="button" data-id="<?php echo $v['productId']?>"><?php echo $v['name']?></button>
                        <?php }?>
                    <li class="plane-line" >航线：<select id="line" name="line" class="selectpicker show-tick " >
                        </select>
                        </li>
                    <button class="submit" id="submit" type="button" >搜索</button>
                    </li>
                </ul>
            </form>
        </div>
        <div class="mapPlaneBox" id="mapPlaneBox"><div id="air" class="air-chart">

            </div></div>
    </div>
</div>
<script type="text/javascript" src="<?php echo STATIC_?>jquery.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/rollSlide.js"></script>
<script src="<?php echo STATIC_JS?>dataIndex/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/echarts.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/echarts-wordcloud.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/china.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/common.js"></script>
<!--<script type="text/javascript" src="--><?php //echo STATIC_JS?><!--dataIndex/planeMap.js"></script>-->
<script>

    $('#closeBtn').click(function () {
        $('.alertPopBoxBg').hide();
    });
    //选择
    $(document).on('click','.plane-form .button',function () {
        $(this).addClass('active').siblings().removeClass('active');
    });
    //选择
    $('#plane button').click(function () {
        var url="/index/findLine";
        var id = $(this).data('id');
        var urlData={id:id};

        $.ajax({
            type : "post",
            url :url,
            data : urlData,
            async : false, //重点
            dataType:'json',
            success : function(res){
                console.log(res);
                if(res.status == 'true'){
                    $('#line').html('');
                    for (var i=0;i<=res.data.length;i++){
                        var html = '<option value="'+res.data[i]['id']+'">'+res.data[i]['lineName']+'</option>';
                        $('#line').append(html);
                    }
                }else{
                    $('#line').html('');
                }
            }
        })
    });
</script>
<script type="text/javascript">
    //搜索
    $('#submit').click(function () {
        var url="/index/hisToday";
        var startTime=$("#startTime").val();
        var lineId=$('#line').val();
        console.log(lineId);
        var planeId=$('#plane button.active').data('id');
        if(!planeId){
            alert('请选择设备');
        }
        var urlData={startTime:startTime,lineId:lineId,planeId:planeId};

        $.ajax({
            type : "post",
            url :url,
            data : urlData,
            async : false, //重点
            dataType:'json',
            success : function(res){
                console.log(res)
                if(res.status === "true"){
                    //综合图
                    var myChartWarning = echarts.init(document.getElementById("air"));
                    var optionW = {
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'cross',
                                label: {
                                    backgroundColor: '#283b56'
                                }
                            }
                        },
                        toolbox: {
                            show: true,
                            feature: {
                                magicType: {
                                    type: ['line', 'bar']
                                },  //切换为折线图，切换为柱状图
                                saveAsImage: {
                                    name:"气体数据图",
                                    type:"jpeg",
                                    backgroundColor:"rgba(0,0,0,.5)",
                                }   //保存为图片
                            },
                            right:"100px",
                        },
                        calculable: true,
                        legend: {
                            data:res.data.airList,
                            textStyle: {
                                fontSize: 10,
                                color: '#ffffff'
                            },
                        },

                        dataZoom: {
                            show: true,
                            start:0,
                            end:20
                        },
                        xAxis: [
                            {
                                type: 'category',
                                data: res.data.recTime,
                                axisTick: {
                                    alignWithLabel: true,
                                },
                                axisLine: {
                                    lineStyle: {
                                        color:'#eee',
                                        width: 1,
                                    }
                                }
                            }
                        ],
                        yAxis: [
                            {
                                type: 'value',
                                axisLine:{
                                    lineStyle:{
                                        width:1,
                                        color:'#eee',//y轴的轴线的宽度和颜色
                                    }
                                },
                                splitLine: {
                                    show: true,
                                    lineStyle: {
                                        color: ['#231e40'],
                                        width: 1,
                                        type: 'solid'
                                    }
                                }
                            }

                        ],
                        series: [
                            {name: 'CO',
                                type: 'bar',
                                data: res.data.CO,
                            },
                            {name: 'SO2',
                                type: 'bar',
                                data:  res.data.SO2,

                            },
                            {
                                name: 'NO2',
                                type: 'bar',
                                data:  res.data.NO2,
                            },
                            {
                                name: 'O3',
                                type: 'bar',
                                data:  res.data.O3,
                            },{
                                name: 'PM2.5',
                                type: 'bar',
                                data:  res.data['PM2.5'],
                            },
                            {
                                name: 'PM10',
                                type: 'bar',
                                data:  res.data.PM10,
                            }
                        ]
                    };
                    myChartWarning.setOption(optionW);
                    window.onresize = function () {
                        myChartWarning.resize();
                    };
                }else{
                    $('#mapPlaneBox').html("<div id='allmap' class='plane-map'><p class='map-p'>没有相关数据...</p></div>");
                }
            }
        });
    });

</script>
</body>
</html>