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
-- Структура таблицы `films_06585`
--

CREATE TABLE IF NOT EXISTS `films_06585` (
  `id_film` int(11) NOT NULL AUTO_INCREMENT,
  `name_film` varchar(150) DEFAULT NULL,
  `id_genre` int(11) NOT NULL,
  `id_director` int(11) NOT NULL,
  `img_path` varchar(150) NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_genre` (`id_genre`),
  KEY `id_director` (`id_director`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `films_06585`
--

INSERT INTO `films_06585` (`id_film`, `name_film`, `id_genre`, `id_director`, `img_path`) VALUES
(1, 'Леон', 1, 20, 'lion.jpg'),
(2, ' Пятый элемент', 3, 20, '1987.jpg'),
(3, 'Форрест Гамп', 8, 29, '220px-1994_Forrest_Gump.jpg'),
(4, 'Бойцовский клуб', 1, 28, '2599.jpg'),
(5, 'Начало', 6, 27, 'inception.jpg'),
(6, 'Интерстеллар', 6, 27, 'Interstellar_2014.jpg'),
(7, 'Матрица', 6, 30, 'Matrix.jpg'),
(8, 'Облачный Атлас', 7, 30, 'Cloud_Atlas.jpg'),
(9, 'Эффект бабочки', 6, 32, 'iphone360_5167.jpg'),
(10, 'Турист', 1, 33, '1379582174_turist.jpg'),
(11, ' Адвокат дьявола', 9, 32, 'S120xU.jpg');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `films_06585`
--
ALTER TABLE `films_06585`
  ADD CONSTRAINT `films_06585_ibfk_1` FOREIGN KEY (`id_genre`) REFERENCES `genres_06585` (`id_genre`),
  ADD CONSTRAINT `films_06585_ibfk_2` FOREIGN KEY (`id_director`) REFERENCES `directors_06585` (`id_director`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
