<?PHP
function ft_is_sort($array)
{
	$i = 0;
	$nbarg = count($array);
	while ($nbarg > 1)
	{
		if ($array[$i] < $array[$i + 1])
		{
			$i++;
			$nbarg--;
		}
		else
		{
			return (false);
		}
	}
	return (true);
}
?>