--
-- Database table: `user_users_empty`
--

DROP TABLE IF EXISTS `user_users_empty`;

CREATE TABLE `user_users_empty` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(128) NOT NULL,
    `alias` varchar(128) NOT NULL,
    `password` varchar(255) NOT NULL,
    `status` bit NOT NULL,
    `created_on` datetime NOT NULL,
    `updated_on` datetime DEFAULT NULL,
    `pwd_reset_token` varchar(32) DEFAULT NULL,
    `pwd_reset_token_created_on` datetime DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`),
    UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
