<?php
try {
$bdd = new PDO('mysql:host=localhost;dbname=dsa;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$queryActivity = $bdd->query('SELECT DISTINCT(sexe) FROM global');
while ($work = $queryActivity->fetch(PDO::FETCH_ASSOC)) {
	
	$query = $bdd->query('SELECT SUM(q9a) as q9a, SUM(q9b) as q9b, SUM(q9c) as q9c, SUM(q9d) as q9d, SUM(q9e) as q9e, COUNT(*) as nb FROM global WHERE sexe = "'.$work['sexe'].'"');
	if ($data = $query->fetch(PDO::FETCH_ASSOC)) {
		$json[$work['sexe']] = $data;
		$json[$work['sexe']]['max'] = array_search(max($data), $data);
	}
}


header('Content-Type: application/json');
print(json_encode($json));

?>