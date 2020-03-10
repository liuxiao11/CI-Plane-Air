/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : 127.0.0.1:3306
Source Database       : air

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-03-07 19:46:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for air
-- ----------------------------
DROP TABLE IF EXISTS `air`;
CREATE TABLE `air` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '气体id',
  `productId` int(11) DEFAULT NULL COMMENT '产品ID',
  `CO` double(255,0) DEFAULT NULL COMMENT '一氧化碳',
  `SO2` double(255,0) DEFAULT NULL COMMENT '二氧化硫',
  `NO2` double(255,0) DEFAULT NULL COMMENT '二氧化氮',
  `O3` double(255,0) DEFAULT NULL COMMENT '臭氧',
  `PM2.5` double(255,0) DEFAULT NULL COMMENT 'PM2.5',
  `PM10` double(255,0) DEFAULT NULL,
  `VOC` double(255,0) DEFAULT NULL COMMENT '可挥发性气体',
  `CO2` double(255,0) DEFAULT NULL COMMENT '二氧化碳',
  `H2S` double(255,0) DEFAULT NULL COMMENT '硫化氢',
  `NO` double(255,0) DEFAULT NULL COMMENT '一氧化氮',
  `CH2O` double(255,0) DEFAULT NULL COMMENT '甲醛',
  `NH3` double(255,0) DEFAULT NULL COMMENT '氨气',
  `PH3` double(255,0) DEFAULT NULL COMMENT '磷化氢',
  `HCN` double(255,0) DEFAULT NULL COMMENT '氰化氢',
  `C2H4` double(255,0) DEFAULT NULL COMMENT '乙烯',
  `H2O2` double(255,0) DEFAULT NULL COMMENT '过氧化氢',
  `CH4` double(255,0) DEFAULT NULL COMMENT '甲烷',
  `F2` double(255,0) DEFAULT NULL COMMENT '氟',
  `HCL` double(255,0) DEFAULT NULL COMMENT '氯化氢',
  `C2H4O` double(255,0) DEFAULT NULL COMMENT '环氧乙烷',
  `SF6` double(255,0) DEFAULT NULL COMMENT '六氟化硫',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of air
-- ----------------------------
INSERT INTO `air` VALUES ('1', '1', '200', '150', '230', '88', '200', '110', '111', '201', '150', '30', '78', '69', '77', null, '100', '90', '89', null, null, null, '110');
INSERT INTO `air` VALUES ('2', '2', '188', '180', '200', '98', '150', '123', '85', '168', '103', '50', '60', '50', '70', '98', '88', '156', '69', '99', '80', '87', '120');
INSERT INTO `air` VALUES ('4', '3', '143', '140', '180', '128', '163', '150', '85', '168', '69', '50', '60', '50', '70', '98', '88', '156', '100', '99', '80', '87', '90');
INSERT INTO `air` VALUES ('3', '4', '65', '98', '150', '158', '120', '90', '111', '201', '55', '30', '78', '69', '77', '125', '100', '90', '120', '88', '100', '150', '66');
INSERT INTO `air` VALUES ('5', '5', '150', '100', '98', '100', '140', '80', '111', '201', '58', '30', '78', '69', '77', '125', '100', '90', '150', '88', '100', '150', '100');

-- ----------------------------
-- Table structure for airdectectpack
-- ----------------------------
DROP TABLE IF EXISTS `airdectectpack`;
CREATE TABLE `airdectectpack` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `header` int(11) DEFAULT NULL,
  `serialNum` int(11) DEFAULT NULL,
  `powerNum` int(11) DEFAULT NULL,
  `uversion` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `lGPS_lat` double(16,6) DEFAULT NULL,
  `lGPS_lon` double(16,6) DEFAULT NULL,
  `nGPS_alt` int(11) DEFAULT NULL,
  `iTempertrue` double(16,1) DEFAULT NULL,
  `uHumidity` double(16,1) DEFAULT NULL,
  `uPM2_5` int(11) DEFAULT NULL,
  `uPM10` int(11) DEFAULT NULL,
  `uCO` double(16,1) DEFAULT NULL,
  `uSO2` int(11) DEFAULT NULL,
  `uNO2` int(11) DEFAULT NULL,
  `uO3` int(11) DEFAULT NULL,
  `crc` int(11) DEFAULT NULL,
  `recDAY` date DEFAULT NULL,
  `recTime` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of airdectectpack
