/*
 Navicat MySQL Data Transfer

 Source Server         : LIQUID
 Source Server Version : 50096
 Source Host           : localhost
 Source Database       : lahaina_db

 Target Server Version : 50096
 File Encoding         : utf-8

 Date: 12/13/2012 12:10:00 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `notifications`
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL auto_increment,
  `host` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `code` varchar(20) NOT NULL,
  `email_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `created_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `staff_id` int(11) NOT NULL,
  `source_ip` int(10) NOT NULL,
  `start_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `end_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postal_zip` varchar(255) NOT NULL,
  `raw_data` longtext NOT NULL,
  PRIMARY KEY  (`notification_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
