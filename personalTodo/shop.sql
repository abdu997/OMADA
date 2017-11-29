CREATE TABLE IF NOT EXISTS `personal_todo` (
    `task_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `task` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
    `progress` varchar(20) NOT NULL,
    `status` varchar(20) NOT NULL,
    `timestamp` date NOT NULL,
    PRIMARY KEY (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=01 ;