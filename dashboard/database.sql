CREATE TABLE IF NOT EXISTS `users`(
    `user_id` INT(11) NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(60) NOT NULL,
    `password` VARCHAR(150) NOT NULL,
    `first_name` VARCHAR(45) NOT NULL,
    `last_name` VARCHAR(45) NOT NULL,
    `status` VARCHAR(45) NOT NULL,
    PRIMARY KEY(`user_id`),
    UNIQUE KEY `user_id_UNIQUE`(`user_id`),
    UNIQUE KEY `email_UNIQUE`(`email`)
) ENGINE = InnoDB AUTO_INCREMENT = 01 DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `password_reset`(
    `request_id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) DEFAULT NULL,
    `user_email` VARCHAR(45) DEFAULT NULL,
    `token` VARCHAR(45) DEFAULT NULL,
    `timestamp` VARCHAR(45) DEFAULT NULL,
    `expiration` VARCHAR(45) DEFAULT NULL,
    `status` VARCHAR(45) DEFAULT NULL,
    PRIMARY KEY(`request_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 01 DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `team`(
    `team_id` INT(11) NOT NULL AUTO_INCREMENT,
    `team_name` VARCHAR(45) NOT NULL,
    `type` VARCHAR(45) NOT NULL,
    `plan` VARCHAR(45) NOT NULL,
    PRIMARY KEY(`team_id`),
    UNIQUE KEY `team_id_UNIQUE`(`team_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 01 DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `team_user`(
    `team_connect_id` INT(11) NOT NULL AUTO_INCREMENT,
    `team_id` INT(11) NOT NULL,
    `user_id` INT(11) NOT NULL,
    `admin` VARCHAR(1) NOT NULL,
    PRIMARY KEY(`team_connect_id`),
    UNIQUE KEY `team_connect_id_UNIQUE`(`team_connect_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 01 DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `team_nonuser`(
    `confirmation_id` INT(11) NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(45) NOT NULL,
    `team_id` INT(11) NOT NULL,
    `admin` VARCHAR(1) NOT NULL,
    `status` VARCHAR(45) NOT NULL,
    PRIMARY KEY(`confirmation_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 01 DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `team_boards`(
    `board_id` INT(11) NOT NULL AUTO_INCREMENT,
    `team_id` INT(11) NOT NULL,
    `board` VARCHAR(45) NOT NULL,
    `tag_color` VARCHAR(45) NOT NULL,
    PRIMARY KEY(`board_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 01 DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `team_goal`(
    `goal_id` INT(11) NOT NULL AUTO_INCREMENT,
    `board_id` INT(11) NOT NULL,
    `team_id` INT(11) NOT NULL,
    `status` VARCHAR(200) NOT NULL,
    `goal` VARCHAR(200) NOT NULL,
    `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`goal_id`)
) ENGINE = MyISAM AUTO_INCREMENT = 01 DEFAULT CHARSET = latin1; 

CREATE TABLE IF NOT EXISTS `progress_record`(
    `record_id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `team_id` INT(11) NOT NULL,
    `goal_id` INT(11) NOT NULL,
    `board_id` INT(11) NOT NULL,
    `record` VARCHAR(500) NOT NULL,
    `initial_record` VARCHAR(1) NOT NULL,
    `timestamp` VARCHAR(45) NOT NULL,
    PRIMARY KEY(`record_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 01 DEFAULT CHARSET = latin1; 

CREATE TABLE IF NOT EXISTS `pert_table`(
    `record_id` INT(11) NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(255) DEFAULT NULL,
    `team_id` INT(11) NOT NULL,
    `user_id` INT(11) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) DEFAULT NULL,
    `start_message` VARCHAR(255) DEFAULT NULL,
    `start_time` DATE DEFAULT NULL,
    `end_time` DATE DEFAULT NULL,
    `expected_time` INT(11) DEFAULT NULL,
    `optimistic_time` INT(11) DEFAULT NULL,
    `realistic_time` INT(11) DEFAULT NULL,
    `pessimistic_time` INT(11) DEFAULT NULL,
    `goal_id` INT(11) DEFAULT NULL,
    `task_id` INT(11) DEFAULT NULL,
    `color` VARCHAR(10) DEFAULT NULL,
    `progress` VARCHAR(20) DEFAULT NULL,
    `timestamp` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `status` VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY(`record_id`),
    UNIQUE KEY `record_id_UNIQUE`(`record_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = latin1; 

CREATE TABLE IF NOT EXISTS `link_bank`(
    `record_id` INT(11) NOT NULL AUTO_INCREMENT,
    `team_id` INT(11) NOT NULL,
    `user_id` INT(11) NOT NULL,
    `link` VARCHAR(200) NOT NULL,
    `note` VARCHAR(200) NOT NULL,
    `status` VARCHAR(20) NOT NULL,
    `timestamp` DATE NOT NULL,
    PRIMARY KEY(`record_id`)
) ENGINE = MyISAM DEFAULT CHARSET = latin1 AUTO_INCREMENT = 01; 

CREATE TABLE IF NOT EXISTS `personal_todo`(
    `task_id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `task` VARCHAR(200) COLLATE utf8_unicode_ci NOT NULL,
    `progress` VARCHAR(20) NOT NULL,
    `status` VARCHAR(20) NOT NULL,
    `timestamp` DATE NOT NULL,
    PRIMARY KEY(`task_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci AUTO_INCREMENT = 01;