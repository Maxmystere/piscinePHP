SELECT `title`,`summary` FROM `film`
WHERE
	LOWER(`summary`) LIKE '%Vincent%'
ORDER BY `id_film`;
