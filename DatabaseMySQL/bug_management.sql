/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : bug_management

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-11-08 01:11:54
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
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for country
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `cc_iso` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `country_name` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_cc_iso` (`cc_iso`)
) ENGINE=MyISAM AUTO_INCREMENT=270 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES ('1', 'AW', 'Aruba');
INSERT INTO `country` VALUES ('2', 'AG', 'Antigua and Barbuda');
INSERT INTO `country` VALUES ('3', 'AE', 'United Arab Emirates');
INSERT INTO `country` VALUES ('4', 'AF', 'Afghanistan');
INSERT INTO `country` VALUES ('5', 'DZ', 'Algeria');
INSERT INTO `country` VALUES ('6', 'AZ', 'Azerbaijan');
INSERT INTO `country` VALUES ('7', 'AL', 'Albania');
INSERT INTO `country` VALUES ('8', 'AM', 'Armenia');
INSERT INTO `country` VALUES ('9', 'AD', 'Andorra');
INSERT INTO `country` VALUES ('10', 'AO', 'Angola');
INSERT INTO `country` VALUES ('11', 'AS', 'American Samoa');
INSERT INTO `country` VALUES ('12', 'AR', 'Argentina');
INSERT INTO `country` VALUES ('13', 'AU', 'Australia');
INSERT INTO `country` VALUES ('14', '-', 'Ashmore and Cartier Islands');
INSERT INTO `country` VALUES ('15', 'AT', 'Austria');
INSERT INTO `country` VALUES ('16', 'AI', 'Anguilla');
INSERT INTO `country` VALUES ('17', 'AX', 'Åland Islands');
INSERT INTO `country` VALUES ('18', 'AQ', 'Antarctica');
INSERT INTO `country` VALUES ('19', 'BH', 'Bahrain');
INSERT INTO `country` VALUES ('20', 'BB', 'Barbados');
INSERT INTO `country` VALUES ('21', 'BW', 'Botswana');
INSERT INTO `country` VALUES ('22', 'BM', 'Bermuda');
INSERT INTO `country` VALUES ('23', 'BE', 'Belgium');
INSERT INTO `country` VALUES ('24', 'BS', 'Bahamas, The');
INSERT INTO `country` VALUES ('25', 'BD', 'Bangladesh');
INSERT INTO `country` VALUES ('26', 'BZ', 'Belize');
INSERT INTO `country` VALUES ('27', 'BA', 'Bosnia and Herzegovina');
INSERT INTO `country` VALUES ('28', 'BO', 'Bolivia');
INSERT INTO `country` VALUES ('29', 'MM', 'Myanmar');
INSERT INTO `country` VALUES ('30', 'BJ', 'Benin');
INSERT INTO `country` VALUES ('31', 'BY', 'Belarus');
INSERT INTO `country` VALUES ('32', 'SB', 'Solomon Islands');
INSERT INTO `country` VALUES ('33', '-', 'Navassa Island');
INSERT INTO `country` VALUES ('34', 'BR', 'Brazil');
INSERT INTO `country` VALUES ('35', '-', 'Bassas da India');
INSERT INTO `country` VALUES ('36', 'BT', 'Bhutan');
INSERT INTO `country` VALUES ('37', 'BG', 'Bulgaria');
INSERT INTO `country` VALUES ('38', 'BV', 'Bouvet Island');
INSERT INTO `country` VALUES ('39', 'BN', 'Brunei');
INSERT INTO `country` VALUES ('40', 'BI', 'Burundi');
INSERT INTO `country` VALUES ('41', 'CA', 'Canada');
INSERT INTO `country` VALUES ('42', 'KH', 'Cambodia');
INSERT INTO `country` VALUES ('43', 'TD', 'Chad');
INSERT INTO `country` VALUES ('44', 'LK', 'Sri Lanka');
INSERT INTO `country` VALUES ('45', 'CG', 'Congo, Republic of the');
INSERT INTO `country` VALUES ('46', 'CD', 'Congo, Democratic Republic of the');
INSERT INTO `country` VALUES ('47', 'CN', 'China');
INSERT INTO `country` VALUES ('48', 'CL', 'Chile');
INSERT INTO `country` VALUES ('49', 'KY', 'Cayman Islands');
INSERT INTO `country` VALUES ('50', 'CC', 'Cocos (Keeling) Islands');
INSERT INTO `country` VALUES ('51', 'CM', 'Cameroon');
INSERT INTO `country` VALUES ('52', 'KM', 'Comoros');
INSERT INTO `country` VALUES ('53', 'CO', 'Colombia');
INSERT INTO `country` VALUES ('54', 'MP', 'Northern Mariana Islands');
INSERT INTO `country` VALUES ('55', '-', 'Coral Sea Islands');
INSERT INTO `country` VALUES ('56', 'CR', 'Costa Rica');
INSERT INTO `country` VALUES ('57', 'CF', 'Central African Republic');
INSERT INTO `country` VALUES ('58', 'CU', 'Cuba');
INSERT INTO `country` VALUES ('59', 'CV', 'Cape Verde');
INSERT INTO `country` VALUES ('60', 'CK', 'Cook Islands');
INSERT INTO `country` VALUES ('61', 'CY', 'Cyprus');
INSERT INTO `country` VALUES ('62', 'DK', 'Denmark');
INSERT INTO `country` VALUES ('63', 'DJ', 'Djibouti');
INSERT INTO `country` VALUES ('64', 'DM', 'Dominica');
INSERT INTO `country` VALUES ('65', 'UM', 'Jarvis Island');
INSERT INTO `country` VALUES ('66', 'DO', 'Dominican Republic');
INSERT INTO `country` VALUES ('67', '-', 'Dhekelia Sovereign Base Area');
INSERT INTO `country` VALUES ('68', 'EC', 'Ecuador');
INSERT INTO `country` VALUES ('69', 'EG', 'Egypt');
INSERT INTO `country` VALUES ('70', 'IE', 'Ireland');
INSERT INTO `country` VALUES ('71', 'GQ', 'Equatorial Guinea');
INSERT INTO `country` VALUES ('72', 'EE', 'Estonia');
INSERT INTO `country` VALUES ('73', 'ER', 'Eritrea');
INSERT INTO `country` VALUES ('74', 'SV', 'El Salvador');
INSERT INTO `country` VALUES ('75', 'ET', 'Ethiopia');
INSERT INTO `country` VALUES ('76', '-', 'Europa Island');
INSERT INTO `country` VALUES ('77', 'CZ', 'Czech Republic');
INSERT INTO `country` VALUES ('78', 'GF', 'French Guiana');
INSERT INTO `country` VALUES ('79', 'FI', 'Finland');
INSERT INTO `country` VALUES ('80', 'FJ', 'Fiji');
INSERT INTO `country` VALUES ('81', 'FK', 'Falkland Islands (Islas Malvinas)');
INSERT INTO `country` VALUES ('82', 'FM', 'Micronesia, Federated States of');
INSERT INTO `country` VALUES ('83', 'FO', 'Faroe Islands');
INSERT INTO `country` VALUES ('84', 'PF', 'French Polynesia');
INSERT INTO `country` VALUES ('85', 'UM', 'Baker Island');
INSERT INTO `country` VALUES ('86', 'FR', 'France');
INSERT INTO `country` VALUES ('87', 'TF', 'French Southern and Antarctic Lands');
INSERT INTO `country` VALUES ('88', 'GM', 'Gambia, The');
INSERT INTO `country` VALUES ('89', 'GA', 'Gabon');
INSERT INTO `country` VALUES ('90', 'GE', 'Georgia');
INSERT INTO `country` VALUES ('91', 'GH', 'Ghana');
INSERT INTO `country` VALUES ('92', 'GI', 'Gibraltar');
INSERT INTO `country` VALUES ('93', 'GD', 'Grenada');
INSERT INTO `country` VALUES ('94', '-', 'Guernsey');
INSERT INTO `country` VALUES ('95', 'GL', 'Greenland');
INSERT INTO `country` VALUES ('96', 'DE', 'Germany');
INSERT INTO `country` VALUES ('97', '-', 'Glorioso Islands');
INSERT INTO `country` VALUES ('98', 'GP', 'Guadeloupe');
INSERT INTO `country` VALUES ('99', 'GU', 'Guam');
INSERT INTO `country` VALUES ('100', 'GR', 'Greece');
INSERT INTO `country` VALUES ('101', 'GT', 'Guatemala');
INSERT INTO `country` VALUES ('102', 'GN', 'Guinea');
INSERT INTO `country` VALUES ('103', 'GY', 'Guyana');
INSERT INTO `country` VALUES ('104', '-', 'Gaza Strip');
INSERT INTO `country` VALUES ('105', 'HT', 'Haiti');
INSERT INTO `country` VALUES ('106', 'HK', 'Hong Kong');
INSERT INTO `country` VALUES ('107', 'HM', 'Heard Island and McDonald Islands');
INSERT INTO `country` VALUES ('108', 'HN', 'Honduras');
INSERT INTO `country` VALUES ('109', 'UM', 'Howland Island');
INSERT INTO `country` VALUES ('110', 'HR', 'Croatia');
INSERT INTO `country` VALUES ('111', 'HU', 'Hungary');
INSERT INTO `country` VALUES ('112', 'IS', 'Iceland');
INSERT INTO `country` VALUES ('113', 'ID', 'Indonesia');
INSERT INTO `country` VALUES ('114', 'IM', 'Isle of Man');
INSERT INTO `country` VALUES ('115', 'IN', 'India');
INSERT INTO `country` VALUES ('116', 'IO', 'British Indian Ocean Territory');
INSERT INTO `country` VALUES ('117', '-', 'Clipperton Island');
INSERT INTO `country` VALUES ('118', 'IR', 'Iran');
INSERT INTO `country` VALUES ('119', 'IL', 'Israel');
INSERT INTO `country` VALUES ('120', 'IT', 'Italy');
INSERT INTO `country` VALUES ('121', 'CI', 'Cote d\'Ivoire');
INSERT INTO `country` VALUES ('122', 'IQ', 'Iraq');
INSERT INTO `country` VALUES ('123', 'JP', 'Japan');
INSERT INTO `country` VALUES ('124', 'JE', 'Jersey');
INSERT INTO `country` VALUES ('125', 'JM', 'Jamaica');
INSERT INTO `country` VALUES ('126', 'SJ', 'Jan Mayen');
INSERT INTO `country` VALUES ('127', 'JO', 'Jordan');
INSERT INTO `country` VALUES ('128', 'UM', 'Johnston Atoll');
INSERT INTO `country` VALUES ('129', '-', 'Juan de Nova Island');
INSERT INTO `country` VALUES ('130', 'KE', 'Kenya');
INSERT INTO `country` VALUES ('131', 'KG', 'Kyrgyzstan');
INSERT INTO `country` VALUES ('132', 'KP', 'Korea, North');
INSERT INTO `country` VALUES ('133', 'UM', 'Kingman Reef');
INSERT INTO `country` VALUES ('134', 'KI', 'Kiribati');
INSERT INTO `country` VALUES ('135', 'KR', 'Korea, South');
INSERT INTO `country` VALUES ('136', 'CX', 'Christmas Island');
INSERT INTO `country` VALUES ('137', 'KW', 'Kuwait');
INSERT INTO `country` VALUES ('138', 'KV', 'Kosovo');
INSERT INTO `country` VALUES ('139', 'KZ', 'Kazakhstan');
INSERT INTO `country` VALUES ('140', 'LA', 'Laos');
INSERT INTO `country` VALUES ('141', 'LB', 'Lebanon');
INSERT INTO `country` VALUES ('142', 'LV', 'Latvia');
INSERT INTO `country` VALUES ('143', 'LT', 'Lithuania');
INSERT INTO `country` VALUES ('144', 'LR', 'Liberia');
INSERT INTO `country` VALUES ('145', 'SK', 'Slovakia');
INSERT INTO `country` VALUES ('146', 'UM', 'Palmyra Atoll');
INSERT INTO `country` VALUES ('147', 'LI', 'Liechtenstein');
INSERT INTO `country` VALUES ('148', 'LS', 'Lesotho');
INSERT INTO `country` VALUES ('149', 'LU', 'Luxembourg');
INSERT INTO `country` VALUES ('150', 'LY', 'Libyan Arab');
INSERT INTO `country` VALUES ('151', 'MG', 'Madagascar');
INSERT INTO `country` VALUES ('152', 'MQ', 'Martinique');
INSERT INTO `country` VALUES ('153', 'MO', 'Macau');
INSERT INTO `country` VALUES ('154', 'MD', 'Moldova, Republic of');
INSERT INTO `country` VALUES ('155', 'YT', 'Mayotte');
INSERT INTO `country` VALUES ('156', 'MN', 'Mongolia');
INSERT INTO `country` VALUES ('157', 'MS', 'Montserrat');
INSERT INTO `country` VALUES ('158', 'MW', 'Malawi');
INSERT INTO `country` VALUES ('159', 'ME', 'Montenegro');
INSERT INTO `country` VALUES ('160', 'MK', 'The Former Yugoslav Republic of Macedonia');
INSERT INTO `country` VALUES ('161', 'ML', 'Mali');
INSERT INTO `country` VALUES ('162', 'MC', 'Monaco');
INSERT INTO `country` VALUES ('163', 'MA', 'Morocco');
INSERT INTO `country` VALUES ('164', 'MU', 'Mauritius');
INSERT INTO `country` VALUES ('165', 'UM', 'Midway Islands');
INSERT INTO `country` VALUES ('166', 'MR', 'Mauritania');
INSERT INTO `country` VALUES ('167', 'MT', 'Malta');
INSERT INTO `country` VALUES ('168', 'OM', 'Oman');
INSERT INTO `country` VALUES ('169', 'MV', 'Maldives');
INSERT INTO `country` VALUES ('170', 'MX', 'Mexico');
INSERT INTO `country` VALUES ('171', 'MY', 'Malaysia');
INSERT INTO `country` VALUES ('172', 'MZ', 'Mozambique');
INSERT INTO `country` VALUES ('173', 'NC', 'New Caledonia');
INSERT INTO `country` VALUES ('174', 'NU', 'Niue');
INSERT INTO `country` VALUES ('175', 'NF', 'Norfolk Island');
INSERT INTO `country` VALUES ('176', 'NE', 'Niger');
INSERT INTO `country` VALUES ('177', 'VU', 'Vanuatu');
INSERT INTO `country` VALUES ('178', 'NG', 'Nigeria');
INSERT INTO `country` VALUES ('179', 'NL', 'Netherlands');
INSERT INTO `country` VALUES ('180', '', 'No Man\'s Land');
INSERT INTO `country` VALUES ('181', 'NO', 'Norway');
INSERT INTO `country` VALUES ('182', 'NP', 'Nepal');
INSERT INTO `country` VALUES ('183', 'NR', 'Nauru');
INSERT INTO `country` VALUES ('184', 'SR', 'Suriname');
INSERT INTO `country` VALUES ('185', 'AN', 'Netherlands Antilles');
INSERT INTO `country` VALUES ('186', 'NI', 'Nicaragua');
INSERT INTO `country` VALUES ('187', 'NZ', 'New Zealand');
INSERT INTO `country` VALUES ('188', 'PY', 'Paraguay');
INSERT INTO `country` VALUES ('189', 'PN', 'Pitcairn Islands');
INSERT INTO `country` VALUES ('190', 'PE', 'Peru');
INSERT INTO `country` VALUES ('191', '-', 'Paracel Islands');
INSERT INTO `country` VALUES ('192', '-', 'Spratly Islands');
INSERT INTO `country` VALUES ('193', 'PK', 'Pakistan');
INSERT INTO `country` VALUES ('194', 'PL', 'Poland');
INSERT INTO `country` VALUES ('195', 'PA', 'Panama');
INSERT INTO `country` VALUES ('196', 'PT', 'Portugal');
INSERT INTO `country` VALUES ('197', 'PG', 'Papua New Guinea');
INSERT INTO `country` VALUES ('198', 'PW', 'Palau');
INSERT INTO `country` VALUES ('199', 'GW', 'Guinea-Bissau');
INSERT INTO `country` VALUES ('200', 'QA', 'Qatar');
INSERT INTO `country` VALUES ('201', 'RE', 'Reunion');
INSERT INTO `country` VALUES ('202', 'RS', 'Serbia');
INSERT INTO `country` VALUES ('203', 'MH', 'Marshall Islands');
INSERT INTO `country` VALUES ('204', 'MF', 'Saint Martin');
INSERT INTO `country` VALUES ('205', 'RO', 'Romania');
INSERT INTO `country` VALUES ('206', 'PH', 'Philippines');
INSERT INTO `country` VALUES ('207', 'PR', 'Puerto Rico');
INSERT INTO `country` VALUES ('208', 'RU', 'Russia');
INSERT INTO `country` VALUES ('209', 'RW', 'Rwanda');
INSERT INTO `country` VALUES ('210', 'SA', 'Saudi Arabia');
INSERT INTO `country` VALUES ('211', 'PM', 'Saint Pierre and Miquelon');
INSERT INTO `country` VALUES ('212', 'KN', 'Saint Kitts and Nevis');
INSERT INTO `country` VALUES ('213', 'SC', 'Seychelles');
INSERT INTO `country` VALUES ('214', 'ZA', 'South Africa');
INSERT INTO `country` VALUES ('215', 'SN', 'Senegal');
INSERT INTO `country` VALUES ('216', 'SH', 'Saint Helena');
INSERT INTO `country` VALUES ('217', 'SI', 'Slovenia');
INSERT INTO `country` VALUES ('218', 'SL', 'Sierra Leone');
INSERT INTO `country` VALUES ('219', 'SM', 'San Marino');
INSERT INTO `country` VALUES ('220', 'SG', 'Singapore');
INSERT INTO `country` VALUES ('221', 'SO', 'Somalia');
INSERT INTO `country` VALUES ('222', 'ES', 'Spain');
INSERT INTO `country` VALUES ('223', 'LC', 'Saint Lucia');
INSERT INTO `country` VALUES ('224', 'SD', 'Sudan');
INSERT INTO `country` VALUES ('225', 'SJ', 'Svalbard');
INSERT INTO `country` VALUES ('226', 'SE', 'Sweden');
INSERT INTO `country` VALUES ('227', 'GS', 'South Georgia and the Islands');
INSERT INTO `country` VALUES ('228', 'SY', 'Syrian Arab Republic');
INSERT INTO `country` VALUES ('229', 'CH', 'Switzerland');
INSERT INTO `country` VALUES ('230', 'TT', 'Trinidad and Tobago');
INSERT INTO `country` VALUES ('231', '-', 'Tromelin Island');
INSERT INTO `country` VALUES ('232', 'TH', 'Thailand');
INSERT INTO `country` VALUES ('233', 'TJ', 'Tajikistan');
INSERT INTO `country` VALUES ('234', 'TC', 'Turks and Caicos Islands');
INSERT INTO `country` VALUES ('235', 'TK', 'Tokelau');
INSERT INTO `country` VALUES ('236', 'TO', 'Tonga');
INSERT INTO `country` VALUES ('237', 'TG', 'Togo');
INSERT INTO `country` VALUES ('238', 'ST', 'Sao Tome and Principe');
INSERT INTO `country` VALUES ('239', 'TN', 'Tunisia');
INSERT INTO `country` VALUES ('240', 'TL', 'East Timor');
INSERT INTO `country` VALUES ('241', 'TR', 'Turkey');
INSERT INTO `country` VALUES ('242', 'TV', 'Tuvalu');
INSERT INTO `country` VALUES ('243', 'TW', 'Taiwan');
INSERT INTO `country` VALUES ('244', 'TM', 'Turkmenistan');
INSERT INTO `country` VALUES ('245', 'TZ', 'Tanzania, United Republic of');
INSERT INTO `country` VALUES ('246', 'UG', 'Uganda');
INSERT INTO `country` VALUES ('247', 'GB', 'United Kingdom');
INSERT INTO `country` VALUES ('248', 'UA', 'Ukraine');
INSERT INTO `country` VALUES ('249', 'US', 'United States');
INSERT INTO `country` VALUES ('250', 'BF', 'Burkina Faso');
INSERT INTO `country` VALUES ('251', 'UY', 'Uruguay');
INSERT INTO `country` VALUES ('252', 'UZ', 'Uzbekistan');
INSERT INTO `country` VALUES ('253', 'VC', 'Saint Vincent and the Grenadines');
INSERT INTO `country` VALUES ('254', 'VE', 'Venezuela');
INSERT INTO `country` VALUES ('255', 'VG', 'British Virgin Islands');
INSERT INTO `country` VALUES ('256', 'VN', 'Vietnam');
INSERT INTO `country` VALUES ('257', 'VI', 'Virgin Islands (US)');
INSERT INTO `country` VALUES ('258', 'VA', 'Holy See (Vatican City)');
INSERT INTO `country` VALUES ('259', 'NA', 'Namibia');
INSERT INTO `country` VALUES ('260', '-', 'West Bank');
INSERT INTO `country` VALUES ('261', 'WF', 'Wallis and Futuna');
INSERT INTO `country` VALUES ('262', 'EH', 'Western Sahara');
INSERT INTO `country` VALUES ('263', 'UM', 'Wake Island');
INSERT INTO `country` VALUES ('264', 'WS', 'Samoa');
INSERT INTO `country` VALUES ('265', 'SZ', 'Swaziland');
INSERT INTO `country` VALUES ('266', 'CS', 'Serbia and Montenegro');
INSERT INTO `country` VALUES ('267', 'YE', 'Yemen');
INSERT INTO `country` VALUES ('268', 'ZM', 'Zambia');
INSERT INTO `country` VALUES ('269', 'ZW', 'Zimbabwe');

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
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
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
  `issue_status` int(11) NOT NULL,
  `issue_type` int(11) DEFAULT NULL,
  `issue_link` int(11) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `due_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `description` text,
  `priority_id` int(11) DEFAULT NULL,
  `label` int(11) DEFAULT NULL,
  `original_estimate` int(11) DEFAULT NULL,
  `remaining_estimate` int(11) DEFAULT NULL,
  `resolution_id` smallint(3) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of issue
