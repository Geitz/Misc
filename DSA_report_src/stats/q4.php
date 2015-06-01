<?php
try {
$bdd = new PDO('mysql:host=localhost;dbname=dsa;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$queryActivity = $bdd->query('SELECT DISTINCT(main_activity) FROM global');
while ($work = $queryActivity->fetch(PDO::FETCH_ASSOC)) {
	
	$query = $bdd->query('SELECT SUM(q4a) as q4a, SUM(q4b) as q4b, SUM(q4c) as q4c, SUM(q4d) as q4d, SUM(q4e) as q4e, COUNT(*) as nb FROM global WHERE main_activity = "'.$work['main_activity'].'"');
	if ($data = $query->fetch(PDO::FETCH_ASSOC)) {
		$json[$work['main_activity']] = $data;
		$json[$work['main_activity']]['max'] = array_search(max($data), $data);
	}
}


header('Content-Type: application/json');
print(json_encode($json));

?>