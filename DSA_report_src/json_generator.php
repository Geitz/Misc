<?php
try {
$bdd = new PDO('mysql:host=localhost;dbname=dsa;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$data = array();

$data['questions'][1] = array('label' => '1. Parks and green spaces', 'answers' => array('1a. Preserve existing turf', '1b. Construction of parks in existing neighborhoods', '1c. Build homes near green spaces', '1d. Renovate existing parks', '1e. Improve accessibility to major green spaces'));

$data['questions'][2] = array('label' => '2. Diversity in the housing supply', 'answers' => array('2a. Offer more housing types', '2b. Offer more apartment sizes', '2c. Offer small-scale land ownership', '2d. Preserve the conceptual foundations of the buildings from the 1970s', '2e. Offer more housing near the water'));

$data['questions'][3] = array('label' => '3. A Living UV Places', 'answers' => array('3a. Mix Traffic Act', '3b. Place parking along the streets', '3c. Turning entrances to streets', '3d. Place public buildings in transparent ground floors', '3e. Secure parking solutions for homes'));

$data['questions'][4] = array('label' => '4. Communications', 'answers' => array('4a. Pairing the new streets with existing ones to strengthen the connection to the adjacent neighborhoods and reduce the barriers that the main roads pose.', '4b. Improve communications at night between various parts of the municipality', '4c. Improve communications to and from the UV Improve the north-south and east-west routes through a fine-mesh and well integrated metropolitan area networks.', '4e. Improve communications to and from downtown Stockholm'));

$data['questions'][5] = array('label' => '5. Culture & Recreation', 'answers' => array('5a. Expand the range of cultural sports and leisure activities', '5b. Creating better opportunities for festivals and concerts', '5c. Creating more opportunities for outdoor sports', '5d. Create marketplaces outdoors', '5e. Providing municipal grants for cultural and leisure projects'));

$data['questions'][6] = array('label' => '6. education', 'answers' => array('6a. Renovate older schools', '6b. Building new schools', '6c. Improve the schoolyard the physical environments', '6d. Improve the quality of primary education', '6e. Improve the quality of secondary education are'));

$data['questions'][7] = array('label' => '7. caring', 'answers' => array('7a. More cultural and recreational activities for the elderly', '7b. More cultural and recreational activities for children and young people', '7c. Improving care for the elderly in the municipality', '7d. More youth centers and field assistants', '7e. Reduce the groups of children in preschool'));

$data['questions'][8] = array('label' => '8. The School', 'answers' => array('8a. Small groups of children in preschool', '8b. Raise the quality of teaching', '8c. More professional development for schools and teachers', '8d. Mer modern information technology (IT) in education', '8e. Involve carers more in school'));

$data['questions'][9] = array('label' => '9. security', 'answers' => array('9a. Increase security around the station area', '9b. More police in central Väsby', '9c. Improve the lighting in the center of Vasby', '9d. Narrow opening hours for alcohol outlets in central Väsby', '9e. Extend hours of business in central Väsby'));

$data['questions'][10] = array('label' => '10. sustainable development', 'answers' => array('10a. Reduce energy consumption', '10b. Reduce transport and noise', '10c. Increase climate adaptation and recycling', '10d. Prioritize environmentally friendly transport modes (walking, cycling, public transport)', '10e. Reducing environmental toxins and hazardous chemicals in nature'));

$data['questions'][11] = array('label' => '11. Weighting', 'answers' => array('1. Parks and green spaces', '2. Diversity in the housing supply', '3. A Living common places', '4. Communications', '5. Culture and Leisure', '6. education', '7. caring', '8. The School', '9. security', '10. ecological sustainability'));

$data['questions'][12] = array('label' => '12. Water or housing', 'answers' => array('12a. Build homes near water', '12b. Preserving nature and shorelines intact'));

$data['questions'][13] = array('label' => '13. Service or green areas', 'answers' => array('13a. Densify the city center and increasing service','13b. Preserving green spaces intact'));

$data['questions'][14] = array('label' => '14. Seat or smaller urban', 'answers' => array('14a. Develop central Upplands Väsby', '14b. Opt for smaller urban areas in the municipality'));

//print_r($data);

/*
$fd = fopen('./questions.json', 'w+');
fwrite($fd, json_encode($data));
*/

$answers = array();

$req = $bdd->query('SELECT * FROM global');
while ($d = $req->fetch()) {
	
	$answers['votes'][] = array(
		'informations' => array(
			'date'			=> $d['date'],
			'ip'			=> $d['ip'],
			'current_city'	=> $d['current_city'],
			'education_lvl'	=> $d['education_lvl'],
			'sexe'			=> $d['sexe'],
			'age_range'		=> $d['age_range'],
			'time_in_vasby'	=> $d['time_in_city']
		),
		'answers'		=> array(null,
			explode("\t", $d['question1']),
			explode("\t", $d['question2']),
			explode("\t", $d['question3']),
			explode("\t", $d['question4']),
			explode("\t", $d['question5']),
			explode("\t", $d['question6']),
			explode("\t", $d['question7']),
			explode("\t", $d['question8']),
			explode("\t", $d['question9']),
			explode("\t", $d['question10']),
			explode("\t", $d['question11']),
			explode("\t", $d['question12']),
			explode("\t", $d['question13']),
			explode("\t", $d['question14']),
		)
	);
}

$answers['infos'] = array('total' => count($answers['votes']));

$fd = fopen('./answers.json', 'w+');
fwrite($fd, json_encode($answers));


		
	/*
$req = $bdd->prepare('INSERT INTO global(date, draft, ip, uid, question1, question2, question3, question4, question5, question6, question7, question8, question9, question10, question11, question12, question13, question14, current_city, education_lvl, main_activity, time_in_city, age_range, sexe) VALUES(:date, :draft, :ip, :uid, :question1, :question2, :question3, :question4, :question5, :question6, :question7, :question8, :question9, :question10, :question11, :question12, :question13, :question14, :current_city, :education_lvl, :main_activity, :time_in_city, :age_range, :sexe)');
	$req->execute(array(
		'date' 			=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[2]),
		'draft' 		=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[3]),
		'ip' 			=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[4]),
		'uid' 			=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[5]),
		'question1' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[7]),
		'question2' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[8]),
		'question3' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[9]),
		'question4' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[10]),
		'question5' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[11]),
		'question6' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[12]),
		'question7' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[13]),
		'question8' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[14]),
		'question9' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[15]),
		'question10' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[16]),
		'question11' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[17]),
		'question12' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[18]),
		'question13' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[19]),
		'question14' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[20]),
		'current_city' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[21]),
		'education_lvl' => str_replace(array(" ", "", '"') , array(" ", "", "") , $d[22]),
		'main_activity' => str_replace(array(" ", "", '"') , array(" ", "", "") , $d[23]),
		'time_in_city' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[24]),
		'age_range' 	=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[25]),
		'sexe' 			=> str_replace(array(" ", "", '"') , array(" ", "", "") , $d[26])
		));
		
		print("$d[0]\n");
		
}
*/

//echo json_encode($data);

?>