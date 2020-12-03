<?php
$timestart = microtime(true);

function slope($right, $down)
{
	$toboggan = file("input3");
	if ($toboggan === false) die("erreur de lecture");

	//compteur d'arbres 
	$arbres = 0;

	//coords
	$x = 0;
	$y = 0;

	//mod
	$xmax = strlen($toboggan[0])-2;

	while ($y<count($toboggan)) 
	{
		$x += $right;
		if ($x>$xmax) $x = $x-$xmax-1;
		$y += $down;
		if ($y<count($toboggan) && substr($toboggan[$y], $x, 1) != '.') $arbres++;
	}

	return $arbres;
}

echo slope(1, 1) * slope(3, 1) * slope(5, 1) * slope(7, 1) * slope(1, 2);


$timeend = microtime(true);
echo "<hr>temps : " . number_format($timeend-$timestart, 4);
?>