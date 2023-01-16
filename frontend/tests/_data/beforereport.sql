-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.4.11-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица autotesmer_test.appeal
CREATE TABLE IF NOT EXISTS `appeal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `dial_id` int(11) NOT NULL,
  `dispute_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.appeal: ~0 rows (приблизительно)
DELETE FROM `appeal`;
/*!40000 ALTER TABLE `appeal` DISABLE KEYS */;
/*!40000 ALTER TABLE `appeal` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.auth_assignment
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы autotesmer_test.auth_assignment: ~3 rows (приблизительно)
DELETE FROM `auth_assignment`;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
	('Администратор', '467', 1583216763),
	('Клиент', '469', 1584161620),
	('Эксперт', '468', 1584161603);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.auth_item
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы autotesmer_test.auth_item: ~34 rows (приблизительно)
DELETE FROM `auth_item`;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('accessArbitrage', 2, 'Доступ к арбитражу', NULL, NULL, 1583216763, 1583216763),
	('accessBackend', 2, 'Доступ к административному разделу', NULL, NULL, 1583216762, 1583216762),
	('accessBanners', 2, 'Доступ к баннерам', NULL, NULL, 1583216763, 1583216763),
	('accessCategories', 2, 'Доступ к категориям', NULL, NULL, 1583216763, 1583216763),
	('accessGroups', 2, 'Доступ к группам', NULL, NULL, 1583216763, 1583216763),
	('accessLK', 2, 'Доступ к личному кабинету', NULL, NULL, 1583216763, 1583216763),
	('accessMailing', 2, 'Доступ к рассылкам', NULL, NULL, 1583216763, 1583216763),
	('accessMailTemplates', 2, 'Доступ к почтовым шаблонам', NULL, NULL, 1583216763, 1583216763),
	('accessMenu', 2, 'Доступ к меню', NULL, NULL, 1583216763, 1583216763),
	('accessPackages', 2, 'Доступ к пакетам', NULL, NULL, 1583216763, 1583216763),
	('accessPages', 2, 'Доступ к страницам', NULL, NULL, 1583216763, 1583216763),
	('accessProfile', 2, 'Доступ к профилю', NULL, NULL, 1583216763, 1583216763),
	('accessPromocodes', 2, 'Доступ к промокодам', NULL, NULL, 1583216763, 1583216763),
	('accessRoles', 2, 'Доступ к ролям', NULL, NULL, 1583216763, 1583216763),
	('accessUsers', 2, 'Доступ к пользователям', NULL, NULL, 1583216762, 1583216762),
	('accessVerifications', 2, 'Доступ к проверкам документов', NULL, NULL, 1583216763, 1583216763),
	('createSiteReview', 2, 'Оставлять отзывы о сайте', NULL, NULL, 1583216762, 1583216762),
	('editArbitrage', 2, 'Редактирование арбитража', NULL, NULL, 1583216763, 1583216763),
	('editBanners', 2, 'Редактирование баннеров', NULL, NULL, 1583216763, 1583216763),
	('editCategories', 2, 'Редактирование категорий', NULL, NULL, 1583216763, 1583216763),
	('editGroups', 2, 'Редактирование групп', NULL, NULL, 1583216763, 1583216763),
	('editMailing', 2, 'Редактирование ролей', NULL, NULL, 1583216763, 1583216763),
	('editMailTemplates', 2, 'Редактирование почтовых шаблонов', NULL, NULL, 1583216763, 1583216763),
	('editMenu', 2, 'Управление меню', NULL, NULL, 1583216763, 1583216763),
	('editPackages', 2, 'Редактирование пакетов', NULL, NULL, 1583216763, 1583216763),
	('editPages', 2, 'Редактирование страниц', NULL, NULL, 1583216763, 1583216763),
	('editPromocodes', 2, 'Редактирование промокодов', NULL, NULL, 1583216763, 1583216763),
	('editRoles', 2, 'Редактирование ролей', NULL, NULL, 1583216763, 1583216763),
	('editUsers', 2, 'Редактирование пользователей', NULL, NULL, 1583216763, 1583216763),
	('editVerifications', 2, 'Управление проверкой документов', NULL, NULL, 1583216763, 1583216763),
	('Администратор', 1, 'Администратор', NULL, NULL, 1583216763, 1583216763),
	('Клиент', 1, 'Клиент', NULL, NULL, 1583216763, 1583216763),
	('Модератор', 1, 'Модератор', NULL, NULL, 1583216763, 1583216763),
	('Эксперт', 1, 'Эксперт', NULL, NULL, 1583216763, 1583216763);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.auth_item_child
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы autotesmer_test.auth_item_child: ~46 rows (приблизительно)
DELETE FROM `auth_item_child`;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('accessArbitrage', 'accessBackend'),
	('accessBanners', 'accessBackend'),
	('accessCategories', 'accessBackend'),
	('accessGroups', 'accessBackend'),
	('accessMailing', 'accessBackend'),
	('accessMailTemplates', 'accessBackend'),
	('accessMenu', 'accessBackend'),
	('accessPackages', 'accessBackend'),
	('accessPages', 'accessBackend'),
	('accessPromocodes', 'accessBackend'),
	('accessRoles', 'accessBackend'),
	('accessUsers', 'accessBackend'),
	('accessVerifications', 'accessBackend'),
	('editArbitrage', 'accessArbitrage'),
	('editBanners', 'accessBanners'),
	('editCategories', 'accessCategories'),
	('editGroups', 'accessGroups'),
	('editMailing', 'accessMailing'),
	('editMailTemplates', 'accessMailTemplates'),
	('editMenu', 'accessMenu'),
	('editPackages', 'accessPackages'),
	('editPages', 'accessPages'),
	('editPromocodes', 'accessPromocodes'),
	('editRoles', 'accessRoles'),
	('editUsers', 'accessUsers'),
	('editVerifications', 'accessVerifications'),
	('Администратор', 'createSiteReview'),
	('Администратор', 'editArbitrage'),
	('Администратор', 'editBanners'),
	('Администратор', 'editCategories'),
	('Администратор', 'editGroups'),
	('Администратор', 'editMailing'),
	('Администратор', 'editMailTemplates'),
	('Администратор', 'editMenu'),
	('Администратор', 'editPackages'),
	('Администратор', 'editPages'),
	('Администратор', 'editPromocodes'),
	('Администратор', 'editRoles'),
	('Администратор', 'editUsers'),
	('Администратор', 'editVerifications'),
	('Клиент', 'accessProfile'),
	('Клиент', 'createSiteReview'),
	('Модератор', 'editBanners'),
	('Модератор', 'editMailing'),
	('Эксперт', 'accessProfile'),
	('Эксперт', 'createSiteReview');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.auth_rule
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы autotesmer_test.auth_rule: ~0 rows (приблизительно)
DELETE FROM `auth_rule`;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.banners
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `view_counter` int(11) unsigned DEFAULT 0,
  `image` text DEFAULT NULL,
  `order` int(11) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 ROW_FORMAT=COMPACT;

-- Дамп данных таблицы autotesmer_test.banners: ~0 rows (приблизительно)
DELETE FROM `banners`;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.banner_group
CREATE TABLE IF NOT EXISTS `banner_group` (
  `banner_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.banner_group: ~0 rows (приблизительно)
DELETE FROM `banner_group`;
/*!40000 ALTER TABLE `banner_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `banner_group` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.banner_position
CREATE TABLE IF NOT EXISTS `banner_position` (
  `banner_id` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.banner_position: ~0 rows (приблизительно)
DELETE FROM `banner_position`;
/*!40000 ALTER TABLE `banner_position` DISABLE KEYS */;
/*!40000 ALTER TABLE `banner_position` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.brief
CREATE TABLE IF NOT EXISTS `brief` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) unsigned NOT NULL DEFAULT 0,
  `request_id` int(11) unsigned NOT NULL DEFAULT 0,
  `mark_id` int(11) unsigned DEFAULT NULL,
  `model_id` int(11) unsigned DEFAULT NULL,
  `price` float DEFAULT 0,
  `reward` float DEFAULT 0,
  `currency_id` int(11) DEFAULT 0,
  `engine_volume` int(11) DEFAULT 0,
  `kpp` int(11) DEFAULT 0,
  `drive` int(11) DEFAULT 0,
  `body` int(11) DEFAULT 0,
  `colors` varchar(100) DEFAULT '0',
  `year_from` int(11) DEFAULT 0,
  `mileage` int(11) DEFAULT 0 COMMENT 'Пробег',
  `additionally` text DEFAULT NULL,
  `about` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `dial_type` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.brief: ~1 rows (приблизительно)
DELETE FROM `brief`;
/*!40000 ALTER TABLE `brief` DISABLE KEYS */;
INSERT INTO `brief` (`id`, `order_id`, `request_id`, `mark_id`, `model_id`, `price`, `reward`, `currency_id`, `engine_volume`, `kpp`, `drive`, `body`, `colors`, `year_from`, `mileage`, `additionally`, `about`, `status`, `dial_type`) VALUES
	(11, 30, 28, 1, 1, 23, 20, 1, 2, 1, 1, 4, '0', 2000, 2, 'add', 'add', 3, 1);
