<?php
$timestart = microtime(true);
$lignes = file("input6");
if ($lignes === false) die("erreur de lecture");
array_push($lignes, "\n");
$compter=0;

$j=0;

for ($i=0; $i<count($lignes); $i++)
{
	if ($lignes[$i] != "\n" )
	{
		$ligne = trim($lignes[$i]);
		${'cara'.$j} = array();
		for ($k=0; $k<strlen($ligne); $k++) 
		{
			array_push(${'cara'.$j}, $ligne[$k]);
		}
		$j++;
	}
	else 
	{
		for ($z=0; $z<($j-1); $z++)
		{
			${'cara' . ($z+1)} = array_intersect(${'cara'.$z}, ${'cara' . ($z+1)});
			
		}
		$compter += count(${'cara' . ($z)});
		$j=0;
	}
}

echo "valides: " . $compter;
$timeend = microtime(true);
echo "<hr>temps : " . number_format($timeend-$timestart, 4);
?>