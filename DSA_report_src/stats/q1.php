<?php
try {
$bdd = new PDO('mysql:host=localhost;dbname=dsa;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$queryCity = $bdd->query('SELECT DISTINCT(current_city) FROM global');
while ($cities = $queryCity->fetch(PDO::FETCH_ASSOC)) {
	$query = $bdd->query('SELECT SUM(q1a) as q1a, SUM(q1b) as q1b, SUM(q1c) as q1c, SUM(q1d) as q1d, SUM(q1e) as q1e, COUNT(*) as nb FROM global WHERE current_city = "'.$cities['current_city'].'"');
	if ($data = $query->fetch(PDO::FETCH_ASSOC)) {
		$json[$cities['current_city']] = $data;
		$json[$cities['current_city']]['max'] = array_search(max($data), $data);
	}
}

header('Content-Type: application/json');
print(json_encode($json));


?>