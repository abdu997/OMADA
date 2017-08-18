CREATE TABLE `chatroom_user` (
  `chatconn_id` int(11) NOT NULL AUTO_INCREMENT,
  `chatroom_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`chatconn_id`,`user_id`,`chatroom_id`),
  KEY `fk_1_idx` (`chatroom_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1


CREATE TABLE `chatrooms` (
  `chatroom_id` int(10) NOT NULL AUTO_INCREMENT,
  `team_id` decimal(11,0) DEFAULT NULL,
  `chatroom_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`chatroom_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1

CREATE TABLE `messages` (
  `messages_id` int(11) NOT NULL AUTO_INCREMENT,
  `chatroom_id` int(11) DEFAULT NULL,
  `class` varchar(45) DEFAULT NULL,
  `sender` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text,
  PRIMARY KEY (`messages_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1