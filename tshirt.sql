-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 30 2014 г., 21:37
-- Версия сервера: 5.6.20
-- Версия PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `tshirt`
--

-- --------------------------------------------------------

--
-- Структура таблицы `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
`id` int(11) NOT NULL,
  `new` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `small_image` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `offer`
--

INSERT INTO `offer` (`id`, `new`, `title`, `small_image`) VALUES
(8, 0, 'my tshirt', '5a36bb5448dbb7e711df0b1888436bc5_Desert.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(11) NOT NULL,
  `client` text NOT NULL,
  `products` text NOT NULL,
  `new` tinyint(4) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `client`, `products`, `new`, `date`) VALUES
(34, 'a:4:{s:5:"fname";s:12:"Максим";s:5:"lname";s:12:"Данько";s:5:"phone";s:11:"89061710540";s:7:"address";s:12:"Москва";}', 'a:1:{i:20;a:7:{s:2:"id";s:2:"20";s:5:"title";s:12:"Майка 1";s:11:"discription";s:23:"Черная майка";s:5:"price";s:7:"2000.00";s:2:"fm";s:1:"1";s:11:"small_image";s:44:"cd02b4bb944202e3a3444b190db84932_5013955.jpg";s:5:"count";i:1;}}', 0, '2014-11-25 15:05:09'),
(35, 'a:4:{s:5:"fname";s:14:"Дмитрий";s:5:"lname";s:16:"Коршунов";s:5:"phone";s:6:"552280";s:7:"address";s:8:"Крым";}', 'a:2:{i:21;a:7:{s:2:"id";s:2:"21";s:5:"title";s:12:"Майка 2";s:11:"discription";s:46:"Белая свободная футболка";s:5:"price";s:7:"2000.00";s:2:"fm";s:1:"1";s:11:"small_image";s:45:"d86c22fcbf8650bad44a3ce231f26b52_11229228.jpg";s:5:"count";i:1;}i:20;a:7:{s:2:"id";s:2:"20";s:5:"title";s:12:"Майка 1";s:11:"discription";s:23:"Черная майка";s:5:"price";s:7:"2000.00";s:2:"fm";s:1:"1";s:11:"small_image";s:44:"cd02b4bb944202e3a3444b190db84932_5013955.jpg";s:5:"count";i:1;}}', 0, '2014-11-28 00:22:29'),
(36, 'a:4:{s:5:"fname";s:12:"Данияр";s:5:"lname";s:20:"Усунгалиев";s:5:"phone";s:11:"89051612589";s:7:"address";s:17:"Кладбище ";}', 'a:1:{i:20;a:7:{s:2:"id";s:2:"20";s:5:"title";s:12:"Майка 1";s:11:"discription";s:23:"Черная майка";s:5:"price";s:7:"2000.00";s:2:"fm";s:1:"1";s:11:"small_image";s:44:"cd02b4bb944202e3a3444b190db84932_5013955.jpg";s:5:"count";i:3;}}', 0, '2014-11-28 14:56:34');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `discription` text NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `fm` tinyint(1) NOT NULL,
  `small_image` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `discription`, `price`, `fm`, `small_image`) VALUES
(20, 'Майка 1', 'Черная майка', '2000.00', 1, 'cd02b4bb944202e3a3444b190db84932_5013955.jpg'),
(21, 'Майка 2', 'Белая свободная футболка', '2000.00', 1, 'd86c22fcbf8650bad44a3ce231f26b52_11229228.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `role`) VALUES
(1, 'admin', 'ba4eb9755fa9e470036ab9c0aad3e875', '^&*(()', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
