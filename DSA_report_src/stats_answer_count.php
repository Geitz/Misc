<?php
	
	$question = file_get_contents("./questions.json");
	$asw = file_get_contents("./answers.json");
	
	/*
	** Nombre de note a X pour chaque sous réponse
	** Note moyenne pour chaque sous réponse
	*/	
	
	$GLOBAL_QUESTIONS = json_decode($question);
	$GLOBAL_ANSWERS = json_decode($asw);
	
	
	function get_stats($gquestion, $ganswer, $question, $asn) {
		
		//print_r($ganswer);
		//exit();
		$count = 1;
		$notes = array();

		foreach($ganswer->votes as $a) {
			$as = $a->answers;	
			$notes[] = $as[$question][$asn];
			//print_r($as[$question][$asn]); print("\n");
			$count++;
		}

		print_r($repartition);
		$repartition = array_count_values($notes);
		$sum = 0;
		foreach($repartition as $k=>$v) {
			$k = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $k);
			$sum += $k * $v;
		}
		
		$avg = $sum / $count;
		return (array('avg' => $avg, 'sum' => $sum, 'repartition' => $repartition));
	}
	
	$data = array();
	$i = 1;
	foreach($GLOBAL_QUESTIONS->questions as $q) {
		//print_r($q);
		$data['questions'][$i]['label'] = $q->label; 
		$j = 0;
		foreach($q->answers as $v) {
			$data['questions'][$i]['answers'][$v] = get_stats($GLOBAL_QUESTIONS, $GLOBAL_ANSWERS, $i, $j);
			$j++;
		}
		$i++;
	}
	
	$fd = fopen('./stats_answer_count.json', 'w+');
	fwrite($fd, json_encode($data));
	fclose($fd);
?>