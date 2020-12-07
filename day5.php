<?php
$timestart = microtime(true);
$lignes = file("input5");
if ($lignes === false) die("erreur de lecture");
$boarding_passes = array();

for ($i=0; $i<count($lignes); $i++)
{
	$ligne = trim($lignes[$i]);
	
	//row
	$idmin = 0;
	$idmax = 127;
	for ($j=0; $j<7; $j++)
	{
		if (strtoupper($ligne[$j] == 'F')) $idmax -= ceil(($idmax - $idmin)/2);
		else $idmin += 1+floor(($idmax - $idmin)/2);
	}
	
	//column
	$jdmin = 0;
	$jdmax = 7;
	for (; $j<10; $j++)
	{
		if (strtoupper($ligne[$j] == 'L')) $jdmax -= ceil(($jdmax - $jdmin)/2);
		else $jdmin += 1+floor(($jdmax - $jdmin)/2);

	}
	array_push($boarding_passes, 8* $idmin + $jdmin);
}
sort($boarding_passes);

for ($i=1; $i<count($boarding_passes); $i++)
	if ($boarding_passes[$i]-$boarding_passes[$i-1] != 1 &&  $boarding_passes[$i]!=$boarding_passes[$i-1]) echo $boarding_passes[$i]+1;

 
$timeend = microtime(true);
echo "<hr>temps : " . number_format($timeend-$timestart, 4);

?>