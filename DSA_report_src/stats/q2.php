<?php
try {
$bdd = new PDO('mysql:host=localhost;dbname=dsa;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$queryAge = $bdd->query('SELECT DISTINCT(time_in_city) FROM global');
while ($age = $queryAge->fetch(PDO::FETCH_ASSOC)) {
	
	$query = $bdd->query('SELECT SUM(q2a) as q2a, SUM(q2b) as q2b, SUM(q2c) as q2c, SUM(q2d) as q2d, SUM(q2e) as q2e, COUNT(*) as nb FROM global WHERE time_in_city = "'.$age['time_in_city'].'"');
	if ($data = $query->fetch(PDO::FETCH_ASSOC)) {
		$json[$age['time_in_city']] = $data;
		$json[$age['time_in_city']]['max'] = array_search(max($data), $data);
	}
}


header('Content-Type: application/json');
print(json_encode($json));

?>