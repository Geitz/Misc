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
	
	$query = $bdd->query('SELECT SUM(q3a) as q3a, SUM(q3b) as q3b, SUM(q3c) as q3c, SUM(q3d) as q3d, SUM(q3e) as q3e, COUNT(*) as nb FROM global WHERE main_activity = "'.$work['main_activity'].'"');
	if ($data = $query->fetch(PDO::FETCH_ASSOC)) {
		$json[$work['main_activity']] = $data;
		$json[$work['main_activity']]['max'] = array_search(max($data), $data);
	}
}


header('Content-Type: application/json');
print(json_encode($json));

?>