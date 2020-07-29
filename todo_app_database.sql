/*
 Navicat Premium Data Transfer

 Source Server         : Econnection
 Source Server Type    : MySQL
 Source Server Version : 100134
 Source Host           : localhost:3306
 Source Schema         : todo_app

 Target Server Type    : MySQL
 Target Server Version : 100134
 File Encoding         : 65001

 Date: 29/07/2020 21:20:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for todo_table
-- ----------------------------
DROP TABLE IF EXISTS `todo_table`;
CREATE TABLE `todo_table`  (
  `todo_id` int(11) NOT NULL AUTO_INCREMENT,
  `todo_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `todo_datecreated` date NULL DEFAULT NULL,
  `todo_userid` int(11) NULL DEFAULT NULL,
  `todo_status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `todo_userrole` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`todo_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for todo_users
-- ----------------------------
DROP TABLE IF EXISTS `todo_users`;
CREATE TABLE `todo_users`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fullname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `userrole` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of todo_users
-- ----------------------------
INSERT INTO `todo_users` VALUES (6, 'administrator', 'administrator', '$2y$10$wK.hSCpQLvfzoMDiVzlTHeP5gtee37NV4wWTGtDl1Q0SibbkeJpca', 'admin');

SET FOREIGN_KEY_CHECKS = 1;
