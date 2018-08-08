<?php
	namespace Project\Doing;

	final class ReadACard
	{
		public $file_path;
		public $card_content;

		function __construct($card_type)
		{
			$this->file_path = "../../information/".$card_type.".json";
			$file_string = file_get_contents($this->file_path);
			$this->card_content = json_decode($file_string);
		}

		public function getMysqlColumn()
		{
			$return_array = array();
			$front_column_object= $this->card_content->information;
			$all_number1 = count($front_column_object);
			for ($i = 0; $i < $all_number1; $i++) {
				array_push($return_array, $front_column_object[$i]->i_name);
			}
			$behind_column_array = $this->getTableEnd();
			$all_number2 = count($behind_column_array);
			for ($i = 0; $i < $all_number2; $i++) {
				array_push($return_array, $behind_column_array[$i]);
			}
			return $return_array;
		}

		private function getTableEnd()
		{
			$file_table_end_json = "../../information/table_end.json";
			$file_string = file_get_contents($file_table_end_json);
			$json_table_end = json_decode($file_string);
			$read_json_array = $json_table_end->at_end;
			return $read_json_array;
		}


		public function test_show()
		{
			var_dump($this->getMysqlColumn());
		}
	}
?>
<?php
	$asd= new ReadACard("flights");
	$asd->test_show();
?>