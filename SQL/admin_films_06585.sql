-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 15 2015 г., 08:15
-- Версия сервера: 5.5.25
-- Версия PHP: 5.5.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `sp2111db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin_films_06585`
--

CREATE TABLE IF NOT EXISTS `admin_films_06585` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `admin_firstName` varchar(150) NOT NULL,
  `admin_secondName` varchar(150) NOT NULL,
  `admin_login` varchar(150) NOT NULL,
  `admin_password` varchar(150) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `admin_films_06585`
--

INSERT INTO `admin_films_06585` (`id_admin`, `admin_firstName`, `admin_secondName`, `admin_login`, `admin_password`) VALUES
(1, 'Bill', 'Gates', 'bill', '12345'),
(2, 'viky', 'Pa', 'v', 'p');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
