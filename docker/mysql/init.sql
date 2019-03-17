CREATE DATABASE IF NOT EXISTS `users`;

use `users`;

CREATE TABLE IF NOT EXISTS `user` (
                       `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                       `first_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
                       `last_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `phone` (
                       `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                       `user_id` int(11) unsigned NOT NULL,
                       `phone_no` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
                       PRIMARY KEY (`id`),
                       KEY `user_id` (`user_id`),
                       CONSTRAINT `phone_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;