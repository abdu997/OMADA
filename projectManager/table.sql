 CREATE TABLE IF NOT EXISTS `team_goal` (
     `goal_id` int(11) NOT NULL AUTO_INCREMENT,  
     `team_id` int(11) NOT NULL,
     `status` varchar(200) NOT NULL,
     `goal` varchar(200) NOT NULL,
     `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
     PRIMARY KEY (`goal_id`)
 ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;