SELECT UPPER(`last_name`) as "NAME",`first_name`, `price`  FROM `member`, `subscription`, `user_card`
WHERE
	`price` > 42 AND `user_card`.`id_user` = `member`.`id_user_card`
ORDER BY `last_name` ASC, `first_name` ASC;
