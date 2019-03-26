#!/usr/bin/php
<?PHP
if ($argc > 1)
{
	if (preg_match("/([Ll]undi|[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche) ([1-9]|[12]\d|3[01]) ([Jj]anvier|[Ff]evrier|[Mm]ars|[Aa]vril|[Mm]ai|[Jj]uin|[Jj]uillet|[Aa]out|[Ss]eptembre|[Oo]ctobre|[Nn]ovembre|[Dd]ecembre) (19[7-9][0-9]|2\d\d{2}) (([01]?\d|2[0-3]):[0-5][0-9]:[0-5][0-9])/", $argv[1]))
	{
		$date = explode(" ", $argv[1]);
		$date[4] = explode(':', $date[4]);
		if (strpos($date[2], "anvier"))
			$date[2] = 1;
		else if (strpos($date[2], "evrier"))
			$date[2] = 2;
		else if (strpos($date[2], "ars"))
			$date[2] = 3;
		else if (strpos($date[2], "avril"))
			$date[2] = 4;
		else if (strpos($date[2], "ai"))
			$date[2] = 5;
		else if (strpos($date[2], "uin"))
			$date[2] = 6;
		else if (strpos($date[2], "uillet"))
			$date[2] = 7;
		else if (strpos($date[2], "out"))
			$date[2] = 8;
		else if (strpos($date[2], "eptembre"))
			$date[2] = 9;
		else if (strpos($date[2], "ctobre"))
			$date[2] = 10;
		else if (strpos($date[2], "ovembre"))
			$date[2] = 11;
		else if (strpos($date[2], "ecembre"))
			$date[2] = 12;
		$timestamp = $date[4][2] + $date[4][1] * 60 + $date[4][0] * 3600 + ($date[1] - 1) * 86400 + ($date[2] - 1) * 2678400 + ($date[3] - 1970) * 31536000;
		print($timestamp);
	}
	else
	{
		print("Wrong Format");
	}
	print("\n");
}
?>