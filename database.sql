-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2021 at 03:30 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodlab`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@site.com', 'admin', NULL, '5ff1c3531ed3f1609679699.jpg', '$2y$10$2qcOUKrDIUqyyCklvHp7IO8fGNcJ1gAXtxouTn1isZPHu6H8CfHPq', NULL, '2021-05-07 07:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `click` int(11) NOT NULL DEFAULT 0,
  `impression` int(11) NOT NULL DEFAULT 0,
  `type` tinyint(1) DEFAULT 0 COMMENT 'Banner : 1, Script : 2',
  `size` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT 'Enable : 1, Disable : 2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bloods`
--

CREATE TABLE `bloods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT 'Enable : 1 Disable : 0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT 'Enable : 1, Disable : 0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `featured` tinyint(1) DEFAULT 0,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `religion` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_donate` int(11) NOT NULL DEFAULT 0,
  `gender` tinyint(4) DEFAULT 0 COMMENT 'Male : 1, Female : 2',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Pending : 0, Approved : 1, Banned : 2',
  `birth_date` date DEFAULT NULL,
  `last_donate` date DEFAULT NULL,
  `socialMedia` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_sms_templates`
--

CREATE TABLE `email_sms_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subj` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcodes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_status` tinyint(1) NOT NULL DEFAULT 1,
  `sms_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_sms_templates`
--

