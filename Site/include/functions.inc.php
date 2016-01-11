<?php
	function getEnglishDate($date){
		$membres = explode('/', $date);
		$date = $membres[2].'-'.$membres[0].'-'.$membres[1];
		return $date;
	}

?>
