var Time = '';
var Startpoint;
var Endpoint;
var cxt = "/user_guide/_static/images/";
//开始定时刷新
dataIndex();
dataMap();
setInterval(dataIndex, 10000);
if($.cookie('id') == 'null'){
    m = setInterval(dataMap, 10000);
}else{
    clearTimeout(m)
}
function dataIndex() {
    var myDate = new Date();
    $.post('/index/indexPage', function (data) {
        console.log(data.data)
        if (data.status == 'true') {
            Time = data.data.time;
            Startpoint = data.data.Start_point;
            Endpoint = data.data.End_point;
            var plane = data.data.plane;
            var dataAir = data.data.air;
            var total = data.data.total;
            var SO2data = [];
            var NO2data = [];
            var PM2data = [];
            var PM10data = [];
            var COdata = [];
            var O3data = [];
            var CH4data = [];
            var SF6data = [];
            var H2O2data = [];
            var COCL2data = [];
            if (dataAir && Startpoint && plane) {
                for (var i = 0; i < dataAir.length; i++) {
                    SO2data.push(dataAir[i].uSO2);
                    NO2data.push(dataAir[i].uNO2);
                    PM2data.push(dataAir[i]['uPM2_5']);
                    PM10data.push(dataAir[i].uPM10);
                    COdata.push(dataAir[i].uCO);
                    O3data.push(dataAir[i].uO3);
                    if(dataAir[i].CH4 && dataAir[i].SF6 && dataAir[i].H2O2 && dataAir[i].H2S){
                        CH4data.push(dataAir[i].CH4);
                        SF6data.push(dataAir[i].SF6);
                        H2O2data.push(dataAir[i].H2O2);
                        COCL2data.push(dataAir[i].H2S);
                    }
                }

                //柱状图
                var myChartSO2 = echarts.init(document.getElementById("SO2"));
                var myChartNO2 = echarts.init(document.getElementById("NO2"));
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
                    legend: {
                        itemWidth: 13,
                        itemHeight: 10,
                        left: 210,
                        top: 25,
                        textStyle: {
                            fontSize: 10,
                            color: '#ffffff'
                        },
                        data: ['SO2']
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
                            data: Time,
                            axisTick: {
                                alignWithLabel: true,
                            },
                            axisLine: {
                                lineStyle: {
                                    color: ['#231e40'],
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
                                    color: ['#231e40'],
                                    width: 1,
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
                        {
                            name: 'SO2',
                            type: 'bar',
                            barWidth: '40%',
                            data: SO2data
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
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                            type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                        },
                    },
                    legend: {
                        itemWidth: 13,
                        itemHeight: 10,
                        left: 210,
                        top: 25,
                        textStyle: {
                            fontSize: 10,
                            color: '#FFFFFF'
                        },
                        data: ['NO2']
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
                            data: Time,
                            axisTick: {
                                alignWithLabel: true,
                            },
                            axisLine: {
                                lineStyle: {
                                    color: ['#231e40'],
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
                                    color: ['#231e40'],
                                    width: 1,
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
                        {
                            name: 'NO2',
                            type: 'bar',
                            barWidth: '40%',
                            data: NO2data
                        }
                    ]
                };
                //折线图
                var myChartPM = echarts.init(document.getElementById("PM"));
                var myChartCO = echarts.init(document.getElementById("CO-O3"));
                var myChartCH4 = echarts.init(document.getElementById("CH4"));
                var optionPM = {
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
                        data: ['PM10', 'PM2.5']
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
                        },
                        {
                            name: 'O3',
                            type: 'line',
                            stack: '总量',
                            symbol: 'none',
                            smooth:true,
                            label: {
                                normal: {
                                    show: true,
                                    position: 'top'
                                }
                            },
                            itemStyle: {
                                normal: {
                                    color: '#ffc3a0'
                                }
                            },
                            areaStyle: {
                                normal: {
                                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                        offset: 0,
                                        color: '#ffc3a0'
                                    }, {
                                        offset: 1,
                                        color: 'rgba(105,96,79,0.5)'
                                    }])
                                }
                            },
                            data: O3data
                        }
                    ]
                };
                var optionCH4 = {
                    textStyle: {
                        color: '#f9fbfb',
                    },
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        itemWidth: 13,
                        itemHeight: 10,
                        top: 10,
                        textStyle: {
                            fontSize: 10,
                            color: '#ffffff'
                        },
                        data: ['CH4', 'SF6', 'H2O2', 'H2S']
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                    },
                    xAxis: {
                        type: 'category',
                        boundaryGap: false,
                        axisLine: {
                            lineStyle: {
                                color: '#231e40',
                                width: 1,
                            }
                        },
                        data: Time
                    },
                    yAxis: {
                        type: 'value',
                        axisLine: {
                            lineStyle: {
                                color: '#231e40',
                                width: 1,
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
                    },
                    series: [
                        {
                            name: 'CH4',
                            type: 'line',
                            stack: '总量',
                            data: CH4data
                        },
                        {
                            name: 'SF6',
                            type: 'line',
                            stack: '总量',
                            data: SF6data
                        },
                        {
                            name: 'H2O2',
                            type: 'line',
                            stack: '总量',
                            data: H2O2data
                        },
                        {
                            name: 'H2S',
                            type: 'line',
                            stack: '总量',
                            data: COCL2data
                        }
                    ]
                };

                //饼图
                var myChartWarning = echarts.init(document.getElementById("warning"));
                var optionW = {
                    textStyle: {
                        fontSize: 12   // 调节字体大小

                    },
                    title : {
                        text: '',       // 主标题名称
                        subtext: '',    // 副标题名称
                        x:'center'      // 标题的位置
                    },
                    tooltip : {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                    },
                    // legend: {
                    //     orient: 'vertical',         // 标签名称垂直排列
                    //     x: 'right',                 // 标签的位置
                    //     data:['CO','SO2','NO2','O3','PM2.5','PM10']
                    // },                              // 标签变量名称
                    calculable : true,
                    series : [
                        {
                            name:'今日风险数量',                    // 图表名称
                            type:'pie',                         // 图表类型
                            radius : [20, 70],                 // 图表内外半径大小
                            center : ['50%', '50%'],            // 图表位置
                            roseType : 'area',
                            label: {
                                normal: {
                                    show: true,
                                    formatter: '{b}({d}%)'      // 显示百分比
                                }
                            },
                            data:data.data.pie
                        }
                    ]
                };
                myChartSO2.setOption(optionSO2, true);
                myChartNO2.setOption(optionNO2, true);
                myChartPM.setOption(optionPM, true);
                myChartCO.setOption(optionCO, true);
                myChartCH4.setOption(optionCH4, true);
                myChartWarning.setOption(optionW, true);
                window.onresize = function () {
                    // myChartSO2.resize();
                    myChartNO2.resize();
                    myChartPM.resize();
                    myChartCO.resize();
                    myChartCH4.resize();
                    myChartWarning.resize();
                };
                $('#plane-data ul').html('');
                $("#dataNums").html('');
                $("#dataNums").rollNum({
                    deVal:total
                });
                console.log("111");
                console.log(plane);
                // $('#warning-total').html('今日预警总数：'+data.data.total);
                for (var p = 0; p < plane.length; p++) {
                    console.log(plane[p]['ptoductType']);
                    if(plane[p]['ptoductType'] == "0"){
                        var planeHtml = '<li>' +
                            '<div class="plane-title">无人机' + plane[p].productID + '号</div>' +
                            '<div class="plane-content">' +
                            '<img class="carPlane" src="' + cxt + 'dataIndex/carPlane.png" alt="无人机">' +
                            '<div class="plane-text">' +
                            '<p>飞行状态：正常</p>' +
                            // '<p>飞行速度：' + plane[p].speed + 'm/s</p>' +
                            '<p>飞行高度：' + plane[p].nGPS_alt + 'm</p>' +
                            '</div>' +
                            '</div>' +
                            '</li>';
                    }else{
                        var planeHtml = '<li>' +
                            '<div class="plane-title">无人机' + plane[p].productID + '号</div>' +
                            '<div class="plane-content">' +
                            '<img  src="' + cxt + 'dataIndex/plane.png" alt="无人机">' +
                            '<div class="plane-text">' +
                            '<p>飞行状态：正常</p>' +
                            // '<p>飞行速度：' + plane[p].speed + 'm/s</p>' +
                            '<p>飞行高度：' + plane[p].nGPS_alt + 'm</p>' +
                            '</div>' +
                            '</div>' +
                            '</li>';
                    }
                    $('#plane-data ul').append(planeHtml);
                }


            }
        } else if (data.status == 'false') {
            console.log('暂无数据');
        }
    }, 'json');
    //显示最后更新时间
    $('#refresh').html("<span id=\"refreshTime\">最后刷新时间：" + myDate.toLocaleDateString() + " " + myDate.toLocaleTimeString() + "</span>");
}

