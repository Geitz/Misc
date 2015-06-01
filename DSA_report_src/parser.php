<?php
try {
$bdd = new PDO('mysql:host=localhost;dbname=dsa;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$feed = 'UV.csv';

// Arrays we'll use later
$keys = array();
$newArray = array();

function csvToArray($file, $delimiter) { 
  if (($handle = fopen($file, 'r')) !== FALSE) { 
    $i = 0; 
    while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) { 
      for ($j = 0; $j < count($lineArray); $j++) { 
        $arr[$i][$j] = $lineArray[$j]; 
      } 
      $i++; 
    } 
    fclose($handle); 
  } 
  return $arr; 
} 

// Do it
$data = csvToArray($feed, ',');

$dt = array_slice($data, 4);
foreach($dt as $d) {
	if (!isset($d[2]))
		continue;

		$flag = true;
		$q = array();
		
		$q[] = explode(' ', str_replace(array("\t", "  "), ' ', preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[7]))));
		$q[] = explode(' ', str_replace(array("\t", "  "), ' ', preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[8]))));
		$q[] = explode(' ', str_replace(array("\t", "  "), ' ', preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[9]))));
		$q[] = explode(' ', str_replace(array("\t", "  "), ' ', preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[10]))));
		$q[] = explode(' ', str_replace(array("\t", "  "), ' ', preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[11]))));
		$q[] = explode(' ', str_replace(array("\t", "  "), ' ', preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[12]))));
		$q[] = explode(' ', str_replace(array("\t", "  "), ' ', preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[13]))));
		$q[] = explode(' ', str_replace(array("\t", "  "), ' ', preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[14]))));
		$q[] = explode(' ', str_replace(array("\t", "  "), ' ', preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[15]))));
		$q[] = explode(' ', str_replace(array("\t", "  "), ' ', preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[16]))));
		$q[] = explode(' ', str_replace(array("\t", "  "), ' ', preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[17]))));
		$q[] = explode(' ', str_replace(array("\t", "  "), ' ', preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[18]))));
		$q[] = explode(' ', str_replace(array("\t", "  "), ' ', preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[19]))));
		$q[] = explode(' ', str_replace(array("\t", "  "), ' ', preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[20]))));
		
		$count = array(5,5,5,5,5,5,5,5,5,5,10,1,1,1);
		$i = 0;
		while ($i < 13) {
			if (count($q[$i]) < $count[$i]) {
				$flag = false;
				break;
			}
			$i++;
		}
		
		if (!$flag)
			continue;
			
	$flag = str_split(preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[22])));
	
	if ($flag[2] == "G" && $flag[4] == 'y' && $flag[6] == 'm' && $flag[8] == 'n') {
		print("FOUND\n");
		$flag = true;
	}
	else {
		$flag = false;
	}
		
	$req = $bdd->prepare('INSERT INTO global(date, draft, ip, uid, question1, q1a, q1b, q1c, q1d, q1e, question2, q2a, q2b, q2c, q2d, q2e, question3, q3a, q3b, q3c, q3d, q3e, question4, q4a, q4b, q4c, q4d, q4e, question5, q5a, q5b, q5c, q5d, q5e, question6, q6a, q6b, q6c, q6d, q6e, question7, q7a, q7b, q7c, q7d, q7e, question8, q8a, q8b, q8c, q8d, q8e, question9, q9a, q9b, q9c, q9d, q9e, question10, q10a, q10b, q10c, q10d, q10e, question11, q11a, q11b, q11c, q11d, q11e, q11f, q11g, q11h, q11i, q11j, question12, q12a, question13, q13a, question14, q14a, current_city, education_lvl, main_activity, time_in_city, age_range, sexe) VALUES (:date, :draft, :ip, :uid, :question1, :q1a, :q1b, :q1c, :q1d, :q1e, :question2, :q2a, :q2b, :q2c, :q2d, :q2e, :question3, :q3a, :q3b, :q3c, :q3d, :q3e, :question4, :q4a, :q4b, :q4c, :q4d, :q4e, :question5, :q5a, :q5b, :q5c, :q5d, :q5e, :question6, :q6a, :q6b, :q6c, :q6d, :q6e, :question7, :q7a, :q7b, :q7c, :q7d, :q7e, :question8, :q8a, :q8b, :q8c, :q8d, :q8e, :question9, :q9a, :q9b, :q9c, :q9d, :q9e, :question10, :q10a, :q10b, :q10c, :q10d, :q10e, :question11, :q11a, :q11b, :q11c, :q11d, :q11e, :q11f, :q11g, :q11h, :q11i, :q11j, :question12, :q12a, :question13, :q13a, :question14, :q14a, :current_city, :education_lvl, :main_activity, :time_in_city, :age_range, :sexe)') or exit(mysql_error());
	$req->execute(array(
		'date' 			=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[2])),
		'draft' 		=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[3])),
		'ip' 			=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[4])),
		'uid' 			=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[5])),
		'question1' 	=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[7])),
		'q1a' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[0][0])),
		'q1b' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[0][1])),
		'q1c' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[0][2])),
		'q1d' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[0][3])),
		'q1e' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[0][4])),
		'question2' 	=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[8])),
		'q2a' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[1][0])),
		'q2b' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[1][1])),
		'q2c' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[1][2])),
		'q2d' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[1][3])),
		'q2e' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[1][4])),
		'question3' 	=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[9])),
		'q3a' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[2][0])),
		'q3b' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[2][1])),
		'q3c' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[2][2])),
		'q3d' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[2][3])),
		'q3e' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[2][4])),
		'question4' 	=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[10])),
		'q4a' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[3][0])),
		'q4b' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[3][1])),
		'q4c' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[3][2])),
		'q4d' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[3][3])),
		'q4e' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[3][4])),
		'question5' 	=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[11])),
		'q5a' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[4][0])),
		'q5b' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[4][1])),
		'q5c' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[4][2])),
		'q5d' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[4][3])),
		'q5e' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[4][4])),
		'question6' 	=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[12])),
		'q6a' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[5][0])),
		'q6b' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[5][1])),
		'q6c' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[5][2])),
		'q6d' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[5][3])),
		'q6e' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[5][4])),
		'question7' 	=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[13])),
		'q7a' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[6][0])),
		'q7b' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[6][1])),
		'q7c' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[6][2])),
		'q7d' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[6][3])),
		'q7e' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[6][4])),
		'question8' 	=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[14])),
		'q8a' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[7][0])),
		'q8b' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[7][1])),
		'q8c' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[7][2])),
		'q8d' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[7][3])),
		'q8e' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $q[7][4])),
		'question9' 	=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[15])),
		'q9a' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[8][0])),
		'q9b' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[8][1])),
		'q9c' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[8][2])),
		'q9d' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[8][3])),
		'q9e' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[8][4])),
		'question10' 	=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[16])),
		'q10a' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[9][0])),
		'q10b' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[9][1])),
		'q10c' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[9][2])),
		'q10d' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[9][3])),
		'q10e' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[9][4])),
		'question11' 	=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[17])),
		'q11a' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[10][0])),
		'q11b' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[10][1])),
		'q11c' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[10][2])),
		'q11d' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[10][3])),
		'q11e' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[10][4])),
		'q11f' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[10][5])),
		'q11g' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[10][6])),
		'q11h' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[10][7])),
		'q11i' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[10][8])),
		'q11j' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[10][9])),
		'question12' 	=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[18])),
		'q12a' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[11][0])),
		'question13' 	=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[19])),
		'q13a' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[12][0])),
		'question14' 	=> preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , $d[20])),
		'q14a' 			=> intval(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$q[13][0])),
		'current_city' 	=> preg_replace('/[\x00-\x1F\x80-\xFF]/', '',preg_replace('/[\x00-\x1F\x80-\xFF]/', '', preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , utf8_encode($d[21]))))),
		
		'education_lvl' => preg_replace('/[\x00-\x1F\x80-\xFF]/', '',preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , ($flag) ? $d[22].', '.$d[23] : $d[22]))),
		'main_activity' => preg_replace('/[\x00-\x1F\x80-\xFF]/', '',preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , ($flag) ? $d[24] : $d[23]))),
		'time_in_city' 	=> preg_replace('/[\x00-\x1F\x80-\xFF]/', '',preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , ($flag) ? $d[25] : $d[24]))),
		'age_range' 	=> preg_replace('/[\x00-\x1F\x80-\xFF]/', '',preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , ($flag) ? $d[26] : $d[25]))),
		'sexe' 			=> preg_replace('/[\x00-\x1F\x80-\xFF]/', '',preg_replace("/\s{2,}/", " ", str_replace(array(" ", "", '"') , array(" ", "", "") , ($flag) ? $d[27] : $d[26])))
		));

		
	//	print("$d[0]\n");
		
}


//echo json_encode($data);

?>