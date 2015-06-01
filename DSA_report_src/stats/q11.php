<?php
try {
$bdd = new PDO('mysql:host=localhost;dbname=dsa;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$queryActivity = $bdd->query('SELECT DISTINCT(age_range) FROM global');
while ($work = $queryActivity->fetch(PDO::FETCH_ASSOC)) {
	
	$query = $bdd->query('SELECT SUM(q11a) as q11a, SUM(q11b) as q11b, SUM(q11c) as q11c, SUM(q11d) as q11d, SUM(q11e) as q11e, COUNT(*) as nb FROM global WHERE age_range = "'.$work['age_range'].'"');
	if ($data = $query->fetch(PDO::FETCH_ASSOC)) {
		$json[$work['age_range']] = $data;
		$json[$work['age_range']]['max'] = array_search(max($data), $data);
	}
}


header('Content-Type: application/json');
print(json_encode($json));

?>