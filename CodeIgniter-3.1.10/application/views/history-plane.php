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
    <title>空气质量监控系统-历史数据（无人机）</title>
    <link rel="icon" href="<?php echo STATIC_IMG?>/favicon.ico"/>
    <link href="https://cdn.bootcss.com/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="https://a.amap.com/jsapi_demos/static/demo-center/css/demo-center.css" />
    <link href="<?php echo STATIC_CSS?>dataIndex/common.css" rel="stylesheet" type="text/css" >
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
        .air-center .center-top .plane-form ul li{float: left;margin-right: 80px;margin-top: 30px}
        .air-center .center-top .plane-form input{width: 250px !important;height: 40px!important;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;padding:0 0 0 20px !important;font-size: 20px;border-radius: 40px}
        .air-center .center-top .plane-form ul li button{width: 113px;height: 40px;border: 1px solid #838383;background-color: #0d3154;color: #d9d9d9;font-size: 16px;border-radius: 40px;margin-right: 20px;margin-bottom: 20px}
        .air-center .center-top .plane-form ul li button:focus{outline:none}
        .air-center .center-top .plane-form ul li .active{box-shadow: 0 0 8px #fcea00;color: #fff363;}
        .air-center .center-top .plane-form .submit{width: 120px !important;height: 40px !important;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) center no-repeat;background-size: 180px 48px;font-size: 22px;display: block;float: right;padding: 0 !important;color: #d9d9d9}
        .air-center .plane-map{width: 1218px;height: 551px;margin:20px auto 0;border-radius: 25px;}
        .air-center .plane-map .fleft{color: #13227a;font-size: 14px;font-weight: bold}
        .air-center .plane-map .playcss{width: 32px;height: 32px;background:url(<?php echo STATIC_IMG?>dataIndex/action.png) left top no-repeat;background-size: contain}
        .air-center .map-border{width: 1248px;height: 553px;position: absolute;z-index:1;background:url(<?php echo STATIC_IMG?>dataIndex/map-border.png) left top no-repeat;    background-size: 1248px 553px;left: 503px;}
        .plane-list{height: 111px;overflow-y: auto;padding-top: 5px;}
    </style>
</head>
<body>
<div id="container">
    <div class="air-top">空气质量监控系统-历史数据</div>
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
                    <li>结束时间：<input type="text" class="plane-name" name="time" id="endTime" readonly ></li>
                    <li class="plane-list">无人机：
                        <?php if($planeList) foreach ($planeList as $k => $v){?>
                            <button class="button" type="button" data-id="<?php echo $v['productId']?>"><?php echo $v['productId']?></button>
                        <?php }?>
                        <button class="submit" id="submit" type="button" >搜索</button>
                    </li>
                </ul>
            </form>
        </div>
        <div><div id="allmap" class="plane-map"></div></div>
    </div>
</div>
<script type="text/javascript" src="<?php echo STATIC_?>jquery.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/rollSlide.js"></script>
<script src="https://cdn.bootcss.com/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ZY3NXS5MWZXGlHaTQikPK3BuxnxQF0hB"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/common.js"></script>
<!--<script type="text/javascript" src="--><?php //echo STATIC_JS?><!--dataIndex/planeMap.js"></script>-->
<script>
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
                PointArr = res.data.point;
                speed = res.data.speed;
                alt = res.data.alt;
            }
        });
        var points = [];
        var pointStart = new BMap.Point(PointArr[0].BLng, PointArr[0].BLat);
        var pointEnd=new BMap.Point(PointArr[PointArr.length-1].BLng, PointArr[PointArr.length-1].BLat);
        for(var i=0;i<PointArr.length;i++){
            var pointTemp = new BMap.Point(PointArr[i].BLng, PointArr[i].BLat);
            points.push(pointTemp);
        }
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
                '<span class="cric ccolor_g"></span><span>平均高度:'+alt+'m</span>'+
                '</div>'+
                '<div>'+
                '<span class="cric ccolor_b"></span><span>平均速度:'+speed+'m/s</span>'+
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
                //显示小车子
                car = new BMap.Marker(points[0],{icon:myIcon2});
                map.addOverlay(car);
                //标注起点、终点
                var sic=cxt+'dataIndex/position.png';
                var smyIcon = new BMap.Icon(sic,new BMap.Size(25,25),{imageSize: new BMap.Size(25,25),});
                var eic=cxt+'dataIndex/position.png';
                var emyIcon = new BMap.Icon(eic,new BMap.Size(25,25),{imageSize: new BMap.Size(25,25),});
                var sMark=new BMap.Marker(pointStart,{icon:smyIcon});
                map.addOverlay(sMark);
                var eMark=new BMap.Marker(pointEnd,{icon:emyIcon});
                map.addOverlay(eMark);
                //点亮操作按钮
                playBtn.disabled = false;
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
    });
</script>
</body>
</html>