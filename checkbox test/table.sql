 CREATE TABLE IF NOT EXISTS `linkRepository` (  
  `id` int(11) NOT NULL AUTO_INCREMENT,  
  `team_id` int(11) NOT NULL,  
  `user_id` int(11) NOT NULL,
  `link` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL, 
  PRIMARY KEY (`id`)  
 ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;