INSERT INTO `email_sms_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(16, 'ADMIN_SUPPORT_REPLY', 'Support Ticket Reply ', 'Reply Support Ticket', '<div><p><span style=\"font-size: 11pt;\" data-mce-style=\"font-size: 11pt;\"><strong>A member from our support team has replied to the following ticket:</strong></span></p><p><b><span style=\"font-size: 11pt;\" data-mce-style=\"font-size: 11pt;\"><strong><br></strong></span></b></p><p><b>[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</b></p><p>----------------------------------------------</p><p>Here is the reply : <br></p><p> {{reply}}<br></p></div><div><br></div>', '{{subject}}\r\n\r\n{{reply}}\r\n\r\n\r\nClick here to reply:  {{link}}', '{\"ticket_id\":\"Support Ticket ID\", \"ticket_subject\":\"Subject Of Support Ticket\", \"reply\":\"Reply from Staff/Admin\",\"link\":\"Ticket URL For relpy\"}', 1, 1, '2020-06-08 18:00:00', '2020-05-04 02:24:40'),
(217, 'DONOR_CONTACT', 'Contact Donor', 'Contact Donor', '<p><br></p>', '{{name}} {{email}} {{message}}', '{\"name\" : \"Visitor Name\",\"email\": \"Visitor Email\", \"message\": \"Message\"}', 1, 1, NULL, '2021-08-01 05:57:55');

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'object',
  `support` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>enable, 2=>disable',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'twak.png', 0, NULL, '2019-10-18 23:16:05', '2021-05-18 05:37:12'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google_analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{app_key}}\"></script>\r\n                <script>\r\n                  window.dataLayer = window.dataLayer || [];\r\n                  function gtag(){dataLayer.push(arguments);}\r\n                  gtag(\"js\", new Date());\r\n                \r\n                  gtag(\"config\", \"{{app_key}}\");\r\n                </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'ganalytics.png', 0, NULL, NULL, '2021-05-04 10:19:12'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'Facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"----\"}}', 'fb_com.PNG', 0, NULL, NULL, '2021-08-03 06:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_keys` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_values` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(1, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"BloodLab\",\"Blood Donation\",\"Blood Donation Platform\"],\"description\":\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit\",\"social_title\":\"BloodLab - Blood Donation Platform\",\"social_description\":\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit ff\",\"image\":\"61093a8563ade1627994757.jpg\"}', '2020-07-04 23:42:52', '2021-08-03 06:45:57'),
(24, 'about.content', '{\"has_image\":\"1\",\"heading\":\"Why BloodLab\",\"sub_heading\":\"Omnis harum qui vel repudiandae officiis nemo perferendis libero soluta consequuntur culpa, laborum facere, fugiat totam ratione.\",\"video_link\":\"https:\\/\\/www.youtube.com\\/embed\\/zb3Qk8SG5Ms\",\"about_image\":\"60fff7dc7c1141627387868.jpg\"}', '2020-10-28 00:51:20', '2021-07-27 11:41:08'),
(25, 'blog.content', '{\"heading\":\"Latest News\",\"sub_heading\":\"Hic tenetur nihil ex. Doloremque ipsa velit, ea molestias expedita sed voluptatem ex voluptatibus temporibus sequi. sddd\"}', '2020-10-28 00:51:34', '2020-10-28 00:52:52'),
(26, 'blog.element', '{\"has_image\":[\"1\",\"1\"],\"title\":\"Cumque fugit eligendi quisquam placeat quas voluptate. Quos\",\"description_nic\":\"<div><div class=\\\"col-lg-2 col-md-2\\\" style=\\\"width:220px;max-width:100%;\\\"><div class=\\\"post-share-sidebar\\\" style=\\\"text-align:center;\\\"><div><font color=\\\"#007bff\\\" face=\\\"Line Awesome Brands\\\"><span style=\\\"font-size:22px;\\\"><br \\/><\\/span><\\/font><\\/div><\\/div><\\/div><div class=\\\"col-lg-8 col-md-10\\\" style=\\\"width:880px;max-width:100%;color:rgb(80,80,80);font-family:Roboto, sans-serif;\\\"><div class=\\\"blog-details-content\\\"><p class=\\\"blog-details-subtitle\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:1.375rem;\\\">Amet consectetur adipisicing elit. Laudantium, harum repudiandae. Minus molestiae eveniet tenetur iste nesciunt eligendi quam distinctio consectetur, rerum iusto alias, cum, autem eum veniam quo voluptatum doloribus officiis aliquam quidem.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;\\\">Excepturi quo porro autem, beatae at provident cum atque quidem reprehenderit quam explicabo neque vel laborum perferendis quas officiis ex voluptatum, laudantium alias fugit quae, nostrum hic. Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod excepturi veritatis, ut magnam. Dolorem, quas.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;\\\">Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;\\\">Excepturi quo porro autem, beatae at provident cum atque quidem reprehenderit quam explicabo neque vel laborum perferendis quas officiis ex voluptatum, laudantium alias fugit quae, nostrum hic. Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod excepturi veritatis, ut magnam. Dolorem, quas.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;\\\">Beatae at provident cum atque quidem reprehenderit quam explicabo neque vel laborum perferendis quas officiis voluptatum, laudantium alias fugit quae, nostrum hic. Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod excepturi veritatis, ut magnam. Dolorem, quas.<\\/p><\\/div><\\/div><\\/div>\",\"blog_image\":\"610243c8052141627538376.jpg\"}', '2020-10-28 00:57:19', '2021-08-01 06:39:23'),
(27, 'contact_us.content', '{\"has_image\":\"1\",\"title\":\"Get in touch for any kind of help and informations\",\"email_address\":\"demo@gmail.com\",\"contact_details\":\"Usa , New York\",\"contact_number\":\"867547654634645\",\"latitude\":\"12\",\"longitude\":\"32\",\"background_image\":\"61024077d3ad01627537527.png\"}', '2020-10-28 00:59:19', '2021-08-02 14:12:01'),
(28, 'counter.content', '{\"heading\":\"Latest News\",\"sub_heading\":\"Register New Account\"}', '2020-10-28 01:04:02', '2020-10-28 01:04:02'),
(30, 'blog.element', '{\"has_image\":[\"1\",\"1\"],\"title\":\"Doloribus cumque fugit eligendi quisquam placeat quas voluptate. Quos\",\"description_nic\":\"<p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Excepturi quo porro autem, beatae at provident cum atque quidem reprehenderit quam explicabo neque vel laborum perferendis quas officiis ex voluptatum, laudantium alias fugit quae, nostrum hic. Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod excepturi veritatis, ut magnam. Dolorem, quas.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Excepturi quo porro autem, beatae at provident cum atque quidem reprehenderit quam explicabo neque vel laborum perferendis quas officiis ex voluptatum, laudantium alias fugit quae, nostrum hic. Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod excepturi veritatis, ut magnam. Dolorem, quas.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Excepturi quo porro autem, beatae at provident cum atque quidem reprehenderit quam explicabo neque vel laborum perferendis quas officiis ex voluptatum, laudantium alias fugit quae, nostrum hic. Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod excepturi veritatis, ut magnam. Dolorem, quas.<\\/p>\",\"blog_image\":\"610243febdbf81627538430.jpg\"}', '2020-10-31 00:39:05', '2021-08-01 06:39:35'),
(31, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"las la-expand\\\"><\\/i>\",\"url\":\"https:\\/\\/www.google.com\\/\"}', '2020-11-12 04:07:30', '2021-05-12 05:56:59'),
(33, 'feature.content', '{\"heading\":\"asdf\",\"sub_heading\":\"asdf\"}', '2021-01-03 23:40:54', '2021-01-03 23:40:55'),
(34, 'feature.element', '{\"title\":\"asdf\",\"description\":\"asdf\",\"feature_icon\":\"asdf\"}', '2021-01-03 23:41:02', '2021-01-03 23:41:02'),
(35, 'service.element', '{\"trx_type\":\"withdraw\",\"service_icon\":\"<i class=\\\"las la-highlighter\\\"><\\/i>\",\"title\":\"asdfasdf\",\"description\":\"asdfasdfasdfasdf\"}', '2021-03-06 01:12:10', '2021-03-06 01:12:10'),
(36, 'service.content', '{\"trx_type\":\"withdraw\",\"heading\":\"asdf fffff\",\"sub_heading\":\"asdf asdfasdf\"}', '2021-03-06 01:27:34', '2021-03-06 02:19:39'),
(39, 'banner.content', '{\"has_image\":\"1\",\"heading\":\"A lot of things hurt. Saving lives doesn\'t have to\",\"background_image\":\"60fffe430ffba1627389507.jpg\"}', '2021-05-02 06:09:30', '2021-07-27 12:08:27'),
(41, 'cookie.data', '{\"link\":\"#\",\"description\":\"<div><span style=\\\"font-family: Exo, sans-serif; font-size: 18px;\\\">We may use cookies or any other tracking technologies when you visit our website, including any other media form, mobile website, or mobile application related or connected to help customize the Site and improve your experience.<\\/span><br><\\/div>\",\"status\":1}', '2020-07-04 23:42:52', '2021-08-03 08:33:49'),
(42, 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">What information do we collect?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">How do we protect your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">All provided delicate\\/credit data is sent through Stripe.<br \\/>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Do we disclose any information to outside parties?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Children\'s Online Privacy Protection Act Compliance<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Changes to our Privacy Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">If we decide to change our privacy policy, we will post those changes on this page.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">How long we retain your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">What we don\\u2019t do with your data<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/p><\\/div>\"}', '2021-06-09 08:50:42', '2021-06-09 08:50:42'),
(43, 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details\":\"<div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We claim all authority to dismiss, end, or handicap any help with or without cause per administrator discretion. This is a Complete independent facilitating, on the off chance that you misuse our ticket or Livechat or emotionally supportive network by submitting solicitations or protests we will impair your record. The solitary time you should reach us about the seaward facilitating is if there is an issue with the worker. We have not many substance limitations and everything is as per laws and guidelines. Try not to join on the off chance that you intend to do anything contrary to the guidelines, we do check these things and we will know, don\'t burn through our own and your time by joining on the off chance that you figure you will have the option to sneak by us and break the terms.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><ul class=\\\"font-18\\\" style=\\\"padding-left:15px;list-style-type:disc;font-size:18px;\\\"><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Configuration requests - If you have a fully managed dedicated server with us then we offer custom PHP\\/MySQL configurations, firewalls for dedicated IPs, DNS, and httpd configurations.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Software requests - Cpanel Extension Installation will be granted as long as it does not interfere with the security, stability, and performance of other users on the server.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Emergency Support - We do not provide emergency support \\/ Phone Support \\/ LiveChat Support. Support may take some hours sometimes.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Webmaster help - We do not offer any support for webmaster related issues and difficulty including coding, &amp; installs, Error solving. if there is an issue where a library or configuration of the server then we can help you if it\'s possible from our end.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Backups - We keep backups but we are not responsible for data loss, you are fully responsible for all backups.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">We Don\'t support any child porn or such material.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No spam-related sites or material, such as email lists, mass mail programs, and scripts, etc.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No harassing material that may cause people to retaliate against you.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No phishing pages.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">You may not run any exploitation script from the server. reason can be terminated immediately.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">If Anyone attempting to hack or exploit the server by using your script or hosting, we will terminate your account to keep safe other users.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Malicious Botnets are strictly forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Spam, mass mailing, or email marketing in any way are strictly forbidden here.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Malicious hacking materials, trojans, viruses, &amp; malicious bots running or for download are forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Resource and cronjob abuse is forbidden and will result in suspension or termination.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Php\\/CGI proxies are strictly forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">CGI-IRC is strictly forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No fake or disposal mailers, mass mailing, mail bombers, SMS bombers, etc.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">NO CREDIT OR REFUND will be granted for interruptions of service, due to User Agreement violations.<\\/li><\\/ul><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Terms &amp; Conditions for Users<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">Before getting to this site, you are consenting to be limited by these site Terms and Conditions of Use, every single appropriate law, and guidelines, and concur that you are answerable for consistency with any material neighborhood laws. If you disagree with any of these terms, you are restricted from utilizing or getting to this site.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Support<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">Whenever you have downloaded our item, you may get in touch with us for help through email and we will give a valiant effort to determine your issue. We will attempt to answer using the Email for more modest bug fixes, after which we will refresh the center bundle. Content help is offered to confirmed clients by Tickets as it were. Backing demands made by email and Livechat.<\\/p><p class=\\\"my-3 font-18 font-weight-bold\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">On the off chance that your help requires extra adjustment of the System, at that point, you have two alternatives:<\\/p><ul class=\\\"font-18\\\" style=\\\"padding-left:15px;list-style-type:disc;font-size:18px;\\\"><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Hang tight for additional update discharge.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Or on the other hand, enlist a specialist (We offer customization for extra charges).<\\/li><\\/ul><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Ownership<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">You may not guarantee scholarly or selective possession of any of our items, altered or unmodified. All items are property, we created them. Our items are given \\\"with no guarantees\\\" without guarantee of any sort, either communicated or suggested. On no occasion will our juridical individual be subject to any harms including, however not restricted to, immediate, roundabout, extraordinary, accidental, or significant harms or different misfortunes emerging out of the utilization of or powerlessness to utilize our items.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Warranty<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We don\'t offer any guarantee or assurance of these Services in any way. When our Services have been modified we can\'t ensure they will work with all outsider plugins, modules, or internet browsers. Program similarity ought to be tried against the show formats on the demo worker. If you don\'t mind guarantee that the programs you use will work with the component, as we can not ensure that our systems will work with all program mixes.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Unauthorized\\/Illegal Usage<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">You may not utilize our things for any illicit or unapproved reason or may you, in the utilization of the stage, disregard any laws in your locale (counting yet not restricted to copyright laws) just as the laws of your nation and International law. Specifically, it is disallowed to utilize the things on our foundation for pages that advance: brutality, illegal intimidation, hard sexual entertainment, bigotry, obscenity content or warez programming joins.<br \\/><br \\/>You can\'t imitate, copy, duplicate, sell, exchange or adventure any of our segment, utilization of the offered on our things, or admittance to the administration without the express composed consent by us or item proprietor.<br \\/><br \\/>Our Members are liable for all substance posted on the discussion and demo and movement that happens under your record.<br \\/><br \\/>We hold the chance of hindering your participation account quickly if we will think about a particularly not allowed conduct.<br \\/><br \\/>If you make a record on our site, you are liable for keeping up the security of your record, and you are completely answerable for all exercises that happen under the record and some other activities taken regarding the record. You should quickly inform us, of any unapproved employments of your record or some other penetrates of security.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Fiverr, Seoclerks Sellers Or Affiliates<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We do NOT ensure full SEO campaign conveyance within 24 hours. We make no assurance for conveyance time by any means. We give our best assessment to orders during the putting in of requests, anyway, these are gauges. We won\'t be considered liable for loss of assets, negative surveys or you being prohibited for late conveyance. If you are selling on a site that requires time touchy outcomes, utilize Our SEO Services at your own risk.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Payment\\/Refund Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">No refund or cash back will be made. After a deposit has been finished, it is extremely unlikely to invert it. You should utilize your equilibrium on requests our administrations, Hosting, SEO campaign. You concur that once you complete a deposit, you won\'t document a debate or a chargeback against us in any way, shape, or form.<br \\/><br \\/>If you document a debate or chargeback against us after a deposit, we claim all authority to end every single future request, prohibit you from our site. False action, for example, utilizing unapproved or taken charge cards will prompt the end of your record. There are no special cases.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Free Balance \\/ Coupon Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We offer numerous approaches to get FREE Balance, Coupons and Deposit offers yet we generally reserve the privilege to audit it and deduct it from your record offset with any explanation we may it is a sort of misuse. If we choose to deduct a few or all of free Balance from your record balance, and your record balance becomes negative, at that point the record will naturally be suspended. If your record is suspended because of a negative Balance you can request to make a custom payment to settle your equilibrium to actuate your record.<\\/p><\\/div>\"}', '2021-06-09 08:51:18', '2021-06-09 08:51:18'),
(44, 'blood.content', '{\"has_image\":\"1\",\"heading\":\"Avaiable Blood Donors\",\"background_image\":\"60fff77d8bf601627387773.png\"}', '2021-07-27 11:38:29', '2021-07-27 11:39:33'),
(45, 'about.element', '{\"title\":\"100% Automated\",\"sub_title\":\"Aamet consectetur adipisicing elit. Est voluptatibus accusamus nam labore, quam a quo. Quibusdam est voluptatibus animi quia\",\"about_icon\":\"<i class=\\\"las la-magic\\\"><\\/i>\"}', '2021-07-27 11:41:46', '2021-07-27 11:41:46'),
(46, 'about.element', '{\"title\":\"Always Free\",\"sub_title\":\"Aamet consectetur adipisicing elit. Est voluptatibus accusamus nam labore, quam a quo. Quibusdam est voluptatibus animi quia.\",\"about_icon\":\"<i class=\\\"las la-compass\\\"><\\/i>\"}', '2021-07-27 11:42:10', '2021-07-27 11:42:10'),
(47, 'about.element', '{\"title\":\"All Data is Secured\",\"sub_title\":\"Aamet consectetur adipisicing elit. Est voluptatibus accusamus nam labore, quam a quo. Quibusdam est voluptatibus animi quia.\",\"about_icon\":\"<i class=\\\"las la-shield-alt\\\"><\\/i>\"}', '2021-07-27 11:42:29', '2021-07-27 11:42:29'),
(48, 'donor.content', '{\"has_image\":\"1\",\"heading\":\"Top Donors\",\"sub_heading\":\"Dolor sit amet, consectetur adipisicing elit. Dignissimos soluta est qui totam expedita eaque, deleniti quidem sequi magni iure nulla corporis.\",\"background_image\":\"60fff8a0c56951627388064.png\"}', '2021-07-27 11:44:24', '2021-08-03 04:57:31'),
(49, 'how_it_work.content', '{\"has_image\":\"1\",\"heading\":\"The Blood Donation Process\",\"background_image\":\"60fff8d9bc57d1627388121.jpg\"}', '2021-07-27 11:45:21', '2021-07-27 11:45:22'),
(50, 'how_it_work.element', '{\"title\":\"Registration\",\"icon\":\"<i class=\\\"las la-user\\\"><\\/i>\"}', '2021-07-27 11:45:37', '2021-07-27 11:45:37'),
(51, 'how_it_work.element', '{\"title\":\"Health History\",\"icon\":\"<i class=\\\"las la-file-alt\\\"><\\/i>\"}', '2021-07-27 11:45:53', '2021-07-27 11:45:53'),
(52, 'how_it_work.element', '{\"title\":\"Blood Donation\",\"icon\":\"<i class=\\\"las la-tint\\\"><\\/i>\"}', '2021-07-27 11:46:08', '2021-07-27 11:46:08'),
(53, 'how_it_work.element', '{\"title\":\"Refreshment and Recovery\",\"icon\":\"<i class=\\\"las la-heartbeat\\\"><\\/i>\"}', '2021-07-27 11:46:23', '2021-08-03 04:56:59'),
(54, 'overview.content', '{\"has_image\":\"1\",\"heading\":\"Bloodlab is committed to advancing public policies that promote safety, increase availability, and spur innovation.\",\"background_image\":\"60fff964007751627388260.jpg\"}', '2021-07-27 11:47:39', '2021-07-27 11:47:40'),
(55, 'overview.element', '{\"title\":\"5012 Donors\",\"overview_icon\":\"<i class=\\\"las la-user\\\"><\\/i>\"}', '2021-07-27 11:48:18', '2021-07-27 11:48:18'),
(56, 'overview.element', '{\"title\":\"52 Areas\",\"overview_icon\":\"<i class=\\\"las la-map\\\"><\\/i>\"}', '2021-07-27 11:48:36', '2021-07-27 11:48:36'),
(57, 'overview.element', '{\"title\":\"320 Volunteer\",\"overview_icon\":\"<i class=\\\"las la-hands-helping\\\"><\\/i>\"}', '2021-07-27 11:48:53', '2021-07-27 11:48:53'),
(58, 'overview.element', '{\"title\":\"8 Blood Groups\",\"overview_icon\":\"<i class=\\\"las la-tint\\\"><\\/i>\"}', '2021-07-27 11:49:10', '2021-07-27 11:49:10'),
(59, 'patner.content', '{\"heading\":\"Our Community Partner\",\"sub_heading\":\"Earum optio in ipsum, non dolore, veritatis molestias assumenda sint aspernatur.\"}', '2021-07-27 11:49:33', '2021-07-27 11:49:33'),
(60, 'patner.element', '{\"has_image\":\"1\",\"background_image\":\"60fffa29c492f1627388457.png\"}', '2021-07-27 11:50:57', '2021-07-27 11:50:57'),
(61, 'patner.element', '{\"has_image\":\"1\",\"background_image\":\"60fffa2f279121627388463.png\"}', '2021-07-27 11:51:03', '2021-07-27 11:51:03'),
(62, 'patner.element', '{\"has_image\":\"1\",\"background_image\":\"60fffa346397a1627388468.png\"}', '2021-07-27 11:51:08', '2021-07-27 11:51:08'),
(63, 'patner.element', '{\"has_image\":\"1\",\"background_image\":\"60fffa39274da1627388473.png\"}', '2021-07-27 11:51:13', '2021-07-27 11:51:13'),
(64, 'patner.element', '{\"has_image\":\"1\",\"background_image\":\"60fffa3e49a791627388478.png\"}', '2021-07-27 11:51:18', '2021-07-27 11:51:18'),
(65, 'testimonial.content', '{\"has_image\":\"1\",\"heading\":\"What Blood Donors say\",\"sub_heading\":\"Architecto corporis voluptate ut iure veritatis tempore vitae. Minima ea provident eaque.\",\"background_image\":\"60fffa7b16d461627388539.jpg\"}', '2021-07-27 11:52:19', '2021-08-03 05:48:30'),
(66, 'testimonial.element', '{\"name\":\"Demo1\",\"testimonial\":\"Repellat, laudantium soluta laborum distinctio iste modi consectetur, atque, consequatur facere quidem hic unde harum alias molestias eveniet accusantium. Quasi natus aut minima modi saepe beatae reprehenderit illum\",\"rating\":\"3\",\"donor_count\":\"3\"}', '2021-07-27 11:53:02', '2021-07-27 11:53:02'),
(67, 'testimonial.element', '{\"name\":\"Demo2\",\"testimonial\":\"Repellat, laudantium soluta laborum distinctio iste modi consectetur, atque, consequatur facere quidem hic unde harum alias molestias eveniet accusantium. Quasi natus aut minima modi saepe beatae reprehenderit illum\",\"rating\":\"4\",\"donor_count\":\"5\"}', '2021-07-27 11:53:17', '2021-07-27 11:53:17'),
(68, 'testimonial.element', '{\"name\":\"Demo6\",\"testimonial\":\"Repellat, laudantium soluta laborum distinctio iste modi consectetur, atque, consequatur facere quidem hic unde harum alias molestias eveniet accusantium. Quasi natus aut minima modi saepe beatae reprehenderit illum\",\"rating\":\"5\",\"donor_count\":\"23\"}', '2021-07-27 11:53:31', '2021-07-27 11:53:31'),
(69, 'testimonial.element', '{\"name\":\"Demo6\",\"testimonial\":\"Repellat, laudantium soluta laborum distinctio iste modi consectetur, atque, consequatur facere quidem hic unde harum alias molestias eveniet accusantium. Quasi natus aut minima modi saepe beatae reprehenderit illum\",\"rating\":\"5\",\"donor_count\":\"54\"}', '2021-07-27 11:53:50', '2021-07-27 11:53:50'),
(70, 'testimonial.element', '{\"name\":\"Demo7\",\"testimonial\":\"Repellat, laudantium soluta laborum distinctio iste modi consectetur, atque, consequatur facere quidem hic unde harum alias molestias eveniet accusantium. Quasi natus aut minima modi saepe beatae reprehenderit illum\",\"rating\":\"4\",\"donor_count\":\"55\"}', '2021-07-27 11:54:11', '2021-07-27 11:54:11'),
(71, 'footer.content', '{\"has_image\":\"1\",\"title\":\"Animi sequi aliquam illum voluptatum ratione, quaerat dignissimos fugiat. Ea, vitae odio quasi aspernatur expedita maiores, quidem voluptates libero quaerat fugiat nisi, ratione inventore iusto nostrum voluptas sint culpa.\",\"btn_name\":\"Blood Donor\",\"btn_url\":\"#\",\"first_count_digits\":\"4523\",\"first_count_title\":\"Donors\",\"second_count_digits\":\"5324\",\"second_count_title\":\"Volunteers\",\"background_image\":\"61023b2b0ac1b1627536171.jpg\"}', '2021-07-29 04:52:51', '2021-07-29 04:52:51'),
(72, 'breadcrumb.content', '{\"has_image\":\"1\",\"background_image\":\"61023f89990b81627537289.jpg\"}', '2021-07-29 05:11:29', '2021-07-29 05:11:29'),
(73, 'blog.element', '{\"has_image\":[\"1\",\"1\"],\"title\":\"Doloribus cumque fugit eligendi quisquam placeat quas voluptate. Quo\",\"description_nic\":\"<p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Excepturi quo porro autem, beatae at provident cum atque quidem reprehenderit quam explicabo neque vel laborum perferendis quas officiis ex voluptatum, laudantium alias fugit quae, nostrum hic. Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod excepturi veritatis, ut magnam. Dolorem, quas.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod.<span style=\\\"color:rgb(80,80,80);\\\">Excepturi quo porro autem, beatae at provident cum atque quidem reprehenderit quam explicabo neque vel laborum perferendis quas officiis ex voluptatum, laudantium alias fugit quae, nostrum hic. Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod excepturi veritatis, ut magnam. Dolorem, quas.<\\/span><\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod.<span style=\\\"color:rgb(80,80,80);\\\">Excepturi quo porro autem, beatae at provident cum atque quidem reprehenderit quam explicabo neque vel laborum perferendis quas officiis ex voluptatum, laudantium alias fugit quae, nostrum hic. Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod excepturi veritatis, ut magnam. Dolorem, quas.<\\/span><\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod.<\\/p>\",\"blog_image\":\"610245326e5161627538738.jpg\"}', '2021-07-29 05:31:51', '2021-08-01 06:39:46'),
(74, 'blog.element', '{\"has_image\":[\"1\",\"1\"],\"title\":\"Cumque fugit eligendi quisquam placeat quas voluptate. Quos\",\"description_nic\":\"<p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Excepturi quo porro autem, beatae at provident cum atque quidem reprehenderit quam explicabo neque vel laborum perferendis quas officiis ex voluptatum, laudantium alias fugit quae, nostrum hic. Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod excepturi veritatis, ut magnam. Dolorem, quas.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod.<span style=\\\"color:rgb(80,80,80);\\\">Excepturi quo porro autem,\\u00a0<\\/span><\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\"><span style=\\\"color:rgb(80,80,80);\\\">beatae at provident cum atque quidem reprehenderit quam explicabo neque vel laborum perferendis quas officiis ex voluptatum, laudantium alias fugit quae, nostrum hic. Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod excepturi veritatis, ut magnam. Dolorem, quas.<\\/span><\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod.<\\/p>\",\"blog_image\":\"61024477bc45a1627538551.jpg\"}', '2021-07-29 05:32:31', '2021-08-01 06:39:58'),
(75, 'blog.element', '{\"has_image\":[\"1\",\"1\"],\"title\":\"Doloribus cumque fugit eligendi quisquam placeat quas voluptate. Quo\",\"description_nic\":\"<p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Excepturi quo porro autem, beatae at provident cum atque quidem reprehenderit quam explicabo neque vel laborum perferendis quas officiis ex voluptatum, laudantium alias fugit quae, nostrum hic. Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod excepturi veritatis, ut magnam. Dolorem, quas.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod.<span style=\\\"color:rgb(80,80,80);\\\">Excepturi quo porro autem, beatae at provident cum atque quidem reprehenderit quam explicabo neque vel laborum perferendis quas officiis ex voluptatum, laudantium alias fugit quae,\\u00a0<\\/span><\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\"><span style=\\\"color:rgb(80,80,80);\\\">nostrum hic. Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod excepturi veritatis, ut magnam. Dolorem, quas.<\\/span><\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod.<\\/p>\",\"blog_image\":\"610244b866dd21627538616.jpg\"}', '2021-07-29 05:33:36', '2021-08-01 06:40:08'),
(76, 'blog.element', '{\"has_image\":[\"1\",\"1\"],\"title\":\"Aliquid doloribus cumque fugit eligendi quisquam placeat quas voluptate. Quo\",\"description_nic\":\"<p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Excepturi quo porro autem, beatae at provident cum atque quidem reprehenderit quam explicabo neque vel laborum perferendis quas officiis ex voluptatum, laudantium alias fugit quae, nostrum hic. Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod excepturi veritatis, ut magnam. Dolorem, quas.<\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod.<span style=\\\"color:rgb(80,80,80);\\\">Excepturi quo porro autem, beatae at provident cum atque quidem reprehenderit quam explicabo neque vel laborum perferendis quas officiis ex voluptatum, laudantium alias fugit quae, nostrum hic. Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod excepturi veritatis, ut magnam. Dolorem, quas.<\\/span><\\/p><p style=\\\"margin-top:20px;margin-right:0px;margin-left:0px;color:rgb(80,80,80);font-family:Roboto, sans-serif;font-size:16px;\\\">Animi expedita dolore libero odio corrupti ratione culpa, ipsum esse pariatur illo, excepturi vero, maiores omnis praesentium fuga dolores molestias accusamus illum! Ducimus laborum molestias unde iusto quaerat consectetur suscipit placeat, amet accusamus velit nihil voluptate harum ipsum debitis nam eius saepe! Eius culpa error itaque minima dolorum quae voluptates molestiae nesciunt natus accusamus ab, facere officia praesentium quod.<\\/p>\",\"blog_image\":\"610244dc0c48d1627538652.jpg\"}', '2021-07-29 05:34:12', '2021-08-01 06:40:17'),
(77, 'featured_donor.content', '{\"has_image\":\"1\",\"heading\":\"Featured Donor\",\"sub_heading\":\"Dolor sit amet, consectetur adipisicing elit. Dignissimos soluta est qui totam expedita eaque, deleniti quidem sequi magni iure nulla corporis.\",\"background_image\":\"6107e35b1f0401627906907.png\"}', '2021-08-02 12:21:47', '2021-08-03 04:57:37'),
(78, 'latest_donor.content', '{\"has_image\":\"1\",\"heading\":\"Latest Donor\",\"sub_heading\":\"Dolor sit amet, consectetur adipisicing elit. Dignissimos soluta est qui totam expedita eaque, deleniti quidem sequi magni iure nulla corporis.\",\"background_image\":\"6107e3696253d1627906921.png\"}', '2021-08-02 12:22:01', '2021-08-03 04:57:43'),
(79, 'faq.content', '{\"heading\":\"Frequently Asked Questions\",\"sub_heading\":\"Dolor sit amet consectetur adipisicing elit. Ad voluptatum fuga eius expedita, nulla quos blanditiis nobis laboriosam. Natus cum eum fuga praesentium.\"}', '2021-08-02 14:58:28', '2021-08-02 14:58:28');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(80, 'faq.element', '{\"title\":\"Consectetur adipisicing dolor sit amet, consectetur adipisicing elit.\",\"answer\":\"dolor sit amet consectetur adipisicing elit. Ad voluptatum fuga eius expedita, nulla quos blanditiis nobis laboriosam. Natus cum eum fuga\"}', '2021-08-02 14:58:53', '2021-08-02 14:58:53'),
(81, 'faq.element', '{\"title\":\"Consectetur adipisicing dolor sit amet, consectetur adipisicing elit.\",\"answer\":\"olor sit amet consectetur adipisicing elit. Doloremque perspiciatis harum voluptatibus natus alias nesciunt eius similique tenetur corporis fuga eligendi in enim quisquam dolor voluptates nihil obcaecati pariatur commodi facilis, officiis nobis porro eum architecto! Delectus ut voluptatibus voluptatem, aliquam tenetur et facilis, quia veritatis temporibus, ex magni soluta.\"}', '2021-08-02 14:59:13', '2021-08-02 14:59:13'),
(82, 'faq.element', '{\"title\":\"Consectetur adipisicing dolor sit amet, consectetur adipisicing elit.\",\"answer\":\"dolor sit amet consectetur adipisicing elit. Doloremque perspiciatis harum voluptatibus natus alias nesciunt eius similique tenetur corporis fuga eligendi in enim quisquam dolor voluptates nihil obcaecati pariatur commodi facilis, officiis nobis porro eum architecto! Delectus ut voluptatibus voluptatem, aliquam tenetur et facilis, quia veritatis temporibus, ex magni soluta\"}', '2021-08-02 14:59:32', '2021-08-02 14:59:32'),
(83, 'faq.element', '{\"title\":\"Eligendi in enim quisquam dolor voluptates nihil.\",\"answer\":\"sit amet consectetur adipisicing elit. Doloremque perspiciatis harum voluptatibus natus alias nesciunt eius similique tenetur corporis fuga eligendi in enim quisquam dolor voluptates nihil obcaecati pariatur commodi facilis, officiis nobis porro eum architecto! Delectus ut voluptatibus voluptatem, aliquam tenetur et facilis, quia veritatis temporibus, ex magni soluta.\"}', '2021-08-02 14:59:48', '2021-08-02 14:59:48'),
(84, 'faq.element', '{\"title\":\"Doloremque perspiciatis harum voluptatibus natus.\",\"answer\":\"ipsum dolor sit amet consectetur adipisicing elit. Doloremque perspiciatis harum voluptatibus natus alias nesciunt eius similique tenetur corporis fuga eligendi in enim quisquam dolor voluptates nihil obcaecati pariatur commodi facilis, officiis nobis porro eum architecto! Delectus ut voluptatibus voluptatem, aliquam tenetur et facilis, quia veritatis temporibus, ex magni soluta\"}', '2021-08-02 15:00:05', '2021-08-02 15:00:05'),
(85, 'faq.element', '{\"title\":\"Eligendi in enim quisquam dolor voluptates nihil.\",\"answer\":\"Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.Eligendi in enim quisquam dolor voluptates nihil.\"}', '2021-08-02 15:10:38', '2021-08-02 15:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sitename` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_color` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'email configuration',
  `sms_config` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `en` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email notification, 0 - dont send, 1 - send',
  `sn` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'sms notification, 0 - dont send, 1 - send',
  `force_ssl` tinyint(1) NOT NULL DEFAULT 0,
  `active_template` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sys_version` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `sitename`, `email_from`, `email_template`, `sms_api`, `base_color`, `secondary_color`, `mail_config`, `sms_config`, `en`, `sn`, `force_ssl`, `active_template`, `sys_version`, `created_at`, `updated_at`) VALUES
