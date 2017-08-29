CREATE TABLE IF NOT EXISTS `chatroom_user` (
  `chatconn_id` int(11) NOT NULL AUTO_INCREMENT,
  `chatroom_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`chatconn_id`,`user_id`,`chatroom_id`),
  KEY `fk_1_idx` (`chatroom_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1


CREATE TABLE IF NOT EXISTS `chatrooms` (
  `chatroom_id` int(10) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `chatroom_name` varchar(255) NOT NULL,
  PRIMARY KEY (`chatroom_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1

CREATE TABLE IF NOT EXISTS `messages` (
  `messages_id` int(11) NOT NULL AUTO_INCREMENT,
  `chatroom_id` int(11) NOT NULL,
  `class` varchar(45) NOT NULL,
  `sender` int(11) NOT NULL,
  `timestamp` varchar(40) NOT NULL,
  `message` text(500) NOT NULL,
  `initial_message` varchar(45) NOT NULL,
  PRIMARY KEY (`messages_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1