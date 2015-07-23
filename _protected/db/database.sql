-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2015 at 11:52 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `openpeststrap`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(11) unsigned NOT NULL,
  `x` int(10) unsigned DEFAULT NULL,
  `y` int(10) unsigned DEFAULT NULL,
  `width` int(10) unsigned DEFAULT NULL,
  `height` int(10) unsigned DEFAULT NULL,
  `radius` int(10) unsigned DEFAULT NULL,
  `is_circle` tinyint(1) unsigned DEFAULT '0',
  `image_id` int(11) unsigned DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('member', 2, 1437473807),
('theCreator', 1, 1436869085);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Administrator of this application', NULL, NULL, 1436524576, 1436524576),
('adminArticle', 2, 'Allows admin+ roles to manage articles', NULL, NULL, 1436524575, 1436524575),
('createArticle', 2, 'Allows editor+ roles to create articles', NULL, NULL, 1436524575, 1436524575),
('deleteArticle', 2, 'Allows admin+ roles to delete articles', NULL, NULL, 1436524575, 1436524575),
('editor', 1, 'Editor of this application', NULL, NULL, 1436524576, 1436524576),
('manageUsers', 2, 'Allows admin+ roles to manage users', NULL, NULL, 1436524575, 1436524575),
('member', 1, 'Registered users, members of this site', NULL, NULL, 1436524575, 1436524575),
('premium', 1, 'Premium members. They have more permissions than normal members', NULL, NULL, 1436524575, 1436524575),
('support', 1, 'Support staff', NULL, NULL, 1436524575, 1436524575),
('theCreator', 1, 'You!', NULL, NULL, 1436524576, 1436524576),
('updateArticle', 2, 'Allows editor+ roles to update articles', NULL, NULL, 1436524575, 1436524575),
('updateOwnArticle', 2, 'Update own article', 'isAuthor', NULL, 1436524575, 1436524575),
('usePremiumContent', 2, 'Allows premium+ roles to use premium content', NULL, NULL, 1436524575, 1436524575);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('theCreator', 'admin'),
('editor', 'adminArticle'),
('editor', 'createArticle'),
('admin', 'deleteArticle'),
('admin', 'editor'),
('admin', 'manageUsers'),
('support', 'member'),
('support', 'premium'),
('editor', 'support'),
('admin', 'updateArticle'),
('updateOwnArticle', 'updateArticle'),
('editor', 'updateOwnArticle'),
('premium', 'usePremiumContent');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isAuthor', 'O:25:"app\\rbac\\rules\\AuthorRule":3:{s:4:"name";s:8:"isAuthor";s:9:"createdAt";i:1436524575;s:9:"updatedAt";i:1436524575;}', 1436524575, 1436524575);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(10) unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trap_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `device_date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1436524547),
('m141022_115823_create_user_table', 1436524554),
('m141022_115912_create_rbac_tables', 1436524556),
('m150104_153617_create_article_table', 1436524556);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pest_families`
--

CREATE TABLE IF NOT EXISTS `pest_families` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pest_families`
--

INSERT INTO `pest_families` (`id`, `name`, `description`) VALUES
(1, 'Cerambycidae (long-horned beetles)', 'These beetles are generally elongate and cylindrical in shape, and often brightly colored. Their distinctive antennae extend over one-half the length of the body, sometimes even surpassing the body length. Adults typically feed on flowers; the larvae often bore into stems of herbaceous plants or trees. The soybean stem borer is practically the only agronomic pest in this family, although some species are a threat to fruit and ornamental trees.'),
(2, 'Chrysomelidae (leaf beetles)', 'Oval to oval-elongate in shape, chrysomelid beetles are usually less than 13 mm long. Their color and shape is so variable, however, that they may be difficult to identify consistently. Since both the larval and adult chrysomelids are phytophagous, a large number of economically significant species occur in this family. Adults feed on flowers and foliage; many larval forms attack plant roots. This family encompasses the corn rootworms, cereal leaf beetle, bean leaf beetle, and flea beetles.'),
(3, 'Anthomyiidae (root maggot flies)', 'In this family, the larva is the injurious life stage. Although most larvae are root- and seed-destroying maggots, some are leafminers. The seedcorn maggot is a common pest belonging to this family. To distinguish the adults from similar flies, wing venation must be closely examined (see couplet 3 of Key to Adults).'),
(4, 'Lygaeidae (seed bugs, chinch bugs)', 'There is great variability among the members of this family. Some are phytophagous, others predaceous. Wing venation (as described in the Key) distinguishes members of this family from other Heteropteran families. The chinch bug is its best known member.');

-- --------------------------------------------------------

--
-- Table structure for table `pest_reports`
--

