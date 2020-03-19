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
    <meta http-equiv="Content-Type" content="te xt/html; charset=UTF-8"/>
    <title>空气质量监控平台-首页</title>
    <link rel="icon" href="<?php echo STATIC_IMG?>/favicon.ico"/>
    <link href="<?php echo STATIC_CSS?>dataIndex/easyui.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo STATIC_CSS?>dataIndex/globle.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo STATIC_CSS?>dataIndex/common.css" rel="stylesheet" type="text/css" >
    <style>
        .top{position:absolute;width:100%;height:93px;font-size: 37px;line-height: 93px;text-align: center;letter-spacing: 10px}
        .air-top{position:absolute;width:100%;height:93px;background:url(<?php echo STATIC_IMG?>dataIndex/top22.png) left top no-repeat;background-size: 100% 100%;}
        .air-left{display: inline-block;width:420px;margin-top: 55px;position: absolute;left: 5px}
        .air-date{width: 388px;height: 59px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) left top no-repeat;background-size: contain;font-size: 22px;line-height: 59px;margin: 0 auto}
        .air-left .air-date .air-icon{width: 11px;height: 11px;background:url(<?php echo STATIC_IMG?>dataIndex/icon.png) left top no-repeat;background-size: contain;vertical-align:middle;margin-left: 11px}
        .air{width: 415px;height: 226px;background:url(<?php echo STATIC_IMG?>dataIndex/air-border1.png) left top no-repeat;background-size: contain;margin: 20px auto;overflow:hidden }
        .air object{width: 430px;height: 243px;overflow:hidden;margin: 0 auto;display: block; }
        .air #allmap{width: 377px;height: 163px;margin: 50px 15px 0;}
        .air:last-child{margin-bottom: 0}
        .air-chart{margin: 0 auto}
        .air .air-title{margin: 8px 0 0 30px;display: inline-block;font-size: 14px}
        .air-center{position: absolute;width: 1033px;height: 928px;margin-top: 140px;left: 50%;margin-left: -516.5px;}
        .air-center .plane-data{width: 1033px;height: 167px;overflow: hidden;position: relative;}
        .air-center .plane-data ul{width: 918px;height: 150px;margin:17px auto 0;}
        .air-center .plane-data>ul>li{width: 274px;height: 150px;background:url(<?php echo STATIC_IMG?>dataIndex/plane-border2.png) left top no-repeat;background-size: contain;float: left;margin-left: 40px;margin-top: 13px}
        .air-center .plane-data>ul>li:nth-child(1){margin-left: 0;}
        .air-center .plane-data>ul>li img{width: 63px;height: 29px;vertical-align: top;margin-top: 35px ;animation:pulse 1s infinite;-moz-animation:pulse 1s infinite;-webkit-animation:pulse 1s infinite;-o-animation:pulse 1s infinite;}
        .air-center .plane-data>ul>li .carPlane{width: 63px;height: 50px;margin-top: 20px;vertical-align: top;animation:pulse 1s infinite;-moz-animation:pulse 1s infinite;-webkit-animation:pulse 1s infinite;-o-animation:pulse 1s infinite;}
        .air-center .plane-data .plane-title{color: #f9fbfb;margin-top: 10px}
        .air-center .plane-data>ul>li.active .plane-title{color: #02FFFA;}
        .air-center .plane-data .plane-img{width: 128px;height: 105px;text-align: center;display: inline-block;}
        .air-center .plane-data .plane-content{margin-top:8px;display: inline-block;}
        .air-center .plane-data>ul>li.active .plane-content{color: #02FFFA}
        .air-center .plane-data .plane-content .plane-text{display: inline-block;margin-left: 20px;margin-top: 15px}
        .air-center .plane-data .plane-content .plane-text p{line-height: 22px}
        .roll_row .roll__list::before, .roll_row .roll__list::after {content: "";display: table;line-height: 0;}
        .roll_row .roll__list::after {clear: both;}
        .roll_row .roll__list{width: 9999px;}
        .roll_col .roll__list{width: 100%;}
/*        .air-center .map-border{width: 960px;height: 467px;margin:0 auto 0;border: 20px ridge transparent;border-image:url(*/<?php //echo STATIC_IMG?>/*dataIndex/border.gif) 30 30 round ;}*/
        .air-center .center-top{width: 1033px;height: 700px;background:url(<?php echo STATIC_IMG?>dataIndex/center-top.png) left top no-repeat;background-size: cover;}
        .air-center .plane-map{width: 952px;height: 465px;margin:20px auto 0; border-radius: 25px;border: 5px ridge #00679c;}
        .air-center object{width: 936px;height: 430px;display: block;margin:10px auto 0; border-radius: 25px;}
        .air-center .map-border .air-title{display: inline-block}
        .air-center .map-border #choice_url{float: right;margin-right: 15px;margin-top: 0;border: 1px solid #838383;background-color: #0d3154;color: #FFFFFF;height: 30px}
        .air-center .map-border{width: 952px;height: 465px;display: block;margin:10px auto 0; border-radius: 25px;}
        .air-bottom .air{display: inline-block;width: 341px;margin: 0;margin-top: 5px;background:url(<?php echo STATIC_IMG?>dataIndex/air_bottom_border.png) left top no-repeat;background-size: contain;}

        .air-right {display: inline-block;width:420px;margin-top: 55px;position: absolute;right: 1px;}
        .air-right .air-btn{text-align: center}
        .air-right .air-btn-border{width: 121px;height: 33px;background:url(<?php echo STATIC_IMG?>dataIndex/air-btn-bg.png) left top no-repeat;background-size: contain;font-size: 16px;color: #fff363;text-align: center;line-height: 33px;display: inline-block}
        .air-right .air-btn-border img{width: 22px;height: 22px;vertical-align: sub;margin-right: 5px}
        .air-right .info1{width: 415px;height: 327px;background:url(<?php echo STATIC_IMG?>dataIndex/b-air-border1.png) left top no-repeat;background-size: contain;margin: 28px 0}
        .info1 .air-title{margin: 8px 0 0 20px;display: inline-block;font-size: 14px}
        .info1 #choice_url{float: right;margin-right: 15px;margin-top: 21px;border: 1px solid #838383;background-color: #0d3154;color: #FFFFFF;height: 30px}
        .air-right .number{width: 318px;height: 50px;margin:20px auto 10px ;text-align: center;font-size: 16px;}
        .air-right .plane-person{width: 380px;height: 259px;margin:30px auto 0 ;font-size: 14px;}
        .air-right .plane-map{width: 374px;height: 259px;margin: 0 auto;top: 52px;}
        /*弹窗*/
        .alertPopBoxBg{display:none;position: fixed;bottom: 0;left: 0;top: 0;right: 0;width: 100%;height: 1080px;background-color: rgba(0,0,0,0.6);z-index: 102;}
        .alertPopBox{display:block;position:absolute;margin:auto;width:672px;height:520px;top: 0;left: 0;right: 0;bottom: 0;background: url(<?php echo STATIC_IMG?>dataIndex/alert-border.png) left top rgba(9,33,68,0.5);}
        .alertPopBox .close-btn{width: 28px;height: 28px;float: right;margin: 15px;}
        .alertPopBox .air-table{padding: 10px;width: 95%;height: 80%;overflow-y: auto}
        .air-table table{width: 100%;text-align: center;border-spacing: 0;border-collapse: collapse;}
        .air-table table th,td{text-align: center;padding: 8px}
        .air-table table thead tr{background-color: rgba(78,166,255,0.3)}
        .air-table table tbody tr:nth-child(even){background-color: rgba(78,166,255,0.1)}

    </style>
    <script>
        WIDGET = {ID: '82iyG2gmyN'};
    </script>
    <script type="text/javascript" src="https://apip.weatherdt.com/view/static/js/r.js?v=1111"></script>
</head>
<body>
<div id="container">
    <div class="top"><div class="air-top" id="upload-img"></div>空气质量监控平台</div>
    <div class="air-left">
        <div class="air-date">
            <i class="air-icon"></i>
            <span id="date">2019年10月26日 星期六</span>
        </div>
        <div class="weather" style="margin-top: 24px"  ondrop="drop(event,this)" ondragover="allowDrop(event,this)" draggable="true" ondragstart="drag(event,this)">
            <div id="weather-view-he"></div>
        </div>
        <div class="air air-aqi" ondrop="drop(event,this)" ondragover="allowDrop(event,this)" draggable="true" ondragstart="drag(event,this)">
            <p class="air-title">AQI指数</p>
            <div class="air-chart" id="aqi" style="width: 98%;height: 85%"></div>
        </div>
        <div class="air air-PM10" ondrop="drop(event,this)" ondragover="allowDrop(event,this)" draggable="true" ondragstart="drag(event,this)">
            <p class="air-title">PM10</p>
            <div class="air-chart"  id="PM10" style="width: 98%;height: 85%"></div>
        </div>
        <div class="air air-PM2.5" ondrop="drop(event,this)" ondragover="allowDrop(event,this)" draggable="true" ondragstart="drag(event,this)">
            <p class="air-title">PM2.5</p>
            <div class="air-chart" id="PM2_5" style="width: 98%;height: 85%"></div>
        </div>
    </div>

    <div class="air-center" >
        <div class="center-top">
            <div class="plane-data roll-wrap roll_row" id="plane-data">
                <ul class="roll__list">
                    <?php if($plane) foreach ($plane as $k => $v){?>
                    <li>
                        <div class="plane-content">
                            <div class="plane-img">
                                <?PHP if( $v['productType'] == "0"){?>
                                    <img  src="<?php echo STATIC_IMG?>dataIndex/plane.png" alt="无人机">
                                <?php }else{?>
                                <img class="carPlane" src="<?php echo STATIC_IMG?>dataIndex/carPlane.png" alt="无人机"><?php }?>
                                <div class="plane-title" data-id="<?php echo $v['productID']?>">无人机<?php echo $v['productID']?></div>
                                </div>
                            <div class="plane-text">
                                <p>湿度：<?php echo $v['uHumidity']?></p>
                                <p>温度：<?php echo $v['iTempertrue']?></p>
                                <p>高度：<?php echo $v['nGPS_alt']?>m</p>
                                </div>
                            </div>
                        </li>
                    <?php }?>
                </ul>
            </div>
            <div class="map-border" id="gridsterBox1" ondrop="drop(event,this)" ondragover="allowDrop(event,this)" draggable="true" ondragstart="drag(event,this)">
                <div id="allmap" class="plane-map" ></div>
            </div>
        </div>
        <div class="air-bottom">
            <div class="air air-O3" >
                <p class="air-title">O3</p>
                <div class="air-chart" id="O3" style="width: 95%;height: 85%"></div>
            </div>
            <div class="air air-SO2"  >
                <p class="air-title">SO2</p>
                <div class="air-chart" id="SO2" style="width: 95%;height: 85%"></div>
            </div>
            <div class="air air-NO2" >
                <p class="air-title">NO2</p>
                <div class="air-chart" id="NO2" style="width: 95%;height: 85%"></div>
            </div>
        </div>
    </div>

    <div class="air-right">
        <div class="air-date air-btn">
            <a href="<?php echo base_url()?>index/dataSet" class="air-btn-border"><img src="<?php echo STATIC_IMG?>dataIndex/btn-set.png">数据设置</a>
            <a href="<?php echo base_url()?>index/planeHis" class="air-btn-border"><img src="<?php echo STATIC_IMG?>dataIndex/btn-history.png">历史记录</a>
        </div>
        <div class="info1 air-warning">
            <p class="air-title">气体预警和风险数量</p>
            <a href="javascript:void (0)" id="warningDis" class="air-title" style="float: right;margin-right: 15px">更多详情</a>
            <div class="number">
                <div class="num-btn air-btn1" id="warning-total">今日预警总数：<div id="dataNums"></div></div>
                <!--                <i class="num-btn air-btn2"><span>166</span><br>今日查阅总数</i>-->
            </div>
            <div class="air-chart" id="warning" style="width: 95%;height: 63%"></div>
        </div>
        <div class="info1 gridsterBox" id="gridsterBox" ondrop="drop(event,this)" ondragover="allowDrop(event,this)" draggable="true" ondragstart="drag(event,this)">
            <p class="air-title">设备信息</p>
            <select id="choice_url" >
                <?php if(isset($video_url) && !empty($video_url)) foreach ($video_url as $vk => $vv){?>
                    <option value="<?php echo $vv?>">视频源<?php echo $vk+1?></option>
                <?php }?>
            </select>
            <div class="plane-person" >
                <object classid="clsid:E23FE9C6-778E-49D4-B537-38FCDE4887D8"
                        codebase="http://downloads.videolan.org/pub/videolan/vlc/latest/win32/axvlc.cab"
                        width="100%"
                        height="100%"
                        events="True"
                        id="vlc2"  ondrop="drop(event,this)" ondragover="allowDrop(event,this)" draggable="true" ondragstart="drag(event,this)">
                    <param name="MRL" value="udp://@239.255.1.1:1234" />
                    <param name="ShowDisplay" value="True" />
                    <param name="Loop" value="False" />
                    <param name="AutoPlay" value="True" />
                    <embed type="application/x-vlc-plugin"
                           pluginspage="http://www.videolan.org"
                           width="100%"
                           height="100%"
                           src="<?php if(isset($video_url) && !empty($video_url)) echo $video_url[0]?>"
                           id="vlc">
                    </embed>
                </object>
            </div>
        </div>
        <div class="air air-CO" ondrop="drop(event,this)" ondragover="allowDrop(event,this)" draggable="true" ondragstart="drag(event,this)">
            <p class="air-title">CO</p>
            <div class="air-chart" id="CO" style="width: 95%;height: 85%"></div>
        </div>
    </div>
    <!--气体预警详情弹窗-->
    <div class="alertPopBoxBg" id="alert">
        <div class="alertPopBox">
            <a href="javascript:void (0)" id="closeBtn"><img class="close-btn" src="<?php echo STATIC_IMG?>dataIndex/close.png" ></a>
            <h3 style="margin: 15px">预警信息</h3>
            <div class="air-table">
                <table id="airWarTable">
                    <thead>
                    <tr>
                        <th>无人机编号</th>
                        <th>气体名称</th>
                        <th>采集值</th>
                        <th>气体阈值</th>
                        <th>时间</th>
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
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/echarts.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/echarts-wordcloud.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/china.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/rollSlide.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/num.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=nVzaOG4nXU266Xgw2HZZvEyvfHIGlsmm"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/air.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/common.js"></script>
<script>
    $('#vlc').click(function () {
        if($(this)[0].paused){
            $(this)[0].play();
        }else{
            $(this)[0].pause();
        }
    });
    $(document).on('change','#choice_url',function () {
        var url = $(this).val();
        var vlc = $('#vlc');
        vlc.remove()
        var str = '<param name="MRL" value="udp://@239.255.1.1:1234" /><param name="ShowDisplay" value="True" /> <param name="Loop" value="False" /> <param name="AutoPlay" value="True" /><embed src="'+ url +'" type="application/x-vlc-plugin" pluginspage="http://www.videolan.org" width="100%" height="100%" id="vlc">';
        $('#vlc2').html(str);
    });
    function allowDrop(ev,divdom) {
        ev.preventDefault();
    }
    var srcdiv = null;
    var temp = null;
    //当拖动时触发
    function drag(ev, divdom) {
        srcdiv = divdom;
        temp = divdom.innerHTML;
    }
    function dis(id,mychart) {
        var mychart = echarts.getInstanceById($('#'+id).attr("_echarts_instance_"));
        if (mychart != null && mychart != "" && mychart != undefined) {
            mychart.dispose();
        }
        var chats = document.getElementById(id);
        if(chats){
            mychart = echarts.init(chats);
            return mychart;
        }else{
            return false;
        }
    }
    //当拖动完后触发
    function drop(ev, divdom) {
        ev.preventDefault();
        if (srcdiv !== divdom) {
            srcdiv.innerHTML = divdom.innerHTML;
            divdom.innerHTML = temp;
            $('.air').find('.ditu').remove();
            $.post('/index/indexPage', function (data) {
                if (data.status == 'true') {
                    Time = data.data.time;
                    var dataAir = data.data.air;
                    console.log(dataAir)
                    var PM2data = [];
                    var PM10data = [];
                    var COdata = [];
                    if (dataAir) {
                        for (var i = 0; i < dataAir.length; i++) {
                            PM2data.push(dataAir[i].uPM2_5);
                            PM10data.push(dataAir[i].uPM10);
                            COdata.push(dataAir[i].uCO);
                        }
                        //折线图
                        var myChartPM10 = echarts.init(document.getElementById("PM10"));
                        var myChartPM2_5 = echarts.init(document.getElementById("PM2_5"));
                        var myChartCO = echarts.init(document.getElementById("CO"));
                        var myChartaqi = echarts.init(document.getElementById("aqi"));
                        var optionaqi = {
                            textStyle: {
                                color: '#f9fbfb',
                            },
                            tooltip: {
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
                                textStyle: {
                                    fontSize: 10,
                                    color: '#ffffff'
                                },
                                data: ['aqi']
                            },
                            grid: {
                                left: '3%',
                                right: '4%',
                                bottom: '3%',
                                containLabel: true
                            },
                            xAxis: {
                                type: 'category',
                                data: data.data.aqix,
                                boundaryGap: false,
                                axisTick:{
                                    show:false,
                                },
                                axisLabel:{
                                    color:'#fff'
                                },
                                axisLine:{
                                    lineStyle:{
                                        color:'rgba(12,102,173,.5)',
                                        width:2,
                                    }
                                }
                            },
                            yAxis: {
                                type: 'value',
                                axisTick:{
                                    show:true,//不显示刻度线
                                },
                                axisLabel:{
                                    color:'#fff'  //y轴上的字体颜色
                                },
                                axisLine:{
                                    lineStyle:{
                                        width:2,
                                        color:'rgba(12,102,173,.5)',//y轴的轴线的宽度和颜色
                                    }
                                },
                                splitLine: {
                                    show: false
                                }
                            },
                            series: [
                                {
                                    name: 'PM10',
                                    type:'line',
                                    itemStyle: {
                                        normal: {
                                            color: '#ffdf81',
                                        }
                                    },
                                    areaStyle: {
                                        normal: {
                                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                                offset: 0,
                                                color: '#ffdf81'
                                            }, {
                                                offset: 1,
                                                color: 'rgba(255,223,129,0.1)'
                                            }])
                                        }
                                    },
                                    data: data.data.aqi
                                }
                            ]
                        };
                        var optionPM10 = {
                            textStyle: {
                                color: '#f9fbfb',
                            },
                            tooltip: {
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
                                textStyle: {
                                    fontSize: 10,
                                    color: '#ffffff'
                                },
                                data: ['PM10']
                            },
                            grid: {
                                left: '3%',
                                right: '4%',
                                bottom: '3%',
                                containLabel: true
                            },
                            xAxis: {
                                type: 'category',
                                data: Time,
                                axisTick:{
                                    show:false,
                                },
                                boundaryGap: false,
                                axisTick:{
                                    show:false,
                                },
                                axisLabel:{
                                    color:'#fff'
                                },
                                axisLine:{
                                    lineStyle:{
                                        color:'rgba(12,102,173,.5)',
                                        width:2,
                                    }
                                }
                            },
                            yAxis: {
                                type: 'value',
                                axisTick:{
                                    show:true,//不显示刻度线
                                },
                                axisLabel:{
                                    color:'#fff'  //y轴上的字体颜色
                                },
                                axisLine:{
                                    lineStyle:{
                                        width:2,
                                        color:'rgba(12,102,173,.5)',//y轴的轴线的宽度和颜色
                                    }
                                },
                                splitLine: {
                                    show: false
                                }
                            },
                            series: [
                                {
                                    name: 'PM10',
                                    type:'line',
                                    symbol: 'none',
                                    smooth:true,
                                    itemStyle: {
                                        normal: {
                                            color: '#00adb5',
                                        }
                                    },
                                    areaStyle: {
                                        normal: {
                                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                                offset: 0,
                                                color: '#00adb5'
                                            }, {
                                                offset: 1,
                                                color: 'rgba(4,137,152,0.5)'
                                            }])
                                        }
                                    },
                                    data: PM10data
                                }
                            ]
                        };
                        var optionPM2_5 = {
                            textStyle: {
                                color: '#f9fbfb',
                            },
                            tooltip: {
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
                                textStyle: {
                                    fontSize: 10,
                                    color: '#ffffff'
                                },
                                data: ['PM2.5']
                            },
                            grid: {
                                left: '3%',
                                right: '4%',
                                bottom: '3%',
                                containLabel: true
                            },
                            xAxis: {
                                type: 'category',
                                data: Time,
                                axisTick:{
                                    show:false,
                                },
                                boundaryGap: false,
                                axisTick:{
                                    show:false,
                                },
                                axisLabel:{
                                    color:'#fff'
                                },
                                axisLine:{
                                    lineStyle:{
                                        color:'rgba(12,102,173,.5)',
                                        width:2,
                                    }
                                }
                            },
                            yAxis: {
                                type: 'value',
                                axisTick:{
                                    show:true,//不显示刻度线
                                },
                                axisLabel:{
                                    color:'#fff'  //y轴上的字体颜色
                                },
                                axisLine:{
                                    lineStyle:{
                                        width:2,
                                        color:'rgba(12,102,173,.5)',//y轴的轴线的宽度和颜色
                                    }
                                },
                                splitLine: {
                                    show: false
                                }
                            },
                            series: [
                                {
                                    name: 'PM2.5',
                                    type:'line',
                                    symbol: 'none',
                                    smooth:true,
                                    itemStyle: {
                                        normal: {
                                            color: '#09b0f5',
                                        }
                                    },
                                    areaStyle: {
                                        normal: {
                                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                                offset: 0,
                                                color: '#09b0f5'
                                            }, {
                                                offset: 1,
                                                color: 'rgba(12,102,173,.5)'
                                            }])
                                        }
                                    },
                                    data: PM2data
                                },
                            ]
                        };
                        var optionCO = {
                            textStyle: {
                                color: '#f9fbfb',
                            },
                            tooltip: {
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
                                textStyle: {
                                    fontSize: 10,
                                    color: '#ffffff'
                                },
                                data: ['CO', 'O3']
                            },
                            grid: {
                                left: '3%',
                                right: '4%',
                                bottom: '3%',
                                containLabel: true
                            },
                            xAxis: {
                                type: 'category',
                                data: Time,
                                axisTick:{
                                    show:false,
                                },
                                boundaryGap: false,
                                axisTick:{
                                    show:false,
                                },
                                axisLabel:{
                                    color:'#fff'
                                },
                                axisLine:{
                                    lineStyle:{
                                        color:'rgba(12,102,173,.5)',
                                        width:2,
                                    }
                                }
                            },
                            yAxis: {
                                type: 'value',
                                axisTick:{
                                    show:true,//不显示刻度线
                                },
                                axisLabel:{
                                    color:'#fff'  //y轴上的字体颜色
                                },
                                axisLine:{
                                    lineStyle:{
                                        width:2,
                                        color:'rgba(12,102,173,.5)',//y轴的轴线的宽度和颜色
                                    }
                                },
                                splitLine: {
                                    show: false
                                }
                            },
                            series: [
                                {
                                    name: 'CO',
                                    type: 'line',
                                    stack: '总量',
                                    symbol: 'none',
                                    smooth:true,
                                    itemStyle: {
                                        normal: {
                                            color: '#c5796d'
                                        }
                                    },
                                    areaStyle: {
                                        normal: {
                                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                                offset: 0,
                                                color: '#c5796d'
                                            }, {
                                                offset: 1,
                                                color: 'rgba(138,70,51,0.5)'
                                            }])
                                        }
                                    },
                                    data: COdata
                                }
                            ]
                        };
                        var myChartPM102 = dis('PM10',myChartPM10);
                        var myChartPM252 = dis('PM2_5',myChartPM2_5);
                        var myChartCO2 = dis('CO',myChartCO);
                        var myChartaqi2 = dis('aqi',myChartaqi);

                        if (myChartPM252){
                            myChartPM252.setOption(optionPM2_5);
                        }
                        if (myChartCO2){
                            myChartCO2.setOption(optionCO);
                        }
                        if (myChartPM102){
                            myChartPM102.setOption(optionPM10);
                        }
                        if (myChartaqi2){
                            myChartaqi2.setOption(optionaqi);
                        }
                        window.onresize = function () {
                            myChartPM102.resize();
                            myChartPM252.resize();
                            myChartCO2.resize();
                            myChartaqi2.resize();
                        };

                    }
                } else if (data.status == 'false') {
                    console.log('暂无数据');
                }
            }, 'json');
        }
    }

    var pic = $('#upload-img');
    var status = 1;
    function run()
    {
        $("#upload-img").fadeTo(900,status);
        if (status == 1) {
            status = 0.5;
        } else {
            status = 1;
        }
    }

    setInterval('run()',1000);
</script>
</body>
</html>