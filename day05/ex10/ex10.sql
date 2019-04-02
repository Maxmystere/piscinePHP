SELECT `title` as "Title", `summary`as "Summary" FROM `film`
WHERE
	`summary` LIKE '%erotic%'
ORDER BY `prod_year` DESC;
