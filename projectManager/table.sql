CREATE TABLE `team_projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `project` varchar(45) NOT NULL,
  `tag_color` varchar(45) NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1

CREATE TABLE `team_goal` (
  `goal_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `goal` varchar(200) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`goal_id`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=latin1

CREATE TABLE `progress_record` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `goal_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `record` varchar(500) NOT NULL,
  `initial_record` varchar(1) NOT NULL,
  `timestamp` varchar(45) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=latin1