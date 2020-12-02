<?php
$timestart = microtime(true);
$lignes = file("input2");
if ($lignes === false) die("erreur de lecture de ");
$valid = 0;
for ($i=0; $i<count($lignes); $i++)
{
	$ligne = explode(" ", $lignes[$i]);
	$minmax = explode("-", $ligne[0]);
	$min = $minmax[0];
	$max = $minmax[1];
	$lettre = substr($ligne[1], 0, 1);
	$mdp = $ligne[2];
	//part 1 
	//if (substr_count($mdp, $lettre)>= $min && substr_count($mdp, $lettre)<=$max ) $valid++;
	//part 2
	$min--;
	$max--;
	if (substr($mdp,$min,1) == $lettre xor substr($mdp,$max,1) == $lettre) $valid++; 
}
echo "valides: $valid";
$timeend = microtime(true);
echo "<hr>temps : " . number_format($timeend-$timestart, 4);
?>
