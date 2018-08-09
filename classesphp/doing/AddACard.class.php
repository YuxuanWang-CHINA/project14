<?php
	namespace Project\Doing;
	include_once "./OneCard.class.php";

	final class AddACard extends OneCard
	{
		public function commitChange($insert_array)
		{

		}

		private function insertMysqlColumn()
		{
			$columns_array = $this->getMysqlColumn();
			$key = array_search("id", $columns_array);
			array_splice($columns_array, $key, 1);
			return $columns_array;
		}

		private function EndInputArray()
		{
			$columns_array = $this->getTableEnd();
		}

		public function test_show()
		{

		}
	}
?>
<?php
//$asd=new AddACard("flights");
//$asd->insertMysqlColumn();
?>