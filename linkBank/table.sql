 CREATE TABLE IF NOT EXISTS `link_bank` (  
  `record_id` int(11) NOT NULL AUTO_INCREMENT,  
  `team_id` int(11) NOT NULL,  
  `user_id` int(11) NOT NULL,
  `link` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL, 
  `status` varchar(20) NOT NULL, 
  `timestamp` date NOT NULL, 
  PRIMARY KEY (`record_id`)  
 ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=01 ;