-- ----------------------------
INSERT INTO `airdectectpack` VALUES ('97', '187', '0', '0', '53', '2', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-03', '16:48:51');
INSERT INTO `airdectectpack` VALUES ('98', '187', '0', '0', '53', '2', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-03', '16:48:54');
INSERT INTO `airdectectpack` VALUES ('99', '187', '0', '0', '53', '2', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-03', '16:48:57');
INSERT INTO `airdectectpack` VALUES ('100', '187', '0', '0', '53', '2', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-06', '16:49:00');
INSERT INTO `airdectectpack` VALUES ('101', '187', '0', '0', '53', '2', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-06', '16:49:03');
INSERT INTO `airdectectpack` VALUES ('102', '187', '0', '0', '53', '1', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-06', '16:49:06');
INSERT INTO `airdectectpack` VALUES ('103', '187', '0', '0', '53', '2', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-06', '16:49:09');
INSERT INTO `airdectectpack` VALUES ('104', '187', '0', '0', '53', '2', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-06', '16:49:12');
INSERT INTO `airdectectpack` VALUES ('105', '187', '0', '0', '53', '2', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-03', '16:49:15');
INSERT INTO `airdectectpack` VALUES ('106', '187', '0', '0', '53', '2', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-03', '16:49:18');
INSERT INTO `airdectectpack` VALUES ('107', '187', '0', '0', '53', '2', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-03', '16:49:21');
INSERT INTO `airdectectpack` VALUES ('108', '187', '0', '0', '53', '2', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-03', '16:49:24');
INSERT INTO `airdectectpack` VALUES ('109', '187', '0', '0', '53', '2', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-03', '16:49:27');
INSERT INTO `airdectectpack` VALUES ('110', '187', '0', '0', '53', '2', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-03', '16:49:30');
INSERT INTO `airdectectpack` VALUES ('111', '187', '0', '0', '53', '2', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-03', '16:49:33');
INSERT INTO `airdectectpack` VALUES ('112', '187', '0', '0', '53', '2', '0.000000', '0.000000', '0', '26.7', '24.0', '39', '48', '0.0', '55', '0', '179', '245', '2020-03-03', '16:49:35');

-- ----------------------------
-- Table structure for air_threshold
-- ----------------------------
DROP TABLE IF EXISTS `air_threshold`;
CREATE TABLE `air_threshold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field` varchar(255) DEFAULT NULL COMMENT '字段名',
  `threshold` double DEFAULT NULL COMMENT '气体阈值',
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of air_threshold
-- ----------------------------
INSERT INTO `air_threshold` VALUES ('1', 'CO', '100', '2020-03-03 10:30:09');
INSERT INTO `air_threshold` VALUES ('2', 'SO2', '150', '2019-12-15 15:31:31');
INSERT INTO `air_threshold` VALUES ('3', 'NO2', '100', null);
INSERT INTO `air_threshold` VALUES ('4', 'O3', '200', '2020-01-15 09:53:07');
INSERT INTO `air_threshold` VALUES ('5', 'PM2.5', '200', '2020-01-15 09:53:15');
INSERT INTO `air_threshold` VALUES ('6', 'PM10', '145', null);
INSERT INTO `air_threshold` VALUES ('7', 'VOC', null, null);
INSERT INTO `air_threshold` VALUES ('8', 'CO2', '100', null);
INSERT INTO `air_threshold` VALUES ('9', 'H2S', null, null);
INSERT INTO `air_threshold` VALUES ('10', 'NO', null, null);
INSERT INTO `air_threshold` VALUES ('11', 'CH2O', '100', null);
INSERT INTO `air_threshold` VALUES ('12', 'NH3', null, null);
INSERT INTO `air_threshold` VALUES ('13', 'PH3', null, null);
INSERT INTO `air_threshold` VALUES ('14', 'HCN', null, null);
INSERT INTO `air_threshold` VALUES ('15', 'C2H4', null, null);
INSERT INTO `air_threshold` VALUES ('16', 'H2O2', null, null);
INSERT INTO `air_threshold` VALUES ('17', 'CH4', null, null);
INSERT INTO `air_threshold` VALUES ('18', 'F2', null, null);
INSERT INTO `air_threshold` VALUES ('19', 'HCL', null, null);
INSERT INTO `air_threshold` VALUES ('20', 'C2H4O', null, null);
INSERT INTO `air_threshold` VALUES ('21', 'SF6', null, null);

-- ----------------------------
-- Table structure for plane
-- ----------------------------
DROP TABLE IF EXISTS `plane`;
CREATE TABLE `plane` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productType` int(11) DEFAULT '0' COMMENT '设备类型',
  `productId` int(11) DEFAULT NULL COMMENT '无人机编号',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态1：正常 0：异常',
  `alt` double(255,2) DEFAULT NULL COMMENT '最大高度',
  `speed` double(225,2) DEFAULT NULL COMMENT '平均速度',
  `video` varchar(255) DEFAULT '' COMMENT '视频源地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of plane
-- ----------------------------
INSERT INTO `plane` VALUES ('1', '0', '1922', '1', '500.00', '4.00', 'rtsp://184.72.239.149/vod/mp4://BigBuckBunny_175k.mov');
INSERT INTO `plane` VALUES ('6', '0', '1958', '1', '500.00', '5.00', 'rtsp://184.72.239.149/vod/mp4://BigBuckBunny_175k.mov');
INSERT INTO `plane` VALUES ('4', '1', '1998', '1', '900.00', '7.00', 'rtsp://184.72.239.149/vod/mp4://BigBuckBunny_175k.mov,rtsp://184.72.239.149/vod/mp4://BigBuckBunny_175k.mov,rtsp://184.72.239.149/vod/mp4://BigBuckBunny_175k.mov');
INSERT INTO `plane` VALUES ('5', '0', '1997', '1', '800.00', '6.00', 'rtsp://184.72.239.149/vod/mp4://BigBuckBunny_175k.mov');
INSERT INTO `plane` VALUES ('7', '0', '2555', '1', '600.00', '5.00', 'rtsp://184.72.239.149/vod/mp4://BigBuckBunny_175k.mov');
INSERT INTO `plane` VALUES ('8', '0', '8947', '1', '600.00', '5.60', 'rtsp://184.72.239.149/vod/mp4://BigBuckBunny_175k.mov');
INSERT INTO `plane` VALUES ('10', '0', '53453', '1', '600.00', '5.60', 'rtsp://184.72.239.149/vod/mp4://BigBuckBunny_175k.mov');
INSERT INTO `plane` VALUES ('11', '1', '2', '1', '6.00', '5.00', 'rtsp://184.72.239.149/vod/mp4://BigBuckBunny_175k.mov');
INSERT INTO `plane` VALUES ('12', '1', '1111', '1', '600.00', '1.00', '');
INSERT INTO `plane` VALUES ('13', '1', '1111', '1', '600.00', '22.00', '');
INSERT INTO `plane` VALUES ('14', '1', '1', '1', '6.00', '3.00', 'rtmp://58.200.131.2:1935/livetv/hunantv,plane.mp4');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '收到包的顺序',
  `Header` int(11) DEFAULT NULL COMMENT '包头0*BB，十进制187',
  `serialNum` int(11) DEFAULT NULL COMMENT '序号，GPS绝对时间，采集到的气体时间',
  `powerNum` int(11) DEFAULT NULL COMMENT '上电次数',
  `version` int(11) DEFAULT NULL COMMENT '版本号，代表数据长度',
  `ptoductType` int(11) DEFAULT '0' COMMENT '设备类型 0：无人机 1：车载',
  `productId` int(11) NOT NULL COMMENT '产品ID',
  `lat` double(225,10) DEFAULT NULL COMMENT '经度',
  `lon` double(225,10) DEFAULT NULL COMMENT '纬度',
  `speed` double(225,2) DEFAULT NULL COMMENT '速度',
  `alt` double(225,2) NOT NULL COMMENT '高度',
  `CRC` int(11) DEFAULT NULL COMMENT '8位CRC校验',
  `Day` date DEFAULT NULL COMMENT '接收日期',
  `Time` time DEFAULT NULL COMMENT '接收时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', null, '1574926175', null, null, '1', '1998', '34.2935302306', '108.9531326294', '5.00', '900.00', null, '2020-03-02', '15:10:52');
INSERT INTO `product` VALUES ('2', null, '1574926245', null, null, '1', '1997', '34.2935302306', '108.9531326294', '6.00', '800.00', null, '2020-03-02', '17:03:04');
INSERT INTO `product` VALUES ('3', null, '1574994875', null, null, '0', '1998', '34.2935302306', '108.9531326294', '5.60', '780.00', null, '2020-03-02', '12:10:52');
INSERT INTO `product` VALUES ('4', null, '1574994901', null, null, '0', '1998', '34.2935302306', '108.9531326294', '8.00', '500.00', null, '2020-03-02', '08:03:04');
INSERT INTO `product` VALUES ('5', null, '1574994901', null, null, '0', '1998', '34.2935302306', '108.9531326294', '8.00', '500.00', null, '2020-03-02', '10:03:04');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT '姓名',
  `iphone` varchar(255) DEFAULT NULL COMMENT '电话',
  `charge` varchar(255) DEFAULT NULL COMMENT '负责内容',
  `week` varchar(255) DEFAULT '' COMMENT '排班日期',
  `productId` int(11) DEFAULT NULL COMMENT '负责无人机的id',
  `time` date DEFAULT NULL COMMENT '日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('12', '张1', '18622231111', '无人机操作', '星期六', null, '2019-11-30');
INSERT INTO `user` VALUES ('13', '张三', '18622232222', '无人机操作', '星期五', null, '2019-11-29');
INSERT INTO `user` VALUES ('14', '张1', '18622231111', '无人机操作', '星期六', null, '2019-11-30');
INSERT INTO `user` VALUES ('17', '刘潇', '18611632222', '无人机操作', '星期五', null, '2019-11-29');
