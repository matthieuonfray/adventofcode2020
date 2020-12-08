<?php
define('FILE', "input8");
if (($lignes = file(FILE)) === false) die("erreur de lecture " . FILE);

//NOP
$j=0;
$nopc = substr_count(file_get_contents(FILE), 'nop');

while (1)
{
	//RAZ jeu
	$k=0;
	$i=0;
	$acc = 0;
	$instr = array();
	while (! in_array($i, $instr))
	{
		if ($i >= count($lignes)) die("acc=" . $acc);
		array_push($instr, $i);
		$ligne = trim($lignes[$i]);
		$ordre = substr($ligne, 0, 3);
		$vl = substr($ligne, 4);
		switch ($ordre)
		{
			case "acc": $acc += $vl; $i++; break;
			case "nop": 
				//EXPLOIT jmp
				if ($j==$k) $i += $vl;
				else $i++;
				$k++;  
				break;
			case "jmp" : $i += $vl; break;
		}
	}

	//NEXT exploit
	$j++;
	if ($j>$nopc) break;
}
echo "échec partiel $j<br>";


$j=0;
$jmpc = substr_count(file_get_contents(FILE), 'jmp');

while (1)
{
	//RAZ jeu
	$k=0;
	$i=0;
	$acc = 0;
	$instr = array();
	while (! in_array($i, $instr))
	{
		if ($i >= count($lignes)) die("acc=" . $acc);
		array_push($instr, $i);
		$ligne = trim($lignes[$i]);
		$ordre = substr($ligne, 0, 3);
		$vl = substr($ligne, 4);
		switch ($ordre)
		{
			case "acc": $acc += $vl; $i++; break;
			case "nop": $i++; break;
			case "jmp" : 
			if ($j==$k)	$i++;
			else $i += $vl; 
			$k++;
			break;
		}
	}
	//NEXT exploit
	$j++;
	if ($j>$jmpc) break;

}
echo "échec total $j";
?>