/*!40000 ALTER TABLE `brief` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.cards
CREATE TABLE IF NOT EXISTS `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expire_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.cards: ~0 rows (приблизительно)
DELETE FROM `cards`;
/*!40000 ALTER TABLE `cards` DISABLE KEYS */;
/*!40000 ALTER TABLE `cards` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.card_registration_request
CREATE TABLE IF NOT EXISTS `card_registration_request` (
  `request_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT 0,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.card_registration_request: ~0 rows (приблизительно)
DELETE FROM `card_registration_request`;
/*!40000 ALTER TABLE `card_registration_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `card_registration_request` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(400) DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.category: ~0 rows (приблизительно)
DELETE FROM `category`;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) unsigned NOT NULL DEFAULT 0,
  `user1_id` int(10) unsigned NOT NULL DEFAULT 0,
  `user2_id` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.chat: ~1 rows (приблизительно)
DELETE FROM `chat`;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` (`id`, `owner_id`, `user1_id`, `user2_id`) VALUES
	(34, 30, 469, 468);
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.chat_messages
CREATE TABLE IF NOT EXISTS `chat_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chat_id` int(10) unsigned NOT NULL DEFAULT 0,
  `author_id` int(10) unsigned NOT NULL DEFAULT 0,
  `text` text NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `viewed` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.chat_messages: ~0 rows (приблизительно)
DELETE FROM `chat_messages`;
/*!40000 ALTER TABLE `chat_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_messages` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.city
CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.city: ~84 rows (приблизительно)
DELETE FROM `city`;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` (`id`, `name`) VALUES
	(1, 'Майкоп'),
	(2, 'Горно-Алтайск'),
	(3, 'Уфа'),
	(4, 'Улан-Удэ'),
	(5, 'Махачкала'),
	(6, 'Магас'),
	(7, 'Нальчик'),
	(8, 'Элиста'),
	(9, 'Черкесск'),
	(10, 'Петрозаводск'),
	(11, 'Сыктывкар'),
	(12, 'Симферополь'),
	(13, 'Йошкар-Ола'),
	(14, 'Саранск'),
	(15, 'Якутск'),
	(16, 'Владикавказ'),
	(17, 'Казань'),
	(18, 'Кызыл'),
	(19, 'Ижевск'),
	(20, 'Абакан'),
	(21, 'Грозный'),
	(22, 'Чебоксары'),
	(23, 'Барнаул'),
	(24, 'Чита'),
	(25, 'Петропавловск-Камчатский'),
	(26, 'Краснодар'),
	(27, 'Красноярск'),
	(28, 'Пермь'),
	(29, 'Владивосток'),
	(30, 'Ставрополь'),
	(31, 'Хабаровск'),
	(32, 'Благовещенск'),
	(33, 'Архангельск'),
	(34, 'Астрахань'),
	(35, 'Белгород'),
	(36, 'Брянск'),
	(37, 'Владимир'),
	(38, 'Волгоград'),
	(39, 'Вологда'),
	(40, 'Воронеж'),
	(41, 'Иваново'),
	(42, 'Иркутск'),
	(43, 'Калининград'),
	(44, 'Калуга'),
	(45, 'Кемерово'),
	(46, 'Киров'),
	(47, 'Кострома'),
	(48, 'Курган'),
	(49, 'Курск'),
	(50, 'Санкт-Петербург'),
	(51, 'Липецк'),
	(52, 'Магадан'),
	(53, 'Москва'),
	(54, 'Мурманск'),
	(55, 'Нижний Новгород'),
	(56, 'Великий Новгород'),
	(57, 'Новосибирск'),
	(58, 'Омск'),
	(59, 'Оренбург'),
	(60, 'Орёл'),
	(61, 'Пенза'),
	(62, 'Псков'),
	(63, 'Ростов-на-Дону'),
	(64, 'Рязань'),
	(65, 'Самара'),
	(66, 'Саратов'),
	(67, 'Южно-Сахалинск'),
	(68, 'Екатеринбург'),
	(69, 'Смоленск'),
	(70, 'Тамбов'),
	(71, 'Тверь'),
	(72, 'Томск'),
	(73, 'Тула'),
	(74, 'Тюмень'),
	(75, 'Ульяновск'),
	(76, 'Челябинск'),
	(77, 'Ярославль'),
	(79, 'Санкт-Петербург'),
	(80, 'Севастополь'),
	(81, 'Биробиджан'),
	(82, 'Нарьян-Мар'),
	(83, 'Ханты-Мансийск'),
	(84, 'Анадырь'),
	(85, 'Салехард');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.country
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=219 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.country: ~218 rows (приблизительно)
DELETE FROM `country`;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` (`id`, `name`) VALUES
	(1, 'Абхазия'),
	(2, 'Австралия'),
	(3, 'Австрия'),
	(4, 'Азербайджан'),
	(5, 'Албания'),
	(6, 'Алжир'),
	(7, 'Ангола'),
	(8, 'Ангуилья'),
	(9, 'Андорра'),
	(10, 'Антигуа и Барбуда'),
	(11, 'Антильские о-ва'),
	(12, 'Аргентина'),
	(13, 'Армения'),
	(14, 'Арулько'),
	(15, 'Афганистан'),
	(16, 'Багамские о-ва'),
	(17, 'Бангладеш'),
	(18, 'Барбадос'),
	(19, 'Бахрейн'),
	(20, 'Беларусь'),
	(21, 'Белиз'),
	(22, 'Бельгия'),
	(23, 'Бенин'),
	(24, 'Бермуды'),
	(25, 'Болгария'),
	(26, 'Боливия'),
	(27, 'Босния/Герцеговина'),
	(28, 'Ботсвана'),
	(29, 'Бразилия'),
	(30, 'Британские Виргинские о-ва'),
	(31, 'Бруней'),
	(32, 'Буркина Фасо'),
	(33, 'Бурунди'),
	(34, 'Бутан'),
	(35, 'Валлис и Футуна о-ва'),
	(36, 'Вануату'),
	(37, 'Великобритания'),
	(38, 'Венгрия'),
	(39, 'Венесуэла'),
	(40, 'Восточный Тимор'),
	(41, 'Вьетнам'),
	(42, 'Габон'),
	(43, 'Гаити'),
	(44, 'Гайана'),
	(45, 'Гамбия'),
	(46, 'Гана'),
	(47, 'Гваделупа'),
	(48, 'Гватемала'),
	(49, 'Гвинея'),
	(50, 'Гвинея-Бисау'),
	(51, 'Германия'),
	(52, 'Гернси о-в'),
	(53, 'Гибралтар'),
	(54, 'Гондурас'),
	(55, 'Гонконг'),
	(56, 'Гренада'),
	(57, 'Гренландия'),
	(58, 'Греция'),
	(59, 'Грузия'),
	(60, 'Дания'),
	(61, 'Джерси о-в'),
	(62, 'Джибути'),
	(63, 'Доминиканская республика'),
	(64, 'Египет'),
	(65, 'Замбия'),
	(66, 'Западная Сахара'),
	(67, 'Зимбабве'),
	(68, 'Израиль'),
	(69, 'Индия'),
	(70, 'Индонезия'),
	(71, 'Иордания'),
	(72, 'Ирак'),
	(73, 'Иран'),
	(74, 'Ирландия'),
	(75, 'Исландия'),
	(76, 'Испания'),
	(77, 'Италия'),
	(78, 'Йемен'),
	(79, 'Кабо-Верде'),
	(80, 'Казахстан'),
	(81, 'Камбоджа'),
	(82, 'Камерун'),
	(83, 'Канада'),
	(84, 'Катар'),
	(85, 'Кения'),
	(86, 'Кипр'),
	(87, 'Кирибати'),
	(88, 'Китай'),
	(89, 'Колумбия'),
	(90, 'Коморские о-ва'),
	(91, 'Конго (Brazzaville)'),
	(92, 'Конго (Kinshasa)'),
	(93, 'Коста-Рика'),
	(94, 'Кот-д\'\'Ивуар'),
	(95, 'Куба'),
	(96, 'Кувейт'),
	(97, 'Кука о-ва'),
	(98, 'Кыргызстан'),
	(99, 'Лаос'),
	(100, 'Латвия'),
	(101, 'Лесото'),
	(102, 'Либерия'),
	(103, 'Ливан'),
	(104, 'Ливия'),
	(105, 'Литва'),
	(106, 'Лихтенштейн'),
	(107, 'Люксембург'),
	(108, 'Маврикий'),
	(109, 'Мавритания'),
	(110, 'Мадагаскар'),
	(111, 'Македония'),
	(112, 'Малави'),
	(113, 'Малайзия'),
	(114, 'Мали'),
	(115, 'Мальдивские о-ва'),
	(116, 'Мальта'),
	(117, 'Марокко'),
	(118, 'Мартиника о-в'),
	(119, 'Мексика'),
	(120, 'Мозамбик'),
	(121, 'Молдова'),
	(122, 'Монако'),
	(123, 'Монголия'),
	(124, 'Мьянма (Бирма)'),
	(125, 'Мэн о-в'),
	(126, 'Намибия'),
	(127, 'Науру'),
	(128, 'Непал'),
	(129, 'Нигер'),
	(130, 'Нигерия'),
	(131, 'Нидерланды (Голландия)'),
	(132, 'Никарагуа'),
	(133, 'Новая Зеландия'),
	(134, 'Новая Каледония о-в'),
	(135, 'Норвегия'),
	(136, 'Норфолк о-в'),
	(137, 'О.А.Э.'),
	(138, 'Оман'),
	(139, 'Пакистан'),
	(140, 'Панама'),
	(141, 'Папуа Новая Гвинея'),
	(142, 'Парагвай'),
	(143, 'Перу'),
	(144, 'Питкэрн о-в'),
	(145, 'Польша'),
	(146, 'Португалия'),
	(147, 'Пуэрто Рико'),
	(148, 'Реюньон'),
	(149, 'Россия'),
	(150, 'Руанда'),
	(151, 'Румыния'),
	(152, 'США'),
	(153, 'Сальвадор'),
	(154, 'Самоа'),
	(155, 'Сан-Марино'),
	(156, 'Сан-Томе и Принсипи'),
	(157, 'Саудовская Аравия'),
	(158, 'Свазиленд'),
	(159, 'Святая Люсия'),
	(160, 'Святой Елены о-в'),
	(161, 'Северная Корея'),
	(162, 'Сейшеллы'),
	(163, 'Сен-Пьер и Микелон'),
	(164, 'Сенегал'),
	(165, 'Сент Китс и Невис'),
	(166, 'Сент-Винсент и Гренадины'),
	(167, 'Сербия'),
	(168, 'Сингапур'),
	(169, 'Сирия'),
	(170, 'Словакия'),
	(171, 'Словения'),
	(172, 'Соломоновы о-ва'),
	(173, 'Сомали'),
	(174, 'Судан'),
	(175, 'Суринам'),
	(176, 'Сьерра-Леоне'),
	(177, 'Таджикистан'),
	(178, 'Таиланд'),
	(179, 'Тайвань'),
	(180, 'Танзания'),
	(181, 'Того'),
	(182, 'Токелау о-ва'),
	(183, 'Тонга'),
	(184, 'Тринидад и Тобаго'),
	(185, 'Тувалу'),
	(186, 'Тунис'),
	(187, 'Туркменистан'),
	(188, 'Туркс и Кейкос'),
	(189, 'Турция'),
	(190, 'Уганда'),
	(191, 'Узбекистан'),
	(192, 'Украина'),
	(193, 'Уругвай'),
	(194, 'Фарерские о-ва'),
	(195, 'Фиджи'),
	(196, 'Филиппины'),
	(197, 'Финляндия'),
	(198, 'Франция'),
	(199, 'Французская Гвинея'),
	(200, 'Французская Полинезия'),
	(201, 'Хорватия'),
	(202, 'Чад'),
	(203, 'Черногория'),
	(204, 'Чехия'),
	(205, 'Чили'),
	(206, 'Швейцария'),
	(207, 'Швеция'),
	(208, 'Шри-Ланка'),
	(209, 'Эквадор'),
	(210, 'Экваториальная Гвинея'),
	(211, 'Эритрея'),
	(212, 'Эстония'),
	(213, 'Эфиопия'),
	(214, 'ЮАР'),
	(215, 'Южная Корея'),
	(216, 'Южная Осетия'),
	(217, 'Ямайка'),
	(218, 'Япония');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.currency
CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `abbr` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.currency: ~0 rows (приблизительно)
DELETE FROM `currency`;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` (`id`, `abbr`) VALUES
	(1, 'RUB');
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.dial
CREATE TABLE IF NOT EXISTS `dial` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payout_id` int(10) unsigned DEFAULT NULL,
  `payment_id` int(10) unsigned DEFAULT NULL,
  `type` int(10) unsigned NOT NULL,
  `status` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `reward` float unsigned NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `chat_id` int(10) unsigned NOT NULL,
  `expert_id` int(10) unsigned NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `dispute_id` int(11) DEFAULT NULL,
  `brief_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.dial: ~1 rows (приблизительно)
DELETE FROM `dial`;
/*!40000 ALTER TABLE `dial` DISABLE KEYS */;
INSERT INTO `dial` (`id`, `payout_id`, `payment_id`, `type`, `status`, `order_id`, `reward`, `client_id`, `chat_id`, `expert_id`, `request_id`, `dispute_id`, `brief_id`) VALUES
	(34, NULL, NULL, 1, 2, 30, 20, 469, 34, 468, 28, NULL, 11);
