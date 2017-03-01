-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 25 2017 г., 17:08
-- Версия сервера: 5.5.45-log
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `timet`
--

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `name`, `code`, `status`) VALUES
(1, 'Client1', 'CL1', '5'),
(2, 'Client2', 'CL2', '5'),
(3, 'Client3', 'CL3', '5'),
(4, 'Client4', 'CL4', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `clients_status`
--

CREATE TABLE IF NOT EXISTS `clients_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `clients_status`
--

INSERT INTO `clients_status` (`id`, `status_name`, `created_at`, `updated_at`) VALUES
(1, 'Not approved', NULL, NULL),
(2, 'Pending', NULL, NULL),
(3, 'In progress', NULL, NULL),
(4, 'Rejected', NULL, NULL),
(5, 'Approved', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `clients_users`
--

CREATE TABLE IF NOT EXISTS `clients_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `clients_users`
--

INSERT INTO `clients_users` (`id`, `client_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 3, 3, NULL, NULL),
(2, 4, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `departments`
--

INSERT INTO `departments` (`id`, `department_code`, `department_name`) VALUES
(1, 'DEV', 'Development'),
(2, 'QA', 'QA Department');

-- --------------------------------------------------------

--
-- Структура таблицы `departments_users`
--

CREATE TABLE IF NOT EXISTS `departments_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `departments_users`
--

INSERT INTO `departments_users` (`id`, `department_id`, `user_id`) VALUES
(1, 1, 4),
(2, 2, 5),
(3, 2, 7),
(4, 2, 8),
(5, 2, 9),
(6, 1, 10),
(7, 1, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_10_10_070703_create_roles_table', 1),
('2016_10_10_070739_create_users_status_table', 1),
('2016_10_10_130305_create_projects_table', 2),
('2016_10_10_131242_create_projects_status_table', 2),
('2016_10_10_131735_create_projects_type_table', 2),
('2016_10_10_135659_create_user_roles_table', 3),
('2016_10_10_150907_create_projects_users_table', 4),
('2017_02_17_205700_create_departments', 5),
('2017_02_17_214011_create_clients', 6),
('2017_02_17_221143_create_departments_users', 7),
('2017_02_24_161223_create_timesheet_table', 8),
('2017_02_24_170409_create_projects_clients_table', 9),
('2017_02_24_171251_create_clients_users_table', 9),
('2017_02_24_195548_create_clients_status_table', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_customer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_budget_time` int(11) NOT NULL,
  `project_budget_money` double(8,2) NOT NULL,
  `project_lead` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_type` int(11) NOT NULL,
  `project_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `project_description`, `project_customer`, `project_budget_time`, `project_budget_money`, `project_lead`, `project_type`, `project_status`) VALUES
(1, 'p1', 'p1Desc', 'Dima', 120, 350.00, 'Dima L', 1, 1),
(2, 'p1', 'p1Desc', 'Dima', 120, 350.00, 'Dima L', 1, 1),
(3, 'p2', 'p2Desc', 'Dima', 30, 220.00, 'Dima l', 1, 1),
(4, 'sp1', 'sp1Desc', 'Dima l', 88, 455.00, 'Dima', 2, 1),
(5, 'sp2', 'sp2Desc', 'Dima L', 54, 444.00, 'Dima', 2, 1),
(6, 'p4', 'p4Desc', 'Dima', 939, 8888.00, 'Dima L', 1, 1),
(7, 't2p1', 't2p1Desc', 'Dima2', 77, 838.00, 'Dima2 L', 1, 1),
(8, 'adminProj1', 'AdminProjDescr', 'admin', 111, 250.00, 'Dima Admin', 1, 1),
(9, 'adminProj2', 'AdminProjDescr', 'admin', 1112, 2502.00, 'Dima Admin', 1, 1),
(10, 'adminProj2', 'AdminProjDescr', 'admin', 1112, 2502.00, 'Dima Admin', 1, 1),
(11, 'adminProj3', 'AdminProjDescr', 'admin', 1113, 2503.00, 'Dima Admin', 1, 1),
(12, 'adminProj4', 'AdminProjDescr', 'admin', 1114, 2504.00, 'Dima Admin', 1, 1),
(13, 'adminProj4', 'AdminProjDescr', 'admin', 1114, 2504.00, 'Dima Admin', 1, 1),
(14, 'adminProj5', 'AdminProjDescr', 'admin', 1115, 2505.00, 'Dima Admin', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `projects_clients`
--

CREATE TABLE IF NOT EXISTS `projects_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `projects_status`
--

CREATE TABLE IF NOT EXISTS `projects_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `projects_status`
--

INSERT INTO `projects_status` (`id`, `status_name`) VALUES
(1, 'Not approved'),
(2, 'Pending'),
(3, 'In progress'),
(4, 'Rejected'),
(5, 'Approved');

-- --------------------------------------------------------

--
-- Структура таблицы `projects_type`
--

CREATE TABLE IF NOT EXISTS `projects_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `projects_type`
--

INSERT INTO `projects_type` (`id`, `type_name`) VALUES
(1, 'Project'),
(2, 'Sub Project');

-- --------------------------------------------------------

--
-- Структура таблицы `projects_users`
--

CREATE TABLE IF NOT EXISTS `projects_users` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `projects_users`
--

INSERT INTO `projects_users` (`project_id`, `user_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 2),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'User');

-- --------------------------------------------------------

--
-- Структура таблицы `timesheet`
--

CREATE TABLE IF NOT EXISTS `timesheet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `worked_time` int(11) NOT NULL,
  `logged_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `user_parent` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `user_parent`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'test@test.com', '$2y$10$pBGypJoxZyjgAcjcm1LEOuitsgux/TNdqEh3yBl/brXc2jllQudii', 1, 1, NULL, 'bXQsA52sUoRQdl6gALJRzN1anH0nnR2ePVLazphModoZkn1oFZ7zaIcr1DZS', '2016-10-10 05:15:18', '2017-02-24 13:34:48'),
(2, 'Test2', 'test2@test.com', '$2y$10$4987ZPU1/oTTQ20xiu/INuQq.5zFBAGaleh8KE4vEhlFezfMOwSUa', 1, 1, NULL, NULL, '2016-10-14 05:27:48', '2016-10-14 05:27:48'),
(3, 'admin', 'admin@admin.com', '$2y$10$yUkI3Bi7AQsAtaPm9Re5yOOWKKOv/rwQzBaqdPV1kcMER0q/lXqFC', 1, 1, NULL, NULL, '2017-02-17 15:05:05', '2017-02-17 15:05:05'),
(11, 'SubUser1', 'sub1@timet.com', '$2y$10$mjLXTI5YcR1gwDPkHEy/A.ZFNwcfwm8HZJFZ84eaUjZGgr1R2nXMu', 3, 5, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users_roles`
--

CREATE TABLE IF NOT EXISTS `users_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users_roles`
--

INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
(5, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users_status`
--

CREATE TABLE IF NOT EXISTS `users_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `users_status`
--

INSERT INTO `users_status` (`id`, `status_name`) VALUES
(1, 'Not approved'),
(2, 'Pending'),
(3, 'In progress'),
(4, 'Rejected'),
(5, 'Approved');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
