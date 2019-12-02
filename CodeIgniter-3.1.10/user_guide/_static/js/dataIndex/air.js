var Time = '';
var Startpoint;
var Endpoint;
$.post('/index/indexPage',function (data) {
    // console.log(data);
    if(data.status == 'true'){
        Time = data.data.time;
        Startpoint = data.data.Start_point;
        Endpoint = data.data.End_point;
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
        // console.log(Startpoint)

        // 百度地图API功能
        var map=new BMap.Map("allmap");
        var startPoint = Startpoint;
        map.centerAndZoom(new BMap.Point(startPoint.lon, startPoint.lat), 15);
        map.enableScrollWheelZoom(true);

        var myIcon=new BMap.Icon("/user_guide/_static/images/dataIndex/planeS.png", new BMap.Size(32, 32), { //飞机图片
            //offset: new BMap.Size(0, -5),    //相当于CSS精灵
            imageOffset: new BMap.Size(0, 0)//图片的偏移量。为了是图片底部中心对准坐标点。
        });
        var carMk=new BMap.Marker(new BMap.Point(startPoint.lon, startPoint.lat),{icon:myIcon});
        map.addOverlay(carMk);

        function renderLastPoint(point){
            // 实例化一个驾车导航用来生成路线
            var driving=new BMap.DrivingRoute(map);
            var sp=new BMap.Point(startPoint.lon, startPoint.lat);
            var ep=new BMap.Point(point.lon, point.lat);
            driving.search(sp, ep);
            //设置新的开始点
            startPoint=point;

            driving.setSearchCompleteCallback(function(res){
                //console.info(res);
                if(driving.getStatus()==BMAP_STATUS_SUCCESS){
                    //获取两点之间的实际点组
                    var plan=res.getPlan(0);
                    var arrPois=[];
                    for(var j=0;j<plan.getNumRoutes();j++){
                        var route=plan.getRoute(j);
                        arrPois=arrPois.concat(route.getPath());
                    }
                    //把实际点加到地图上
                    //根据点组的长度画线和画点
                    drawMap(arrPois);
                }
            });
        }

        var t30=3000;

        function drawMap(pointArr){
            if(pointArr.length==0){
                return;
            }
            var t=t30;//30秒
            //计算每次执行的时间
            var at=t/pointArr.length;
            var i=0;

            var f=function(){
                if((i+1)>(pointArr.length-1)){
                    return;
                }
                var sp=pointArr[i];
                var ep=pointArr[i+1];

                //地图画线
                var polyline=new BMap.Polyline([sp,ep],{strokeColor:"#d4237a", strokeWeight:4, strokeOpacity:0.5});//创建折线
                map.addOverlay(polyline);
                //移动点
                carMk.setPosition(ep);
                var bound=map.getBounds();//地图可视区域
                if(bound.containsPoint(ep)==false){
                    map.panTo(ep);
                }

                i++;
                setTimeout(function(){
                    f();
                },at);
            };

            f();

        }
        //模拟业务
        var ii=0;
        var _task=setInterval(function(){
            var lastPoint={lon:Endpoint.lon+ii*0.01,lat:34.3175030000};//终点
            if(lastPoint.lon==startPoint.lon&&lastPoint.lat==startPoint.lat){
                //相同点，则不需要画图
                return;
            }
            ii++;

            renderLastPoint(lastPoint);

        },t30);
        // var _task=setInterval(function(){
        //     console.log(Endpoint);
        //     var lastPoint = Endpoint;//终点
        //     if(lastPoint.lon==startPoint.lon && lastPoint.lat==startPoint.lat){
        //         //相同点，则不需要画图
        //         return;
        //     }
        // },t30);
    }else if(data.status == 'false'){
        console.log('暂无数据');
    }
},'json');
//定时刷新数据
function resresh() {
    var myDate = new Date();
    //每三秒自执行
    setTimeout(function () {
        setInterval(function () {
            console.log("刷新页面");
            $.post('/index/indexPage',function (data) {
                // console.log(data);
                if(data.status == 'true'){
                    Time = data.data.time;
                    Startpoint = data.data.Start_point;
                    Endpoint = data.data.End_point;
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
        }, 30000)
    }, 30000)

    //显示最后更新时间
    $('#refresh').html("<span id=\"refreshTime\">最后刷新时间：" + myDate.toLocaleDateString() + " " + myDate.toLocaleTimeString() + "</span>");
}
resresh();
//开始定时刷新
setInterval(resresh, 30000);
$('#plane-data').rollSlide({
    orientation: 'left',
    num: 1,
    v: 1000,
    space: 1000,
    isRoll: true
});
$('#plane-data').rollNoInterval().left();


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
