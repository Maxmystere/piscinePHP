SELECT COUNT(*) AS "films" FROM `film`
WHERE
	(`last_projection` BETWEEN '2006-10-30' AND '2007-07-27')
	OR DATE_FORMAT(`last_projection`, "%m-%d") = "12-24"
;
