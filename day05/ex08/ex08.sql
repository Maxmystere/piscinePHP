SELECT `last_name`,`first_name`,`birthdate` FROM `user_card`
WHERE
	YEAR(`birthdate`) = '1989'
ORDER BY `last_name`
