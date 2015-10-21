-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 20 Octobre 2015 à 12:58
-- Version du serveur :  5.6.26
-- Version de PHP :  5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fashion`
--

-- --------------------------------------------------------

--
-- Structure de la table `tbl_albums`
--

CREATE TABLE IF NOT EXISTS `tbl_albums` (
  `album_id` int(11) NOT NULL,
  `album_name` text,
  `status` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `description` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tbl_categories`
--

INSERT INTO `tbl_categories` (`cat_id`, `cat_name`, `status`, `description`, `created_at`, `updated_at`, `type`) VALUES
(1, 'Test', 1, '1', NULL, NULL, 1),
(2, 'test12', 1, '1', NULL, NULL, 1),
(3, 'test3', 1, '1', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_cat_post`
--

CREATE TABLE IF NOT EXISTS `tbl_cat_post` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tbl_cat_post`
--

INSERT INTO `tbl_cat_post` (`id`, `cat_id`, `post_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 16, 1, 1444812571, 1444812571),
(3, 2, 16, 1, 1444812571, 1444812571),
(4, 3, 16, 1, 1444812571, 1444812571),
(5, 1, 17, 1, 1444813550, 1444813550),
(6, 2, 17, 1, 1444813550, 1444813550),
(7, 3, 17, 1, 1444813550, 1444813550),
(8, 1, 18, 1, 1444813940, 1444813940),
(9, 2, 18, 1, 1444813940, 1444813940),
(10, 3, 18, 1, 1444813940, 1444813940),
(11, 1, 19, 1, 1445310322, 1445310322),
(12, 2, 19, 1, 1445310322, 1445310322),
(13, 3, 19, 1, 1445310322, 1445310322),
(14, 1, 20, 1, 1445324395, 1445324395),
(15, 2, 20, 1, 1445324395, 1445324395),
(16, 3, 20, 1, 1445324396, 1445324396),
(17, 1, 21, 1, 1445324400, 1445324400),
(18, 2, 21, 1, 1445324401, 1445324401),
(19, 3, 21, 1, 1445324401, 1445324401),
(20, 1, 22, 1, 1445324402, 1445324402),
(21, 2, 22, 1, 1445324403, 1445324403),
(22, 3, 22, 1, 1445324403, 1445324403),
(23, 1, 23, 1, 1445324405, 1445324405),
(24, 2, 23, 1, 1445324405, 1445324405),
(25, 3, 23, 1, 1445324405, 1445324405),
(26, 1, 24, 1, 1445324407, 1445324407),
(27, 2, 24, 1, 1445324407, 1445324407),
(28, 3, 24, 1, 1445324407, 1445324407),
(29, 1, 25, 1, 1445324409, 1445324409),
(30, 2, 25, 1, 1445324409, 1445324409),
(31, 3, 25, 1, 1445324409, 1445324409),
(32, 1, 26, 1, 1445324410, 1445324410),
(33, 2, 26, 1, 1445324410, 1445324410),
(34, 3, 26, 1, 1445324410, 1445324410),
(35, 1, 27, 1, 1445324413, 1445324413),
(36, 2, 27, 1, 1445324413, 1445324413),
(37, 3, 27, 1, 1445324413, 1445324413),
(38, 1, 28, 1, 1445324414, 1445324414),
(39, 2, 28, 1, 1445324414, 1445324414),
(40, 3, 28, 1, 1445324414, 1445324414),
(41, 1, 29, 1, 1445324415, 1445324415),
(42, 2, 29, 1, 1445324415, 1445324415),
(43, 3, 29, 1, 1445324415, 1445324415),
(44, 1, 30, 1, 1445324417, 1445324417),
(45, 2, 30, 1, 1445324417, 1445324417),
(46, 3, 30, 1, 1445324417, 1445324417),
(47, 1, 31, 1, 1445324418, 1445324418),
(48, 2, 31, 1, 1445324418, 1445324418),
(49, 3, 31, 1, 1445324418, 1445324418),
(50, 1, 32, 1, 1445324419, 1445324419),
(51, 2, 32, 1, 1445324419, 1445324419),
(52, 3, 32, 1, 1445324419, 1445324419),
(53, 1, 33, 1, 1445324421, 1445324421),
(54, 2, 33, 1, 1445324421, 1445324421),
(55, 3, 33, 1, 1445324422, 1445324422),
(56, 1, 34, 1, 1445324422, 1445324422),
(57, 2, 34, 1, 1445324422, 1445324422),
(58, 3, 34, 1, 1445324422, 1445324422),
(59, 1, 35, 1, 1445324423, 1445324423),
(60, 2, 35, 1, 1445324423, 1445324423),
(61, 3, 35, 1, 1445324423, 1445324423);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_cat_user`
--

CREATE TABLE IF NOT EXISTS `tbl_cat_user` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `comment_id` int(11) NOT NULL,
  `comment_content` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tbl_comments`
--

INSERT INTO `tbl_comments` (`comment_id`, `comment_content`, `created_at`, `updated_at`, `created_by`, `status`, `post_id`) VALUES
(6, 'test again', 1445227470, 1445227470, 1, 1, 18),
(7, 'test', 1445227486, 1445227486, 1, 1, 18);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_images`
--

CREATE TABLE IF NOT EXISTS `tbl_images` (
  `img_id` int(11) NOT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `image_like_count` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tbl_images`
--

INSERT INTO `tbl_images` (`img_id`, `img_url`, `status`, `created_at`, `updated_at`, `post_id`, `created_by`, `comment_id`, `album_id`, `image_like_count`) VALUES
(1, 'images/2015-10-14/1/144481036120150807_201622.jpg', 1, 1444810361, 1444810361, 2, 1, NULL, NULL, NULL),
(2, 'images/2015-10-14/1/144481064320150807_201622.jpg', 1, 1444810644, 1444810644, 3, 1, NULL, NULL, NULL),
(3, 'images/2015-10-14/1/144481068020150807_201622.jpg', 1, 1444810680, 1444810680, 4, 1, NULL, NULL, NULL),
(4, 'images/2015-10-14/1/144481071320150807_201622.jpg', 1, 1444810713, 1444810713, 5, 1, NULL, NULL, 0),
(5, 'images/2015-10-14/1/144481224820150807_201622.jpg', 1, 1444812248, 1444812248, 9, 1, NULL, NULL, 0),
(6, 'images/2015-10-14/1/144481257120150807_201622.jpg', 1, 1444812571, 1444812571, 16, 1, NULL, NULL, 0),
(7, 'images/2015-10-14/1/1444813550Chrysanthemum.jpg', 1, 1444813550, 1444813550, 17, 1, NULL, NULL, 0),
(8, 'images/2015-10-14/1/1444813940Chrysanthemum.jpg', 1, 1444813940, 1444813940, 18, 1, NULL, NULL, 0),
(9, 'images/2015-10-20//1445310321Desert.jpg', 1, 1445310322, 1445310322, 19, NULL, NULL, NULL, 0),
(10, 'images/2015-10-20//1445310321Hydrangeas.jpg', 1, 1445310322, 1445310322, 19, NULL, NULL, NULL, 0),
(11, 'images/2015-10-20/1/1445324394Tulips.jpg', 1, 1445324396, 1445324396, 20, 1, NULL, NULL, 0),
(12, 'images/2015-10-20/1/1445324400Tulips.jpg', 1, 1445324401, 1445324401, 21, 1, NULL, NULL, 0),
(13, 'images/2015-10-20/1/1445324402Tulips.jpg', 1, 1445324403, 1445324403, 22, 1, NULL, NULL, 0),
(14, 'images/2015-10-20/1/1445324404Tulips.jpg', 1, 1445324406, 1445324406, 23, 1, NULL, NULL, 0),
(15, 'images/2015-10-20/1/1445324407Tulips.jpg', 1, 1445324407, 1445324407, 24, 1, NULL, NULL, 0),
(16, 'images/2015-10-20/1/1445324409Tulips.jpg', 1, 1445324409, 1445324409, 25, 1, NULL, NULL, 0),
(17, 'images/2015-10-20/1/1445324410Tulips.jpg', 1, 1445324411, 1445324411, 26, 1, NULL, NULL, 0),
(18, 'images/2015-10-20/1/1445324412Tulips.jpg', 1, 1445324413, 1445324413, 27, 1, NULL, NULL, 0),
(19, 'images/2015-10-20/1/1445324414Tulips.jpg', 1, 1445324414, 1445324414, 28, 1, NULL, NULL, 0),
(20, 'images/2015-10-20/1/1445324415Tulips.jpg', 1, 1445324416, 1445324416, 29, 1, NULL, NULL, 0),
(21, 'images/2015-10-20/1/1445324417Tulips.jpg', 1, 1445324417, 1445324417, 30, 1, NULL, NULL, 0),
(22, 'images/2015-10-20/1/1445324418Tulips.jpg', 1, 1445324418, 1445324418, 31, 1, NULL, NULL, 0),
(23, 'images/2015-10-20/1/1445324419Tulips.jpg', 1, 1445324419, 1445324419, 32, 1, NULL, NULL, 0),
(24, 'images/2015-10-20/1/1445324421Tulips.jpg', 1, 1445324422, 1445324422, 33, 1, NULL, NULL, 0),
(25, 'images/2015-10-20/1/1445324422Tulips.jpg', 1, 1445324423, 1445324423, 34, 1, NULL, NULL, 0),
(26, 'images/2015-10-20/1/1445324423Tulips.jpg', 1, 1445324424, 1445324424, 35, 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_like`
--

CREATE TABLE IF NOT EXISTS `tbl_like` (
  `id` int(11) NOT NULL,
  `from` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_notifications`
--

CREATE TABLE IF NOT EXISTS `tbl_notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `is_read` int(11) DEFAULT NULL,
  `content` text,
  `recipient_id` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_posts`
--

CREATE TABLE IF NOT EXISTS `tbl_posts` (
  `post_id` int(11) NOT NULL,
  `post_content` text,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `post_like_count` int(11) DEFAULT NULL,
  `post_comment_count` int(11) DEFAULT NULL,
  `post_view_count` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tbl_posts`
--

INSERT INTO `tbl_posts` (`post_id`, `post_content`, `user_id`, `status`, `created_at`, `updated_at`, `post_like_count`, `post_comment_count`, `post_view_count`, `location`) VALUES
(16, 'test', 1, 1, 1444812571, 1444812571, 0, 0, 0, 'test'),
(17, 'test', 1, 1, 1444813550, 1444813550, 0, 0, 0, 'test'),
(18, 'test', 1, 1, 1444813940, 1444813940, 0, 7, 0, 'test'),
(19, 'Test', 1, 1, 1445310321, 1445310321, 0, 0, 0, 'test'),
(20, 'test', 1, 1, 1445324395, 1445324395, 0, 0, 0, 'test'),
(21, 'test', 1, 1, 1445324400, 1445324400, 0, 0, 0, 'test'),
(22, 'test', 1, 1, 1445324402, 1445324402, 0, 0, 0, 'test'),
(23, 'test', 1, 1, 1445324404, 1445324404, 0, 0, 0, 'test'),
(24, 'test', 1, 1, 1445324407, 1445324407, 0, 0, 0, 'test'),
(25, 'test', 1, 1, 1445324409, 1445324409, 0, 0, 0, 'test'),
(26, 'test', 1, 1, 1445324410, 1445324410, 0, 0, 0, 'test'),
(27, 'test', 1, 1, 1445324413, 1445324413, 0, 0, 0, 'test'),
(28, 'test', 1, 1, 1445324414, 1445324414, 0, 0, 0, 'test'),
(29, 'test', 1, 1, 1445324415, 1445324415, 0, 0, 0, 'test'),
(30, 'test', 1, 1, 1445324417, 1445324417, 0, 0, 0, 'test'),
(31, 'test', 1, 1, 1445324418, 1445324418, 0, 0, 0, 'test'),
(32, 'test', 1, 1, 1445324419, 1445324419, 0, 0, 0, 'test'),
(33, 'test', 1, 1, 1445324421, 1445324421, 0, 0, 0, 'test'),
(34, 'test', 1, 1, 1445324422, 1445324422, 0, 0, 0, 'test'),
(35, 'test', 1, 1, 1445324423, 1445324423, 0, 0, 0, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_relationship`
--

CREATE TABLE IF NOT EXISTS `tbl_relationship` (
  `id` int(11) NOT NULL,
  `user_id_1` int(11) DEFAULT NULL,
  `user_id_2` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_reports`
--

CREATE TABLE IF NOT EXISTS `tbl_reports` (
  `id` int(11) NOT NULL,
  `from` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `content` text,
  `created_at` time DEFAULT NULL,
  `updated_at` time DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL,
  `facebook_id` varchar(225) DEFAULT NULL,
  `facebook_access_token` text,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `description` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `is_online` int(11) DEFAULT NULL,
  `device_id` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `facebook_id`, `facebook_access_token`, `username`, `password`, `photo`, `gender`, `age`, `description`, `created_at`, `updated_at`, `access_token`, `is_online`, `device_id`, `status`) VALUES
(1, '12', '123456', 'huy', NULL, 'https://graph.facebook.com/586759558131053/picture?type=large&width=200&height=200', 15, 12, NULL, 1444810798, 1444810798, NULL, NULL, 'ttt', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_user_post_relationship`
--

CREATE TABLE IF NOT EXISTS `tbl_user_post_relationship` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_wishlist`
--

CREATE TABLE IF NOT EXISTS `tbl_wishlist` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `tbl_albums`
--
ALTER TABLE `tbl_albums`
  ADD PRIMARY KEY (`album_id`);

--
-- Index pour la table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `tbl_cat_post`
--
ALTER TABLE `tbl_cat_post`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbl_cat_user`
--
ALTER TABLE `tbl_cat_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Index pour la table `tbl_images`
--
ALTER TABLE `tbl_images`
  ADD PRIMARY KEY (`img_id`);

--
-- Index pour la table `tbl_like`
--
ALTER TABLE `tbl_like`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Index pour la table `tbl_relationship`
--
ALTER TABLE `tbl_relationship`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbl_user_post_relationship`
--
ALTER TABLE `tbl_user_post_relationship`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tbl_cat_post`
--
ALTER TABLE `tbl_cat_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT pour la table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `tbl_images`
--
ALTER TABLE `tbl_images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT pour la table `tbl_relationship`
--
ALTER TABLE `tbl_relationship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tbl_user_post_relationship`
--
ALTER TABLE `tbl_user_post_relationship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
