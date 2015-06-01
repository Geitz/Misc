<?php
try {
$bdd = new PDO('mysql:host=localhost;dbname=dsa;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$query = $bdd->query('SELECT SUM(q5a) as q5a, SUM(q5b) as q5b, SUM(q5c) as q5c, SUM(q5d) as q5d, SUM(q5e) as q5e, COUNT(*) as nb FROM global');
if ($data = $query->fetch(PDO::FETCH_ASSOC)) {
	$data['max'] = array_search(max($data), $data);
}


header('Content-Type: application/json');
print(json_encode($data));

?>