CREATE TABLE IF NOT EXISTS `pest_reports` (
  `id` int(10) unsigned NOT NULL,
  `num_of_pests` int(11) NOT NULL,
  `num_of_pests_total` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `trap_id` int(11) unsigned NOT NULL,
  `is_reset` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pest_family` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pest_reports`
--

INSERT INTO `pest_reports` (`id`, `num_of_pests`, `num_of_pests_total`, `date_time`, `created_at`, `updated_at`, `trap_id`, `is_reset`, `pest_family`) VALUES
(1, 22, 21, '2015-07-04 07:07:36', '2015-07-20 14:03:37', '2015-07-20 14:03:37', 2, 1, 2),
(5, 55, 57, '2015-07-13 08:07:16', '2015-07-20 14:35:11', '2015-07-20 14:35:11', 3, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `traps`
--

CREATE TABLE IF NOT EXISTS `traps` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pests_network_id` int(11) unsigned DEFAULT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `battery_charge` decimal(5,2) NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  `status` enum('PAUSED','ACTIVE','DELETED','BLOCKED') COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_running` tinyint(1) NOT NULL,
  `is_public` tinyint(1) NOT NULL,
  `error_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `traps`
--

INSERT INTO `traps` (`id`, `name`, `pests_network_id`, `uuid`, `latitude`, `longitude`, `battery_charge`, `startdate`, `enddate`, `status`, `description`, `user_id`, `created_at`, `is_running`, `is_public`, `error_code`, `updated_at`) VALUES
(1, 'Banja Luka 1', NULL, 'fb506ce7-5f18-4520-bfbf-6b8ec948771f', '44.7661320', '17.1974920', '50.00', '2015-07-12 08:53:24', '2015-07-12 08:53:24', 'ACTIVE', 'Banja Luka', 1, '2015-07-12 08:53:24', 1, 1, 'NULL', '2015-07-12 08:53:24'),
(2, 'Banja Luka 2', NULL, '96f0d09f-24c2-4910-82e2-76659a4b4273', '44.7661320', '17.1974920', '50.00', '2015-07-20 11:07:52', '2015-07-20 11:07:53', 'PAUSED', 'sfsdf', 1, '2015-07-20 11:07:01', 1, 1, '0', '2015-07-20 11:56:21'),
(3, 'Doboj', NULL, 'd5225e19-8c26-46e0-929b-86740be0fd93', '44.7300840', '18.0907250', '87.00', '2015-07-20 11:07:31', '2015-07-20 11:07:33', 'ACTIVE', 'asdasd', 1, '2015-07-20 11:07:46', 1, 0, '0', '2015-07-20 11:58:53'),
(4, 'Zaluzani', NULL, '0d04fb33-d863-4309-9263-ed09c42472c8', '44.8899280', '17.2769080', '43.00', '2015-07-06 05:07:56', '2015-07-21 15:07:08', 'ACTIVE', 'dfgdfghdfgdfg', 2, '1899-12-11 05:12:00', 1, 1, '0', '2015-07-21 15:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `trap_networks`
--

CREATE TABLE IF NOT EXISTS `trap_networks` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_activation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `status`, `auth_key`, `password_reset_token`, `account_activation_token`, `created_at`, `updated_at`) VALUES
(1, 'cwix', 'cwixixpro@gmail.com', '$2y$13$rH9Cj3QBhB6LlyXYxvm6Auvc8rZ3Y1cUFsJUuUEBVrn0w0UymvzTW', 10, 'yvFPWkQXehWf0Pwi_YUX0WZq0aFA2RD9', NULL, NULL, 1436869085, 1437640064),
(2, 'user2', 'user@email.com', '$2y$13$JxiLwkuxRmbpbI4GOzcmZepf3SBWXT8ZPcJY55pS/UJWL6HimsABW', 10, 'US4UZKWFjgSQh05pfmY_oaTh9jWlyWex', NULL, NULL, 1437473807, 1437473807);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `access` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `access`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@openpeststrap.com', '$2y$10$tLkG9arPxyo6nk1R4tIHb.P0KftVnccZg8tbMN8E18xGD8xB7vWG.', 1, NULL, '2015-05-13 05:46:50', '2015-05-13 05:46:50'),
(2, 'User', 'user@openpeststrap.com', '$2y$10$vMuqSemnve1gkwplVAs8XOhxSrDaGWEFenSr/hWLuO53GDHaOr1La', 0, 'sFvLhtpByOHJH6SV23aGcFq5j9FyD1PLwzUhz9yGDRohfguNXHolmVixeE6y', '2015-05-13 05:46:51', '2015-05-14 14:43:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_image_id` (`image_id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`), ADD KEY `rule_name` (`rule_name`), ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`), ADD KEY `links_campaign_id_index` (`trap_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pest_families`
--
ALTER TABLE `pest_families`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pest_reports`
--
ALTER TABLE `pest_reports`
  ADD PRIMARY KEY (`id`), ADD KEY `links_campaign_id_index` (`date_time`), ADD KEY `fk_trap_id` (`trap_id`), ADD KEY `fk_species_id` (`pest_family`);

--
-- Indexes for table `traps`
--
ALTER TABLE `traps`
  ADD PRIMARY KEY (`id`), ADD KEY `campaigns_user_id_index` (`user_id`), ADD KEY `fk_pests_network_id` (`pests_network_id`);

--
-- Indexes for table `trap_networks`
--
ALTER TABLE `trap_networks`
  ADD PRIMARY KEY (`id`), ADD KEY `links_campaign_id_index` (`campaign_id`), ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pest_families`
--
ALTER TABLE `pest_families`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pest_reports`
--
ALTER TABLE `pest_reports`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `traps`
--
ALTER TABLE `traps`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trap_networks`
--
ALTER TABLE `trap_networks`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
ADD CONSTRAINT `fk_image_id` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Constraints for table `article`
--
ALTER TABLE `article`
ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pest_reports`
--
ALTER TABLE `pest_reports`
ADD CONSTRAINT `fk_species_id` FOREIGN KEY (`pest_family`) REFERENCES `pest_families` (`id`),
ADD CONSTRAINT `fk_trap_id` FOREIGN KEY (`trap_id`) REFERENCES `traps` (`id`);

--
-- Constraints for table `traps`
--
ALTER TABLE `traps`
ADD CONSTRAINT `fk_pests_network_id` FOREIGN KEY (`pests_network_id`) REFERENCES `trap_networks` (`id`);

--
-- Constraints for table `trap_networks`
--
ALTER TABLE `trap_networks`
ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
