-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 15 2019 г., 05:56
-- Версия сервера: 5.7.24
-- Версия PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `meowboard`
--

-- --------------------------------------------------------

--
-- Структура таблицы `flag`
--

DROP TABLE IF EXISTS `flag`;
CREATE TABLE IF NOT EXISTS `flag` (
  `id_flag` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_flag` varchar(6) NOT NULL,
  PRIMARY KEY (`id_flag`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `flag`
--

INSERT INTO `flag` (`id_flag`, `name_flag`) VALUES
(1, 'акт'),
(2, 'отлож'),
(3, 'заверш');

-- --------------------------------------------------------

--
-- Структура таблицы `list_questions`
--

DROP TABLE IF EXISTS `list_questions`;
CREATE TABLE IF NOT EXISTS `list_questions` (
  `id_question` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `text_question` varchar(200) NOT NULL,
  `id_flag` int(11) UNSIGNED NOT NULL,
  `id_list_theme_questions` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_question`),
  KEY `id_list_theme_questions` (`id_list_theme_questions`),
  KEY `list_questions_ibfk_2` (`id_flag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `list_theme_questions`
--

DROP TABLE IF EXISTS `list_theme_questions`;
CREATE TABLE IF NOT EXISTS `list_theme_questions` (
  `id_list_theme_questions` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_theme_guestions` varchar(200) NOT NULL,
  PRIMARY KEY (`id_list_theme_questions`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id_quv` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_guestion` int(11) UNSIGNED NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `id_voice` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_quv`),
  KEY `id_user` (`id_user`),
  KEY `question_ibfk_2` (`id_voice`),
  KEY `question_ibfk_3` (`id_guestion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(65) NOT NULL,
  `pass` varchar(65) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id_user`, `login`, `pass`) VALUES
(1, 'Momy', '1ceff8a1bf75e430cf1fee53e65a4d44'),
(2, 'Laren', '1ceff8a1bf75e430cf1fee53e65a4d44'),
(3, 'Faaan', '1ceff8a1bf75e430cf1fee53e65a4d45');

-- --------------------------------------------------------

--
-- Структура таблицы `ut`
--

DROP TABLE IF EXISTS `ut`;
CREATE TABLE IF NOT EXISTS `ut` (
  `id_ut` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int(11) UNSIGNED NOT NULL,
  `id_team_question` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_ut`),
  KEY `id_user` (`id_user`),
  KEY `ut_ibfk_2` (`id_team_question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `voice`
--

DROP TABLE IF EXISTS `voice`;
CREATE TABLE IF NOT EXISTS `voice` (
  `id_voice` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mark` int(11) NOT NULL,
  PRIMARY KEY (`id_voice`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `voice`
--

INSERT INTO `voice` (`id_voice`, `mark`) VALUES
(1, -1),
(2, 0),
(3, 1);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `list_questions`
--
ALTER TABLE `list_questions`
  ADD CONSTRAINT `list_questions_ibfk_1` FOREIGN KEY (`id_list_theme_questions`) REFERENCES `list_theme_questions` (`id_list_theme_questions`),
  ADD CONSTRAINT `list_questions_ibfk_2` FOREIGN KEY (`id_flag`) REFERENCES `flag` (`id_flag`);

--
-- Ограничения внешнего ключа таблицы `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `question_ibfk_2` FOREIGN KEY (`id_voice`) REFERENCES `voice` (`id_voice`),
  ADD CONSTRAINT `question_ibfk_3` FOREIGN KEY (`id_guestion`) REFERENCES `list_questions` (`id_question`);

--
-- Ограничения внешнего ключа таблицы `ut`
--
ALTER TABLE `ut`
  ADD CONSTRAINT `ut_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `ut_ibfk_2` FOREIGN KEY (`id_team_question`) REFERENCES `list_theme_questions` (`id_list_theme_questions`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
