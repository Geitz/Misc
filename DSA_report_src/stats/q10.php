<?php
try {
$bdd = new PDO('mysql:host=localhost;dbname=dsa;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$query = $bdd->query('SELECT SUM(q10a) as q10a, SUM(q10b) as q10b, SUM(q10c) as q10c, SUM(q10d) as q10d, SUM(q10e) as q10e, COUNT(*) as nb FROM global');
if ($data = $query->fetch(PDO::FETCH_ASSOC)) {
	$data['max'] = array_search(max($data), $data);
}

header('Content-Type: application/json');
print(json_encode($data));

?>