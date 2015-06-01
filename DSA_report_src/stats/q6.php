<?php
try {
$bdd = new PDO('mysql:host=localhost;dbname=dsa;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


	$query = $bdd->query('SELECT SUM(q6a) as q6a, SUM(q6b) as q6b, SUM(q6c) as q6c, SUM(q6d) as q6d, SUM(q6e) as q6e, COUNT(*) as nb FROM global WHERE age_range != "65+" AND age_range != "55-64"');
	if ($data = $query->fetch(PDO::FETCH_ASSOC)) {
		$data['max'] = array_search(max($data), $data);
	}


header('Content-Type: application/json');
print(json_encode($data));

?>