CREATE TABLE `test`.`users` (
`idusers` INT NOT NULL AUTO_INCREMENT,
`username` VARCHAR(45) NOT NULL,
`email` VARCHAR(60) NOT NULL, 
`password` VARCHAR(150) NOT NULL,  
`first_name` VARCHAR(45) NULL,  
`last_name` VARCHAR(45) NULL, 
`team` VARCHAR(45) NULL DEFAULT NULL,
 
PRIMARY KEY (`idusers`),  
UNIQUE INDEX `idusers_UNIQUE` (`idusers` ASC));
CREATE TABLE `team` ( 
`team_id` int(11) NOT NULL AUTO_INCREMENT, 
`team_name` varchar(45) NOT NULL, 
PRIMARY KEY (`team_id`), 
UNIQUE KEY `team_id_UNIQUE` (`team_id`), 
UNIQUE KEY `team_name_UNIQUE` (`team_name`)
);


CREATE TABLE `confirmation_users` (
  
`idconfirmation_users` int(11) NOT NULL AUTO_INCREMENT,
  
`email` varchar(150) NOT NULL,
  
`confirmed` varchar(1) DEFAULT 'N',
    
`team_id` INT,
  
PRIMARY KEY (`idconfirmation_users`),
  
UNIQUE KEY `idconfirmation_users_UNIQUE` 
(`idconfirmation_users`)
);



CREATE TABLE `user_reset` (
  
`id` int(11) NOT NULL AUTO_INCREMENT,
  
`Time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  
`GUID` varchar(150) DEFAULT NULL,
  
`email` varchar(150) DEFAULT NULL,
  
PRIMARY KEY (`id`)
);

CREATE TABLE `team_user` (
  
`t_id` int(11) NOT NULL,
  
`u_id` int(11) NOT NULL,
  
`admin` varchar(1) DEFAULT 'N',
  
PRIMARY KEY (`t_id`,`u_id`)
);   