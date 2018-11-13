-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 08, 2018 at 04:11 PM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 5.5.38-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bug_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `proj_id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` smallint(3) NOT NULL,
  `cc_iso` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `country_name` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `country`
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
-- Table structure for table `invite`
--

CREATE TABLE `invite` (
  `id` int(11) NOT NULL,
  `proj_id` int(11) NOT NULL,
  `user_send_id` int(11) NOT NULL,
  `user_receive_id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1:Đã mời        2:Đã chấp nhận      3:Từ chối',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invite`
--

INSERT INTO `invite` (`id`, `proj_id`, `user_send_id`, `user_receive_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 1, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `id` int(11) NOT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`id`, `proj_id`, `reporter`, `assignee`, `summary`, `issue_status`, `issue_type`, `issue_link`, `attachment`, `due_date`, `description`, `priority_id`, `label`, `original_estimate`, `remaining_estimate`, `resolution_id`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Yes', 1, 1, 1, '1', '2018-11-07 15:20:12', '1', 1, 1, 1, 1, 1, 1, '2018-11-07 15:20:12', '2018-11-07 15:20:12'),
(2, 1, 1, 1, 'No', 2, 1, 1, '1', '2018-11-07 15:20:08', '1', 1, 1, 1, 1, 1, 1, '2018-11-07 15:20:08', '2018-11-07 15:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `issuelink`
--

CREATE TABLE `issuelink` (
  `id` int(11) NOT NULL,
  `link_type_id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `issuelinktype`
--

CREATE TABLE `issuelinktype` (
  `id` int(11) NOT NULL,
  `link_name` varchar(255) NOT NULL,
  `inward` varchar(255) DEFAULT NULL,
  `outward` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `issuelinktype`
--

INSERT INTO `issuelinktype` (`id`, `link_name`, `inward`, `outward`) VALUES
(1, 'Blocks', 'is blocked by', 'blocks'),
(2, 'Cloners', 'is cloned by', 'clones'),
(4, 'Relates', 'relates to', 'relates to'),
(5, 'jira_subtask_link', 'jira_subtask_inward', 'jira_subtask_outward'),
(6, 'Epic-Story Link', 'has Epic', 'is Epic of');

-- --------------------------------------------------------

--
-- Table structure for table `issuestatus`
--

CREATE TABLE `issuestatus` (
  `id` int(11) NOT NULL,
  `sequence` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `proj_id` int(11) DEFAULT NULL,
  `icon_url` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `issuestatus`
--

INSERT INTO `issuestatus` (`id`, `sequence`, `name`, `description`, `proj_id`, `icon_url`) VALUES
(1, 1, 'Khởi tạo', '', 1, '/images/icons/statuses/open.png'),
(2, 2, 'Thực thi', NULL, 1, '/images/icons/status_generic.gif'),
(3, 3, 'Kiểm tra', NULL, 1, '/images/icons/status_generic.gif'),
(4, 4, 'Hoàn thành', '', 1
  , '/images/icons/statuses/inprogress.png'),
(5, 5, 'Reopened', '', 0, '/images/icons/statuses/reopened.png'),
(6, 6, 'Resolved', '', 0, '/images/icons/statuses/resolved.png'),
(7, 7, 'Closed', '', 0, '/images/icons/statuses/closed.png');

-- --------------------------------------------------------

--
-- Table structure for table `issuetype`
--

CREATE TABLE `issuetype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `icon_url` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `issuetype`
--

INSERT INTO `issuetype` (`id`, `name`, `description`, `icon_url`) VALUES
(1, 'Epic', NULL, '/images/icons/issuetypes/epic.svg'),
(2, 'Story', NULL, '/images/icons/issuetypes/story.svg'),
(3, 'Task', 'A task that needs to be done.', NULL),
(4, 'Sub-task', 'The sub-task of the issue', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `label`
--

CREATE TABLE `label` (
  `id` int(11) NOT NULL,
  `proj_id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE `priority` (
  `id` int(11) NOT NULL,
  `sequence` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `icon_url` varchar(255) DEFAULT NULL,
  `status_color` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`id`, `sequence`, `name`, `description`, `icon_url`, `status_color`) VALUES
(1, 1, 'Highest', 'This problem will block progress.', '/images/icons/priorities/highest.png', '#d04437'),
(2, 2, 'High', 'Serious problem that could block progress.', '/images/icons/priorities/high.png', '#f15C75'),
(3, 3, 'Medium', 'Has the potential to affect progress.', '/images/icons/priorities/medium.png', '#f79232'),
(4, 4, 'Low', 'Minor problem or easily worked around.', '/images/icons/priorities/low.png', '#707070'),
(5, 5, 'Lowest', 'Trivial problem with little or no impact on progress.', '/images/icons/priorities/lowest.png', '#999999');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `p_key` varchar(50) DEFAULT NULL,
  `lead_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `p_key`, `lead_id`, `created_at`, `updated_at`) VALUES
(1, 'ABC', 'ABC1', 1, '2018-11-07 15:53:50', '2018-11-07 15:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `resolution`
--

CREATE TABLE `resolution` (
  `id` int(11) NOT NULL,
  `sequence` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `icon_url` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resolution`
--

INSERT INTO `resolution` (`id`, `sequence`, `name`, `description`, `icon_url`) VALUES
(1, 1, 'Done', 'Work has been completed on this issue.', NULL),
(2, 2, 'Won\'t Do', 'This issue won\'t be actioned.', NULL),
(3, 3, 'Duplicate', 'The problem is a duplicate of an existing issue.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` smallint(2) DEFAULT '1',
  `nation` smallint(3) NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `type`, `nation`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Duy Vuong Dao', 'quan@quan.com', '$2y$10$e8IQiqFtWmbBP5R8vN0YGu225Ud9U5qoGlA91WCu//pJ/S/xws/iW', 1, 0, 'admin', 'BLm17SbX8k793PONbv18cLaC1x42ndEmLGN5h3BvfT62GL6wQ1Y3kD6lpTYY', '2018-11-01 00:38:53', '2018-11-01 00:38:53'),
(2, 'Vượng Duy', 'duyvuongdao2@gmail.com', '$2y$10$QXpRqxWVskzVMCnN52E2euf3opeC22fSsbS8ZjfYJnohqTV.RRd9.', 1, 256, '', '63e7NaQL9Kx2qrsjz8OL6UbRIeURXD5t3705K19vFLeqZuBjfsBqs9Xy7iux', '2018-11-01 02:40:45', '2018-11-01 02:40:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_cc_iso` (`cc_iso`);

--
-- Indexes for table `invite`
--
ALTER TABLE `invite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuelink`
--
ALTER TABLE `issuelink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuelinktype`
--
ALTER TABLE `issuelinktype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuestatus`
--
ALTER TABLE `issuestatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuetype`
--
ALTER TABLE `issuetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `label`
--
ALTER TABLE `label`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resolution`
--
ALTER TABLE `resolution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;
--
-- AUTO_INCREMENT for table `invite`
--
ALTER TABLE `invite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `issuelink`
--
ALTER TABLE `issuelink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `issuelinktype`
--
ALTER TABLE `issuelinktype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `issuestatus`
--
ALTER TABLE `issuestatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `issuetype`
--
ALTER TABLE `issuetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `label`
--
ALTER TABLE `label`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `priority`
--
ALTER TABLE `priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `resolution`
--
ALTER TABLE `resolution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
