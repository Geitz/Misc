<?php
try {
$bdd = new PDO('mysql:host=localhost;dbname=dsa;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$query = $bdd->query('SELECT SUM(q7a) as q7a, SUM(q7b) as q7b, SUM(q7c) as q7c, SUM(q7d) as q7d, SUM(q7e) as q7e, COUNT(*) as nb FROM global');
if ($data = $query->fetch(PDO::FETCH_ASSOC)) {
	$data['max'] = array_search(max($data), $data);
}

header('Content-Type: application/json');
print(json_encode($data));

?>