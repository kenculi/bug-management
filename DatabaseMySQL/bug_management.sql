-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th10 14, 2018 lúc 06:57 PM
-- Phiên bản máy phục vụ: 10.3.9-MariaDB
-- Phiên bản PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bug_management`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `activities_log`
--

DROP TABLE IF EXISTS `activities_log`;
CREATE TABLE IF NOT EXISTS `activities_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL COMMENT '1: project; 2: issue',
  `field` tinyint(2) NOT NULL COMMENT '1: summary; 2: desc; 3: status; 4: assignee; 5: label; 6: priority; 7: attachment; 8: clone issue; 9: delete issue',
  `issue_id` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `activities_log`
--

INSERT INTO `activities_log` (`id`, `type`, `field`, `issue_id`, `project_id`, `user_id`, `note`, `created_at`) VALUES
(1, 2, 1, 1, 1, 2, 'A -> B', '2018-11-13 18:07:38'),
(2, 2, 2, 1, 1, 2, 'vượng đang học -> vượng đang học n&egrave;', '2018-11-14 16:46:27'),
(3, 2, 3, 1, 1, 2, 'Kiểm tra -> Hoàn thành', '2018-11-14 16:46:38'),
(4, 2, 4, 1, 1, 2, 'Duy Vuong Dao -> Vượng Duy', '2018-11-14 16:46:42'),
(5, 2, 6, 1, 1, 2, 'Highest -> High', '2018-11-14 16:46:56'),
(6, 2, 5, 1, 1, 2, 'ha -> ha,kaka,hihi', '2018-11-14 16:47:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `proj_id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `proj_id`, `issue_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'thử', '2018-11-12 18:14:26', '2018-11-12 18:14:26'),
(2, 2, 1, 1, 'kh&ocirc;ng', '2018-11-12 18:16:01', '2018-11-12 18:16:01'),
(3, 2, 1, 1, 'h&uacute;', '2018-11-12 18:16:30', '2018-11-12 18:16:30'),
(4, 2, 1, 1, 'h&uacute; e', '2018-11-12 18:17:28', '2018-11-12 18:17:28'),
(5, 2, 1, 1, 'n&egrave; pa', '2018-11-12 18:17:56', '2018-11-12 18:17:56'),
(6, 2, 1, 1, 'hử', '2018-11-12 18:19:15', '2018-11-12 18:19:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `cc_iso` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `country_name` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_cc_iso` (`cc_iso`)
) ENGINE=MyISAM AUTO_INCREMENT=270 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Đang đổ dữ liệu cho bảng `country`
--

INSERT INTO `country` (`id`, `cc_iso`, `country_name`) VALUES
(1, 'AW', 'Aruba'),
(2, 'AG', 'Antigua and Barbuda'),
(3, 'AE', 'United Arab Emirates'),
(4, 'AF', 'Afghanistan'),
(5, 'DZ', 'Algeria'),
(6, 'AZ', 'Azerbaijan'),
(7, 'AL', 'Albania'),
(8, 'AM', 'Armenia'),
(9, 'AD', 'Andorra'),
(10, 'AO', 'Angola'),
(11, 'AS', 'American Samoa'),
(12, 'AR', 'Argentina'),
(13, 'AU', 'Australia'),
(14, '-', 'Ashmore and Cartier Islands'),
(15, 'AT', 'Austria'),
(16, 'AI', 'Anguilla'),
(17, 'AX', 'Åland Islands'),
(18, 'AQ', 'Antarctica'),
(19, 'BH', 'Bahrain'),
(20, 'BB', 'Barbados'),
(21, 'BW', 'Botswana'),
(22, 'BM', 'Bermuda'),
(23, 'BE', 'Belgium'),
(24, 'BS', 'Bahamas, The'),
(25, 'BD', 'Bangladesh'),
(26, 'BZ', 'Belize'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BO', 'Bolivia'),
(29, 'MM', 'Myanmar'),
(30, 'BJ', 'Benin'),
(31, 'BY', 'Belarus'),
(32, 'SB', 'Solomon Islands'),
(33, '-', 'Navassa Island'),
(34, 'BR', 'Brazil'),
(35, '-', 'Bassas da India'),
(36, 'BT', 'Bhutan'),
(37, 'BG', 'Bulgaria'),
(38, 'BV', 'Bouvet Island'),
(39, 'BN', 'Brunei'),
(40, 'BI', 'Burundi'),
(41, 'CA', 'Canada'),
(42, 'KH', 'Cambodia'),
(43, 'TD', 'Chad'),
(44, 'LK', 'Sri Lanka'),
(45, 'CG', 'Congo, Republic of the'),
(46, 'CD', 'Congo, Democratic Republic of the'),
(47, 'CN', 'China'),
(48, 'CL', 'Chile'),
(49, 'KY', 'Cayman Islands'),
(50, 'CC', 'Cocos (Keeling) Islands'),
(51, 'CM', 'Cameroon'),
(52, 'KM', 'Comoros'),
(53, 'CO', 'Colombia'),
(54, 'MP', 'Northern Mariana Islands'),
(55, '-', 'Coral Sea Islands'),
(56, 'CR', 'Costa Rica'),
(57, 'CF', 'Central African Republic'),
(58, 'CU', 'Cuba'),
(59, 'CV', 'Cape Verde'),
(60, 'CK', 'Cook Islands'),
(61, 'CY', 'Cyprus'),
(62, 'DK', 'Denmark'),
(63, 'DJ', 'Djibouti'),
(64, 'DM', 'Dominica'),
(65, 'UM', 'Jarvis Island'),
(66, 'DO', 'Dominican Republic'),
(67, '-', 'Dhekelia Sovereign Base Area'),
(68, 'EC', 'Ecuador'),
(69, 'EG', 'Egypt'),
(70, 'IE', 'Ireland'),
(71, 'GQ', 'Equatorial Guinea'),
(72, 'EE', 'Estonia'),
(73, 'ER', 'Eritrea'),
(74, 'SV', 'El Salvador'),
(75, 'ET', 'Ethiopia'),
(76, '-', 'Europa Island'),
(77, 'CZ', 'Czech Republic'),
(78, 'GF', 'French Guiana'),
(79, 'FI', 'Finland'),
(80, 'FJ', 'Fiji'),
(81, 'FK', 'Falkland Islands (Islas Malvinas)'),
(82, 'FM', 'Micronesia, Federated States of'),
(83, 'FO', 'Faroe Islands'),
(84, 'PF', 'French Polynesia'),
(85, 'UM', 'Baker Island'),
(86, 'FR', 'France'),
(87, 'TF', 'French Southern and Antarctic Lands'),
(88, 'GM', 'Gambia, The'),
(89, 'GA', 'Gabon'),
(90, 'GE', 'Georgia'),
(91, 'GH', 'Ghana'),
(92, 'GI', 'Gibraltar'),
(93, 'GD', 'Grenada'),
(94, '-', 'Guernsey'),
(95, 'GL', 'Greenland'),
(96, 'DE', 'Germany'),
(97, '-', 'Glorioso Islands'),
(98, 'GP', 'Guadeloupe'),
(99, 'GU', 'Guam'),
(100, 'GR', 'Greece'),
(101, 'GT', 'Guatemala'),
(102, 'GN', 'Guinea'),
(103, 'GY', 'Guyana'),
(104, '-', 'Gaza Strip'),
(105, 'HT', 'Haiti'),
(106, 'HK', 'Hong Kong'),
(107, 'HM', 'Heard Island and McDonald Islands'),
(108, 'HN', 'Honduras'),
(109, 'UM', 'Howland Island'),
(110, 'HR', 'Croatia'),
(111, 'HU', 'Hungary'),
(112, 'IS', 'Iceland'),
(113, 'ID', 'Indonesia'),
(114, 'IM', 'Isle of Man'),
(115, 'IN', 'India'),
(116, 'IO', 'British Indian Ocean Territory'),
(117, '-', 'Clipperton Island'),
(118, 'IR', 'Iran'),
(119, 'IL', 'Israel'),
(120, 'IT', 'Italy'),
(121, 'CI', 'Cote d\'Ivoire'),
(122, 'IQ', 'Iraq'),
(123, 'JP', 'Japan'),
(124, 'JE', 'Jersey'),
(125, 'JM', 'Jamaica'),
(126, 'SJ', 'Jan Mayen'),
(127, 'JO', 'Jordan'),
(128, 'UM', 'Johnston Atoll'),
(129, '-', 'Juan de Nova Island'),
(130, 'KE', 'Kenya'),
(131, 'KG', 'Kyrgyzstan'),
(132, 'KP', 'Korea, North'),
(133, 'UM', 'Kingman Reef'),
(134, 'KI', 'Kiribati'),
(135, 'KR', 'Korea, South'),
(136, 'CX', 'Christmas Island'),
(137, 'KW', 'Kuwait'),
(138, 'KV', 'Kosovo'),
(139, 'KZ', 'Kazakhstan'),
(140, 'LA', 'Laos'),
(141, 'LB', 'Lebanon'),
(142, 'LV', 'Latvia'),
(143, 'LT', 'Lithuania'),
(144, 'LR', 'Liberia'),
(145, 'SK', 'Slovakia'),
(146, 'UM', 'Palmyra Atoll'),
(147, 'LI', 'Liechtenstein'),
(148, 'LS', 'Lesotho'),
(149, 'LU', 'Luxembourg'),
(150, 'LY', 'Libyan Arab'),
(151, 'MG', 'Madagascar'),
(152, 'MQ', 'Martinique'),
(153, 'MO', 'Macau'),
(154, 'MD', 'Moldova, Republic of'),
(155, 'YT', 'Mayotte'),
(156, 'MN', 'Mongolia'),
(157, 'MS', 'Montserrat'),
(158, 'MW', 'Malawi'),
(159, 'ME', 'Montenegro'),
(160, 'MK', 'The Former Yugoslav Republic of Macedonia'),
(161, 'ML', 'Mali'),
(162, 'MC', 'Monaco'),
(163, 'MA', 'Morocco'),
(164, 'MU', 'Mauritius'),
(165, 'UM', 'Midway Islands'),
(166, 'MR', 'Mauritania'),
(167, 'MT', 'Malta'),
(168, 'OM', 'Oman'),
(169, 'MV', 'Maldives'),
(170, 'MX', 'Mexico'),
(171, 'MY', 'Malaysia'),
(172, 'MZ', 'Mozambique'),
(173, 'NC', 'New Caledonia'),
(174, 'NU', 'Niue'),
(175, 'NF', 'Norfolk Island'),
(176, 'NE', 'Niger'),
(177, 'VU', 'Vanuatu'),
(178, 'NG', 'Nigeria'),
(179, 'NL', 'Netherlands'),
(180, '', 'No Man\'s Land'),
(181, 'NO', 'Norway'),
(182, 'NP', 'Nepal'),
(183, 'NR', 'Nauru'),
(184, 'SR', 'Suriname'),
(185, 'AN', 'Netherlands Antilles'),
(186, 'NI', 'Nicaragua'),
(187, 'NZ', 'New Zealand'),
(188, 'PY', 'Paraguay'),
(189, 'PN', 'Pitcairn Islands'),
(190, 'PE', 'Peru'),
(191, '-', 'Paracel Islands'),
(192, '-', 'Spratly Islands'),
(193, 'PK', 'Pakistan'),
(194, 'PL', 'Poland'),
(195, 'PA', 'Panama'),
(196, 'PT', 'Portugal'),
(197, 'PG', 'Papua New Guinea'),
(198, 'PW', 'Palau'),
(199, 'GW', 'Guinea-Bissau'),
(200, 'QA', 'Qatar'),
(201, 'RE', 'Reunion'),
(202, 'RS', 'Serbia'),
(203, 'MH', 'Marshall Islands'),
(204, 'MF', 'Saint Martin'),
(205, 'RO', 'Romania'),
(206, 'PH', 'Philippines'),
(207, 'PR', 'Puerto Rico'),
(208, 'RU', 'Russia'),
(209, 'RW', 'Rwanda'),
(210, 'SA', 'Saudi Arabia'),
(211, 'PM', 'Saint Pierre and Miquelon'),
(212, 'KN', 'Saint Kitts and Nevis'),
(213, 'SC', 'Seychelles'),
(214, 'ZA', 'South Africa'),
(215, 'SN', 'Senegal'),
(216, 'SH', 'Saint Helena'),
(217, 'SI', 'Slovenia'),
(218, 'SL', 'Sierra Leone'),
(219, 'SM', 'San Marino'),
(220, 'SG', 'Singapore'),
(221, 'SO', 'Somalia'),
(222, 'ES', 'Spain'),
(223, 'LC', 'Saint Lucia'),
(224, 'SD', 'Sudan'),
(225, 'SJ', 'Svalbard'),
(226, 'SE', 'Sweden'),
(227, 'GS', 'South Georgia and the Islands'),
(228, 'SY', 'Syrian Arab Republic'),
(229, 'CH', 'Switzerland'),
(230, 'TT', 'Trinidad and Tobago'),
(231, '-', 'Tromelin Island'),
(232, 'TH', 'Thailand'),
(233, 'TJ', 'Tajikistan'),
(234, 'TC', 'Turks and Caicos Islands'),
(235, 'TK', 'Tokelau'),
(236, 'TO', 'Tonga'),
(237, 'TG', 'Togo'),
(238, 'ST', 'Sao Tome and Principe'),
(239, 'TN', 'Tunisia'),
(240, 'TL', 'East Timor'),
(241, 'TR', 'Turkey'),
(242, 'TV', 'Tuvalu'),
(243, 'TW', 'Taiwan'),
(244, 'TM', 'Turkmenistan'),
(245, 'TZ', 'Tanzania, United Republic of'),
(246, 'UG', 'Uganda'),
(247, 'GB', 'United Kingdom'),
(248, 'UA', 'Ukraine'),
(249, 'US', 'United States'),
(250, 'BF', 'Burkina Faso'),
(251, 'UY', 'Uruguay'),
(252, 'UZ', 'Uzbekistan'),
(253, 'VC', 'Saint Vincent and the Grenadines'),
(254, 'VE', 'Venezuela'),
(255, 'VG', 'British Virgin Islands'),
(256, 'VN', 'Vietnam'),
(257, 'VI', 'Virgin Islands (US)'),
(258, 'VA', 'Holy See (Vatican City)'),
(259, 'NA', 'Namibia'),
(260, '-', 'West Bank'),
(261, 'WF', 'Wallis and Futuna'),
(262, 'EH', 'Western Sahara'),
(263, 'UM', 'Wake Island'),
(264, 'WS', 'Samoa'),
(265, 'SZ', 'Swaziland'),
(266, 'CS', 'Serbia and Montenegro'),
(267, 'YE', 'Yemen'),
(268, 'ZM', 'Zambia'),
(269, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invite`
--

DROP TABLE IF EXISTS `invite`;
CREATE TABLE IF NOT EXISTS `invite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proj_id` int(11) NOT NULL,
  `user_send_id` int(11) NOT NULL,
  `user_receive_id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1 COMMENT '1:Đã mời        2:Đã chấp nhận      3:Từ chối',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `invite`
--

INSERT INTO `invite` (`id`, `proj_id`, `user_send_id`, `user_receive_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 1, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `issue`
--

DROP TABLE IF EXISTS `issue`;
CREATE TABLE IF NOT EXISTS `issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proj_id` int(11) NOT NULL,
  `reporter` int(11) NOT NULL,
  `assignee` int(11) DEFAULT NULL,
  `summary` varchar(255) NOT NULL,
  `issue_status` int(11) NOT NULL,
  `issue_type` int(11) DEFAULT NULL,
  `issue_link` int(11) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `due_date` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  `priority_id` int(11) DEFAULT NULL,
  `label` varchar(200) DEFAULT NULL,
  `original_estimate` int(11) DEFAULT NULL,
  `remaining_estimate` int(11) DEFAULT NULL,
  `resolution_id` smallint(3) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `issue`
--

INSERT INTO `issue` (`id`, `proj_id`, `reporter`, `assignee`, `summary`, `issue_status`, `issue_type`, `issue_link`, `attachment`, `due_date`, `description`, `priority_id`, `label`, `original_estimate`, `remaining_estimate`, `resolution_id`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'Yes', 4, 1, 1, '1', '2018-11-13 14:15:32', 'vượng đang học n&egrave;', 2, '1,2,3', 1, 1, 1, 1, '2018-11-13 14:05:40', '2018-11-14 16:47:03'),
(2, 1, 1, 1, 'No', 2, 1, 1, '1', '2018-11-10 16:35:13', '1', 1, '1', 1, 1, 1, 1, '2018-11-09 13:07:56', '2018-11-14 17:17:02'),
(3, 1, 2, NULL, 'vượng', 1, NULL, 4, NULL, '2018-11-13 15:46:18', 'vượng đang l&agrave;m', 2, '1,2,3', NULL, NULL, NULL, NULL, '2018-11-12 17:23:18', '2018-11-14 16:53:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `issuelink`
--

DROP TABLE IF EXISTS `issuelink`;
CREATE TABLE IF NOT EXISTS `issuelink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_type_id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `issuelink`
--

INSERT INTO `issuelink` (`id`, `link_type_id`, `issue_id`) VALUES
(1, 2, 1),
(2, 2, 1),
(3, 2, 1),
(4, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `issuelinktype`
--

DROP TABLE IF EXISTS `issuelinktype`;
CREATE TABLE IF NOT EXISTS `issuelinktype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(255) NOT NULL,
  `inward` varchar(255) DEFAULT NULL,
  `outward` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `issuelinktype`
--

INSERT INTO `issuelinktype` (`id`, `link_name`, `inward`, `outward`) VALUES
(1, 'Blocks', 'is blocked by', 'blocks'),
(2, 'Cloners', 'is cloned by', 'clones'),
(4, 'Relates', 'relates to', 'relates to'),
(5, 'jira_subtask_link', 'jira_subtask_inward', 'jira_subtask_outward'),
(6, 'Epic-Story Link', 'has Epic', 'is Epic of');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `issuestatus`
--

DROP TABLE IF EXISTS `issuestatus`;
CREATE TABLE IF NOT EXISTS `issuestatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sequence` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `proj_id` int(11) DEFAULT NULL,
  `icon_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `issuestatus`
--

INSERT INTO `issuestatus` (`id`, `sequence`, `name`, `description`, `proj_id`, `icon_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Khởi tạo', '', 1, '/images/icons/statuses/open.png', '2018-11-14 18:08:07', '2018-11-14 18:08:07'),
(2, 2, 'Thực thi', NULL, 1, '/images/icons/status_generic.gif', '2018-11-14 18:08:07', '2018-11-14 18:08:07'),
(3, 3, 'Kiểm tra', NULL, 1, '/images/icons/status_generic.gif', '2018-11-14 18:08:07', '2018-11-14 18:08:07'),
(4, 4, 'Hoàn thành', '', 1, '/images/icons/statuses/inprogress.png', '2018-11-14 18:08:07', '2018-11-14 18:08:07'),
(5, 5, 'Reopened', '', 0, '/images/icons/statuses/reopened.png', '2018-11-14 18:08:07', '2018-11-14 18:08:07'),
(6, 6, 'Resolved', '', 0, '/images/icons/statuses/resolved.png', '2018-11-14 18:08:07', '2018-11-14 18:08:07'),
(7, 7, 'Closed', '', 0, '/images/icons/statuses/closed.png', '2018-11-14 18:08:07', '2018-11-14 18:08:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `issuetype`
--

DROP TABLE IF EXISTS `issuetype`;
CREATE TABLE IF NOT EXISTS `issuetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `issuetype`
--

INSERT INTO `issuetype` (`id`, `name`, `description`, `icon_url`) VALUES
(1, 'Epic', NULL, '/images/icons/issuetypes/epic.svg'),
(2, 'Story', NULL, '/images/icons/issuetypes/story.svg'),
(3, 'Task', 'A task that needs to be done.', NULL),
(4, 'Sub-task', 'The sub-task of the issue', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `label`
--

DROP TABLE IF EXISTS `label`;
CREATE TABLE IF NOT EXISTS `label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proj_id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `label`
--

INSERT INTO `label` (`id`, `proj_id`, `label`) VALUES
(1, 1, 'ha'),
(2, 1, 'kaka'),
(3, 1, 'hihi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `priority`
--

DROP TABLE IF EXISTS `priority`;
CREATE TABLE IF NOT EXISTS `priority` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sequence` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon_url` varchar(255) DEFAULT NULL,
  `status_color` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `priority`
--

INSERT INTO `priority` (`id`, `sequence`, `name`, `description`, `icon_url`, `status_color`) VALUES
(1, 1, 'Highest', 'This problem will block progress.', '/images/icons/priorities/highest.png', '#d04437'),
(2, 2, 'High', 'Serious problem that could block progress.', '/images/icons/priorities/high.png', '#f15C75'),
(3, 3, 'Medium', 'Has the potential to affect progress.', '/images/icons/priorities/medium.png', '#f79232'),
(4, 4, 'Low', 'Minor problem or easily worked around.', '/images/icons/priorities/low.png', '#707070'),
(5, 5, 'Lowest', 'Trivial problem with little or no impact on progress.', '/images/icons/priorities/lowest.png', '#999999');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `p_key` varchar(50) DEFAULT NULL,
  `lead_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `project`
--

INSERT INTO `project` (`id`, `name`, `p_key`, `lead_id`, `created_at`, `updated_at`) VALUES
(1, 'ABC DEF', 'ABC1', 1, '2018-11-11 15:56:00', '2018-11-11 15:56:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `resolution`
--

DROP TABLE IF EXISTS `resolution`;
CREATE TABLE IF NOT EXISTS `resolution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sequence` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `resolution`
--

INSERT INTO `resolution` (`id`, `sequence`, `name`, `description`, `icon_url`) VALUES
(1, 1, 'Done', 'Work has been completed on this issue.', NULL),
(2, 2, 'Won\'t Do', 'This issue won\'t be actioned.', NULL),
(3, 3, 'Duplicate', 'The problem is a duplicate of an existing issue.', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` smallint(2) DEFAULT 1,
  `nation` smallint(3) NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `type`, `nation`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Duy Vuong Dao', 'quan@quan.com', '$2y$10$e8IQiqFtWmbBP5R8vN0YGu225Ud9U5qoGlA91WCu//pJ/S/xws/iW', 1, 0, 'admin', 'BLm17SbX8k793PONbv18cLaC1x42ndEmLGN5h3BvfT62GL6wQ1Y3kD6lpTYY', '2018-11-01 00:38:53', '2018-11-01 00:38:53'),
(2, 'Vượng Duy', 'duyvuongdao2@gmail.com', '$2y$10$QXpRqxWVskzVMCnN52E2euf3opeC22fSsbS8ZjfYJnohqTV.RRd9.', 1, 256, '', '63e7NaQL9Kx2qrsjz8OL6UbRIeURXD5t3705K19vFLeqZuBjfsBqs9Xy7iux', '2018-11-01 02:40:45', '2018-11-01 02:40:45');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