/*!40000 ALTER TABLE `dial` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.dispute
CREATE TABLE IF NOT EXISTS `dispute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_chat_id` int(11) DEFAULT NULL,
  `expert_chat_id` int(11) DEFAULT NULL,
  `dial_chat_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `dial_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `client_appeal_id` int(11) DEFAULT NULL,
  `expert_appeal_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.dispute: ~0 rows (приблизительно)
DELETE FROM `dispute`;
/*!40000 ALTER TABLE `dispute` DISABLE KEYS */;
/*!40000 ALTER TABLE `dispute` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.emul_card_registration
CREATE TABLE IF NOT EXISTS `emul_card_registration` (
  `request_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `token` text NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.emul_card_registration: ~0 rows (приблизительно)
DELETE FROM `emul_card_registration`;
/*!40000 ALTER TABLE `emul_card_registration` DISABLE KEYS */;
/*!40000 ALTER TABLE `emul_card_registration` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.emul_operations
CREATE TABLE IF NOT EXISTS `emul_operations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.emul_operations: ~0 rows (приблизительно)
DELETE FROM `emul_operations`;
/*!40000 ALTER TABLE `emul_operations` DISABLE KEYS */;
/*!40000 ALTER TABLE `emul_operations` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.favorites
CREATE TABLE IF NOT EXISTS `favorites` (
  `client_id` int(10) unsigned NOT NULL,
  `expert_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.favorites: ~0 rows (приблизительно)
DELETE FROM `favorites`;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `chat_id` int(10) unsigned NOT NULL,
  `dest` text NOT NULL,
  `image` text DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.files: ~0 rows (приблизительно)
DELETE FROM `files`;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.groups: ~0 rows (приблизительно)
DELETE FROM `groups`;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.langs
CREATE TABLE IF NOT EXISTS `langs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abbr` varchar(50) NOT NULL,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.langs: ~2 rows (приблизительно)
DELETE FROM `langs`;
/*!40000 ALTER TABLE `langs` DISABLE KEYS */;
INSERT INTO `langs` (`id`, `abbr`, `label`) VALUES
	(1, 'ru', 'Русский'),
	(2, 'en', 'Английский');
/*!40000 ALTER TABLE `langs` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.mailing
CREATE TABLE IF NOT EXISTS `mailing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(400) DEFAULT NULL,
  `promocodes_set_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `shedule` datetime DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `executed` int(11) DEFAULT 0,
  `execution_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 ROW_FORMAT=COMPACT;

-- Дамп данных таблицы autotesmer_test.mailing: ~0 rows (приблизительно)
DELETE FROM `mailing`;
/*!40000 ALTER TABLE `mailing` DISABLE KEYS */;
/*!40000 ALTER TABLE `mailing` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.mailing_group
CREATE TABLE IF NOT EXISTS `mailing_group` (
  `mailing_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.mailing_group: ~0 rows (приблизительно)
DELETE FROM `mailing_group`;
/*!40000 ALTER TABLE `mailing_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `mailing_group` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.mailing_roles
CREATE TABLE IF NOT EXISTS `mailing_roles` (
  `mailing_id` int(11) DEFAULT NULL,
  `role_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.mailing_roles: ~0 rows (приблизительно)
DELETE FROM `mailing_roles`;
/*!40000 ALTER TABLE `mailing_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `mailing_roles` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.mail_templates
CREATE TABLE IF NOT EXISTS `mail_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(400) DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 ROW_FORMAT=COMPACT;

-- Дамп данных таблицы autotesmer_test.mail_templates: ~0 rows (приблизительно)
DELETE FROM `mail_templates`;
/*!40000 ALTER TABLE `mail_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `mail_templates` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.mark_car
CREATE TABLE IF NOT EXISTS `mark_car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.mark_car: ~2 rows (приблизительно)
DELETE FROM `mark_car`;
/*!40000 ALTER TABLE `mark_car` DISABLE KEYS */;
INSERT INTO `mark_car` (`id`, `name`) VALUES
	(1, 'BMW'),
	(2, 'AUDI');
/*!40000 ALTER TABLE `mark_car` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf16 ROW_FORMAT=COMPACT;

-- Дамп данных таблицы autotesmer_test.menu: ~5 rows (приблизительно)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `name`) VALUES
	(13, 'main_menu'),
	(14, 'Левое меню в подвале'),
	(15, 'Правое меню в подвале'),
	(16, 'Меню 1'),
	(21, 'вафцуйцууй');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.menu_items
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned DEFAULT NULL,
  `name` text DEFAULT NULL,
  `order` int(11) unsigned NOT NULL DEFAULT 0,
  `url` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.menu_items: ~16 rows (приблизительно)
DELETE FROM `menu_items`;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` (`id`, `menu_id`, `name`, `order`, `url`) VALUES
	(3, 13, 'Эксперты', 2, '/site/experts'),
	(4, 13, 'О проекте', 1, '/about'),
	(5, 13, 'Заказы', 3, '/orders'),
	(6, 13, 'Помощь', 4, '/help'),
	(7, 13, 'Контакты', 5, '/contacts'),
	(8, 13, 'пробная страница', 10, '/page/alias'),
	(9, 15, 'Контакты', 1, '/contacts'),
	(10, 15, 'Видео', 2, '/videos'),
	(11, 15, 'Личный кабинет', 3, 'link'),
	(12, 15, 'Политика конфиденциальности', 4, '/politic'),
	(13, 14, 'О проекте', 1, '/about'),
	(14, 14, 'Помощь', 2, '/help'),
	(15, 14, 'Безопасность', 3, '/safety'),
	(16, 14, 'Реклама на сайте', 4, '/adv'),
	(17, 16, 'Пункт 1', 323, 'asdas asdasd asdasd'),
	(26, 21, 'фывафвфы', 1, 'page1 фывфы фывфыв');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.menu_position
CREATE TABLE IF NOT EXISTS `menu_position` (
  `menu_id` int(10) unsigned DEFAULT NULL,
  `position_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.menu_position: ~7 rows (приблизительно)
DELETE FROM `menu_position`;
/*!40000 ALTER TABLE `menu_position` DISABLE KEYS */;
INSERT INTO `menu_position` (`menu_id`, `position_id`) VALUES
	(13, '1'),
	(14, '3'),
	(15, '2'),
	(16, '1'),
	(16, '3'),
	(21, '2'),
	(21, '3');
/*!40000 ALTER TABLE `menu_position` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.menu_positions
CREATE TABLE IF NOT EXISTS `menu_positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.menu_positions: ~3 rows (приблизительно)
DELETE FROM `menu_positions`;
/*!40000 ALTER TABLE `menu_positions` DISABLE KEYS */;
INSERT INTO `menu_positions` (`id`, `name`) VALUES
	(1, 'main_menu'),
	(2, 'footer_2'),
	(3, 'footer_1');
/*!40000 ALTER TABLE `menu_positions` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.migration: ~4 rows (приблизительно)
DELETE FROM `migration`;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1566250585),
	('m140506_102106_rbac_init', 1566250637),
	('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1566250637),
	('m180523_151638_rbac_updates_indexes_without_prefix', 1566250637);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.model_car
CREATE TABLE IF NOT EXISTS `model_car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mark` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.model_car: ~7 rows (приблизительно)
DELETE FROM `model_car`;
/*!40000 ALTER TABLE `model_car` DISABLE KEYS */;
INSERT INTO `model_car` (`id`, `mark`, `name`) VALUES
	(1, 1, 'M8'),
	(2, 1, 'X1'),
	(3, 1, 'X2'),
	(4, 1, 'X3'),
	(5, 2, 'RS4'),
	(6, 2, 'RS5'),
	(7, 2, 'RS6');
