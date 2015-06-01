<?php
try {
$bdd = new PDO('mysql:host=localhost;dbname=dsa;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


	$query = $bdd->query('SELECT SUM(q8a) as q8a, SUM(q8b) as q8b, SUM(q8c) as q8c, SUM(q8d) as q8d, SUM(q8e) as q8e, COUNT(*) as nb FROM global WHERE age_range != "65+" AND age_range != "55-64"');
	if ($data = $query->fetch(PDO::FETCH_ASSOC)) {
		$data['max'] = array_search(max($data), $data);
	}


header('Content-Type: application/json');
print(json_encode($data));

?>