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
-- Структура таблицы `directors_06585`
--

CREATE TABLE IF NOT EXISTS `directors_06585` (
  `id_director` int(11) NOT NULL AUTO_INCREMENT,
  `name_director` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_director`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Дамп данных таблицы `directors_06585`
--

INSERT INTO `directors_06585` (`id_director`, `name_director`) VALUES
(2, 'Джордж Лукас'),
(3, 'Альфред Хичкок'),
(16, 'Акира Куросава'),
(20, 'Люк Бессон'),
(27, 'Кристофер Нолан'),
(28, 'Дэвид Финчер'),
(29, 'Роберт Земекис'),
(30, 'Лана Вачовски'),
(31, 'Гор Вербински'),
(32, 'Эрик Бресс'),
(33, 'Флориан Хенкель'),
(34, 'Тейлор Хэкфорд');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
