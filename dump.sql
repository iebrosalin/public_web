-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 31 2020 г., 19:41
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `spa_test`
--
CREATE DATABASE IF NOT EXISTS `spa_test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `spa_test`;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `soname` varchar(255) NOT NULL,
  `burthday` date NOT NULL,
  `gender` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `role`, `name`, `soname`, `burthday`, `gender`) VALUES
(101, 'user0', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User0', 'UserSoname0', '2019-12-11', 'F'),
(102, 'user1', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User1', 'UserSoname1', '2019-12-11', 'F'),
(103, 'user2', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User2', 'UserSoname2', '2019-12-11', 'F'),
(104, 'user3', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User3', 'UserSoname3', '2019-12-11', 'F'),
(105, 'user4', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User4', 'UserSoname4', '2019-12-11', 'F'),
(106, 'user5', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User5', 'UserSoname5', '2019-12-11', 'F'),
(107, 'user6', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User6', 'UserSoname6', '2019-12-11', 'F'),
(108, 'user7', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User7', 'UserSoname7', '2019-12-11', 'F'),
(109, 'user8', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User8', 'UserSoname8', '2019-12-11', 'F'),
(110, 'user9', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User9', 'UserSoname9', '2019-12-11', 'F'),
(111, 'user10', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User10', 'UserSoname10', '2019-12-11', 'F'),
(112, 'user11', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User11', 'UserSoname11', '2019-12-11', 'F'),
(113, 'user12', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User12', 'UserSoname12', '2019-12-11', 'F'),
(114, 'user13', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User13', 'UserSoname13', '2019-12-11', 'F'),
(115, 'user14', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User14', 'UserSoname14', '2019-12-11', 'F'),
(116, 'user15', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User15', 'UserSoname15', '2019-12-11', 'F'),
(117, 'user16', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User16', 'UserSoname16', '2019-12-11', 'F'),
(118, 'user17', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User17', 'UserSoname17', '2019-12-11', 'F'),
(119, 'user18', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User18', 'UserSoname18', '2019-12-11', 'F'),
(120, 'user19', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User19', 'UserSoname19', '2019-12-11', 'F'),
(121, 'user20', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User20', 'UserSoname20', '2019-12-11', 'F'),
(122, 'user21', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User21', 'UserSoname21', '2019-12-11', 'F'),
(123, 'user22', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User22', 'UserSoname22', '2019-12-11', 'F'),
(124, 'user23', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User23', 'UserSoname23', '2019-12-11', 'F'),
(125, 'user24', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User24', 'UserSoname24', '2019-12-11', 'F'),
(126, 'user25', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User25', 'UserSoname25', '2019-12-11', 'F'),
(127, 'user26', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User26', 'UserSoname26', '2019-12-11', 'F'),
(128, 'user27', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User27', 'UserSoname27', '2019-12-11', 'F'),
(129, 'user28', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User28', 'UserSoname28', '2019-12-11', 'F'),
(130, 'user29', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User29', 'UserSoname29', '2019-12-11', 'F'),
(131, 'user30', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User30', 'UserSoname30', '2019-12-11', 'F'),
(132, 'user31', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User31', 'UserSoname31', '2019-12-11', 'F'),
(133, 'user32', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User32', 'UserSoname32', '2019-12-11', 'F'),
(134, 'user33', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User33', 'UserSoname33', '2019-12-11', 'F'),
(135, 'user34', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User34', 'UserSoname34', '2019-12-11', 'F'),
(136, 'user35', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User35', 'UserSoname35', '2019-12-11', 'F'),
(137, 'user36', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User36', 'UserSoname36', '2019-12-11', 'F'),
(138, 'user37', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User37', 'UserSoname37', '2019-12-11', 'F'),
(139, 'user38', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User38', 'UserSoname38', '2019-12-11', 'F'),
(140, 'user39', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User39', 'UserSoname39', '2019-12-11', 'F'),
(141, 'user40', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User40', 'UserSoname40', '2019-12-11', 'F'),
(142, 'user41', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User41', 'UserSoname41', '2019-12-11', 'F'),
(143, 'user42', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User42', 'UserSoname42', '2019-12-11', 'F'),
(144, 'user43', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User43', 'UserSoname43', '2019-12-11', 'F'),
(145, 'user44', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User44', 'UserSoname44', '2019-12-11', 'F'),
(146, 'user45', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User45', 'UserSoname45', '2019-12-11', 'F'),
(147, 'user46', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User46', 'UserSoname46', '2019-12-11', 'F'),
(148, 'user47', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User47', 'UserSoname47', '2019-12-11', 'F'),
(149, 'user48', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User48', 'UserSoname48', '2019-12-11', 'F'),
(150, 'user49', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User49', 'UserSoname49', '2019-12-11', 'F'),
(151, 'user50', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User50', 'UserSoname50', '2019-12-11', 'F'),
(152, 'user51', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User51', 'UserSoname51', '2019-12-11', 'F'),
(153, 'user52', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User52', 'UserSoname52', '2019-12-11', 'F'),
(154, 'user53', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User53', 'UserSoname53', '2019-12-11', 'F'),
(155, 'user54', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User54', 'UserSoname54', '2019-12-11', 'F'),
(156, 'user55', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User55', 'UserSoname55', '2019-12-11', 'F'),
(157, 'user56', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User56', 'UserSoname56', '2019-12-11', 'F'),
(158, 'user57', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User57', 'UserSoname57', '2019-12-11', 'F'),
(159, 'user58', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User58', 'UserSoname58', '2019-12-11', 'F'),
(160, 'user59', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User59', 'UserSoname59', '2019-12-11', 'F'),
(161, 'user60', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User60', 'UserSoname60', '2019-12-11', 'F'),
(162, 'user61', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User61', 'UserSoname61', '2019-12-11', 'F'),
(163, 'user62', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User62', 'UserSoname62', '2019-12-11', 'F'),
(164, 'user63', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User63', 'UserSoname63', '2019-12-11', 'F'),
(165, 'user64', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User64', 'UserSoname64', '2019-12-11', 'F'),
(166, 'user65', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User65', 'UserSoname65', '2019-12-11', 'F'),
(167, 'user66', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User66', 'UserSoname66', '2019-12-11', 'F'),
(168, 'user67', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User67', 'UserSoname67', '2019-12-11', 'F'),
(169, 'user68', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User68', 'UserSoname68', '2019-12-11', 'F'),
(170, 'user69', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User69', 'UserSoname69', '2019-12-11', 'F'),
(171, 'user70', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User70', 'UserSoname70', '2019-12-11', 'F'),
(172, 'user71', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User71', 'UserSoname71', '2019-12-11', 'F'),
(173, 'user72', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User72', 'UserSoname72', '2019-12-11', 'F'),
(174, 'user73', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User73', 'UserSoname73', '2019-12-11', 'F'),
(175, 'user74', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User74', 'UserSoname74', '2019-12-11', 'F'),
(176, 'user75', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User75', 'UserSoname75', '2019-12-11', 'F'),
(177, 'user76', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User76', 'UserSoname76', '2019-12-11', 'F'),
(178, 'user77', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User77', 'UserSoname77', '2019-12-11', 'F'),
(179, 'user78', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User78', 'UserSoname78', '2019-12-11', 'F'),
(180, 'user79', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User79', 'UserSoname79', '2019-12-11', 'F'),
(181, 'user80', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User80', 'UserSoname80', '2019-12-11', 'F'),
(182, 'user81', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User81', 'UserSoname81', '2019-12-11', 'F'),
(183, 'user82', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User82', 'UserSoname82', '2019-12-11', 'F'),
(184, 'user83', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User83', 'UserSoname83', '2019-12-11', 'F'),
(185, 'user84', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User84', 'UserSoname84', '2019-12-11', 'F'),
(186, 'user85', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User85', 'UserSoname85', '2019-12-11', 'F'),
(187, 'user86', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User86', 'UserSoname86', '2019-12-11', 'F'),
(188, 'user87', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User87', 'UserSoname87', '2019-12-11', 'F'),
(189, 'user88', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User88', 'UserSoname88', '2019-12-11', 'F'),
(190, 'user89', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User89', 'UserSoname89', '2019-12-11', 'F'),
(191, 'user90', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User90', 'UserSoname90', '2019-12-11', 'F'),
(192, 'user91', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User91', 'UserSoname91', '2019-12-11', 'F'),
(193, 'user92', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User92', 'UserSoname92', '2019-12-11', 'F'),
(194, 'user93', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User93', 'UserSoname93', '2019-12-11', 'F'),
(195, 'user94', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User94', 'UserSoname94', '2019-12-11', 'F'),
(196, 'user95', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User95', 'UserSoname95', '2019-12-11', 'F'),
(197, 'user96', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User96', 'UserSoname96', '2019-12-11', 'F'),
(198, 'user97', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User97', 'UserSoname97', '2019-12-11', 'F'),
(199, 'user98', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'User98', 'UserSoname98', '2019-12-11', 'F'),
(201, 'admin', '$2y$10$bNPUJlIdEDo2rDarUYk9GODKYYnjbud9LjKOxNG144RcwXQ7CXdtC', 'admin', 'Admin_Name', 'Admin_Soname', '2019-12-11', 'F'),
(210, 'OddUser201', '$2y$10$3QVpETqA9RlEA9w6B7QCf.fNpaSGHEfQIOEpFOdfIO42TcyKqUPbG', 'user', 'OddUser201', 'UserSoname99', '2019-12-11', 'F');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