function dataMap() {
    $.ajax({
        async: false,
        cache: true,
        url: "/index/testMap",
        type: 'POST',
        success: function (result) {
            $.cookie('id',null);
            var result = JSON.parse(result);
            var point = result.data;
            console.log('222')
            console.log(point)
            if (point != undefined && point.length > 0) {
                // 百度地图API功能
                var map = new BMap.Map("allmap");// 创建Map实例
                map.centerAndZoom(new BMap.Point('西安市'), 12);// 初始化地图,设置中心点坐标和地图级别
                map.enableScrollWheelZoom(true);//开启鼠标滚轮缩放
                // map.addControl(new BMap.NavigationControl()); //添加平移缩放控件
                var mapStyle ={
                    features: ["road","building","water","land"],//隐藏地图上的"poi",
                    style : 'googlelite'
                };
                map.setMapStyle(mapStyle);
                var ic = cxt + 'dataIndex/plane1.png';
                var myIcon2 = new BMap.Icon(
                    ic, // 百度图片
                    new BMap.Size(40, 40), // 视窗大小
                    {
                        imageSize: new BMap.Size(32, 32), // 引用图片实际大小　
                    }
                );
                map.panTo(new BMap.Point(point[0].lon, point[0].lat));	//将地图的中心点更改为从接口获取的指定的点。

                var longitude = [], latitude = [], vehicleID = [], alarm = [];

                for (var i = 0; i < point.length; i++) {
                    //获取每个无人机的位置信息及无人机的捆包号信息，位置信息用来在地图上显示无人机，捆包号用来通过捆包号查询无人机详细信息，以在鼠标滑过此无人机时显示无人机的详细信息。
                    longitude[i] = point[i].lGPS_lon;//经度
                    latitude[i] = point[i].lGPS_lat;//纬度
                    vehicleID[i] = point[i].id;//id号
                    alarm[i] = point[i].serialNum;//报警标志信息
                    // console.log(vehicleID[i]);
                    var goodsId, goodsName, goodsSpeed, goodsAlt;

                    /*** 通过无人机捆包号获取无人机详情信息 ***/
                    $.ajax({
                        async: false,
                        cache: true,
                        url: "/index/testMapId?id=" + vehicleID[i],
                        type: 'GET',
                        success: function (res) {
                            var result = eval('(' + res + ')');
                            var resultContent = result.data;
                            if (result.data.length != 0) {
                                goodsId = resultContent.id;
                                goodsName = resultContent.productID;
                                goodsAlt = resultContent.nGPS_alt;
                                /**** 创建报警图标，并在地图上显示报警图标，且鼠标经过报警图标时，显示报警的详细信息 ***/
                                if (longitude[i] == '0.000000' || latitude[i] == '0.000000') {
                                    var alarmMarker = new BMap.Marker(new BMap.Point(longitude[i], latitude[i]), {icon: new BMap.Icon(cxt + "dataIndex/warning.png", new BMap.Size(32, 32))});  // 创建自定义报警图标
                                    var alarmContent = '<div><img style="float:right;margin:2px" id="alarmInfo" src="' + cxt + 'dataIndex/warning.png" width="30" height="30"/><p style="margin:0;line-height:1.5;font-size:13px;text-indent:2em"><br/>无人机：' + goodsName + '<br/>报警类型：GPS未正常定位<br/>报警时间：' + getFormatDate() +
                                        '<br/></p></div>';
                                    map.addOverlay(alarmMarker); // 将报警图标添加到地图中
                                    addMouseoverHandler2(alarmContent, alarmMarker); //添加鼠标滑过报警图标时显示报警详情的事件
                                }
                                /**** 创建无人机图标，并在地图上显示无人机图标，且鼠标经过无人机图标时，显示无人机的详细信息 ***/
                                var steelMarker = new BMap.Marker(new BMap.Point(longitude[i], latitude[i]), {icon: myIcon2});	//创建无人机图标
                                var steelContent = '<div><p style="margin:0;line-height:1.5;font-size:13px;text-indent:2em"><br/>无人机：' + goodsName + '<br/>高度：' + goodsAlt + 'm<br/>' +
                                    '<button type="button" onclick="getCars(' + goodsName + ')" style="width: 80px;height: 25px;float: right;background-color: #e9873e;border: none;color: #ffffff">跟踪路径</button></p></div>';//无人机详情弹出框
                                map.addOverlay(steelMarker); // 将无人机图标添加到地图中
                                addMouseoverHandler(steelContent, steelMarker); //添加鼠标滑过无人机图标时显示无人机详情的事件

                                /**** 创建报警图标，并在地图上显示报警图标，且鼠标经过报警图标时，显示报警的详细信息 ***/
                                if (alarm[i] == '0' || alarm[i] == '00000000000') {
                                    var alarmMarker = new BMap.Marker(new BMap.Point(longitude[i], latitude[i]), {icon: new BMap.Icon(cxt + "dataIndex/warning.png", new BMap.Size(32, 32))});  // 创建自定义报警图标
                                    var alarmContent = '<div><img style="float:right;margin:2px" id="alarmInfo" src="' + cxt + 'dataIndex/warning.png" width="30" height="30"/><p style="margin:0;line-height:1.5;font-size:13px;text-indent:2em"><br/>无人机：' + goodsName + '<br/>报警类型：时间异常<br/>报警时间：' + getFormatDate() +
                                        '<br/></p></div>';
                                    map.addOverlay(alarmMarker); // 将报警图标添加到地图中
                                    addMouseoverHandler2(alarmContent, alarmMarker); //添加鼠标滑过报警图标时显示报警详情的事件
                                }
                            }
                        }
                    });
                    var trackMap = [];
                    getCars = function (id) {
                        $.cookie('id',id);
                        clearInterval(m)
                        map.clearOverlays();
                        map.panTo(trackMap[trackMap.length - 1]);//将地图的中心点更改为给定的点。
                        map.setZoom(14);//将视图切换到指定的缩放等级，中心点坐标不变。
                        $.ajax({
                            async: false,
                            cache: true,
                            url: "/index/planeLatLon",
                            type: 'POST',
                            data: {productId: id},
                            dataType: 'json',
                            success: function (result) {
                                var resulta = result.data;
                                var conf1 = {
                                    videoid:'h5sVideo1',
                                    protocol: window.location.protocol, //'http:' or 'https:'
                                    host: window.location.host, //'localhost:8080'
                                    rootpath:'/', // '/' or window.location.pathname
                                    token:'token0',
                                    hlsver:'v1', //v1 is for ts, v2 is for fmp4
                                    session:'c1782caf-b670-42d8-ba90-2244d0b0ee83' //session got from login
                                };

                                var v1 = H5sPlayerCreate(conf1);


                                $('#h5sVideo1').parent().click(function () {
                                    if($(this).children(".h5video").get(0).paused){
                                        if(v1 != null)
                                        {
                                            v1.disconnect();
                                            delete v1;
                                            v1 = null;
                                        }

                                        v1 = H5sPlayerCreate(conf1);

                                        console.log(v1);
                                        v1.connect();

                                        $(this).children(".playpause").fadeOut();
                                    }else{
                                        v1.disconnect();
                                        delete v1;
                                        v1 = null;
                                        $(this).children(".h5video").get(0).pause();
                                        $(this).children(".playpause").fadeIn();
                                    }
                                });
                                $('#choice_url').html('');
                                for (var i=0; i<=resulta.video.length;i++){
                                    var choi = '<option value="'+i-1+'">视频源'+(i)+'</option>';
                                }
                                $('#choice_url').append(choi);
                                if (resulta.length != 0) {
                                    /*** 实时获取经纬度信息 ***/
                                    var sitsLongitude = resulta.lon;
                                    var sitsLatitude = resulta.lat;
                                    trackMap.push(new BMap.Point(sitsLongitude, sitsLatitude));//push() 方法可向数组的末尾添加一个或多个元素，并返回新的长度。
                                    var carContent = '<div><br/>经度： ' + sitsLongitude + '<br/>纬度： ' + sitsLatitude + '<p style="color:green; margin-left:65%;">正在跟踪中</p></div>';
                                    var carMarker = new BMap.Marker(new BMap.Point(sitsLongitude, sitsLatitude), {icon: myIcon2});

                                    if (trackMap.length > 2) {
                                        map.addOverlay(new BMap.Polyline([trackMap[trackMap.length - 2], trackMap[trackMap.length - 1]], {
                                            strokeColor: "#d4237a",
                                            strokeWeight: 3,
                                            strokeOpacity: 1,
                                            strokeStyle: "dashed"
                                        }));
                                    }
                                    map.addOverlay(carMarker); // 将无人机图标添加到地图中
                                    addMouseoverHandler(carContent, carMarker);
                                    carMarker.setPosition(trackMap[trackMap.length - 1]);//setPosition:设置标注的地理坐标
                                }
                            },
                            error: function (e) {
                                alert("获取信息失败");
                            }
                        });
                        t = setTimeout(function () {
                            getCars(id);
                        }, 3000);
                    };

                    function ZoomControl2() {
                        // 默认停靠位置和偏移量
                        this.defaultAnchor = BMAP_ANCHOR_BOTTOM_RIGHT;
                        this.defaultOffset = new BMap.Size(20, 70); // 距离右上角位
                    }

                    ZoomControl2.prototype = new BMap.Control();
                    ZoomControl2.prototype.initialize = function (map) {
                        // 创建一个DOM元素
                        var div = document.createElement("div");
                        // 添加文字说明
                        var div1 = '<div class="fright">' +
                            '<a href="#" onclick="reset()">' +
                            '<img src="' + cxt + 'dataIndex/focus.png"/>' +
                            '</a>' +
                            '</div>';
                        div.innerHTML = div1;
                        // 添加DOM元素到地图中
                        map.getContainer().appendChild(div);
                        // 将DOM元素返回
                        return div;
                    };

                    var myZoomCtrl2 = new ZoomControl2();
                    map.addControl(myZoomCtrl2);

                    reset = function () { //重置
                        if(typeof t != "undefined"){
                            clearTimeout(t);
                        }
                        window.location.reload()
                    };

                    function getFormatDate() {
                        var nowDate = new Date();
                        var year = nowDate.getFullYear();
                        var month = nowDate.getMonth() + 1 < 10 ? "0" + (nowDate.getMonth() + 1) : nowDate.getMonth() + 1;
                        var date = nowDate.getDate() < 10 ? "0" + nowDate.getDate() : nowDate.getDate();
                        var hour = nowDate.getHours() < 10 ? "0" + nowDate.getHours() : nowDate.getHours();
                        var minute = nowDate.getMinutes() < 10 ? "0" + nowDate.getMinutes() : nowDate.getMinutes();
                        var second = nowDate.getSeconds() < 10 ? "0" + nowDate.getSeconds() : nowDate.getSeconds();
                        return year + "-" + month + "-" + date + " " + hour + ":" + minute + ":" + second;
                    }

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

                        // /***** 鼠标移开事件 *****/
                        // marker.addEventListener("mouseout",function(e){
                        //     closeInfo(content,e);
                        // });
                    }

                    /**** 鼠标滑过时打开详情弹出框 *****/
                    function openInfo(content, e) {
                        var p = e.target;
                        var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
                        var infoWindow = new BMap.InfoWindow(content, opts);  // 创建信息窗口对象
                        map.openInfoWindow(infoWindow, point); //开启信息窗口
                    }

                    // /**** 鼠标移开时关闭详情弹出框 *****/
                    // function closeInfo(content,e){
                    //     var p = e.target;
                    //     var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
                    //     var infoWindow = new BMap.InfoWindow(content,opts);  // 创建信息窗口对象
                    //     map.closeInfoWindow(infoWindow,point); //关闭信息窗口
                    // }

                    /******* 鼠标滑过标注时显示报警详情的事件 *******/
                    var alarmOpts = {
                        width: 260,     // 信息窗口宽度
                        height: 134,     // 信息窗口高度
                        title: "<b>报警信息</b>", // 信息窗口标题
                        enableMessage: true//设置允许信息窗发送短息
                    };

                    function addMouseoverHandler2(alarmContent, alarmMarker) {
                        alarmMarker.addEventListener("mouseover", function (e) {
                            openInfo2(alarmContent, e)
                        });
                    }

                    function openInfo2(alarmContent, e) {
                        var p = e.target;
                        var point2 = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
                        var infoWindow2 = new BMap.InfoWindow(alarmContent, alarmOpts);  // 创建信息窗口对象
                        map.openInfoWindow(infoWindow2, point2); //开启信息窗口
                    }

                }
            }
        },
        error: function (e) {
            alert("获取信息失败");
        }
    });
}

