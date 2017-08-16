 CREATE TABLE IF NOT EXISTS `linkRepository` (
     `goal_id` int(11) NOT NULL AUTO_INCREMENT,  
     `team_id` int(11) NOT NULL,
     `status` int(11) NOT NULL,
     `goal` varchar(200) NOT NULL,
     `date_created` DATE NOT NULL,
     PRIMARY KEY (`goal_id`)
 ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;