-- ----------------------------
INSERT INTO `issue` VALUES ('1', '1', '1', '1', 'Yes', '1', '1', '1', '1', '2018-11-07 22:20:12', '1', '1', '1', '1', '1', '1', '1', '2018-11-07 22:20:12', '2018-11-07 22:20:12');
INSERT INTO `issue` VALUES ('2', '1', '1', '1', 'No', '2', '1', '1', '1', '2018-11-07 22:20:08', '1', '1', '1', '1', '1', '1', '1', '2018-11-07 22:20:08', '2018-11-07 22:20:08');

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
  `proj_id` int(11) DEFAULT NULL,
  `icon_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of issuestatus
-- ----------------------------
INSERT INTO `issuestatus` VALUES ('1', '1', 'Khởi tạo', '', null, '/images/icons/statuses/open.png');
INSERT INTO `issuestatus` VALUES ('2', '2', 'Thực thi', null, null, '/images/icons/status_generic.gif');
INSERT INTO `issuestatus` VALUES ('3', '3', 'Kiểm tra', null, null, '/images/icons/status_generic.gif');
INSERT INTO `issuestatus` VALUES ('4', '4', 'Hoàn thành', '', null, '/images/icons/statuses/inprogress.png');
INSERT INTO `issuestatus` VALUES ('5', '5', 'Reopened', '', '0', '/images/icons/statuses/reopened.png');
INSERT INTO `issuestatus` VALUES ('6', '6', 'Resolved', '', '0', '/images/icons/statuses/resolved.png');
INSERT INTO `issuestatus` VALUES ('7', '7', 'Closed', '', '0', '/images/icons/statuses/closed.png');

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
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
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
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO `project` VALUES ('1', 'ABC', 'ABC1', '1', '2018-11-07 22:53:50', '2018-11-07 22:53:53');

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
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` smallint(2) DEFAULT '1',
  `nation` smallint(3) NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Duy Vuong Dao', 'quan@quan.com', '$2y$10$e8IQiqFtWmbBP5R8vN0YGu225Ud9U5qoGlA91WCu//pJ/S/xws/iW', '1', '0', 'admin', 'BLm17SbX8k793PONbv18cLaC1x42ndEmLGN5h3BvfT62GL6wQ1Y3kD6lpTYY', '2018-11-01 07:38:53', '2018-11-01 07:38:53');
INSERT INTO `users` VALUES ('2', 'Duy Vuong Dao', 'duyvuongdao2@gmail.com', '$2y$10$QXpRqxWVskzVMCnN52E2euf3opeC22fSsbS8ZjfYJnohqTV.RRd9.', '1', '256', '', '63e7NaQL9Kx2qrsjz8OL6UbRIeURXD5t3705K19vFLeqZuBjfsBqs9Xy7iux', '2018-11-01 09:40:45', '2018-11-01 09:40:45');
