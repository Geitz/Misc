<?php
try {
$bdd = new PDO('mysql:host=localhost;dbname=dsa;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$query = $bdd->query('SELECT * FROM global');
while ($d = $query->fetch()) {
	//print_r($d);
	$question[] 		= explode(' ', str_replace(array("\t", "  "), ' ', $d['question1']));
	$question[] 		= explode(' ', str_replace(array("\t", "  "), ' ', $d['question2']));
	$question[] 		= explode(' ', str_replace(array("\t", "  "), ' ', $d['question3']));
	$question[] 		= explode(' ', str_replace(array("\t", "  "), ' ', $d['question4']));
	$question[] 		= explode(' ', str_replace(array("\t", "  "), ' ', $d['question5']));
	$question[] 		= explode(' ', str_replace(array("\t", "  "), ' ', $d['question6']));
	$question[] 		= explode(' ', str_replace(array("\t", "  "), ' ', $d['question7']));
	$question[] 		= explode(' ', str_replace(array("\t", "  "), ' ', $d['question8']));
	$question[] 		= explode(' ', str_replace(array("\t", "  "), ' ', $d['question9']));
	$question[] 		= explode(' ', str_replace(array("\t", "  "), ' ', $d['question10']));
	$question[] 		= explode(' ', str_replace(array("\t", "  "), ' ', $d['question11']));
	$question[] 		= explode(' ', str_replace(array("\t", "  "), ' ', $d['question12']));
	$question[] 		= explode(' ', str_replace(array("\t", "  "), ' ', $d['question13']));
	$question[] 		= explode(' ', str_replace(array("\t", "  "), ' ', $d['question14']));
	
	$i = 0;
	$update = '';
	$letter = array(' ', 'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p');
	while ($i < 14) {
		$j = 1;
		foreach($question[$i] as $v) {
			$update .= 'q'.($i + 1).$letter[$j].' = "'.$v.'"';
			$update .= ',';
			$j++;
		}
		
		$i++;
	}
	
	print("UPDATE global SET ".$update." id = '".$d["id"]."' WHERE id = '".$d["id"]."'\n\n");
	$bdd->query('UPDATE globale SET '.$update.' id = "'.$d['id'].'" WHERE id = "'.$d['id'].'"');
}

?>