$('#plane-data').rollSlide({
    orientation: 'left',
    num: 1,
    v: 1000,
    space: 1000,
    isRoll: true
});
$('#warningDis').click(function () {
    $('#alert').show();
    var url="/index/warningDis";
    $.post(url,function(result){
        if(result.status == 'true'){
            $('#airWarTable tbody').html('');
            for (var i=0;i <result.data.length;i++){
                var html =
                    '<tr>' +
                    '<td>'+result.data[i].productId+'</td>' +
                    '<td>'+result.data[i].airName+'</td>' +
                    '<td>'+result.data[i].airNum+'</td>' +
                    '<td>'+result.data[i].airTsh+'</td>' +
                    '<td>'+result.data[i].time+'</td>' +
                    '</tr>';
                $('#airWarTable tbody').append(html);
            }
        }else if(result.status == 'false'){
            alert(result.tips);
        }
    },"json");
});
$('#closeBtn').click(function () {
    $('.alertPopBoxBg').hide();
});
/* 获取当前日期 */
function showTime() {
    var show_day = new Array('星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六');
    var time = new Date();
    var year = time.getFullYear();
    var month = time.getMonth() + 1;
    var date = time.getDate();
    var day = time.getDay();
    var hour = time.getHours();
    var minutes = time.getMinutes();
    var second = time.getSeconds();
    /*  month<10?month='0'+month:month;  */
    hour < 10 ? hour = '0' + hour : hour;
    minutes < 10 ? minutes = '0' + minutes : minutes;
    second < 10 ? second = '0' + second : second;
    var now_time = year + '年' + month + '月' + date + '日' + ' ' + show_day[day] + '';
    document.getElementById('date').innerHTML = now_time;
    /* setTimeout("showTime();",1000);  */
}

showTime();