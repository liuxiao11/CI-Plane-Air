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
    <title>空气质量监控平台-历史数据（无人机）</title>
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
        .air-date{width: 260px;height: 60px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) left top no-repeat;background-size: 260px 60px;font-size: 20px;line-height: 60px;margin-top:40px;}
        .air-date img{width: 28px;height: 28px;vertical-align: sub;margin-left: 20px;margin-right: 20px}
        .air-date a{color: #b8c5c8}
        .air-left .active{color: #fff363;background:url(<?php echo STATIC_IMG?>dataIndex/date-active.png) left top no-repeat;background-size: 260px 60px;}
        .air-left .active a{color: #fff363}
        .air-center{width: 1442px;height: 928px;background:url(<?php echo STATIC_IMG?>dataIndex/history-border.png) left top no-repeat;background-size: 1442px 928px;    position: absolute;top: 150px;right: 50px;}
        .air-center .center-top {width: 1442px;height: 299px}
        .air-center .center-top .air-title{width: 699px;height: 37px;margin: 30px 0 0 40px;font-size: 18px;background: url(<?php echo STATIC_IMG?>dataIndex/set-bottom-title.png) left top no-repeat;background-size: contain;padding-left: 50px;color: #cff7ff; }
        .air-center .center-top .plane-form{width: 1250px;height: 230px;margin-left:110px;display: inline-block;font-size: 22px; }
        .air-center .center-top .plane-form ul li{float: left;margin-right: 80px;margin-top: 30px}
        .air-center .center-top .plane-form input{width: 250px !important;height: 40px!important;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;padding:0 0 0 20px !important;font-size: 20px;border-radius: 40px}
        .air-center .center-top .plane-form ul li button{width: 113px;height: 40px;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;font-size: 16px;border-radius: 40px;margin-right: 20px;margin-bottom: 20px}
        .air-center .center-top .plane-form ul li button:focus{outline:none}
        .air-center .center-top .plane-form ul li .active{box-shadow: 0 0 8px #fcea00;color: #fff363;}
        .air-center .center-top .plane-form .submit{width: 120px !important;height: 40px !important;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) center no-repeat;background-size: 180px 48px;font-size: 22px;display: block;float: right;padding: 0 !important;color: #d9d9d9}
        .air-center .mapPlaneBox{float: left;width: 890px;}
        .air-center .plane-map{width: 790px;height: 515px;margin:40px 20px 0 90px;border-radius: 25px;}
        .air-center .plane-map .fleft{color: #13227a;font-size: 14px;font-weight: bold}
        .air-center .plane-map .playcss{width: 32px;height: 32px;background:url(<?php echo STATIC_IMG?>dataIndex/action.png) left top no-repeat;background-size: contain}
        .air-center .map-border{width: 1248px;height: 553px;position: absolute;z-index:1;background:url(<?php echo STATIC_IMG?>dataIndex/map-border.png) left top no-repeat;    background-size: 1248px 553px;left: 503px;}
        .plane-list{height: 111px;overflow-y: auto;padding-top: 5px;}
        .map-p{margin: 80px auto 0; font-size: 18px;text-align: center}
        /*气体详情*/
        .airDesBox{float: left;display: none}
        .airBox{margin-left: 20px}
        .air{width: 460px;height: 460px;margin: 60px 0 0 10px;}
        .air-chart{margin: 0 auto;display: block}
    </style>
</head>
<body>
<div id="container">
    <div class="air-top">空气质量监控平台-历史数据</div>
    <div class="air-left">
        <a href="<?php echo base_url()?>index/indexPage" class="back">返回首页</a>
        <ul>
            <li class="air-date active"><a href="<?php echo base_url()?>index/planeHis"><img src="<?php echo STATIC_IMG?>dataIndex/set-plane.png" alt="">无人机</a></li>
            <li class="air-date"><a href="<?php echo base_url()?>index/airHis"><img src="<?php echo STATIC_IMG?>dataIndex/air.png" alt="">气体</a></li>
        </ul>
    </div>
    <div class="air-center">
        <div class="center-top">
            <p class="air-title">
                无人机历史数据查看
            </p>
            <form class="plane-form">
                <ul>
                    <li>开始时间：<input type="text" class="plane-name" name="time" id="startTime" readonly value="<?php echo date('Y-m-d')?>"></li>
                    <li>结束时间：<input type="text" class="plane-name" name="time" id="endTime" readonly value="<?php echo date('Y-m-d')?>"></li>
                    <li class="plane-list">无人机：
                        <?php if(!empty($planeList) && isset($planeList)) foreach ($planeList as $k => $v){?>
                            <button class="button" type="button" data-id="<?php echo $v['productId']?>"><?php echo $v['productId']?></button>
                        <?php }?>
                        <button class="submit" id="submit" type="button" >搜索</button>
                    </li>
                </ul>
            </form>
        </div>
        <div class="mapPlaneBox" id="mapPlaneBox"><div id="allmap" class="plane-map"></div></div>
        <!--气体详情弹窗-->
        <div class="airDesBox" id="alert">
            <div class="airBox">
                <div class="air" id="airBox">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo STATIC_?>jquery.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/rollSlide.js"></script>
<script src="<?php echo STATIC_JS?>dataIndex/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/echarts.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/echarts-wordcloud.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/china.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=nVzaOG4nXU266Xgw2HZZvEyvfHIGlsmm"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/common.js"></script>
<!--<script type="text/javascript" src="--><?php //echo STATIC_JS?><!--dataIndex/planeMap.js"></script>-->
<script>
    $('#closeBtn').click(function () {
        $('.alertPopBoxBg').hide();
    });
    //选择
    $('.plane-form .button').click(function () {
        $(this).addClass('active').siblings().removeClass('active');
    });
</script>
<script>
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
<script type="text/javascript">
    //搜索
    $('#submit').click(function () {
        var url="<?php echo base_url() ?>index/planeHis";
        var startTime=$("#startTime").val();
        var endTime=$("#endTime").val();
        var planeId=$('.plane-form .active').data('id');
        if(!planeId){
            alert('请选择无人机');
        }
        var urlData={startTime:startTime,endTime:endTime,planeId:planeId};
        var PointArr;
        var speed;
        var alt;
        $.ajax({
            type : "post",
            url :url,
            data : urlData,
            async : false, //重点
            dataType:'json',
            success : function(res){
                console.log(res)
                if(res.status === "true"){
                    $('#alert').hide();
                    PointArr = res.data.point;
                    alt = res.data.alt;
                    var points = [];
                    var pointStart = new BMap.Point(PointArr[0].BLng, PointArr[0].BLat);
                    var pointStartTime = PointArr[0].time;
                    var pointEnd=new BMap.Point(PointArr[PointArr.length-1].BLng, PointArr[PointArr.length-1].BLat);
                    var pointEndT=PointArr.length-1;
                    var pointEndTime=PointArr[pointEndT].time;
                    var cxt = "/user_guide/_static/images/";
                    var clng,clat;
                    var imei= "";
                    var map = new BMap.Map("allmap",{minZoom:8,maxZoom:17});     //百度地图对象
                    var car;   //飞机图标
                    var centerPoint;
                    var timer;     //定时器
                    var index = 0; //记录播放到第几个point
                    // var pointA={BLng:108.9531326294,BLat:34.2935302306};
                    var playBtn;
                    var ic=cxt+'dataIndex/plane1.png';
                    var myIcon2 = new BMap.Icon(
                        ic, // 百度图片
                        new BMap.Size(40,40), // 视窗大小
                        {
                            imageSize: new BMap.Size(35,35), // 引用图片实际大小　
                        }
                    );
                    for(var i=0;i<PointArr.length;i++){
                        var pointTemp = new BMap.Point(PointArr[i].BLng, PointArr[i].BLat);
                        points.push(pointTemp);
                        var eic=cxt+'dataIndex/position.png';
                        var myIcon = new BMap.Icon(eic,new BMap.Size(25,25),{imageSize: new BMap.Size(25,25),});
                        /**** 创建无人机图标，并在地图上显示无人机图标，且鼠标经过无人机图标时，显示无人机的详细信息 ***/
                        var steelMarker = new BMap.Marker(new BMap.Point(PointArr[i].BLng, PointArr[i].BLat), {icon: myIcon});	//创建无人机图标
                        var steelContent = '<div><p>'+PointArr[i].time+'</p><p style="margin:0;line-height:1;font-size:13px;text-indent:2em"><br/>经度：' + PointArr[i].BLat + '<br/>纬度：' + PointArr[i].BLng + '<br/>' +
                            '<button type="button" onclick="dataAny('+PointArr[i].BLng+', '+PointArr[i].BLat+')" style="width: 180px;height: 25px;float: left;background-color: #e9873e;border: none;color: #ffffff;margin-top: 15px">查看该点气体数据</button></p></div>';//无人机详情弹出框
                        map.addOverlay(steelMarker); // 将无人机图标添加到地图中
                        addMouseoverHandler(steelContent, steelMarker); //添加鼠标滑过无人机图标时显示无人机详情的事件
                    }
                    function ZoomControl1(){
                        // 默认停靠位置和偏移量
                        this.defaultAnchor = BMAP_ANCHOR_BOTTOM_LEFT;
                        this.defaultOffset = new BMap.Size(5, 50); // 距离左上角位置
                    }
                    function ZoomControl2(){
                        // 默认停靠位置和偏移量
                        this.defaultAnchor = BMAP_ANCHOR_BOTTOM_RIGHT;
                        this.defaultOffset = new BMap.Size(20, 70); // 距离右上角位置
                    }
                    ZoomControl1.prototype = new BMap.Control();
                    ZoomControl2.prototype = new BMap.Control();
                    ZoomControl1.prototype.initialize = function(map){
                        // 创建一个DOM元素
                        var div = document.createElement("div");
                        // 添加文字说明
                        var div1 = '<div class="fleft">'+
                            '<div>'+
                            '<span class="cric ccolor_r"></span><span>时间:'+startTime+'至'+endTime+'</span>'+
                            '</div>'+
                            '<div>'+
                            '<span class="cric ccolor_g"></span><span>平均高度:'+alt/100+'m</span>'+
                            '</div>'+
                            '</div>';
                        div.innerHTML = div1;
                        // 添加DOM元素到地图中
                        map.getContainer().appendChild(div);
                        // 将DOM元素返回
                        return div;
                    };
                    ZoomControl2.prototype.initialize = function(map){
                        // 创建一个DOM元素
                        var div = document.createElement("div");
                        // 添加文字说明
                        var div1 = '<div class="fright">'+
                            '<a href="#" onclick="round();">'+
                            '<img src="'+cxt+'dataIndex/zoom-in.png"/>'+
                            '</a>'+
                            '<a  href="#" onclick="shrink();">'+
                            '<img src="'+cxt+'dataIndex/zoom-out.png"/>'+
                            '</a>'+
                            '<a href="#" onclick="reset()">'+
                            '<img src="'+cxt+'dataIndex/focus.png"/>'+
                            '</a>'+
                            '<div class="playd">'+
                            '<input id="play" type="button" onclick="play();" disabled class="playcss"/>'+
                            '</div>'+
                            '</div>';
                        div.innerHTML = div1;
                        // 添加DOM元素到地图中
                        map.getContainer().appendChild(div);
                        // 将DOM元素返回
                        return div;
                    };
                    // 创建控件
                    var myZoomCtrl1 = new ZoomControl1();
                    var myZoomCtrl2 = new ZoomControl2();
                    // 添加到地图当中
                    map.addControl(myZoomCtrl1);
                    map.addControl(myZoomCtrl2);

                    map.addEventListener("click",function(e){
                        console.log(e.point)
                    });
                    init();
                    function init() {
                        playBtn = document.getElementById("play");
                        map.centerAndZoom(pointStart,16);
                        map.setCenter(pointStart);
                        map.enableScrollWheelZoom();
                        map.addControl(new BMap.ScaleControl());
                        //通过DrivingRoute获取一条路线的point
                        var driving = new BMap.DrivingRoute(map);
                        driving.search(pointStart, pointEnd);
                        driving.setSearchCompleteCallback(function() {
                            //连接所有点
                            map.addOverlay(new BMap.Polyline(points, {strokeColor: "#D1C9C6", strokeWeight: 5, strokeOpacity: 1}));
                            //显示无人机
                            car = new BMap.Marker(points[0],{icon:myIcon2});
                            map.addOverlay(car);
                            // //标注起点、终点
                            var sic=cxt+'dataIndex/start_point.png';
                            var smyIcon = new BMap.Icon(sic,new BMap.Size(30,30),{imageSize: new BMap.Size(30,30),});
                            var eic=cxt+'dataIndex/end_point.png';
                            var emyIcon = new BMap.Icon(eic,new BMap.Size(30,30),{imageSize: new BMap.Size(30,30),});
                            var sMark=new BMap.Marker(pointStart,{icon:smyIcon});
                            map.addOverlay(sMark);
                            var eMark=new BMap.Marker(pointEnd,{icon:emyIcon});
                            map.addOverlay(eMark);
                            console.log(pointStart)
                            /**** 创建无人机图标，并在地图上显示无人机图标，且鼠标经过无人机图标时，显示无人机的详细信息 ***/
                            var steelContent = '<div><p>'+pointStartTime+'</p><p style="margin:0;line-height:1;font-size:13px;text-indent:2em"><br/>经度：' + pointStart.lng + '<br/>纬度：' + pointStart.lat + '<br/>' + '<button type="button" onclick="dataAny('+pointStart.lng+','+pointStart.lat+')" style="width: 180px;height: 25px;float: left;background-color: #e9873e;border: none;color: #ffffff;margin-top: 15px">查看开始点气体数据</button></p></div>';//无人机详情弹出框
                            var steelContent1 = '<div><p>'+pointEndTime+'</p><p style="margin:0;line-height:1;font-size:13px;text-indent:2em"><br/>经度：' + pointEnd.lng + '<br/>纬度：' + pointEnd.lat + '<br/>' + '<button type="button" onclick="dataAny('+pointEnd.lng+','+pointEnd.lat+')" style="width: 180px;height: 25px;float: left;background-color: #e9873e;border: none;color: #ffffff;margin-top: 15px">查看结束点气体数据</button></p></div>';//无人机详情弹出框
                            addMouseoverHandler(steelContent, sMark); //添加鼠标滑过无人机图标时显示无人机详情的事件
                            addMouseoverHandler(steelContent1, eMark); //添加鼠标滑过无人机图标时显示无人机详情的事件
                            //点亮操作按钮
                            playBtn.disabled = false;
                        });
                    }
                    dataAny = function(lng,lat) {
                        var url="<?php echo base_url() ?>index/dataAnalyse";
                        var urlData={lat:lat,lng:lng,planeId:planeId};
                        $.ajax({
                            type : "post",
                            url :url,
                            data : urlData,
                            async : false, //重点
                            dataType:'json',
                            success : function(res){
                                console.log(res)
                                if(res.status == 'true'){
                                    $('#alert').show();
                                    $('#airBox').html('<div class="air-chart" id="air" style="width: 100%;height: 100%"></div>')
                                    var myChartSO2 = echarts.init(document.getElementById("air"));
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
                                        tooltip: {
                                            trigger: 'axis',
                                            axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                                                type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                                            },
                                        },

                                        grid: {
                                            left: '3%',
                                            right: '4%',
                                            bottom: '3%',
                                            containLabel: true
                                        },
                                        xAxis: [
                                            {
                                                type: 'category',
                                                data: res.data.airlist,
                                                axisTick: {
                                                    alignWithLabel: true,
                                                },
                                                axisLine: {
                                                    lineStyle: {
                                                        color: ['#041530'],
                                                        width: 1,
                                                    }
                                                }
                                            }
                                        ],
                                        yAxis: [
                                            {
                                                type: 'value',
                                                axisLine: {
                                                    lineStyle: {
                                                        color: ['#041530'],
                                                        width: 1,
                                                    }
                                                },
                                                splitLine: {
                                                    show: true,
                                                    lineStyle: {
                                                        color: ['#041530'],
                                                        width: 1,
                                                        type: 'solid'
                                                    }
                                                }
                                            }
                                        ],
                                        series: [
                                            {
                                                name: 'air',
                                                type: 'bar',
                                                barWidth: '40%',
                                                data: res.data.air,
                                                label: {
                                                    show: true, //开启显示
                                                    position: 'top', //在上方显示
                                                    textStyle: { //数值样式
                                                        color: '#f9fbfb',
                                                        fontSize: 20,
                                                        fontWeight: 600
                                                    }
                                                }
                                            }
                                        ]
                                    };
                                    myChartSO2.setOption(optionSO2, true);
                                }else{
                                    alert('该点数据异常')
                                }

                            }
                        });
                    };
                    play = function (){
                        playBtn.disabled = true;
                        var point = points[index];
                        pointA=point;
                        if(index > 0) {
                            map.addOverlay(new BMap.Polyline([points[index - 1], point], {strokeColor: "#d4237a", strokeWeight: 5, strokeOpacity: 1}));
                        }
                        car.setPosition(point);
                        car.setRotation(PointArr[index].Direction);
                        index++;
                        if(index < points.length) {
                            focusMap();
                            timer = window.setTimeout("play(" + index + ")", 200);
                        } else {
                            playBtn.disabled = true;
                            map.panTo(point);
                            reset();
                        }
                    };
                    shrink = function (){//缩小
                        map.zoomTo(map.getZoom() - 1);
                    };
                    round = function (){//放大
                        map.zoomTo(map.getZoom() + 1);
                    };
                    focusMap = function(){
                        map.setCenter(pointA);//使飞机保持在中心点位置移动
                    };
                    reset = function (){ //重置
                        playBtn.disabled = false;
                        if(timer) {
                            window.clearTimeout(timer);
                        }
                        index = 0;
                        pointA =points[0];
                        car.setPosition(points[0]);
                        map.setCenter(pointStart);
                    };

                    /****** 鼠标滑过标注时显示详情的事件 *******/
                    var opts = {
                        width: 260,     // 信息窗口宽度
                        height: 134,     // 信息窗口高度
                        title: "<b>无人机信息</b>", // 信息窗口标题
                        enableMessage: true //设置允许信息窗发送短息
                    };

                    function addMouseoverHandler(content, marker) {
                        /***** 鼠标滑过事件 ******/
                        marker.addEventListener("mouseover", function (e) {
                            openInfo(content, e);
                        });

                    }
                    /**** 鼠标滑过时打开详情弹出框 *****/
                    function openInfo(content, e) {
                        var p = e.target;
                        var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
                        var infoWindow = new BMap.InfoWindow(content, opts);  // 创建信息窗口对象
                        map.openInfoWindow(infoWindow, point); //开启信息窗口
                    }
                }else{
                    $('#alert').hide();
                    $('#mapPlaneBox').html("<div id='allmap' class='plane-map'><p class='map-p'>没有相关数据...</p></div>");
                }
            }
        });
    });
</script>
</body>
</html>