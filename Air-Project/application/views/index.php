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
    <title>空气质量监控系统-首页</title>
    <link rel="icon" href="<?php echo STATIC_IMG?>/favicon.ico"/>
    <link href="<?php echo STATIC_CSS?>dataIndex/easyui.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo STATIC_CSS?>dataIndex/globle.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo STATIC_CSS?>dataIndex/common.css" rel="stylesheet" type="text/css" >
    <style>
        .air-top{position:absolute;width:100%;height:93px;background:url(<?php echo STATIC_IMG?>dataIndex/top.png) left top no-repeat;background-size: 100% 100%;font-size: 37px;line-height: 93px;text-align: center}
        .air-left{display: inline-block;width:420px;margin-top: 55px;position: absolute;left: 5px}
        .air-date{width: 388px;height: 59px;background:url(<?php echo STATIC_IMG?>dataIndex/date.png) left top no-repeat;background-size: contain;font-size: 22px;line-height: 59px;margin: 0 auto}
        .air-left .air-date .air-icon{width: 11px;height: 11px;background:url(<?php echo STATIC_IMG?>dataIndex/icon.png) left top no-repeat;background-size: contain;vertical-align:middle;margin-left: 11px}
        .air-left .air-date .air-weather-icon{width: 47px;height: 37px;background:url(<?php echo STATIC_IMG?>dataIndex/weather-icon.png) left top no-repeat;background-size: contain;vertical-align:middle;margin-left: 35px}
        .air{width: 415px;height: 226px;background:url(<?php echo STATIC_IMG?>dataIndex/air-border.png) left top no-repeat;background-size: contain;margin: 15px auto;overflow:hidden }
        .air:last-child{margin-bottom: 0}
        .air-chart{margin: 0 auto}
        .air .air-title{margin: 11px 0 0 30px;display: inline-block;font-size: 12px}
        .air-center{position: absolute;width: 1033px;height: 928px;background:url(<?php echo STATIC_IMG?>dataIndex/center-border.png) left top no-repeat;background-size: contain;margin-top: 140px;left: 50%;margin-left: -516.5px}
        .air-center .plane-data{width: 1033px;height: 155px;overflow: hidden;position: relative;}
        .air-center .plane-data ul{width: 918px;height: 150px;margin: 0 auto}
        .air-center .plane-data>ul>li{width: 274px;height: 130px;background:url(<?php echo STATIC_IMG?>dataIndex/plane-border.png) left top no-repeat;background-size: 247px 130px;float: left;margin-left: 40px;margin-top: 22px}
        .air-center .plane-data>ul>li:nth-child(1){margin-left: 0}
        .air-center .plane-data>ul>li img{width: 63px;height: 29px;margin-left: 15px;vertical-align: top;margin-top: 20px ;animation:pulse 1s infinite;-moz-animation:pulse 1s infinite;-webkit-animation:pulse 1s infinite;-o-animation:pulse 1s infinite;}
        .air-center .plane-data>ul>li .carPlane{width: 63px;height: 63px;margin-top: 5px;vertical-align: top;animation:pulse 1s infinite;-moz-animation:pulse 1s infinite;-webkit-animation:pulse 1s infinite;-o-animation:pulse 1s infinite;}
        .air-center .plane-data .plane-title{margin-top:20px;margin-left: 15px}
        .air-center .plane-data .plane-content{margin-top:8px;display: inline-block;}
        .air-center .plane-data .plane-content .plane-text{display: inline-block;margin-left: 30px;margin-top: 10px}
        .roll_row .roll__list::before, .roll_row .roll__list::after {content: "";display: table;line-height: 0;}
        .roll_row .roll__list::after {clear: both;}
        .roll_row .roll__list{width: 9999px;}
        .roll_col .roll__list{width: 100%;}
        .air-center .map-border{width: 950px;height: 466px;position: absolute;z-index:1;background:url(<?php echo STATIC_IMG?>dataIndex/map-border.png) left top no-repeat;background-size: 950px 466px;left: 41px;}
        .air-center .plane-map{width: 920px;height: 465px;margin:20px auto 0; border-radius: 25px;}
        .air-bottom {width: 1033px;height: 250px;margin-top: 25px}
        .air-bottom .air-title{margin: 11px 0 0 30px;display: inline-block;font-size: 12px}
        .air-bottom .air-title .title-icon{width: 12px;height: 9px;background: url(<?php echo STATIC_IMG?>dataIndex/title-icon.png) left top no-repeat;background-size: contain}
        .air-right {display: inline-block;width:420px;margin-top: 55px;position: absolute;right: 1px;}
        .air-right .air-btn{text-align: center}
        .air-right .air-btn-border{width: 121px;height: 33px;background:url(<?php echo STATIC_IMG?>dataIndex/air-btn-bg.png) left top no-repeat;background-size: contain;font-size: 16px;color: #fff363;text-align: center;line-height: 33px;display: inline-block}
        .air-right .air-btn-border img{width: 22px;height: 22px;vertical-align: sub;margin-right: 5px}
        .air-right .info1{width: 415px;height: 327px;background:url(<?php echo STATIC_IMG?>dataIndex/b-air-border.png) left top no-repeat;background-size: contain;margin: 28px 0}
        .info1 .air-title{margin: 15px 0 0 30px;display: inline-block;font-size: 12px}
        .air-right .number{width: 318px;height: 50px;margin:20px auto 10px ;text-align: center;font-size: 15px;}
        .air-right .plane-person{width: 96%;height: 100%;margin:30px auto 0 ;font-size: 14px;}
        .air-right .plane-person .person{display: inline-block;margin-left: 25px;}
        .air-right .plane-person .person img{width: 160px;height: 200px;border: 1px solid #00679c}
        .air-right .plane-stock .stock{width: 153px;height: 62px;background:url(<?php echo STATIC_IMG?>dataIndex/plane1-border.png) left top no-repeat;background-size: contain;display: inline-block;float: left;overflow: hidden;margin-left: 45px;margin-bottom: 20px}
        .air-right .plane-stock {width: 98%;height: 162px;overflow-y: auto;margin-top: 25px;}
        .air-right .plane-stock>li:nth-of-type(odd){margin-left: 33px}
        .air-right .plane-stock .stock img{width: 37px;height: 37px;float: left;margin: 10px 12px}
        .air-right .plane-stock .stock p{float: left;margin: 10px 0 2px 15px}
        .air-right .plane-stock .stock button{float: left;width: 60px;margin-left: 15px;font-size:11px;background-color: #e9873e;border: none;color: #ffffff}

        /*弹窗*/
        .alertPopBoxBg{display:none;position: fixed;bottom: 0;left: 0;top: 0;right: 0;width: 100%;height: 1080px;background-color: rgba(0,0,0,0.6);z-index: 102;}
        .alertPopBox{display:block;position:absolute;margin:auto;width:672px;height:520px;top: 0;left: 0;right: 0;bottom: 0;background: url(<?php echo STATIC_IMG?>dataIndex/alert-border.png) left top rgba(9,33,68,0.5);}
        .alertPopBox .close-btn{width: 28px;height: 28px;float: right;margin: 15px;}
        .alertPopBox .air-table{padding: 10px;width: 95%;height: 80%;overflow-y: auto}
        .air-table table{width: 100%;text-align: center;border-spacing: 0;border-collapse: collapse;}
        .air-table table th,td{text-align: center;padding: 8px}
        .air-table table thead tr{background-color: rgba(78,166,255,0.3)}
        .air-table table tbody tr:nth-child(even){background-color: rgba(78,166,255,0.1)}

        /*可拖动*/
        .gridster{width: 100% !important}
    </style>
</head>
<body>
<div id="container">
    <div class="air-top">空气质量监控系统</div>
    <div class="air-left">
        <div class="air-date">
            <i class="air-icon"></i>
            <span id="date">2019年10月26日 星期六</span>
        </div>
        <div class="air air-SO2">
            <p class="air-title">SO2</p>
            <div class="air-chart" id="SO2" style="width: 95%;height: 85%"></div>
        </div>
        <div class="air air-NO2">
            <p class="air-title">NO2</p>
            <div class="air-chart" id="NO2" style="width: 95%;height: 85%"></div>
        </div>
        <div class="air air-PM10">
            <p class="air-title">PM10/PM2.5</p>
            <div class="air-chart"  id="PM" style="width: 95%;height: 85%"></div>
        </div>
        <div class="air air-CO">
            <p class="air-title">CO/O3</p>
            <div class="air-chart" id="CO-O3" style="width: 95%;height: 85%"></div>
        </div>
    </div>
    <div class="gridster">
        <div class="air-center" >
            <div class="plane-data roll-wrap roll_row" id="plane-data">
                <ul class="roll__list">
                </ul>
            </div>
            <div class="gridsterBox" id="gridsterBox1" ><div id="allmap" class="plane-map" ></div></div>
            <div class="air-bottom">
                <p class="air-title">
                    <i class="title-icon"></i>
                    CH4/SF6/H2O2/COCL2
                </p>
                <div class="air-chart" id="CH4" style="width: 100%;height: 85%"></div>
            </div>
        </div>
        <div class="air-right">
            <div class="air-date air-btn">
                <a href="<?php echo base_url()?>index/dataSet" class="air-btn-border"><img src="<?php echo STATIC_IMG?>dataIndex/btn-set.png">数据设置</a>
                <a href="<?php echo base_url()?>index/planeHis" class="air-btn-border"><img src="<?php echo STATIC_IMG?>dataIndex/btn-history.png">历史记录</a>
            </div>
            <div class="info1 air-warning">
                <p class="air-title">气体预警和风险数量</p>
                <a href="javascript:void (0)" id="warningDis" class="air-title" style="float: right;margin-right: 30px">更多详情</a>
                <div class="number">
                    <div class="num-btn air-btn1" id="warning-total">今日预警总数：<div id="dataNums"></div></div>
                    <!--                <i class="num-btn air-btn2"><span>166</span><br>今日查阅总数</i>-->
                </div>
                <div class="air-chart" id="warning" style="width: 95%;height: 63%"></div>
            </div>
<!--            <div class="info1 gridsterBox" id="gridsterBox">-->
            <!--                <p class="air-title">检测设备负责人</p>-->
            <!--                <div class="plane-person">-->
            <!--                    --><?php //if(isset($user) && !empty($user)) foreach ($user as $kk => $vv){?>
            <!--                        <div class="person">-->
            <!--                            <img src="--><?php //echo STATIC_IMG?><!--dataIndex/person.png" >-->
            <!--                            <p>姓名：--><?php //echo $vv['username']?><!--</p>-->
            <!--                            <p>负责内容：--><?php //echo $vv['charge']?><!--</p>-->
            <!--                            <p>联系方式：--><?php //echo $vv['iphone']?><!--</p>-->
            <!--                        </div>-->
            <!--                    --><?php //}?>
            <!--                </div>-->
            <!--            </div>-->
            <div class="info1 gridsterBox">
                <p class="air-title">设备视频</p>
                <div class="plane-person">
                    <video controls="controls" muted autoplay="autoplay" loop="loop" width="100%" >
                        <source src="<?php echo STATIC_IMG?>dataIndex/plane.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
            <div class="air">
                <p class="air-title">检测设备库存</p>
                <ul class="plane-stock">
                    <?php if(isset($planeStock) && !empty($planeStock)) foreach ($planeStock as $k => $v){?>
                        <li class="stock">
                            <img src="<?php echo STATIC_IMG?>dataIndex/plane1.png" >
                            <i class="shu"></i>
                            <p><?php echo $v['productId'] ?><br>
                                <?php if($v['status'] == 1){ echo '状态:正常';}else{ echo '状态:异常';} ?></p>
                        </li>
                    <?php }?>
                </ul>
            </div>
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
<!--<script type="text/javascript" src="--><?php //echo STATIC_JS?><!--dataIndex/drag.js"></script>-->
<script type="text/javascript">
    WIDGET = {FID: 'jyA2dogNAb'}
</script>
<script type="text/javascript" src="https://apip.weatherdt.com/float/static/js/r.js?v=1111"></script>
<script>
    // 盒子1
    $('#gridsterBox').mousedown(function (e) {
        var boxLeft = e.offsetX,   //鼠标按下时记录指针偏离盒子左侧的距离
            boxTop = e.offsetY;    //鼠标按下时记录指针偏离盒子顶部的距离
        $(document).mousemove(function (event) {
            $('#gridsterBox').offset({
                left:event.pageX-boxLeft,    //两者相减保证鼠标按下时盒子位置不动
                top:event.pageY-boxTop       //两者相减保证鼠标按下时盒子位置不动
            });
            if(checkIntersect($('#gridsterBox'),$('#gridsterBox1'),20)){
                console.log(11)
                //在范围内
                $('#gridsterBox1').css('border','2px #F00 dashed');
                $('#gridsterBox1').css('-webkit-animation-name','light');
                $('#gridsterBox1').css('-webkit-animation-duration','1s');
                $('#gridsterBox1').css('-webkit-animation-delay','0.5s');
                $('#gridsterBox1').css('-webkit-animation-iteration-count','100');
                $('#gridsterBox').css({
                    'width': '920px',
                    'height': '465px',
                    'margin':'20px auto 0',
                    'border-radius': '25px',
                })
            }else{
                console.log(22)
                //不在范围内
                $('#gridsterBox1').css('border','2px #09F dashed');
                $('#gridsterBox1').css('-webkit-animation-name','');
                $('#gridsterBox').css({
                    'width': '415px',
                    'height': '327px',
                    'margin':'28px 0',
                    'border-radius': 'none',

                })
            }
        });
        function checkIntersect(obj1,obj2,distance){//检测碰撞,distance为吸附的范围
            var top1 = obj1.offset().top;
            var left1 = obj1.offset().left;
            var width1 = obj1.offset().width;
            var t1 = top1 - $(window).scrollTop();
            var l1 = left1 - $(window).scrollLeft();
            var top2 = obj2.offset().top;
            var left2 = obj2.offset().left;
            var width2 = obj2.width();
            var height2 = obj2.height();
            var t2 = top2 - $(window).scrollTop();
            var l2 = left2 - $(window).scrollLeft();
            if(((l1-l2>=0) && (l1<=width2)) && ((t1-t2>=0) && (t1<=height2))){
                return true;
            }else{
                return false;
            }

        }
    }).mouseup(function () {
        $(document).off('mousemove');   //鼠标松开后清除鼠标移动事件
        $('#gridsterBox1').css('border','none');
        $('#gridsterBox1').css('-webkit-animation-name','');
    });

</script>
</body>
</html>