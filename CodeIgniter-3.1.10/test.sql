/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2019-11-29 19:31:46
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
INSERT INTO `air` VALUES ('1', '1', '200', '150', '98', '88', '200', '110', '111', '201', '58', '30', '78', '69', '77', null, '100', '90', '89', null, null, null, '110');
INSERT INTO `air` VALUES ('2', '2', '143', '180', '100', '98', '163', '108', '85', '168', '55', '50', '60', '50', '70', '98', '88', '156', '69', '99', '80', '87', '120');
INSERT INTO `air` VALUES ('4', '4', '143', '180', '100', '98', '163', '108', '85', '168', '55', '50', '60', '50', '70', '98', '88', '156', '69', '99', '80', '87', '120');
INSERT INTO `air` VALUES ('3', '3', '200', '150', '98', '88', '200', '110', '111', '201', '58', '30', '78', '69', '77', '125', '100', '90', '89', '88', '100', '150', '110');
INSERT INTO `air` VALUES ('5', '5', '200', '150', '98', '88', '200', '110', '111', '201', '58', '30', '78', '69', '77', '125', '100', '90', '89', '88', '100', '150', '110');

-- ----------------------------
-- Table structure for plane
-- ----------------------------
DROP TABLE IF EXISTS `plane`;
CREATE TABLE `plane` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) DEFAULT NULL COMMENT '无人机编号',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态1：正常 0：异常',
  `alt` double(255,2) DEFAULT NULL COMMENT '最大高度',
  `speed` double(225,2) DEFAULT NULL COMMENT '平均速度',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of plane
-- ----------------------------
INSERT INTO `plane` VALUES ('1', '1922', '1', '500.00', '4.00');
INSERT INTO `plane` VALUES ('2', '1855', '0', '600.00', '5.00');
INSERT INTO `plane` VALUES ('6', '1958', '1', '500.00', '5.00');
INSERT INTO `plane` VALUES ('4', '1998', '1', '900.00', '7.00');
INSERT INTO `plane` VALUES ('5', '1997', '1', '800.00', '6.00');
INSERT INTO `plane` VALUES ('7', '2555', '1', '600.00', '5.00');
INSERT INTO `plane` VALUES ('8', '8947', '1', '600.00', '5.60');
INSERT INTO `plane` VALUES ('9', '8554', '1', '600.00', '5.60');
INSERT INTO `plane` VALUES ('10', '53453', '1', '600.00', '5.60');

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
INSERT INTO `product` VALUES ('1', null, '1574926175', null, null, '1998', '34.2935302306', '108.9531326294', '5.00', '900.00', null, '2019-11-29', '15:10:52');
INSERT INTO `product` VALUES ('2', null, '1574926245', null, null, '1997', '34.2935302306', '108.9531326294', '6.00', '800.00', null, '2019-11-29', '17:03:04');
INSERT INTO `product` VALUES ('3', null, '1574994875', null, null, '1998', '34.2935302306', '108.9531326294', '5.60', '780.00', null, '2019-11-29', '12:10:52');
INSERT INTO `product` VALUES ('4', null, '1574994901', null, null, '1998', '34.2935302306', '108.9531326294', '8.00', '500.00', null, '2019-11-29', '08:03:04');
INSERT INTO `product` VALUES ('5', null, '1574994901', null, null, '1998', '34.2935302306', '108.9531326294', '8.00', '500.00', null, '2019-11-28', '08:03:04');

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
