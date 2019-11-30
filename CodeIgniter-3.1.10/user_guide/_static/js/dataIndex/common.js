//获取屏幕缩放比例
function getScale() {
    var width = 1920, height = 1080;
    let ww = window.innerWidth / width;
    let wh = window.innerHeight / height;
    return ww < wh ? ww : wh;
}

var scale = "scale(" + getScale() + ") translate(-50%, -50%)";
console.log(scale);
$('#container').css({"transform": scale});

//柱状图
function bluetable(id,name,time,data) {
    var myChartSO2 = echarts.init(document.getElementById(id));
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
            data:[name]
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
                data : time,
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
                name:name,
                type:'bar',
                barWidth: '40%',
                data:data
            }
        ]
    };
    myChartSO2.setOption(optionSO2, true);
    resize(myChartSO2)
}
function yellowtable(name,time,data) {
    var myChartNO2 = echarts.init(document.getElementById(name));
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
            data:[name]
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
                data : time,
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
                name:name,
                type:'bar',
                barWidth: '40%',
                data:data
            }
        ]
    };
    myChartNO2.setOption(optionNO2, true);
    resize(myChartNO2)
}
function resize(mychart){
    window.onresize = function(){
        mychart.resize();
    };
}
