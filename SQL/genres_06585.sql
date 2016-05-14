-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 15 2015 г., 08:16
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
-- Структура таблицы `genres_06585`
--

CREATE TABLE IF NOT EXISTS `genres_06585` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `name_genre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `genres_06585`
--

INSERT INTO `genres_06585` (`id_genre`, `name_genre`) VALUES
(1, 'Боевик'),
(2, 'Детектив'),
(3, 'Комедия'),
(4, 'Ужасы'),
(5, 'Триллер'),
(6, 'Фантастика'),
(7, 'Фэнтези'),
(8, 'Мелодрама'),
(9, 'Драма');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
