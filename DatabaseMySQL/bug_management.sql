/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : bug_management

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-10-24 23:25:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `proj_id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for invite
-- ----------------------------
DROP TABLE IF EXISTS `invite`;
CREATE TABLE `invite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proj_id` int(11) NOT NULL,
  `user_send_id` int(11) NOT NULL,
  `user_receive_id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1:Đã mời        2:Đã chấp nhận      3:Từ chối',
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of invite
-- ----------------------------

-- ----------------------------
-- Table structure for issue
-- ----------------------------
DROP TABLE IF EXISTS `issue`;
CREATE TABLE `issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proj_id` int(11) NOT NULL,
  `reporter` int(11) NOT NULL,
  `assignee` int(11) DEFAULT NULL,
  `summary` varchar(255) NOT NULL,
  `issue_type` int(11) DEFAULT NULL,
  `issue_link` int(11) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `due_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `description` text,
  `priority_id` int(11) DEFAULT NULL,
  `label` int(11) DEFAULT NULL,
  `original_estimate` int(11) DEFAULT NULL,
  `remaining_estimate` int(11) DEFAULT NULL,
  `resolution_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of issue
-- ----------------------------

-- ----------------------------
-- Table structure for issuelink
-- ----------------------------
DROP TABLE IF EXISTS `issuelink`;
CREATE TABLE `issuelink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_type_id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of issuelink
-- ----------------------------

-- ----------------------------
-- Table structure for issuelinktype
-- ----------------------------
DROP TABLE IF EXISTS `issuelinktype`;
CREATE TABLE `issuelinktype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(255) NOT NULL,
  `inward` varchar(255) DEFAULT NULL,
  `outward` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of issuelinktype
-- ----------------------------
INSERT INTO `issuelinktype` VALUES ('1', 'Blocks', 'is blocked by', 'blocks');
INSERT INTO `issuelinktype` VALUES ('2', 'Cloners', 'is cloned by', 'clones');
INSERT INTO `issuelinktype` VALUES ('3', 'Duplicate', 'is duplicated by', 'duplicates');
INSERT INTO `issuelinktype` VALUES ('4', 'Relates', 'relates to', 'relates to');
INSERT INTO `issuelinktype` VALUES ('5', 'jira_subtask_link', 'jira_subtask_inward', 'jira_subtask_outward');
INSERT INTO `issuelinktype` VALUES ('6', 'Epic-Story Link', 'has Epic', 'is Epic of');

-- ----------------------------
-- Table structure for issuestatus
-- ----------------------------
DROP TABLE IF EXISTS `issuestatus`;
CREATE TABLE `issuestatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sequence` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `icon_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of issuestatus
-- ----------------------------
INSERT INTO `issuestatus` VALUES ('1', '1', 'Open', 'The issue is open and ready for the assignee to start work on it.', '/images/icons/statuses/open.png');
INSERT INTO `issuestatus` VALUES ('2', '3', 'To Do', null, '/images/icons/status_generic.gif');
INSERT INTO `issuestatus` VALUES ('3', '4', 'Done', null, '/images/icons/status_generic.gif');
INSERT INTO `issuestatus` VALUES ('4', '2', 'In Progress', 'This issue is being actively worked on at the moment by the assignee.', '/images/icons/statuses/inprogress.png');
INSERT INTO `issuestatus` VALUES ('5', '5', 'Reopened', 'This issue was once resolved, but the resolution was deemed incorrect. From here issues are either marked assigned or resolved.', '/images/icons/statuses/reopened.png');
INSERT INTO `issuestatus` VALUES ('6', '6', 'Resolved', 'A resolution has been taken, and it is awaiting verification by reporter. From here issues are either reopened, or are closed.', '/images/icons/statuses/resolved.png');
INSERT INTO `issuestatus` VALUES ('7', '7', 'Closed', 'The issue is considered finished, the resolution is correct. Issues which are closed can be reopened.', '/images/icons/statuses/closed.png');

-- ----------------------------
-- Table structure for issuetype
-- ----------------------------
DROP TABLE IF EXISTS `issuetype`;
CREATE TABLE `issuetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `icon_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of issuetype
-- ----------------------------
INSERT INTO `issuetype` VALUES ('1', 'Epic', null, '/images/icons/issuetypes/epic.svg');
INSERT INTO `issuetype` VALUES ('2', 'Story', null, '/images/icons/issuetypes/story.svg');
INSERT INTO `issuetype` VALUES ('3', 'Task', 'A task that needs to be done.', null);
INSERT INTO `issuetype` VALUES ('4', 'Sub-task', 'The sub-task of the issue', null);

-- ----------------------------
-- Table structure for label
-- ----------------------------
DROP TABLE IF EXISTS `label`;
CREATE TABLE `label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proj_id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of label
-- ----------------------------

-- ----------------------------
-- Table structure for priority
-- ----------------------------
DROP TABLE IF EXISTS `priority`;
CREATE TABLE `priority` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sequence` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `icon_url` varchar(255) DEFAULT NULL,
  `status_color` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of priority
-- ----------------------------
INSERT INTO `priority` VALUES ('1', '1', 'Highest', 'This problem will block progress.', '/images/icons/priorities/highest.png', '#d04437');
INSERT INTO `priority` VALUES ('2', '2', 'High', 'Serious problem that could block progress.', '/images/icons/priorities/high.png', '#f15C75');
INSERT INTO `priority` VALUES ('3', '3', 'Medium', 'Has the potential to affect progress.', '/images/icons/priorities/medium.png', '#f79232');
INSERT INTO `priority` VALUES ('4', '4', 'Low', 'Minor problem or easily worked around.', '/images/icons/priorities/low.png', '#707070');
INSERT INTO `priority` VALUES ('5', '5', 'Lowest', 'Trivial problem with little or no impact on progress.', '/images/icons/priorities/lowest.png', '#999999');

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `p_key` varchar(50) DEFAULT NULL,
  `lead_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project
-- ----------------------------

-- ----------------------------
-- Table structure for resolution
-- ----------------------------
DROP TABLE IF EXISTS `resolution`;
CREATE TABLE `resolution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sequence` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `icon_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of resolution
-- ----------------------------
INSERT INTO `resolution` VALUES ('1', '1', 'Done', 'Work has been completed on this issue.', null);
INSERT INTO `resolution` VALUES ('2', '2', 'Won\'t Do', 'This issue won\'t be actioned.', null);
INSERT INTO `resolution` VALUES ('3', '3', 'Duplicate', 'The problem is a duplicate of an existing issue.', null);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1:Developer      2:Manager      3:Admin															',
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `nation` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
