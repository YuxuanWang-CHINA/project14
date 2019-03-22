<?php
	namespace Project\Doing;

	final class ReadSomeCards
	{
		private $username;

		public function getYours($userinput, $numbers = 10)
		{
			$this->username = $userinput;
			$logs_array = $this->findUserCards($numbers);//第一步找到logs
			$final_result = $this->getAllCards($logs_array);
			//var_dump($final_result);
			return $final_result;
		}

		private function findUserCards($numbers)
		{
			include_once "../doing/SetOfMysql.class.php";
			$go_mysql = new \Project\Doing\SetOfMysql();
			$the_result = $go_mysql->reFindUserCards($this->username, $numbers);
			unset($go_mysql);
			//var_dump($the_result);
			return $the_result;
		}

		private function getAllCards($logs_results)
		{
			//var_dump($logs_results);
			$logs_correct1 = array_column($logs_results, "type", "logs");
			$logs_correct2 = array_count_values($logs_correct1);
			$logs_correct3 = array_keys($logs_correct2);
			$all_types_number = count($logs_correct3);
			//var_dump($logs_correct1);
			$final_result = array();
			for ($i = 0; $i < $all_types_number; $i++) {
				$type = $logs_correct3[$i];
				$logs_this_type = array_keys($logs_correct1, $type);
				//var_dump($logs_this_type);
				include_once("./ReadACard.class.php");
				$object_read = new ReadACard($type);
				$get_results = $object_read->readOne($logs_this_type);
				$combination = array($type, $get_results);
				array_push($final_result, $combination);
				//var_dump($get_results);
				//按类别输出
			}
			return $final_result;
			//var_dump($final_result);
		}
	}
?>
<?php
$asd=new ReadSomeCards();
$asd->getYours("wyx");
?>
