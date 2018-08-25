<?php
	namespace Project\Doing;
	include "./OneCard.class.php";

	final class ReadACard extends OneCard
	{
		public function readOne($logs_array)
		{
			$logs_strings = $this->makeArrayToWords($logs_array);
			include_once "../doing/SetOfMysql.class.php";
			$go_mysql = new \Project\Doing\SetOfMysql();
			$results = $go_mysql->reReadOne($this->card_type, $logs_strings);
			unset($go_mysql);
			return $results;
		}
	}	
?>