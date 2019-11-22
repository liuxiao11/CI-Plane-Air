$(document).ready(function ()
{


	//柱状图SO2/NO2
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
			data:['SO2']
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
				data : ['0:00', '02:00', '04:00', '06:00', '08:00', '10:00', '12:00'],
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
				name:'SO2',
				type:'bar',
				barWidth: '40%',
				data:[60, 300, 12, 200, 309, 390, 220]
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
			data:['NO2']
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
				data : ['0:00', '02:00', '04:00', '06:00', '08:00', '10:00', '12:00'],
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
				name:'NO2',
				type:'bar',
				barWidth: '40%',
				data:[10, 52, 200, 334, 390, 330, 220]
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
		tooltip : {
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
			textStyle:{
				fontSize:10,
				color: '#ffffff'
			},
			data:['PM10','PM2.5']
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
				data : ['0:00', '02:00', '04:00', '06:00', '08:00', '10:00', '12:00'],
				axisLine:{
					lineStyle: {
						color: '#041530',
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
						color: '#041530',
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
				name:'PM10',
				type:'line',
				stack: '总量',
				areaStyle: {
					normal:{
						color : 'rgba(118,234,255,0.5)'
					}
				},
				itemStyle:{
					color : '#76eaff'
				},
				lineStyle:{
					color : new echarts.graphic.LinearGradient(
						0, 0, 0, 1,
						[
							{offset: 0, color: '#12c0bc'},
							{offset: 1, color: '#76eaff'},
						])
				},
				data:[120, 132, 101, 134, 90, 230, 210]
			},
			{
				name:'PM2.5',
				type:'line',
				stack: '总量',
				label: {
					normal: {
						show: true,
						position: 'top'
					}
				},
				itemStyle:{
					color : '#ffe992'
				},
				lineStyle:{
					color : new echarts.graphic.LinearGradient(
						0, 0, 0, 1,
						[
							{offset: 0, color: '#ffe992'},
							{offset: 1, color: '#fff449'}
						])
				},
				areaStyle: {
					normal: {color:'rgba(255,233,146,0.5)'}
					},
				data:[15, 165, 56, 200, 190, 165, 80]
			}
		]
	};
	var optionCO = {
		textStyle: {
			color: '#f9fbfb',
		},
		tooltip : {
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
			textStyle:{
				fontSize:10,
				color: '#ffffff'
			},
			data:['CO','O3']
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
				data : ['0:00', '02:00', '04:00', '06:00', '08:00', '10:00', '12:00'],
				axisLine:{
					lineStyle: {
						color: '#041530',
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
						color: '#041530',
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
				name:'CO',
				type:'line',
				stack: '总量',
				areaStyle: {
					normal:{
						color : 'rgba(0,227,252,0.5)'
					}
				},
				itemStyle:{
					color : '#00e3fc'
				},
				lineStyle:{
					color : new echarts.graphic.LinearGradient(
						0, 0, 0, 1,
						[
							{offset: 0, color: '#00e3fc'},
							{offset: 1, color: '#0069ff'},
						])
				},
				data:[50, 150, 98, 120, 60, 88, 200]
			},
			{
				name:'O3',
				type:'line',
				stack: '总量',
				label: {
					normal: {
						show: true,
						position: 'top'
					}
				},
				itemStyle:{
					color : '#ac75ff'
				},
				lineStyle:{
					color : new echarts.graphic.LinearGradient(
						0, 0, 0, 1,
						[
							{offset: 0, color: '#ac75ff'},
							{offset: 1, color: '#ff18f7'}
						])
				},
				areaStyle: {
					normal: {color:'rgba(172,117,255,0.5)'}
					},
				data:[150, 110, 98, 56, 200, 210, 100]
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
			textStyle:{
				fontSize:10,
				color: '#ffffff'
			},
			data:['CH4','SF6','H2O2','COCL2']
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
			axisLine:{
				lineStyle: {
					color: '#041530',
					width: 1,
				}
			},
			data: ['00:00','01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00']
		},
		yAxis: {
			type: 'value',
			axisLine:{
				lineStyle: {
					color: '#041530',
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
		},
		series: [
			{
				name:'CH4',
				type:'line',
				stack: '总量',
				data:[120, 132, 101, 134, 90, 230, 210,220, 182, 191, 234, 290, 330, 310,320, 332, 301, 334, 390, 330, 320,105,154,98]
			},
			{
				name:'SF6',
				type:'line',
				stack: '总量',
				data:[220, 182, 191, 234, 290, 330, 310,165,101, 134, 90, 230, 210,220, 182, 191,154, 190, 330, 410,820, 932, 901, 934]
			},
			{
				name:'H2O2',
				type:'line',
				stack: '总量',
				data:[150, 232, 201, 154, 190, 330, 410,820, 932, 901, 934, 1290, 1330, 1320,120, 132, 101, 134, 90, 230, 210,190, 330, 410]
			},
			{
				name:'COCL2',
				type:'line',
				stack: '总量',
				data:[320, 332, 301, 334, 390, 330, 320,450,154, 190, 330, 410,820, 932, 901, 934, 410,820, 932, 901, 934, 1290, 1330, 1320,]
			},
		]
	};

	//饼图
	var myChartWarning = echarts.init(document.getElementById("warning"));

	var data = genData(15);
	var optionW = {
		tooltip : {
			trigger: 'item',
			formatter: "{a} <br/>{b} : {c}个 ({d}%)"
		},
		legend: {
			type: 'scroll',
			orient: 'vertical',
			itemWidth: 13,
			itemHeight: 10,
			top: 10,
			textStyle:{
				fontSize:10,
				color: '#ffffff'
			},
			right: 0,
			bottom: 10,
			data: data.legendData,

			selected: data.selected
		},
		series : [
			{
				name: '气体',
				type: 'pie',
				radius : '55%',
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
		var nameList = ['SO2', 'NO2', 'PM10', 'PM2.5', 'CO', 'O3', 'CH4', 'SF6', 'H2O2', 'COCL2','CH2O','H2','NH3','H2S','VOC'];
		var numberList = [125,180, 20, 101, 134, 90, 230, 210,220, 182, 191, 234, 290, 330,154];
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
		console.log(legendData)
		console.log(seriesData)
		console.log(selected)
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





	if (optionSO2 && typeof optionSO2 === "object") {
		myChartSO2.setOption(optionSO2, true);
		myChartNO2.setOption(optionNO2, true);
		myChartPM.setOption(optionPM, true);
		myChartCO.setOption(optionCO, true);
		myChartCH4.setOption(optionCH4, true);
		myChartWarning.setOption(optionW, true);
	}
	window.onresize = function(){
		myChartSO2.resize();
		myChartNO2.resize();
		myChartPM.resize();
		myChartCO.resize();
		myChartCH4.resize();
		myChartWarning.resize();
	};
});

$('#plane-data').rollSlide({
	orientation: 'left',
	num: 1,
	v: 1000,
	space: 1000,
	isRoll: true
});
// $('#plane-data').rollNoInterval().left();
// resresh();
// //开始定时刷新
// setInterval(resresh, 30000);

//定时刷新数据
function resresh()
{
	var myDate = new Date();
	//每三秒自执行
	setTimeout(function(){
		setInterval(function(){
			console.log("刷新页面");
			window.location.reload();
		},1000)
	},30000)
			
	//显示最后更新时间
	$('#refresh').html("<span id=\"refreshTime\">最后刷新时间："+myDate.toLocaleDateString()+" "+myDate.toLocaleTimeString()+"</span>");
}

// function f() {
// 	// 初始化起始的经度和纬度34.2930382907,108.9462339878
// 	var startLng = 108.9531326294;
// 	var startLat = 34.2935302306;
// 	var startLng1 = 108.9462339878;
// 	var startLat1 = 34.2930382907;
// 	var tmpLng = startLng;
// // 循环生成一条行车轨迹坐标线路
// // function GetPoints(length,startLat) {
// //   var points = [];
// //   for (i = 0; i < length; i++) {
// //     var lng = parseFloat(tmpLng) + 0.0001;
// //     tmpLng = lng;
// //     var lat = startLat;
// //     var point = [];
// //     point[0] = lng;
// //     point[1] = lat;
// //     points.push(point);
// //   }
// //   console.log(points);
// //   return points;
// // }
//
//
// // 随机生成坐标函数
// 	function GetRandomNum(Min, Max) {
// 		var Range = Max - Min;
// 		var Rand = Math.random();
// 		return (Min + Range * Rand);
// 	}
//
// // 随机生成车辆行驶轨迹坐标
// // var startLng = 108.9531326294;
// // var startLat = 34.2935302306;
// 	var points11 = [];
// 	var points22 = [];
// 	data1 = [108.9531326294,34.2935302306]
// 	data2 = [108.9531326298,34.2935302308]
// 	data3 = [108.9531326299,34.2935302309]
// 	data21 = [108.9531326310,34.2935302317]
// 	data31 = [108.9531326318,34.2935302318]
// 	data41 = [108.9531326320,34.2935302320]
//
// 	data4 = [108.9462339878,34.2930382907]
// 	data5 = [108.9531326279,34.2935302909]
// 	data6 = [108.95313262801,34.2935302312]
// 	data7 = [108.9531326285,34.2935302315]
// 	data8 = [108.9531326288,34.2935302318]
// // points11 = [
// //         data1,data2,data3,data21,data31,data41
// // ];
// 	points11 = [
// 		data4,data5,data6,data7,data8
// 	];
//
//
//
// // 初始化地图
// 	var map = new AMap.Map('plane-map', {
// 		zoom: 18,
// 		center: [119, 30],
// 		layers: [
// 			// 添加交通图层
// 			new AMap.TileLayer.Traffic({
// 				zIndex: 10,
// 				autoRefresh: true,
// 				interval: 180
// 			}),
// 			new AMap.TileLayer()
// 		]
// 	});
//
// // 获取所有的marker对象
// 	function GetMarkers(count,points) {
// 		var markerList = [];
// 		for (i = 0; i < points.length; i++) {
// 			var marker = new AMap.Marker({
// 				position: new AMap.LngLat(points[i][0], points[i][1]),
// 				icon: new AMap.Icon({
// 					size: new AMap.Size(32, 32),
// 					image: "../user_guide/_static/images/dataIndex/planeS.png"
// 				}),
// 				offset: new AMap.Pixel(0, -20)
// 			});
// 			markerList.push(marker);
// 		}
// 		return markerList;
// 	}
//
// // marker数组对象
// 	var markerList = GetMarkers(100,points11);
// // var markerList1 = GetMarkers(11,points22);
// // console.log(GetPath(markerList))
// // console.log(GetPath(markerList1))
// // 根据markerList生成折线节点坐标
// 	function GetPath(markerList) {
// 		var path = [];
// 		for (i = 0; i < markerList.length; i++) {
// 			path.push(markerList[i].getPosition());
// 		}
// 		console.log(path);
// 		return path;
// 	}
// // 创建折线实例
// 	var polyline = new AMap.Polyline({
// 		path: GetPath(markerList),
// 		borderWeight: 4,
// 		strokeColor: '#f60179',
// 		lineJoin: 'round', // 折线拐点样式 round -> 圆形 bevel -> 斜角
// 		lineCap: 'round', // 折线两端样式，默认值butt -> 无头  round -> 圆头 square -> 方头
// 		isOutline: true, // 是否带描边
// 		outlineColor: '#f60179',
// 		strokeOpacity: 0.5,
// 		draggable: false, // 设置折线可以拖拽
// 		showDir: true
// 	});
// // var polyline1 = new AMap.Polyline({
// //   path: GetPath(markerList1),
// //   borderWeight: 4,
// //   strokeColor: '#f60179',
// //   lineJoin: 'round', // 折线拐点样式 round -> 圆形 bevel -> 斜角
// //   lineCap: 'round', // 折线两端样式，默认值butt -> 无头  round -> 圆头 square -> 方头
// //   isOutline: true, // 是否带描边
// //   outlineColor: '#f60179',
// //   strokeOpacity: 0.5,
// //   draggable: false, // 设置折线可以拖拽
// //   showDir: true
// // });
//
// // 添加到map对象
// 	map.add(polyline);
// // map.add(polyline1);
//
// // 定时函数
// 	var marker = null;
// 	function AddMarkerToMap(markerObj) {
// 		if (markerObj == undefined) {
// 			// 清除定时函数
// 			window.clearInterval(timer);
// 			return false;
// 		}
// 		// 清除之前的maker
// 		if (marker != null) {
// 			map.remove(marker);
// 		}
// 		// 暂存
// 		marker = markerObj;
// 		// 设置地图中心为当前的marker坐标
// 		map.setCenter(markerObj.getPosition());
// 		// 添加maker
// 		map.add(markerObj);
// 	}
// // var marker1 = null;
// // function AddMarkerToMap1(markerObj) {
// //   if (markerObj == undefined) {
// //     // 清除定时函数
// //     window.clearInterval(timer1);
// //     return false;
// //   }
// //   // 清除之前的maker
// //   if (marker1 != null) {
// //     map.remove(marker1);
// //   }
// //   // 暂存
// //   marker1 = markerObj;
// //   // 设置地图中心为当前的marker坐标
// //   map.setCenter(markerObj.getPosition());
// //   // 添加maker
// //   map.add(markerObj);
// // }
//
// // 每隔500毫秒执行
// 	var index = 0;
// 	var timer = window.setInterval("AddMarkerToMap(markerList[index++])", 200);
// // var timer1 = window.setInterval("AddMarkerToMap1(markerList1[index++])", 200);
//
//
// // var timer = window.setInterval("AddMarkerToMap();", 500);
//
// //定义折线节点坐标，每个对象为AMap.LngLat    // 34.2931800000,108.9471200000
// 	var path = [
// 		// new AMap.LngLat(108.9471200000, 34.2931800000),
// 		// new AMap.LngLat(121.02190000000073, 32)
// 	]
//
//
//
//
//
// }

