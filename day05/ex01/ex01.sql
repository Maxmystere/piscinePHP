CREATE TABLE ft_table (
	`id` INT UNSIGNED PRIMARY KEY not null AUTO_INCREMENT,
	`login` VARCHAR(10) not null,
	`group` ENUM('staff', 'student', 'other') not null,
	`creation_date` DATE not null
);
