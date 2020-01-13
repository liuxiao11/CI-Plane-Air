/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-01-13 19:55:03
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of air
-- ----------------------------
INSERT INTO `air` VALUES ('1', '1', '200', '150', '98', '88', '200', '110', '111', '201', '58', '30', '78', '69', '77', null, '100', '90', '89', null, null, null, '110');
INSERT INTO `air` VALUES ('2', '2', '143', '180', '100', '98', '163', '108', '85', '168', '55', '50', '60', '50', '70', '98', '88', '156', '69', '99', '80', '87', '120');
INSERT INTO `air` VALUES ('4', '4', '143', '180', '100', '98', '163', '108', '85', '168', '55', '50', '60', '50', '70', '98', '88', '156', '69', '99', '80', '87', '120');
INSERT INTO `air` VALUES ('3', '3', '200', '150', '98', '88', '200', '110', '111', '201', '58', '30', '78', '69', '77', '125', '100', '90', '89', '88', '100', '150', '110');
INSERT INTO `air` VALUES ('5', '5', '200', '150', '98', '88', '200', '110', '111', '201', '58', '30', '78', '69', '77', '125', '100', '90', '89', '88', '100', '150', '110');
INSERT INTO `air` VALUES ('6', '6', '200', '150', '100', '88', '200', '110', '111', '201', '58', '30', '78', '69', '77', '125', '100', '90', '89', '88', '100', '150', '110');
INSERT INTO `air` VALUES ('7', '7', '143', '180', '100', '98', '163', '108', '85', '168', '55', '50', '60', '50', '70', '98', '88', '156', '69', '99', '80', '87', '120');
INSERT INTO `air` VALUES ('8', '8', '200', '150', '98', '88', '200', '110', '111', '201', '58', '30', '78', '69', '77', '125', '100', '90', '89', '88', '100', '150', '110');

-- ----------------------------
-- Table structure for air_threshold
-- ----------------------------
DROP TABLE IF EXISTS `air_threshold`;
CREATE TABLE `air_threshold` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `field` varchar(255) NOT NULL COMMENT '字段名称',
  `threshold` varchar(255) DEFAULT NULL COMMENT '字段阈值',
  `datetime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of air_threshold
-- ----------------------------
INSERT INTO `air_threshold` VALUES ('1', 'CO', '123', '2019-12-13 15:10:17');
INSERT INTO `air_threshold` VALUES ('2', 'SO2', '158', '2019-12-16 15:46:05');
INSERT INTO `air_threshold` VALUES ('3', 'NO2', '200', '2019-12-16 15:46:25');
INSERT INTO `air_threshold` VALUES ('4', 'O3', '200', '2019-12-16 15:46:31');
INSERT INTO `air_threshold` VALUES ('5', 'PM2.5', '100', null);
INSERT INTO `air_threshold` VALUES ('6', 'PM10', '198', '2019-12-13 15:40:00');
INSERT INTO `air_threshold` VALUES ('7', 'VOC', '200', null);
INSERT INTO `air_threshold` VALUES ('8', 'CO2', '300', '2019-12-16 15:48:33');
INSERT INTO `air_threshold` VALUES ('9', 'H2S', '200', null);
INSERT INTO `air_threshold` VALUES ('10', 'NO', '100', null);
INSERT INTO `air_threshold` VALUES ('11', 'CH2O', '100', null);
INSERT INTO `air_threshold` VALUES ('12', 'NH3', '200', null);
INSERT INTO `air_threshold` VALUES ('13', 'PH3', '200', null);
INSERT INTO `air_threshold` VALUES ('14', 'HCN', '200', null);
INSERT INTO `air_threshold` VALUES ('15', 'C2H4', '200', null);
INSERT INTO `air_threshold` VALUES ('16', 'H2O2', '200', null);
INSERT INTO `air_threshold` VALUES ('17', 'CH4', '200', null);
INSERT INTO `air_threshold` VALUES ('18', 'F2', '200', null);
INSERT INTO `air_threshold` VALUES ('19', 'HCL', '200', null);
INSERT INTO `air_threshold` VALUES ('20', 'C2H4O', '200', null);
INSERT INTO `air_threshold` VALUES ('21', 'SF6', '', null);

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of plane
-- ----------------------------
INSERT INTO `plane` VALUES ('1', '1922', '1', '500.00', '4.00');
INSERT INTO `plane` VALUES ('2', '1855', '0', '600.00', '5.00');
INSERT INTO `plane` VALUES ('12', '3223', '1', '600.00', '5.00');
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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', null, '1574926175', null, null, '1998', '34.2935302306', '108.9531326294', '5.00', '900.00', null, '2019-12-17', '15:10:52');
INSERT INTO `product` VALUES ('2', null, '1574994901', null, null, '1997', '34.2935302306', '108.9531326294', '6.00', '800.00', null, '2019-12-17', '17:03:04');
INSERT INTO `product` VALUES ('3', null, '1574994875', null, null, '1997', '34.3175030000', '108.9497050000', '5.60', '780.00', null, '2019-12-17', '12:10:52');
INSERT INTO `product` VALUES ('4', null, '1574994901', null, null, '1998', '34.3255530000', '108.9574660000', '8.00', '500.00', null, '2019-12-17', '10:03:04');
INSERT INTO `product` VALUES ('5', null, '0', null, null, '1998', '34.2935302306', '108.9531326294', '8.00', '500.00', null, '2019-12-17', '08:03:04');
INSERT INTO `product` VALUES ('6', null, '1575424991', null, null, '1998', '34.2935302306', '108.9531326294', '5.00', '400.00', null, '2019-12-17', '10:04:46');
INSERT INTO `product` VALUES ('7', null, '1575427482', null, null, '1997', '34.3255530000', '108.9574660000', '6.00', '500.00', null, '2019-12-17', '11:45:48');
INSERT INTO `product` VALUES ('8', null, '1575432901', null, null, '1997', '34.3289777713', '108.9304733276', '4.00', '500.00', null, '2019-12-17', '12:45:48');

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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('27', '飒飒', '18611633332', '无人机清点', '星期三', null, '2019-12-04');
INSERT INTO `user` VALUES ('23', '都答对打算', '爱豆', '无人机操作', '星期二', null, '2019-12-03');
INSERT INTO `user` VALUES ('22', 'ad11', '1861163333', '无人机清点', '星期二', null, '2019-12-03');
INSERT INTO `user` VALUES ('21', '李四', '18611632458', '无人机操作', '星期二', null, '2019-12-03');
INSERT INTO `user` VALUES ('29', '刘潇', '18611632458', '无人机清点', '星期四', null, '2019-12-05');
INSERT INTO `user` VALUES ('28', '大苏打打算的撒', '三大打算打算', '', '星期二', null, '2019-12-03');
INSERT INTO `user` VALUES ('30', '刘潇', '18611632458', '无人机清点', '星期一', null, '2019-12-16');