(1, 'BloodLab', 'no-reply@viserlab.com', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n                          <a href=\"#\">\r\n                            <img style=\"display:block; line-height:0px; font-size:0px; border:0px;\" src=\"https://i.imgur.com/Z1qtvtV.png\" alt=\"img\">\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello {{fullname}} ({{username}})</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\">{{message}}</td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2021 <a href=\"#\">Website Name</a> . All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', 'hi {{name}}, {{message}}', 'FB3640', '17173A', '{\"name\":\"php\"}', '{\"clickatell_api_key\":\"----------------------------\",\"infobip_username\":\"--------------\",\"infobip_password\":\"----------------------\",\"message_bird_api_key\":\"-------------------\",\"account_sid\":\"AC67afdacf2dacff5f163134883db92c24\",\"auth_token\":\"77726b242830fb28f52fb08c648dd7a6\",\"from\":\"+17739011523\",\"apiv2_key\":\"dfsfgdfgh\",\"name\":\"clickatell\"}', 1, 0, 0, 'basic', NULL, NULL, '2021-08-03 06:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_align` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: left to right text align, 1: right to left text align',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: not default language, 1: default language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `icon`, `text_align`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', '5f15968db08911595250317.png', 0, 0, '2020-07-06 03:47:55', '2021-05-18 05:37:23'),
(5, 'Hindi', 'hn', NULL, 0, 0, '2020-12-29 02:20:07', '2020-12-29 02:20:16'),
(9, 'Bangla', 'bn', NULL, 0, 0, '2021-03-14 04:37:41', '2021-05-12 05:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT 'Enable : 1, Disable : 0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_06_14_061757_create_support_tickets_table', 3),
(5, '2020_06_14_061837_create_support_messages_table', 3),
(6, '2020_06_14_061904_create_support_attachments_table', 3),
(7, '2020_06_14_062359_create_admins_table', 3),
(8, '2020_06_14_064604_create_transactions_table', 4),
(9, '2020_06_14_065247_create_general_settings_table', 5),
(12, '2014_10_12_100000_create_password_resets_table', 6),
(13, '2020_06_14_060541_create_user_logins_table', 6),
(14, '2020_06_14_071708_create_admin_password_resets_table', 7),
(15, '2020_09_14_053026_create_countries_table', 8),
(16, '2021_03_15_084721_create_admin_notifications_table', 9),
(17, '2016_06_01_000001_create_oauth_auth_codes_table', 10),
(18, '2016_06_01_000002_create_oauth_access_tokens_table', 10),
(19, '2016_06_01_000003_create_oauth_refresh_tokens_table', 10),
(20, '2016_06_01_000004_create_oauth_clients_table', 10),
(21, '2016_06_01_000005_create_oauth_personal_access_clients_table', 10),
(22, '2021_05_08_103925_create_sms_gateways_table', 11),
(23, '2019_12_14_000001_create_personal_access_tokens_table', 12),
(24, '2021_05_23_111859_create_email_logs_table', 13),
(25, '2021_07_29_122223_create_bloods_table', 14),
(26, '2021_07_29_150653_create_advertisements_table', 15),
(27, '2021_07_29_162154_create_locations_table', 16),
(28, '2021_07_29_165548_create_cities_table', 17),
(29, '2021_07_31_105756_create_donors_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'HOME', 'home', 'templates.basic.', '[\"blood\",\"about\",\"donor\",\"overview\",\"latest_donor\",\"how_it_work\",\"featured_donor\",\"patner\",\"testimonial\",\"blog\"]', 1, '2020-07-11 06:23:58', '2021-08-03 12:34:05'),
(2, 'About', 'about-us', 'templates.basic.', '[\"about\",\"blog\"]', 0, '2020-07-11 06:35:35', '2020-07-11 07:39:10'),
(4, 'Donor', 'donor', 'templates.basic.', NULL, 1, '2020-10-22 01:14:43', '2020-10-22 01:14:43'),
(5, 'Blog', 'blog', 'templates.basic.', NULL, 1, '2020-10-22 01:14:53', '2020-10-22 01:14:53'),
(12, 'Contact', 'contact', 'templates.basic.', NULL, 1, '2021-07-31 11:04:02', '2021-07-31 11:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_message_id` int(10) UNSIGNED NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supportticket_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bloods`
--
ALTER TABLE `bloods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`phone`);

--
-- Indexes for table `email_sms_templates`
--
ALTER TABLE `email_sms_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bloods`
--
ALTER TABLE `bloods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_sms_templates`
--
ALTER TABLE `email_sms_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
