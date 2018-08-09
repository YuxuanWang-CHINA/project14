<?php
	namespace Project\Doing;

	class OneCard
	{
		public $card_content;

		function __construct($card_type)
		{
			$file_path = "../../information/".$card_type.".json";
			$file_string = file_get_contents($file_path);
			$this->card_content = json_decode($file_string);
		}

		public function getMysqlColumn()
		{
			$return_array = $this->getTableFront();
			$behind_column_array = $this->getTableEnd();
			$all_number = count($behind_column_array);
			for ($i = 0; $i < $all_number; $i++) {
				array_push($return_array, $behind_column_array[$i]);
			}
			return $return_array;
		}

		protected function getTableFront()
		{
			$return_front_array = array();
			$front_column_object= $this->card_content->information;
			$all_number = count($front_column_object);
			for ($i = 0; $i < $all_number; $i++) {
				array_push($return_front_array, $front_column_object[$i]->i_name);
			}
			return $return_front_array;			
		}

		protected function getTableEnd()
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
	//$asd= new OneCard("flights");
	//$asd->test_show();
?>