/*!40000 ALTER TABLE `model_car` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.notice_settings
CREATE TABLE IF NOT EXISTS `notice_settings` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `events` bit(1) NOT NULL DEFAULT b'1',
  `documents_approved` bit(1) NOT NULL DEFAULT b'1',
  `works_in_your_region` bit(1) NOT NULL DEFAULT b'1',
  `expertize_approved` bit(1) NOT NULL DEFAULT b'1',
  `client_created_appeal` bit(1) NOT NULL DEFAULT b'1',
  `wait_payment` bit(1) NOT NULL DEFAULT b'1',
  `card_registered` bit(1) NOT NULL DEFAULT b'1',
  `review_added` bit(1) NOT NULL DEFAULT b'1',
  `package_obtained` bit(1) NOT NULL DEFAULT b'1',
  `arbitration_closed` bit(1) NOT NULL DEFAULT b'1',
  `your_info_changed` bit(1) NOT NULL DEFAULT b'1',
  `new_request` bit(1) NOT NULL DEFAULT b'1',
  `admin_message` bit(1) NOT NULL DEFAULT b'1',
  `you_created_appeal` bit(1) NOT NULL DEFAULT b'1',
  `report_received` bit(1) NOT NULL DEFAULT b'1',
  `you_ordered_a_selection` bit(1) NOT NULL DEFAULT b'1',
  `you_made_a_deposit` bit(1) NOT NULL DEFAULT b'1',
  `you_have_secured_a_deal` bit(1) NOT NULL DEFAULT b'1',
  `you_confirmed_work` bit(1) NOT NULL DEFAULT b'1',
  `new_verification` bit(1) DEFAULT b'1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=470 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.notice_settings: ~3 rows (приблизительно)
DELETE FROM `notice_settings`;
/*!40000 ALTER TABLE `notice_settings` DISABLE KEYS */;
INSERT INTO `notice_settings` (`user_id`, `events`, `documents_approved`, `works_in_your_region`, `expertize_approved`, `client_created_appeal`, `wait_payment`, `card_registered`, `review_added`, `package_obtained`, `arbitration_closed`, `your_info_changed`, `new_request`, `admin_message`, `you_created_appeal`, `report_received`, `you_ordered_a_selection`, `you_made_a_deposit`, `you_have_secured_a_deal`, `you_confirmed_work`, `new_verification`) VALUES
	(467, b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1'),
	(468, b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1'),
	(469, b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1');
/*!40000 ALTER TABLE `notice_settings` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `target_user` int(10) unsigned DEFAULT NULL,
  `readed` int(10) unsigned DEFAULT 0,
  `time` datetime DEFAULT current_timestamp(),
  `content` text DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `params` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.notifications: ~2 rows (приблизительно)
DELETE FROM `notifications`;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` (`id`, `target_user`, `readed`, `time`, `content`, `type_id`, `params`) VALUES
	(186, 469, 0, '2020-03-14 09:54:55', 'Вы заказали услуги эксперта на день на сумму 20000 - 30000 RUB', 36, '{"order_id":30,"target_user":469,"time":"2020:03:14 09:54:54"}'),
	(187, 469, 0, '2020-03-14 09:55:32', 'По вашей заявке поступило новое предложение от эксперта Клиентов К. К.', 32, '{"target_user":469,"time":"2020:03:14 09:55:32"}');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.notification_types
CREATE TABLE IF NOT EXISTS `notification_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `renderer` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.notification_types: ~26 rows (приблизительно)
DELETE FROM `notification_types`;
/*!40000 ALTER TABLE `notification_types` DISABLE KEYS */;
INSERT INTO `notification_types` (`id`, `name`, `renderer`, `description`) VALUES
	(21, 'events', 'NoticeEvents', 'Акция'),
	(22, 'documents_approved', 'NoticeDocumentsApproved', 'Ваши документы прошли проверку'),
	(23, 'works_in_your_region', 'NoticeWorksInYourRegion', 'В вашем регионе опубликовано..'),
	(24, 'expertize_approved', 'NoticeExpertizeApproved', 'Вы прошли экспертизу'),
	(25, 'client_created_appeal', 'NoticeClientCreatedAppeal', 'Клиент открыл арбитраж'),
	(26, 'wait_payment', 'NoticeWaitPayment', 'Клиент подтвердил выполнение задания'),
	(27, 'card_registered', 'NoticeCardRegistered', 'Ваша карта была успешно привязана'),
	(28, 'review_added', 'NoticeReviewAdded', 'Вам оставили новый отзыв'),
	(29, 'package_obtained', 'NoticePackageObtained', 'Приобретен пакет'),
	(30, 'arbitration_closed', 'NoticeArbitrationClosed', 'Арбитраж завершил рассмотрение вашего спора'),
	(31, 'your_info_changed', 'NoticeYourInfoChanged', 'Данные в вашем профиле были изменены'),
	(32, 'new_request', 'NoticeNewRequest', 'Новая заявка'),
	(33, 'admin_message', 'NoticeAdminMessage', 'Уведомления об внесении изменений в работе сервиса'),
	(34, 'you_created_appeal', 'NoticeYouCreatedAppeal', 'Вы открыли арбитраж'),
	(35, 'report_received', 'NoticeReportReceived', 'По вашему заказу получен новый отчет'),
	(36, 'you_ordered_a_selection', 'NoticeYouOrderedASelection', 'Вы заказали подбор'),
	(37, 'you_made_a_deposit', 'NoticeYouMadeADeposit', 'Вы внесли депозит'),
	(38, 'you_have_secured_a_deal', 'NoticeYouHaveSecuredADeal', 'Вы заключили безопасную сделку'),
	(39, 'you_confirmed_work', 'NoticeYouConfirmedWork', 'Вы подтвердили выполнение работы'),
	(40, 'new_verification', 'NoticeNewVerification', 'Новая верификация'),
	(47, 'reverse_failed', 'NoticeReverseFailed', 'Возврат не выполнен'),
	(48, 'reward_failed', 'NoticeRewardFailed', 'Награда не выплачена'),
	(49, 'refund_failed', 'NoticeRefundFailed', 'Возврат вознаграждения не выполнен'),
	(50, 'reward_paid', 'NoticeRewardPaid', 'Награда выплачена'),
	(51, 'refund_paid', 'NoticeRefundPaid', 'Возврат вознаграждения выполнен'),
	(52, 'reverse_success', 'NoticeReverseSuccess', 'Возврат выполнен');
/*!40000 ALTER TABLE `notification_types` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `body` int(10) unsigned DEFAULT NULL,
  `original_body` int(10) unsigned DEFAULT NULL,
  `dial_id` int(10) unsigned DEFAULT NULL,
  `status` int(10) unsigned NOT NULL,
  `client_city` int(10) unsigned DEFAULT NULL,
  `drive` int(10) unsigned DEFAULT NULL,
  `engine` int(10) unsigned DEFAULT NULL,
  `transmission` int(10) unsigned DEFAULT NULL,
  `mark_id` int(10) unsigned DEFAULT NULL,
  `model_id` int(10) unsigned DEFAULT NULL,
  `original_mark` int(10) unsigned DEFAULT NULL,
  `mass` int(10) unsigned DEFAULT NULL,
  `original_pts` int(10) unsigned DEFAULT NULL,
  `currency_id` int(10) unsigned DEFAULT NULL,
  `year_from` int(10) unsigned DEFAULT NULL,
  `original_year_from` int(10) unsigned DEFAULT NULL,
  `year_to` int(10) unsigned DEFAULT NULL,
  `type` int(10) unsigned DEFAULT NULL,
  `category` int(10) unsigned DEFAULT NULL,
  `budget_from` float DEFAULT NULL,
  `budget_to` float DEFAULT NULL,
  `published` int(11) DEFAULT NULL,
  `publication_date` datetime DEFAULT NULL,
  `engine_volume_from` int(11) DEFAULT NULL,
  `engine_volume_to` int(11) DEFAULT NULL,
  `moto_hours_from` int(11) DEFAULT NULL,
  `moto_category` int(11) DEFAULT NULL,
  `water_category` int(11) DEFAULT NULL,
  `moto_hours_to` int(11) DEFAULT NULL,
  `commerce_category` int(11) DEFAULT NULL,
  `gbo` int(11) DEFAULT NULL,
  `power_from` int(11) DEFAULT NULL,
  `power_to` int(11) DEFAULT NULL,
  `period_from` int(11) DEFAULT NULL,
  `period_to` int(11) DEFAULT NULL,
  `expert_id` int(11) DEFAULT 0,
  `closed` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.orders: ~1 rows (приблизительно)
DELETE FROM `orders`;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `client_id`, `comment`, `body`, `original_body`, `dial_id`, `status`, `client_city`, `drive`, `engine`, `transmission`, `mark_id`, `model_id`, `original_mark`, `mass`, `original_pts`, `currency_id`, `year_from`, `original_year_from`, `year_to`, `type`, `category`, `budget_from`, `budget_to`, `published`, `publication_date`, `engine_volume_from`, `engine_volume_to`, `moto_hours_from`, `moto_category`, `water_category`, `moto_hours_to`, `commerce_category`, `gbo`, `power_from`, `power_to`, `period_from`, `period_to`, `expert_id`, `closed`) VALUES
	(30, 469, 'Comment text', 4, 4, 34, 3, 20, 1, 1, 1, 1, 1, 1, NULL, 0, 1, 2000, 1890, 2020, 2, 1, 20000, 30000, 1, '2020-03-14 09:54:54', 0, 10, NULL, NULL, NULL, NULL, NULL, NULL, 10, 1000, 10, 20, 468, 0);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.order_category
CREATE TABLE IF NOT EXISTS `order_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.order_category: ~0 rows (приблизительно)
DELETE FROM `order_category`;
/*!40000 ALTER TABLE `order_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_category` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.packages
CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16 ROW_FORMAT=COMPACT;

-- Дамп данных таблицы autotesmer_test.packages: ~0 rows (приблизительно)
DELETE FROM `packages`;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` (`id`, `name`, `created`) VALUES
	(1, 'Пакет Бегемот', '2019-07-21 20:53:01');
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.package_variant
CREATE TABLE IF NOT EXISTS `package_variant` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `base_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(400) DEFAULT NULL,
  `price` float DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.package_variant: ~3 rows (приблизительно)
DELETE FROM `package_variant`;
/*!40000 ALTER TABLE `package_variant` DISABLE KEYS */;
INSERT INTO `package_variant` (`id`, `base_id`, `name`, `price`) VALUES
	(1, 1, 'Месяц Бегемота', 1000),
	(2, 1, 'Полгода Бегемота', 10000),
	(3, 1, 'Год Бегемота', 20000);
/*!40000 ALTER TABLE `package_variant` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `url` text NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.pages: ~0 rows (приблизительно)
DELETE FROM `pages`;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.passport_verification
CREATE TABLE IF NOT EXISTS `passport_verification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT 0,
  `passport_photo_verified` int(10) unsigned NOT NULL DEFAULT 0,
  `passport_selfie_verified` int(10) unsigned NOT NULL DEFAULT 0,
  `status` int(10) unsigned NOT NULL DEFAULT 0,
  `passport_photo` text NOT NULL,
  `passport_selfie` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `verification_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.passport_verification: ~0 rows (приблизительно)
DELETE FROM `passport_verification`;
/*!40000 ALTER TABLE `passport_verification` DISABLE KEYS */;
/*!40000 ALTER TABLE `passport_verification` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.payment
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `target` int(11) DEFAULT NULL,
  `status` int(10) unsigned NOT NULL,
  `sum` float unsigned NOT NULL DEFAULT 0,
  `currency_id` int(11) NOT NULL,
  `service_name` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `refno` int(11) DEFAULT NULL,
  `promocode` int(11) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `base_sum` float DEFAULT NULL,
  `promocode_set` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.payment: ~1 rows (приблизительно)
DELETE FROM `payment`;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` (`id`, `type`, `user_id`, `target`, `status`, `sum`, `currency_id`, `service_name`, `created`, `refno`, `promocode`, `discount`, `base_sum`, `promocode_set`) VALUES
	(35, 2, 468, 7, 2, 1000, 0, 'Оплата пакета', '2020-03-14 09:53:55', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.payout
CREATE TABLE IF NOT EXISTS `payout` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` int(10) unsigned NOT NULL,
  `dial_id` int(10) unsigned NOT NULL,
  `target` int(10) unsigned NOT NULL,
  `sum` double unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.payout: ~0 rows (приблизительно)
DELETE FROM `payout`;
/*!40000 ALTER TABLE `payout` DISABLE KEYS */;
/*!40000 ALTER TABLE `payout` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.promocodes
CREATE TABLE IF NOT EXISTS `promocodes` (
  `code` varchar(20) NOT NULL,
  `used` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `set_id` int(11) NOT NULL DEFAULT 0,
  `used_time` datetime DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.promocodes: ~0 rows (приблизительно)
DELETE FROM `promocodes`;
/*!40000 ALTER TABLE `promocodes` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocodes` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.promocodes_packages
CREATE TABLE IF NOT EXISTS `promocodes_packages` (
  `promocode_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.promocodes_packages: ~0 rows (приблизительно)
DELETE FROM `promocodes_packages`;
/*!40000 ALTER TABLE `promocodes_packages` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocodes_packages` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.promocodes_sets
CREATE TABLE IF NOT EXISTS `promocodes_sets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(400) DEFAULT NULL,
  `active_from` datetime DEFAULT NULL,
  `active_until` datetime DEFAULT NULL,
  `discount` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 ROW_FORMAT=COMPACT;

-- Дамп данных таблицы autotesmer_test.promocodes_sets: ~0 rows (приблизительно)
DELETE FROM `promocodes_sets`;
/*!40000 ALTER TABLE `promocodes_sets` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocodes_sets` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.requests
CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expert_id` int(10) unsigned NOT NULL DEFAULT 0,
  `order_id` int(10) unsigned NOT NULL DEFAULT 0,
  `content` text DEFAULT NULL,
  `period` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `metric` int(10) unsigned NOT NULL DEFAULT 0,
  `currency_id` int(10) unsigned NOT NULL DEFAULT 0,
  `chat_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `status` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.requests: ~1 rows (приблизительно)
DELETE FROM `requests`;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` (`id`, `expert_id`, `order_id`, `content`, `period`, `price`, `metric`, `currency_id`, `chat_id`, `created`, `status`) VALUES
	(28, 468, 30, 'some text', 2, 20, 2, 0, 34, '2020-03-14 09:55:09', 4);
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.review
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(10) unsigned NOT NULL DEFAULT 0,
  `to` int(10) unsigned DEFAULT 0,
  `order_id` int(10) unsigned DEFAULT 0,
  `content` varchar(1000) NOT NULL DEFAULT '0',
  `evaluation` int(11) DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.review: ~0 rows (приблизительно)
DELETE FROM `review`;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
/*!40000 ALTER TABLE `review` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.service
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_type` int(10) unsigned NOT NULL,
  `activation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `expire_date` datetime DEFAULT NULL,
  `user_package_id` int(10) unsigned DEFAULT NULL,
  `active` int(10) unsigned NOT NULL DEFAULT 0,
  `package_id` int(10) unsigned NOT NULL,
  `package_variant_id` int(10) unsigned NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.service: ~2 rows (приблизительно)
DELETE FROM `service`;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` (`id`, `service_type`, `activation_date`, `expire_date`, `user_package_id`, `active`, `package_id`, `package_variant_id`, `user_id`) VALUES
	(13, 1, '2020-03-14 09:54:30', '2020-04-13 09:54:30', 7, 1, 1, 1, 468),
	(14, 2, '2020-03-14 09:54:30', '2020-04-13 09:54:30', 7, 1, 1, 1, 468);
/*!40000 ALTER TABLE `service` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.service_options
CREATE TABLE IF NOT EXISTS `service_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_type` int(11) DEFAULT NULL,
  `name` int(11) DEFAULT NULL,
  `package_variant_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.service_options: ~7 rows (приблизительно)
DELETE FROM `service_options`;
/*!40000 ALTER TABLE `service_options` DISABLE KEYS */;
INSERT INTO `service_options` (`id`, `service_type`, `name`, `package_variant_id`, `package_id`, `days`) VALUES
	(1, 1, NULL, 2, 1, 180),
	(2, 2, NULL, 2, 1, 180),
	(3, 1, NULL, 1, 1, 30),
	(4, 2, NULL, 1, 1, 30),
	(5, 1, NULL, 3, 1, 365),
	(6, 2, NULL, 3, 1, 365),
	(7, 3, NULL, 3, 1, 365);
/*!40000 ALTER TABLE `service_options` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.tags
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.tags: ~0 rows (приблизительно)
DELETE FROM `tags`;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(200) NOT NULL COMMENT 'Логин',
  `phone_reliable` int(10) unsigned NOT NULL DEFAULT 0 COMMENT 'Телефон подтвержден',
  `card_id` int(10) unsigned NOT NULL DEFAULT 0,
  `password` varchar(100) NOT NULL COMMENT 'Пароль',
  `firstname` varchar(300) NOT NULL COMMENT 'Имя',
  `family` varchar(300) NOT NULL COMMENT 'Фамилия',
  `busyness` int(11) NOT NULL DEFAULT 1,
  `lastname` varchar(300) NOT NULL COMMENT 'Отчество',
  `email` varchar(300) NOT NULL COMMENT 'E-mail',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Дата регистрации',
  `updated_at` datetime NOT NULL COMMENT 'Последнее обновление записи',
  `has_ip` int(11) DEFAULT NULL,
  `has_ul` int(11) DEFAULT NULL,
  `profile_vk` varchar(300) DEFAULT NULL COMMENT 'профиль ВКонтакте',
  `profile_facebook` varchar(300) DEFAULT NULL COMMENT 'профиль Facebook',
  `profile_google` varchar(300) DEFAULT NULL,
  `profile_twitter` int(11) DEFAULT NULL,
  `phone` varchar(20) NOT NULL COMMENT 'Телефон',
  `city_id` int(10) unsigned DEFAULT 53 COMMENT 'Город',
  `birthday` datetime DEFAULT NULL COMMENT 'Дата рождения',
  `has_ip_or_ul` int(10) unsigned DEFAULT NULL COMMENT 'Имеет ИП или Юр.лицо',
  `gender` int(10) unsigned DEFAULT NULL COMMENT 'Пол',
  `active` int(11) DEFAULT NULL COMMENT 'Активен ли аккаунт',
  `activation_key` varchar(100) DEFAULT NULL COMMENT 'Ключ активации аккаунта',
  `photo` varchar(50) DEFAULT NULL,
  `resume` text DEFAULT NULL,
  `confirmed_email` int(11) NOT NULL DEFAULT 1,
  `confirmed_phone` int(11) NOT NULL DEFAULT 0,
  `about` text DEFAULT NULL,
  `text` text DEFAULT NULL,
  `status` text DEFAULT NULL COMMENT 'текст статуса',
  `category_auto` int(1) unsigned DEFAULT 0,
  `category_freight` int(1) unsigned DEFAULT 0,
  `category_moto` int(1) unsigned DEFAULT 0,
  `category_water` int(1) unsigned DEFAULT 0,
  `category_commerce` int(1) unsigned DEFAULT 0,
  `rating` int(11) DEFAULT 0,
  `profile_mailru` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=470 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.users: ~3 rows (приблизительно)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `phone_reliable`, `card_id`, `password`, `firstname`, `family`, `busyness`, `lastname`, `email`, `created_at`, `updated_at`, `has_ip`, `has_ul`, `profile_vk`, `profile_facebook`, `profile_google`, `profile_twitter`, `phone`, `city_id`, `birthday`, `has_ip_or_ul`, `gender`, `active`, `activation_key`, `photo`, `resume`, `confirmed_email`, `confirmed_phone`, `about`, `text`, `status`, `category_auto`, `category_freight`, `category_moto`, `category_water`, `category_commerce`, `rating`, `profile_mailru`) VALUES
	(467, '', 0, 0, '1', 'admin', 'adminov', 1, 'adminovich', 'admin@mail.ru', '2020-03-03 11:26:02', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 53, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL),
	(468, '', 0, 0, '1', 'Эксперт', 'Экспертов', 1, 'Экспертович', 'testmailbox_2@inbox.ru', '2020-03-14 09:53:23', '0000-00-00 00:00:00', 1, 1, NULL, NULL, NULL, NULL, '79320195293', 20, '2010-01-01 09:53:23', NULL, NULL, 1, '', NULL, NULL, 1, 0, NULL, NULL, NULL, 1, 1, 1, 1, 1, 0, NULL),
	(469, '', 0, 0, '1', 'Клиент', 'Клиентов', 1, 'Клиентович', 'testmailbox_1@inbox.ru', '2020-03-14 09:53:40', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '79320195293', 20, NULL, NULL, NULL, 1, '', NULL, NULL, 1, 0, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.user_category
CREATE TABLE IF NOT EXISTS `user_category` (
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.user_category: ~0 rows (приблизительно)
DELETE FROM `user_category`;
/*!40000 ALTER TABLE `user_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_category` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.user_documents
CREATE TABLE IF NOT EXISTS `user_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `filename` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.user_documents: ~0 rows (приблизительно)
DELETE FROM `user_documents`;
/*!40000 ALTER TABLE `user_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_documents` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.user_group
CREATE TABLE IF NOT EXISTS `user_group` (
  `user_id` int(10) unsigned DEFAULT NULL,
  `group_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.user_group: ~0 rows (приблизительно)
DELETE FROM `user_group`;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.user_package
CREATE TABLE IF NOT EXISTS `user_package` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `package_variant_id` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `payment_id` int(10) unsigned DEFAULT NULL,
  `paid` int(10) unsigned NOT NULL DEFAULT 0,
  `user_id` int(10) unsigned NOT NULL,
  `activation_date` datetime DEFAULT current_timestamp(),
  `package_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.user_package: ~1 rows (приблизительно)
DELETE FROM `user_package`;
/*!40000 ALTER TABLE `user_package` DISABLE KEYS */;
INSERT INTO `user_package` (`id`, `package_variant_id`, `created`, `payment_id`, `paid`, `user_id`, `activation_date`, `package_id`) VALUES
	(7, 1, '2020-03-14 09:53:55', 35, 1, 468, '2020-03-14 09:53:55', 1);
/*!40000 ALTER TABLE `user_package` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.vehicle_brand
CREATE TABLE IF NOT EXISTS `vehicle_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Дамп данных таблицы autotesmer_test.vehicle_brand: ~71 rows (приблизительно)
DELETE FROM `vehicle_brand`;
/*!40000 ALTER TABLE `vehicle_brand` DISABLE KEYS */;
INSERT INTO `vehicle_brand` (`id`, `name`) VALUES
	(1, 'Acura'),
	(2, 'Alfa Romeo'),
	(3, 'Aston Martin'),
	(4, 'Audi'),
	(5, 'Bentley'),
	(6, 'BMW'),
	(7, 'Buick'),
	(8, 'Cadillac'),
	(9, 'Chery'),
	(10, 'Chevrolet'),
	(11, 'Chrysler'),
	(12, 'Citroen'),
	(13, 'Daewoo'),
	(14, 'Daihatsu'),
	(15, 'Dodge'),
	(16, 'FAW'),
	(17, 'Ferrari'),
	(18, 'Fiat'),
	(19, 'Ford'),
	(20, 'Geely'),
	(21, 'GMC'),
	(22, 'Great Wall'),
	(23, 'Haima'),
	(24, 'Honda'),
	(25, 'Hummer'),
	(26, 'Hyundai'),
	(27, 'Infiniti'),
	(28, 'Isuzu'),
	(29, 'Iveco'),
	(30, 'Jaguar'),
	(31, 'Jeep'),
	(32, 'Kia'),
	(33, 'Lancia'),
	(34, 'Land Rover'),
	(35, 'Lexus'),
	(36, 'Lifan'),
	(37, 'Lincoln'),
	(38, 'Lotus'),
	(39, 'Maserati'),
	(40, 'Maybach'),
	(41, 'Mazda'),
	(42, 'Mercedes'),
	(43, 'Mercury'),
	(44, 'MG'),
	(45, 'Mini'),
	(46, 'Mitsubishi'),
	(47, 'Nissan'),
	(48, 'Opel'),
	(49, 'Peugeot'),
	(50, 'Pontiac'),
	(51, 'Porsche'),
	(52, 'Renault'),
	(53, 'Rolls Royce'),
	(54, 'Rover'),
	(55, 'Saab'),
	(56, 'Saturn'),
	(57, 'Scion'),
	(58, 'Seat'),
	(59, 'Skoda'),
	(60, 'Smart'),
	(61, 'Ssang Yong'),
	(62, 'Subaru'),
	(63, 'Suzuki'),
	(64, 'Toyota'),
	(65, 'Volkswagen'),
	(66, 'Volvo'),
	(67, 'ZAZ'),
	(68, 'ГАЗ'),
	(69, 'ВАЗ'),
	(70, 'ТаГАЗ'),
	(71, 'УАЗ');
/*!40000 ALTER TABLE `vehicle_brand` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.vehicle_model
CREATE TABLE IF NOT EXISTS `vehicle_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=860 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Дамп данных таблицы autotesmer_test.vehicle_model: ~859 rows (приблизительно)
DELETE FROM `vehicle_model`;
/*!40000 ALTER TABLE `vehicle_model` DISABLE KEYS */;
INSERT INTO `vehicle_model` (`id`, `brand_id`, `name`) VALUES
	(1, 1, 'CL'),
	(2, 1, 'EL'),
	(3, 1, 'Integra'),
	(4, 1, 'MDX'),
	(5, 1, 'NSX'),
	(6, 1, 'RDX'),
	(7, 1, 'RL'),
	(8, 1, 'RSX'),
	(9, 1, 'TL'),
	(10, 1, 'TSX'),
	(11, 1, 'ZDX'),
	(12, 2, '146'),
	(13, 2, '147'),
	(14, 2, '147 GTA'),
	(15, 2, '156'),
	(16, 2, '156 GTA'),
	(17, 2, '159'),
	(18, 2, '166'),
	(19, 2, '8C'),
	(20, 2, 'Brera'),
	(21, 2, 'Giulietta'),
	(22, 2, 'GT'),
	(23, 2, 'GTV'),
	(24, 2, 'MiTo'),
	(25, 2, 'Spider'),
	(26, 3, 'DB9'),
	(27, 3, 'DBS'),
	(28, 3, 'DBS Volante'),
	(29, 3, 'Rapide'),
	(30, 3, 'V12 Vantage'),
	(31, 3, 'V8 Vantage'),
	(32, 3, 'Vanquish S'),
	(33, 4, 'A1'),
	(34, 4, 'A2'),
	(35, 4, 'A3'),
	(36, 4, 'A4'),
	(37, 4, 'A4 Allroad quattro'),
	(38, 4, 'A5'),
	(39, 4, 'A6'),
	(40, 4, 'A7'),
	(41, 4, 'A8'),
	(42, 4, 'Allroad'),
	(43, 4, 'Q5'),
	(44, 4, 'Q7'),
	(45, 4, 'R8'),
	(46, 4, 'R8 V10'),
	(47, 4, 'RS4'),
	(48, 4, 'RS6'),
	(49, 4, 'S4'),
	(50, 4, 'S5'),
	(51, 4, 'S6'),
	(52, 4, 'S8'),
	(53, 4, 'TT'),
	(54, 4, 'TT RS'),
	(55, 4, 'TT S'),
	(56, 5, 'Arnage'),
	(57, 5, 'Azure'),
	(58, 5, 'Brooklands'),
	(59, 5, 'Continental'),
	(60, 5, 'Mulsanne'),
	(61, 6, '1-series (E87)'),
	(62, 6, '3-series (E46)'),
	(63, 6, '3-series (E90)'),
	(64, 6, '5-series (E39)'),
	(65, 6, '5-series (E60)'),
	(66, 6, '5-series (F10)'),
	(67, 6, '6-series (E63)'),
	(68, 6, '7-series (E38)'),
	(69, 6, '7-series (E65,E66)'),
	(70, 6, '7-series (F01,F02,F04)'),
	(71, 6, '8-series (E31)'),
	(72, 6, 'GT (F07)'),
	(73, 6, 'M3 (E46)'),
	(74, 6, 'M3 (E92)'),
	(75, 6, 'M5 (E39)'),
	(76, 6, 'M5 (E60)'),
	(77, 6, 'M6'),
	(78, 6, 'X1 (E84)'),
	(79, 6, 'X3 (E83)'),
	(80, 6, 'X3 (F25)'),
	(81, 6, 'X5 (E53)'),
	(82, 6, 'X5 (E70)'),
	(83, 6, 'X5 M'),
	(84, 6, 'X6 (E71)'),
	(85, 6, 'X6 M'),
	(86, 6, 'Z3'),
	(87, 6, 'Z4 (E85)'),
	(88, 6, 'Z4 (E89)'),
	(89, 6, 'Z8'),
	(90, 7, 'Century'),
	(91, 7, 'Enclave'),
	(92, 7, 'La Crosse'),
	(93, 7, 'Le Sabre'),
	(94, 7, 'Lucerne'),
	(95, 7, 'Park Avenue'),
	(96, 7, 'Rainier'),
	(97, 7, 'Regal'),
	(98, 7, 'Rendezvouz'),
	(99, 7, 'Terraza'),
	(100, 8, 'BLS'),
	(101, 8, 'CTS'),
	(102, 8, 'De Ville'),
	(103, 8, 'DTS'),
	(104, 8, 'Eldorado'),
	(105, 8, 'Escalade'),
	(106, 8, 'Seville'),
	(107, 8, 'SRX'),
	(108, 8, 'STS'),
	(109, 8, 'XLR'),
	(110, 9, 'Amulet'),
	(111, 9, 'CrossEastar'),
	(112, 9, 'Eastar'),
	(113, 9, 'Fora'),
	(114, 9, 'Kimo'),
	(115, 9, 'M11'),
	(116, 9, 'QQ'),
	(117, 9, 'QQ6'),
	(118, 9, 'Tiggo'),
	(119, 10, 'Astro'),
	(120, 10, 'Avalanche'),
	(121, 10, 'Aveo'),
	(122, 10, 'Blazer'),
	(123, 10, 'Camaro'),
	(124, 10, 'Captiva'),
	(125, 10, 'Cavalier'),
	(126, 10, 'Cobalt'),
	(127, 10, 'Colorado'),
	(128, 10, 'Corvette'),
	(129, 10, 'Cruze'),
	(130, 10, 'Epica'),
	(131, 10, 'Equinox'),
	(132, 10, 'Express'),
	(133, 10, 'HHR'),
	(134, 10, 'Impala'),
	(135, 10, 'Lacetti'),
	(136, 10, 'Lanos'),
	(137, 10, 'Lumina'),
	(138, 10, 'Malibu'),
	(139, 10, 'Monte Carlo'),
	(140, 10, 'Niva'),
	(141, 10, 'Orlando'),
	(142, 10, 'Rezzo'),
	(143, 10, 'Silverado'),
	(144, 10, 'Spark'),
	(145, 10, 'SSR'),
	(146, 10, 'Suburban'),
	(147, 10, 'Tahoe'),
	(148, 10, 'Town Country'),
	(149, 10, 'TrailBlazer'),
	(150, 10, 'Traverse'),
	(151, 10, 'Uplander'),
	(152, 10, 'Venture'),
	(153, 11, '300C'),
	(154, 11, '300M'),
	(155, 11, 'Aspen'),
	(156, 11, 'Concorde'),
	(157, 11, 'Crossfire'),
	(158, 11, 'Grand Voyager'),
	(159, 11, 'Pacifica'),
	(160, 11, 'PT Cruiser'),
	(161, 11, 'Sebring'),
	(162, 11, 'Town & Country'),
	(163, 11, 'Voyager'),
	(164, 12, 'Berlingo'),
	(165, 12, 'C-Crosser'),
	(166, 12, 'C1'),
	(167, 12, 'C2'),
	(168, 12, 'C3'),
	(169, 12, 'C3 Picasso'),
	(170, 12, 'C3 Pluriel'),
	(171, 12, 'C4'),
	(172, 12, 'C4 Picasso'),
	(173, 12, 'C5'),
	(174, 12, 'C6'),
	(175, 12, 'C8'),
	(176, 12, 'DS3'),
	(177, 12, 'Grand C4 Picasso'),
	(178, 12, 'Nemo'),
	(179, 12, 'Saxo'),
	(180, 12, 'Xsara'),
	(181, 12, 'Xsara Picasso'),
	(182, 13, 'Evanda'),
	(183, 13, 'Kalos'),
	(184, 13, 'Lacetti'),
	(185, 13, 'Lanos'),
	(186, 13, 'Leganza'),
	(187, 13, 'Magnus'),
	(188, 13, 'Matiz'),
	(189, 13, 'Nexia'),
	(190, 13, 'Nubira'),
	(191, 13, 'Rezzo'),
	(192, 14, 'Applause'),
	(193, 14, 'Copen'),
	(194, 14, 'Cuore'),
	(195, 14, 'Gran Move'),
	(196, 14, 'Materia'),
	(197, 14, 'Sirion'),
	(198, 14, 'Terios'),
	(199, 14, 'Trevis'),
	(200, 14, 'YRV'),
	(201, 15, 'Avenger'),
	(202, 15, 'Caliber'),
	(203, 15, 'Caliber SRT4'),
	(204, 15, 'Caravan'),
	(205, 15, 'Challenger'),
	(206, 15, 'Charger'),
	(207, 15, 'Dakota'),
	(208, 15, 'Durango'),
	(209, 15, 'Intrepid'),
	(210, 15, 'Journey'),
	(211, 15, 'Magnum'),
	(212, 15, 'Neon'),
	(213, 15, 'Nitro'),
	(214, 15, 'Ram 1500'),
	(215, 15, 'Ram 2500'),
	(216, 15, 'Ram SRT10'),
	(217, 15, 'Stratus'),
	(218, 15, 'Viper'),
	(219, 16, 'Vita'),
	(220, 17, '348 GT'),
	(221, 17, '348 Spider'),
	(222, 17, '355 F1 Berlinetta'),
	(223, 17, '355 F1 GTS'),
	(224, 17, '355 F1 Spider'),
	(225, 17, '360 Modena'),
	(226, 17, '360 Spider'),
	(227, 17, '456 GT'),
	(228, 17, '456 GTA'),
	(229, 17, '456 M GT'),
	(230, 17, '456 M GTA'),
	(231, 17, '458 Italia'),
	(232, 17, '512 TR'),
	(233, 17, '550 Barchetta Pininfarina'),
	(234, 17, '550 Maranello'),
	(235, 17, '575 M Maranello'),
	(236, 17, '599 GTB Fiorano'),
	(237, 17, '612 Scaglietti'),
	(238, 17, 'California'),
	(239, 17, 'Challenge Stradale'),
	(240, 17, 'Enzo'),
	(241, 17, 'F355 Berlinetta'),
	(242, 17, 'F355 GTS'),
	(243, 17, 'F355 Spider'),
	(244, 17, 'F430'),
	(245, 17, 'F430 Challenge'),
	(246, 17, 'F430 Spider'),
	(247, 17, 'F50'),
	(248, 17, 'F512 M'),
	(249, 17, 'FXX'),
	(250, 17, 'Superamerica'),
	(251, 19, 'C-Max'),
	(252, 19, 'Cougar'),
	(253, 19, 'Crown Victoria'),
	(254, 19, 'Edge'),
	(255, 19, 'Escape'),
	(256, 19, 'Excursion'),
	(257, 19, 'Expedition'),
	(258, 19, 'Explorer'),
	(259, 19, 'F150'),
	(260, 19, 'Fiesta'),
	(261, 19, 'Five Hundred'),
	(262, 19, 'Flex'),
	(263, 19, 'Focus'),
	(264, 19, 'Freestar'),
	(265, 19, 'Freestyle'),
	(266, 19, 'Fusion'),
	(267, 19, 'Fusion USA'),
	(268, 19, 'Galaxy'),
	(269, 19, 'Grand C-MAX'),
	(270, 19, 'GT'),
	(271, 19, 'Ka'),
	(272, 19, 'Kuga'),
	(273, 19, 'Maverick'),
	(274, 19, 'Mondeo'),
	(275, 19, 'Mustang'),
	(276, 19, 'Puma'),
	(277, 19, 'Ranger'),
	(278, 19, 'S-Max'),
	(279, 19, 'Sport Trac'),
	(280, 19, 'Taurus SE/SEL'),
	(281, 19, 'Taurus X'),
	(282, 19, 'Thunderbird'),
	(283, 19, 'Tourneo Connect'),
	(284, 19, 'Transit'),
	(285, 19, 'Transit Connect'),
	(286, 20, 'MK'),
	(287, 20, 'Otaka'),
	(288, 20, 'Vision'),
	(289, 21, 'Acadia'),
	(290, 21, 'Canyon'),
	(291, 21, 'Envoy'),
	(292, 21, 'Sierra 1500'),
	(293, 21, 'Sierra 2500'),
	(294, 21, 'Yukon'),
	(295, 22, 'Cowry'),
	(296, 22, 'Deer'),
	(297, 22, 'GWPeri'),
	(298, 22, 'Hover'),
	(299, 22, 'Hover H3'),
	(300, 22, 'Hover H5'),
	(301, 22, 'Hover M2'),
	(302, 22, 'Pegasus'),
	(303, 22, 'Safe'),
	(304, 22, 'Sailor'),
	(305, 22, 'Sing'),
	(306, 22, 'Socool'),
	(307, 22, 'Wingle'),
	(308, 22, 'Wingle 3'),
	(309, 22, 'Wingle 5'),
	(310, 23, 'Haima 3'),
	(311, 24, 'Accord'),
	(312, 24, 'Civic'),
	(313, 24, 'CR-V'),
	(314, 24, 'Crosstour'),
	(315, 24, 'Element'),
	(316, 24, 'Fit'),
	(317, 24, 'FR-V'),
	(318, 24, 'HR-V'),
	(319, 24, 'Insight'),
	(320, 24, 'Integra'),
	(321, 24, 'Jazz'),
	(322, 24, 'Legend'),
	(323, 24, 'Odyssey'),
	(324, 24, 'Pilot'),
	(325, 24, 'Prelude'),
	(326, 24, 'Ridgeline'),
	(327, 24, 'S2000'),
	(328, 24, 'Shuttle'),
	(329, 24, 'Stream'),
	(330, 25, 'H2'),
	(331, 25, 'H3'),
	(332, 26, 'Accent'),
	(333, 26, 'Atos Prime'),
	(334, 26, 'Azera'),
	(335, 26, 'Centennial'),
	(336, 26, 'Coupe'),
	(337, 26, 'Elantra'),
	(338, 26, 'Entourage'),
	(339, 26, 'Equus'),
	(340, 26, 'Galloper'),
	(341, 26, 'Genesis'),
	(342, 26, 'Genesis Coupe'),
	(343, 26, 'Getz'),
	(344, 26, 'Grandeur'),
	(345, 26, 'H1'),
	(346, 26, 'i10'),
	(347, 26, 'i20'),
	(348, 26, 'i30'),
	(349, 26, 'ix35'),
	(350, 26, 'ix55 (Veracruz)'),
	(351, 26, 'Matrix'),
	(352, 26, 'Porter'),
	(353, 26, 'Porter II'),
	(354, 26, 'Santa Fe'),
	(355, 26, 'Solaris'),
	(356, 26, 'Sonata'),
	(357, 26, 'Sonata NF'),
	(358, 26, 'Terracan'),
	(359, 26, 'Trajet'),
	(360, 26, 'Tucson'),
	(361, 26, 'Verna'),
	(362, 26, 'XG'),
	(363, 27, 'EX35'),
	(364, 27, 'EX37'),
	(365, 27, 'FX35'),
	(366, 27, 'FX45'),
	(367, 27, 'FX50'),
	(368, 27, 'G25'),
	(369, 27, 'G35 Coupe'),
	(370, 27, 'G35 Sedan'),
	(371, 27, 'G37 Coupe'),
	(372, 27, 'G37 Sedan'),
	(373, 27, 'I35'),
	(374, 27, 'M35'),
	(375, 27, 'M45'),
	(376, 27, 'Q45'),
	(377, 27, 'QX4'),
	(378, 27, 'QX56'),
	(379, 28, 'Ascender'),
	(380, 28, 'Axiom'),
	(381, 28, 'D-Max Rodeo'),
	(382, 28, 'I280'),
	(383, 28, 'I290'),
	(384, 28, 'I350'),
	(385, 28, 'I370'),
	(386, 28, 'Rodeo'),
	(387, 28, 'Trooper'),
	(388, 28, 'VehiCross'),
	(389, 29, 'Daily Van'),
	(390, 30, 'S-Type'),
	(391, 30, 'X-Type'),
	(392, 30, 'XF'),
	(393, 30, 'XJ'),
	(394, 30, 'XK'),
	(395, 31, 'Cherokee'),
	(396, 31, 'Commander'),
	(397, 31, 'Compass'),
	(398, 31, 'Grand Cherokee'),
	(399, 31, 'Liberty'),
	(400, 31, 'Wrangler'),
	(401, 32, 'Carens'),
	(402, 32, 'Carnival'),
	(403, 32, 'Cee`d'),
	(404, 32, 'Cerato'),
	(405, 32, 'Clarus'),
	(406, 32, 'Magentis'),
	(407, 32, 'Mohave'),
	(408, 32, 'Opirus'),
	(409, 32, 'Optima'),
	(410, 32, 'Picanto'),
	(411, 32, 'Rio'),
	(412, 32, 'Shuma'),
	(413, 32, 'Sorento'),
	(414, 32, 'Sorento New'),
	(415, 32, 'Soul'),
	(416, 32, 'Spectra'),
	(417, 32, 'Sportage'),
	(418, 32, 'Venga'),
	(419, 33, 'Delta'),
	(420, 33, 'Lybra'),
	(421, 33, 'Musa'),
	(422, 33, 'Phedra'),
	(423, 33, 'Thesis'),
	(424, 33, 'Ypsilon'),
	(425, 34, 'Defender'),
	(426, 34, 'Discovery 2'),
	(427, 34, 'Discovery 3'),
	(428, 34, 'Discovery 4'),
	(429, 34, 'Evoque'),
	(430, 34, 'Freelander'),
	(431, 34, 'Freelander 2'),
	(432, 34, 'Range Rover'),
	(433, 34, 'Range Rover Sport'),
	(434, 35, 'CT200h'),
	(435, 35, 'ES300'),
	(436, 35, 'ES330'),
	(437, 35, 'ES350'),
	(438, 35, 'GS300'),
	(439, 35, 'GS350'),
	(440, 35, 'GS400'),
	(441, 35, 'GS430'),
	(442, 35, 'GS450h'),
	(443, 35, 'GS460'),
	(444, 35, 'GX460'),
	(445, 35, 'GX470'),
	(446, 35, 'IS-F'),
	(447, 35, 'IS200'),
	(448, 35, 'IS250'),
	(449, 35, 'IS300'),
	(450, 35, 'IS350'),
	(451, 35, 'LFA'),
	(452, 35, 'LS400'),
	(453, 35, 'LS430'),
	(454, 35, 'LS460'),
	(455, 35, 'LS600h'),
	(456, 35, 'LX470'),
	(457, 35, 'LX570'),
	(458, 35, 'RX270'),
	(459, 35, 'RX300'),
	(460, 35, 'RX350'),
	(461, 35, 'RX400h'),
	(462, 35, 'RX450h'),
	(463, 35, 'SC430'),
	(464, 36, 'Breez'),
	(465, 36, 'Smily'),
	(466, 36, 'Solano'),
	(467, 37, 'Aviator'),
	(468, 37, 'LS'),
	(469, 37, 'Mark LT'),
	(470, 37, 'MKS'),
	(471, 37, 'MKT'),
	(472, 37, 'MKX'),
	(473, 37, 'MKZ'),
	(474, 37, 'Navigator'),
	(475, 37, 'Town Car'),
	(476, 37, 'Zephyr'),
	(477, 38, 'Elise'),
	(478, 38, 'Europa S'),
	(479, 38, 'Exige'),
	(480, 39, '3200 GT'),
	(481, 39, 'Coupe'),
	(482, 39, 'Gran Turismo'),
	(483, 39, 'Gran Turismo S'),
	(484, 39, 'Quattroporte'),
	(485, 39, 'Quattroporte S'),
	(486, 40, '57'),
	(487, 40, '57 S'),
	(488, 40, '62'),
	(489, 40, '62 S'),
	(490, 40, 'Landaulet'),
	(491, 41, '2'),
	(492, 41, '3'),
	(493, 41, '323'),
	(494, 41, '5'),
	(495, 41, '6'),
	(496, 41, '626'),
	(497, 41, 'B-Series'),
	(498, 41, 'BT-50'),
	(499, 41, 'CX-5'),
	(500, 41, 'CX-7'),
	(501, 41, 'CX-9'),
	(502, 41, 'MPV'),
	(503, 41, 'MX-5 Miata'),
	(504, 41, 'Premacy'),
	(505, 41, 'RX-8'),
	(506, 41, 'Tribute'),
	(507, 42, 'A-Klasse (W168)'),
	(508, 42, 'A-Klasse (W169)'),
	(509, 42, 'B-Klasse (W245)'),
	(510, 42, 'C-Klasse (CL203)'),
	(511, 42, 'C-Klasse (W202)'),
	(512, 42, 'C-Klasse (W203)'),
	(513, 42, 'C-Klasse (W204)'),
	(514, 42, 'CL-Klasse (C140)'),
	(515, 42, 'CL-Klasse (C215)'),
	(516, 42, 'CL-Klasse (C216)'),
	(517, 42, 'CLC-Klasse'),
	(518, 42, 'CLK-Klasse (W208)'),
	(519, 42, 'CLK-Klasse (W209)'),
	(520, 42, 'CLS-Klasse (C219)'),
	(521, 42, 'E-Klasse (W210)'),
	(522, 42, 'E-Klasse (W211)'),
	(523, 42, 'E-Klasse (W212)'),
	(524, 42, 'G-Klasse (W463)'),
	(525, 42, 'GL-Klasse (X164)'),
	(526, 42, 'GLK-Klasse (X204)'),
	(527, 42, 'M-Klasse (W163)'),
	(528, 42, 'M-Klasse (W164)'),
	(529, 42, 'R-Klasse (W251)'),
	(530, 42, 'S-Klasse (W140)'),
	(531, 42, 'S-Klasse (W220)'),
	(532, 42, 'S-Klasse (W221)'),
	(533, 42, 'SL-Klasse (R230)'),
	(534, 42, 'SLK-Klasse (R170)'),
	(535, 42, 'SLK-Klasse (R171)'),
	(536, 42, 'SLR-Klasse'),
	(537, 42, 'Sprinter'),
	(538, 42, 'Vaneo'),
	(539, 42, 'Viano'),
	(540, 42, 'Vito'),
	(541, 43, 'Grand Marquis'),
	(542, 43, 'Mariner'),
	(543, 43, 'Milan'),
	(544, 43, 'Montego'),
	(545, 43, 'Monterey'),
	(546, 43, 'Mountaineer'),
	(547, 43, 'Sable'),
	(548, 44, 'TF'),
	(549, 44, 'XPower SV'),
	(550, 44, 'ZR'),
	(551, 44, 'ZS'),
	(552, 44, 'ZT'),
	(553, 44, 'ZT-T'),
	(554, 45, 'Clubman'),
	(555, 45, 'Clubman S'),
	(556, 45, 'Cooper'),
	(557, 45, 'Cooper Cabrio'),
	(558, 45, 'Cooper Countryman'),
	(559, 45, 'Cooper S'),
	(560, 45, 'Cooper S All4 Countryman'),
	(561, 45, 'Cooper S Cabrio'),
	(562, 45, 'One'),
	(563, 46, '3000 GT'),
	(564, 46, 'ASX'),
	(565, 46, 'Carisma'),
	(566, 46, 'Colt'),
	(567, 46, 'Eclipse'),
	(568, 46, 'Endeavor'),
	(569, 46, 'Galant'),
	(570, 46, 'Grandis'),
	(571, 46, 'L200'),
	(572, 46, 'Lancer'),
	(573, 46, 'Lancer Evo IX'),
	(574, 46, 'Lancer Evo VII'),
	(575, 46, 'Lancer Evo VIII'),
	(576, 46, 'Lancer Evo X'),
	(577, 46, 'Outlander'),
	(578, 46, 'Outlander XL'),
	(579, 46, 'Pajero'),
	(580, 46, 'Pajero Pinin'),
	(581, 46, 'Pajero Sport'),
	(582, 46, 'Raider'),
	(583, 46, 'Space Gear'),
	(584, 46, 'Space Runner'),
	(585, 46, 'Space Star'),
	(586, 47, 'Almera'),
	(587, 47, 'Almera Classic'),
	(588, 47, 'Almera Tino'),
	(589, 47, 'Altima'),
	(590, 47, 'Armada'),
	(591, 47, 'GT-R'),
	(592, 47, 'Juke'),
	(593, 47, 'Maxima'),
	(594, 47, 'Micra'),
	(595, 47, 'Murano'),
	(596, 47, 'Navara'),
	(597, 47, 'Note'),
	(598, 47, 'NP300 Pick Up'),
	(599, 47, 'Pathfinder'),
	(600, 47, 'Patrol'),
	(601, 47, 'Primera'),
	(602, 47, 'Qashqai'),
	(603, 47, 'Qashqai+2'),
	(604, 47, 'Quest'),
	(605, 47, 'Sentra'),
	(606, 47, 'Skyline'),
	(607, 47, 'Teana'),
	(608, 47, 'Terrano 2'),
	(609, 47, 'Tiida'),
	(610, 47, 'X-Terra'),
	(611, 47, 'X-Trail'),
	(612, 47, 'Z'),
	(613, 48, 'Agila'),
	(614, 48, 'Antara'),
	(615, 48, 'Astra G'),
	(616, 48, 'Astra H'),
	(617, 48, 'Astra J'),
	(618, 48, 'Combo Tour'),
	(619, 48, 'Corsa'),
	(620, 48, 'Frontera'),
	(621, 48, 'Insignia'),
	(622, 48, 'Meriva'),
	(623, 48, 'Monterey'),
	(624, 48, 'Omega'),
	(625, 48, 'Signum'),
	(626, 48, 'Speedster'),
	(627, 48, 'Tigra'),
	(628, 48, 'Vectra B'),
	(629, 48, 'Vectra C'),
	(630, 48, 'Vivaro'),
	(631, 48, 'Zafira'),
	(632, 49, '1007'),
	(633, 49, '107'),
	(634, 49, '206'),
	(635, 49, '207'),
	(636, 49, '3008'),
	(637, 49, '307'),
	(638, 49, '308'),
	(639, 49, '4007'),
	(640, 49, '406'),
	(641, 49, '407'),
	(642, 49, '508'),
	(643, 49, '607'),
	(644, 49, '807'),
	(645, 49, 'Boxer'),
	(646, 49, 'Partner'),
	(647, 49, 'Partner Origin VU'),
	(648, 49, 'Partner Tepee'),
	(649, 49, 'Partner VU'),
	(650, 49, 'RCZ Sport'),
	(651, 50, 'Aztec'),
	(652, 50, 'Bonneville'),
	(653, 50, 'Firebird'),
	(654, 50, 'G5'),
	(655, 50, 'G6'),
	(656, 50, 'G8'),
	(657, 50, 'Grand AM'),
	(658, 50, 'Grand Prix'),
	(659, 50, 'GTO'),
	(660, 50, 'Montana'),
	(661, 50, 'Solstice'),
	(662, 50, 'Sunfire'),
	(663, 50, 'Torrent'),
	(664, 50, 'Trans Sport'),
	(665, 50, 'Vibe'),
	(666, 51, '911'),
	(667, 51, 'Boxster'),
	(668, 51, 'Cayenne'),
	(669, 51, 'Cayman'),
	(670, 51, 'Panamera'),
	(671, 52, 'Avantime'),
	(672, 52, 'Clio'),
	(673, 52, 'Duster'),
	(674, 52, 'Espace'),
	(675, 52, 'Fluence'),
	(676, 52, 'Kangoo'),
	(677, 52, 'Kangoo Compact'),
	(678, 52, 'Koleos'),
	(679, 52, 'Laguna'),
	(680, 52, 'Latitude'),
	(681, 52, 'Logan'),
	(682, 52, 'Master'),
	(683, 52, 'Megane'),
	(684, 52, 'Modus'),
	(685, 52, 'Sandero'),
	(686, 52, 'Sandero Stepway'),
	(687, 52, 'Scenic'),
	(688, 52, 'Symbol'),
	(689, 52, 'Trafic'),
	(690, 52, 'Twingo'),
	(691, 52, 'Vel Satis'),
	(692, 53, 'Phantom'),
	(693, 54, '25'),
	(694, 54, '400'),
	(695, 54, '45'),
	(696, 54, '600'),
	(697, 54, '75'),
	(698, 54, 'Streetwise'),
	(699, 55, '9-2x'),
	(700, 55, '9-3'),
	(701, 55, '9-4x'),
	(702, 55, '9-5'),
	(703, 55, '9-7x'),
	(704, 56, 'Aura'),
	(705, 56, 'Ion'),
	(706, 56, 'LW'),
	(707, 56, 'Outlook'),
	(708, 56, 'SC'),
	(709, 56, 'Sky'),
	(710, 56, 'Vue'),
	(711, 57, 'tC'),
	(712, 57, 'xA'),
	(713, 57, 'xB'),
	(714, 57, 'xD'),
	(715, 58, 'Alhambra'),
	(716, 58, 'Altea'),
	(717, 58, 'Altea Freetrack'),
	(718, 58, 'Altea XL'),
	(719, 58, 'Arosa'),
	(720, 58, 'Cordoba'),
	(721, 58, 'Ibiza'),
	(722, 58, 'Leon'),
	(723, 58, 'Toledo'),
	(724, 59, 'Fabia'),
	(725, 59, 'Felicia'),
	(726, 59, 'Octavia'),
	(727, 59, 'Octavia Scout'),
	(728, 59, 'Octavia Tour'),
	(729, 59, 'Praktik'),
	(730, 59, 'Roomster'),
	(731, 59, 'Superb'),
	(732, 59, 'Yeti'),
	(733, 60, 'Forfour'),
	(734, 60, 'Fourtwo'),
	(735, 60, 'Roadster'),
	(736, 61, 'Actyon'),
	(737, 61, 'Chairman'),
	(738, 61, 'Korando'),
	(739, 61, 'Kyron'),
	(740, 61, 'Musso'),
	(741, 61, 'Musso Sport'),
	(742, 61, 'Rexton'),
	(743, 61, 'Rexton II'),
	(744, 61, 'Rodius'),
	(745, 62, 'Baja'),
	(746, 62, 'Forester'),
	(747, 62, 'Impreza'),
	(748, 62, 'Impreza XV'),
	(749, 62, 'Justy'),
	(750, 62, 'Legacy'),
	(751, 62, 'Outback'),
	(752, 62, 'Traviq'),
	(753, 62, 'Tribeca'),
	(754, 63, 'Alto'),
	(755, 63, 'Baleno'),
	(756, 63, 'Grand Vitara'),
	(757, 63, 'Grand Vitara XL7'),
	(758, 63, 'Ignis'),
	(759, 63, 'Jimny'),
	(760, 63, 'Kizashi'),
	(761, 63, 'Liana'),
	(762, 63, 'Splash'),
	(763, 63, 'Swift'),
	(764, 63, 'SX4'),
	(765, 63, 'Wagon R+'),
	(766, 64, '4Runner'),
	(767, 64, 'Alphard'),
	(768, 64, 'Auris'),
	(769, 64, 'Avalon'),
	(770, 64, 'Avensis'),
	(771, 64, 'Avensis Verso'),
	(772, 64, 'Aygo'),
	(773, 64, 'Camry'),
	(774, 64, 'Celica'),
	(775, 64, 'Corolla'),
	(776, 64, 'Corolla Verso'),
	(777, 64, 'FJ Cruiser'),
	(778, 64, 'Fortuner'),
	(779, 64, 'Hiace'),
	(780, 64, 'Highlander'),
	(781, 64, 'Hilux'),
	(782, 64, 'IQ'),
	(783, 64, 'Land Cruiser 100 GX'),
	(784, 64, 'Land Cruiser 100 VX'),
	(785, 64, 'Land Cruiser 200'),
	(786, 64, 'Land Cruiser 80'),
	(787, 64, 'Land Cruiser 90'),
	(788, 64, 'Land Cruiser Prado'),
	(789, 64, 'Matrix'),
	(790, 64, 'MR2'),
	(791, 64, 'Picnic'),
	(792, 64, 'Previa'),
	(793, 64, 'Prius'),
	(794, 64, 'RAV4'),
	(795, 64, 'Sequoia'),
	(796, 64, 'Sienna'),
	(797, 64, 'Tacoma'),
	(798, 64, 'Tundra'),
	(799, 64, 'Venza'),
	(800, 64, 'Verso'),
	(801, 64, 'Yaris'),
	(802, 64, 'Yaris Verso'),
	(803, 65, 'Amarok'),
	(804, 65, 'Bora'),
	(805, 65, 'Caddy'),
	(806, 65, 'Crafter'),
	(807, 65, 'CrossGolf'),
	(808, 65, 'CrossPolo'),
	(809, 65, 'CrossTouran'),
	(810, 65, 'Eos'),
	(811, 65, 'Fox'),
	(812, 65, 'Golf IV'),
	(813, 65, 'Golf V'),
	(814, 65, 'Golf V Plus'),
	(815, 65, 'Golf VI'),
	(816, 65, 'Jetta'),
	(817, 65, 'Lupo'),
	(818, 65, 'Multivan'),
	(819, 65, 'New Beetle'),
	(820, 65, 'Passat'),
	(821, 65, 'Passat CC'),
	(822, 65, 'Phaeton'),
	(823, 65, 'Pointer'),
	(824, 65, 'Polo'),
	(825, 65, 'Polo Sedan'),
	(826, 65, 'Scirocco'),
	(827, 65, 'Sharan'),
	(828, 65, 'Tiguan'),
	(829, 65, 'Touareg'),
	(830, 65, 'Touran'),
	(831, 65, 'Transporter'),
	(832, 66, 'C30'),
	(833, 66, 'C70 Convertible'),
	(834, 66, 'C70 Coupe'),
	(835, 66, 'S40'),
	(836, 66, 'S60'),
	(837, 66, 'S70'),
	(838, 66, 'S80'),
	(839, 66, 'S90'),
	(840, 66, 'V40'),
	(841, 66, 'V50'),
	(842, 66, 'V70'),
	(843, 66, 'V90'),
	(844, 66, 'XC60'),
	(845, 66, 'XC70'),
	(846, 66, 'XC90'),
	(847, 67, 'Chance'),
	(848, 68, '110'),
	(849, 68, '4X4'),
	(850, 68, 'Classics'),
	(851, 68, 'Granta'),
	(852, 68, 'Kalina'),
	(853, 68, 'Priora'),
	(854, 68, 'Samara'),
	(855, 70, 'Tager'),
	(856, 70, 'Vortex Estina'),
	(857, 71, 'Hunter'),
	(858, 71, 'Patriot'),
	(859, 71, 'Pickup');
/*!40000 ALTER TABLE `vehicle_model` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.video
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` text NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `posted` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.video: ~0 rows (приблизительно)
DELETE FROM `video`;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
/*!40000 ALTER TABLE `video` ENABLE KEYS */;

-- Дамп структуры для таблица autotesmer_test.video_tag
CREATE TABLE IF NOT EXISTS `video_tag` (
  `video_id` int(10) unsigned DEFAULT NULL,
  `tag_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Дамп данных таблицы autotesmer_test.video_tag: ~0 rows (приблизительно)
DELETE FROM `video_tag`;
/*!40000 ALTER TABLE `video_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `video_tag` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
