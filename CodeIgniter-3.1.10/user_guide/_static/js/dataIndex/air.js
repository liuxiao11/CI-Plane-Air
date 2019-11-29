var Time = '';
//数据获取
$(window).on('load', function(){
    $.post('/index/indexPage',function (data) {
        console.log(data);
        if(data.status == 'true'){
            Time = data.data.time;
            var dataAir = data.data.air;
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
            for (var i=0;i<dataAir.length;i++){
                SO2data.push(dataAir[i].SO2);
                NO2data.push(dataAir[i].NO2);
                PM2data.push(dataAir[i]['PM2.5']);
                PM10data.push(dataAir[i].PM10);
                COdata.push(dataAir[i].CO);
                O3data.push(dataAir[i].O3);
                CH4data.push(dataAir[i].CH4);
                SF6data.push(dataAir[i].SF6);
                H2O2data.push(dataAir[i].H2O2);
                COCL2data.push(dataAir[i].COCL2);
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
                xAxis: [
                    {
                        type: 'category',
                        data: Time,
                        axisLine: {
                            lineStyle: {
                                color: '#041530',
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
                                color: '#041530',
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
                        name: 'PM10',
                        type: 'line',
                        stack: '总量',
                        areaStyle: {
                            normal: {
                                color: 'rgba(118,234,255,0.5)'
                            }
                        },
                        itemStyle: {
                            color: '#76eaff'
                        },
                        lineStyle: {
                            color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1,
                                [
                                    {offset: 0, color: '#12c0bc'},
                                    {offset: 1, color: '#76eaff'},
                                ])
                        },
                        data: PM10data
                    },
                    {
                        name: 'PM2.5',
                        type: 'line',
                        stack: '总量',
                        label: {
                            normal: {
                                show: true,
                                position: 'top'
                            }
                        },
                        itemStyle: {
                            color: '#ffe992'
                        },
                        lineStyle: {
                            color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1,
                                [
                                    {offset: 0, color: '#ffe992'},
                                    {offset: 1, color: '#fff449'}
                                ])
                        },
                        areaStyle: {
                            normal: {color: 'rgba(255,233,146,0.5)'}
                        },
                        data: PM2data
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
                xAxis: [
                    {
                        type: 'category',
                        data: Time,
                        axisLine: {
                            lineStyle: {
                                color: '#041530',
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
                                color: '#041530',
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
                        name: 'CO',
                        type: 'line',
                        stack: '总量',
                        areaStyle: {
                            normal: {
                                color: 'rgba(0,227,252,0.5)'
                            }
                        },
                        itemStyle: {
                            color: '#00e3fc'
                        },
                        lineStyle: {
                            color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1,
                                [
                                    {offset: 0, color: '#00e3fc'},
                                    {offset: 1, color: '#0069ff'},
                                ])
                        },
                        data: COdata
                    },
                    {
                        name: 'O3',
                        type: 'line',
                        stack: '总量',
                        label: {
                            normal: {
                                show: true,
                                position: 'top'
                            }
                        },
                        itemStyle: {
                            color: '#ac75ff'
                        },
                        lineStyle: {
                            color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1,
                                [
                                    {offset: 0, color: '#ac75ff'},
                                    {offset: 1, color: '#ff18f7'}
                                ])
                        },
                        areaStyle: {
                            normal: {color: 'rgba(172,117,255,0.5)'}
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
                    data: ['CH4', 'SF6', 'H2O2', 'COCL2']
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
                            color: '#041530',
                            width: 1,
                        }
                    },
                    data: Time
                },
                yAxis: {
                    type: 'value',
                    axisLine: {
                        lineStyle: {
                            color: '#041530',
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
                        name: 'COCL2',
                        type: 'line',
                        stack: '总量',
                        data: COCL2data
                    },
                ]
            };

//饼图
            var myChartWarning = echarts.init(document.getElementById("warning"));

            var data = genData(15);
            var optionW = {
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    type: 'scroll',
                    orient: 'vertical',
                    itemWidth: 13,
                    itemHeight: 10,
                    top: 10,
                    textStyle: {
                        fontSize: 10,
                        color: '#ffffff'
                    },
                    right: 0,
                    bottom: 10,
                    data: data.legendData,

                    selected: data.selected
                },
                series: [
                    {
                        name: '气体',
                        type: 'pie',
                        radius: '55%',
                        center: ['40%', '50%'],
                        data: data.seriesData,
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };

            function genData(count) {
                var nameList = data.data.airList;
                var numberList = data.data.airdataList;
                var legendData = [];
                var seriesData = [];
                var selected = {};
                for (var i = 0; i < count; i++) {
                    legendData.push(nameList[i]);
                    seriesData.push({
                        name: nameList[i],
                        value: numberList[i]
                    });
                    selected[nameList[i]] = i < 6;
                }
                return {
                    legendData: legendData,
                    seriesData: seriesData,
                    selected: selected
                };

                function makeWord(max, min) {
                    var nameLen = Math.ceil(Math.random() * max + min);
                    var name = [];
                    for (var i = 0; i < nameLen; i++) {
                        name.push(nameList[Math.round(Math.random() * nameList.length - 1)]);
                    }
                    return name.join('');
                }
            }
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
        }else if(data.status == 'false'){
            console.log('暂无数据');
        }
    },'json');
});






// myChartSO2.setOption(optionSO2, true);



$('#plane-data').rollSlide({
    orientation: 'left',
    num: 1,
    v: 1000,
    space: 1000,
    isRoll: true
});
$('#plane-data').rollNoInterval().left();
// resresh();
// //开始定时刷新
// setInterval(resresh, 5000);

//定时刷新数据
function resresh() {
    var myDate = new Date();
    //每三秒自执行
    setTimeout(function () {
        setInterval(function () {
            console.log("刷新页面");
            window.location.reload();
        }, 1000)
    }, 5000)

    //显示最后更新时间
    $('#refresh').html("<span id=\"refreshTime\">最后刷新时间：" + myDate.toLocaleDateString() + " " + myDate.toLocaleTimeString() + "</span>");
}

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