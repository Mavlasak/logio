-- Adminer 4.8.1 MySQL 8.0.32 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product` (`id`, `name`) VALUES
(1,	'produkc_cislo_1'),
(2,	'dwqdwqdwqd'),
(3,	'333333'),
(5,	'4564654'),
(7,	'78777'),
(8,	'ewfewfwefw'),
(9,	'156465456'),
(10,	'100000'),
(11,	'ůzpzpuů'),
(12,	'151615'),
(13,	'gegwegewg'),
(14,	'1541515');

-- 2023-07-16 17:12:00
