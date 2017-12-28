/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : hilao_api

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-12-28 09:20:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `hl_project`
-- ----------------------------
DROP TABLE IF EXISTS `hl_project`;
CREATE TABLE `hl_project` (
  `project_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) NOT NULL COMMENT '项目名称',
  `project_desc` varchar(255) NOT NULL COMMENT '项目描述',
  `project_url` varchar(255) DEFAULT NULL COMMENT '项目接口地址',
  `create_user_id` int(11) unsigned DEFAULT '0' COMMENT '创建人ID',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hl_project
-- ----------------------------

-- ----------------------------
-- Table structure for `hl_project_page`
-- ----------------------------
DROP TABLE IF EXISTS `hl_project_page`;
CREATE TABLE `hl_project_page` (
  `page_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version_id` int(11) unsigned NOT NULL COMMENT '项目版本号ID',
  `project_id` int(11) unsigned NOT NULL COMMENT '项目ID',
  `page_name` varchar(255) NOT NULL COMMENT '页面名称',
  `page_desc` varchar(255) DEFAULT NULL COMMENT '页面描述',
  `sort` smallint(6) NOT NULL DEFAULT '1' COMMENT '排序',
  PRIMARY KEY (`page_id`),
  KEY `version_id` (`version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目页面表';

-- ----------------------------
-- Records of hl_project_page
-- ----------------------------

-- ----------------------------
-- Table structure for `hl_project_version`
-- ----------------------------
DROP TABLE IF EXISTS `hl_project_version`;
CREATE TABLE `hl_project_version` (
  `version_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) unsigned NOT NULL COMMENT '项目的ID',
  `version` varchar(10) NOT NULL COMMENT '版本号(v1.0)',
  `version_desc` varchar(255) DEFAULT NULL COMMENT '版本的描述',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`version_id`),
  KEY `project_id` (`project_id`,`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hl_project_version
-- ----------------------------

-- ----------------------------
-- Table structure for `hl_project_version_interface`
-- ----------------------------
DROP TABLE IF EXISTS `hl_project_version_interface`;
CREATE TABLE `hl_project_version_interface` (
  `interface_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(11) unsigned NOT NULL COMMENT '页面ID',
  `project_id` int(11) unsigned NOT NULL COMMENT '项目ID',
  `interface_name` varchar(255) NOT NULL COMMENT '接口名称',
  `interface_url` varchar(255) NOT NULL COMMENT '接口地址',
  `interface_desc` varchar(255) DEFAULT NULL COMMENT '接口描述',
  `create_user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建人ID',
  `create_user_name` varchar(20) DEFAULT NULL COMMENT '创建人姓名',
  `method` varchar(10) NOT NULL DEFAULT 'GET' COMMENT '请求方式',
  `param` text COMMENT '入参',
  `result` text COMMENT '返回值',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(1、正常 2、关闭)',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`interface_id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hl_project_version_interface
-- ----------------------------

-- ----------------------------
-- Table structure for `hl_user`
-- ----------------------------
DROP TABLE IF EXISTS `hl_user`;
CREATE TABLE `hl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL COMMENT '自动登录key',
  `password_hash` varchar(255) NOT NULL COMMENT '加密密码',
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '重置密码token',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of hl_user
-- ----------------------------

-- ----------------------------
-- Table structure for `hl_user_project`
-- ----------------------------
DROP TABLE IF EXISTS `hl_user_project`;
CREATE TABLE `hl_user_project` (
  `user_id` int(11) unsigned NOT NULL,
  `project_id` bigint(20) unsigned NOT NULL,
  `role` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '角色(1、接口开发者 2、接口使用者)',
  PRIMARY KEY (`user_id`,`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户项目权限表';

-- ----------------------------
-- Records of hl_user_project
-- ----------------------------
