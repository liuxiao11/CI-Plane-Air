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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" rel="stylesheet">
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
        .air-center #plane-map{width: 1218px;height: 551px;margin:20px auto 0;border-radius: 25px;}
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
                    <li>开始时间：<input type="text" class="plane-name" name="time" id="startTime" readonly value="2019-11-02"></li>
                    <li>结束时间：<input type="text" class="plane-name" name="time" id="endTime" readonly value="2019-11-08"></li>
                    <li class="plane-list">无人机：
                        <?php if($planeList) foreach ($planeList as $k => $v){?>
                            <button class="button" type="button" data-id="<?php echo $v['productId']?>"><?php echo $v['productId']?></button>
                        <?php }?>
                        <button class="submit" id="submit" type="button" >搜索</button>
                    </li>
                </ul>
            </form>
        </div>
        <div class="plane-map"><i class="map-border"></i><div id="plane-map" class="map" tabindex="0"></div></div>
    </div>
</div>
<script type="text/javascript" src="<?php echo STATIC_?>jquery.js"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/rollSlide.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.10&key=3ce518392b5361b83ad0abb560b4c3b1"></script>
<script type="text/javascript" src="<?php echo STATIC_JS?>dataIndex/common.js"></script>
<script>
    //选择
    $('.plane-form .button').click(function () {
        $(this).addClass('active').siblings().removeClass('active');
    });
    //搜索
    $('#submit').click(function () {
        var url="<?php echo base_url() ?>index/planeHis";
        var startTime=$("#startTime").val();
        var endTime=$("#endTime").val();
        var planeId=$('.plane-form .active').data('id');
        var urlData={startTime:startTime,endTime:endTime,planeId:planeId};
        $.post(url,urlData,function(result){
            if(result.status == 'true'){
                alert(result.tips);
            }else if(result.status == 'false'){
                alert(result.tips);
            }
        },"json");
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



    // 随机生成车辆行驶轨迹坐标
    var startLng = 108.9531326294;
    var startLat = 34.2935302306;

    function GetPoints(length) {
        var points = [];
        for (i = 0; i < length; i++) {
            var Lng;
            var Lat;
            if (i % 2 == 0) {
                Lng = parseFloat(startLng) + 0.00005;
                startLng = Lng;
                Lat = startLat;
            } else if (i % 3 == 0) {
                Lng = startLng;
                Lat = parseFloat(startLat) + 0.00003;
                startLat = Lat;
            } else if (i % 5 == 0) {
                Lng = parseFloat(startLng) + 0.00006;
                startLng = Lng;
                Lat = parseFloat(startLat) + 0.0003;
                startLat = Lat;
            } else if (i % 7 == 0) {
                Lng = parseFloat(startLng) + 0.00002;
                startLng = Lng;
                Lat = startLat;
            } else if (i % 9 == 0) {
                Lng = startLng;
                Lat = parseFloat(startLat) + 0.0003;
                startLat = Lat;
            } else {
                Lng = parseFloat(startLng) + 0.00004;
                startLng = Lng;
                Lat = parseFloat(startLat) + 0.00002;
                startLat = Lat;
            }
            var data = [];
            data[0] = Lng;
            data[1] = Lat;
            points.push(data);
        }
        return points;
    }

</script>
<script type="text/javascript">
    // 初始化地图
    var map = new AMap.Map('plane-map', {
        zoom: 18,
        center: [119, 30],
        layers: [
            // 添加交通图层
            new AMap.TileLayer.Traffic({
                zIndex: 10,
                autoRefresh: true,
                interval: 180
            }),
            new AMap.TileLayer()
        ]
    });

    // 获取所有的marker对象
    function GetMarkers(count) {
        var markerList = [];
        var points = GetPoints(count);
        for (i = 0; i < points.length; i++) {
            var marker = new AMap.Marker({
                position: new AMap.LngLat(points[i][0], points[i][1]),
                icon: new AMap.Icon({
                    size: new AMap.Size(32, 32),
                    image: "../user_guide/_static/images/dataIndex/planeS.png"
                }),
                offset: new AMap.Pixel(0, -20)
            });
            markerList.push(marker);
        }
        return markerList;
    }

    // marker数组对象
    var markerList = GetMarkers(100);

    // 根据markerList生成折线节点坐标
    function GetPath(markerList) {
        var path = [];
        for (i = 0; i < markerList.length; i++) {
            path.push(markerList[i].getPosition());
        }
        console.log(path);
        return path;
    }

    // 创建折线实例
    var polyline = new AMap.Polyline({
        path: GetPath(markerList),
        borderWeight: 4,
        strokeColor: '#f60179',
        lineJoin: 'round', // 折线拐点样式 round -> 圆形 bevel -> 斜角
        lineCap: 'round', // 折线两端样式，默认值butt -> 无头  round -> 圆头 square -> 方头
        isOutline: true, // 是否带描边
        outlineColor: '#f60179',
        strokeOpacity: 0.5,
        draggable: false, // 设置折线可以拖拽
        showDir: true
    });

    // 添加到map对象
    map.add(polyline);

    // 定时函数
    var marker = null;

    function AddMarkerToMap(markerObj) {
        if (markerObj == undefined) {
            // 清除定时函数
            window.clearInterval(timer);
            return false;
        }
        // 清除之前的maker
        if (marker != null) {
            map.remove(marker);
        }
        // 暂存
        marker = markerObj;
        // 设置地图中心为当前的marker坐标
        map.setCenter(markerObj.getPosition());
        // 添加maker
        map.add(markerObj);
    }

    // 每隔500毫秒执行
    var index = 0;
    var timer = window.setInterval("AddMarkerToMap(markerList[index++])", 200);


    // var timer = window.setInterval("AddMarkerToMap();", 500);

    // 定义折线节点坐标，每个对象为AMap.LngLat
    // var path = [
    //   new AMap.LngLat(121.0001, 32),
    //   new AMap.LngLat(121.02190000000073, 32)
    // ]


</script>
</body>
</html>