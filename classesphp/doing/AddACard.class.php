<?php
	namespace Project\Doing;
	include_once "./OneCard.class.php";

	final class AddACard extends OneCard
	{
		public $id;

		public function commitChange($insert_array)
		{
			$this->getId();//第一步
			$this->createLog();//第二步，添加XML和数据库中的logs
			$this->insertIntoMysql($insert_array);//第三步，加入数据库
		}

		//第三步对应，加入数据库
		private function insertIntoMysql($insert_array)
		{
			$the_columns = $this->makeCorrectString($insert_array)[1];
			$the_columns = str_replace("'", "", $the_columns);
			$end_table_value = $this->endInputArray();
			$front_table_value = $this->makeCorrectString($insert_array)[0];
			$all_value = $front_table_value.",".$end_table_value;
			//var_dump($all_value);
			//var_dump($the_columns);
			include_once "./SetOfMysql.class.php";
			$go_mysql = new \Project\Doing\SetOfMysql();
			$go_mysql->reInsertIntoMysql($this->card_type, $the_columns, $all_value);
			unset($go_mysql);
		}

		//处理输入数组,返回2个一个值一个行
		private function makeCorrectString($insert_array)
		{
			$the_columns = $this->insertMysqlColumn();
			$key_table_array = $this->getTableFront();
			$key_insert_array = array_keys($insert_array);
			$key_input_yes = array_intersect($key_table_array, $key_insert_array);//取交集
			$key_input_none = array_values(array_diff($key_table_array, $key_insert_array));//取差集
			//var_dump($key_input_none);
			$all_number = count($key_input_none);
			for ($i = 0; $i < $all_number; $i++) {
				$key = array_search($key_input_none[$i], $the_columns);
				array_splice($the_columns, $key, 1);	
			}
			
			$insert_string = $this->makeArrayToWords(array_values($insert_array));
			$return_array = array();
			$return_array[0] = $insert_string;
			$return_array[1] = $this->makeArrayToWords($the_columns);
			return $return_array;
		}

		//得到sql的列
		private function insertMysqlColumn()
		{
			$columns_array = $this->getMysqlColumn();
			$key = array_search("id", $columns_array);
			array_splice($columns_array, $key, 1);
			return $columns_array;
		}

		//对于模块数据库表的表格结尾值
		private function endInputArray()
		{		
			$logs_value = md5($this->id);
			$user_value = $this->username;
			$return_array = array($logs_value, $user_value);
			$return_string = $this->makeArrayToWords($return_array);
			return $return_string;
		}

		//第一步对应
		private function createLog()
		{
			include_once "./AddCardId.class.php";
			$add_card_log = new AddCardId();
			$add_card_log->addALog($this->username, $this->card_type);
			unset($add_card_log);
		}

		//得到现在的id值
		private function getId()
		{
			include_once "./AddCardId.class.php";
			$add_card = new AddCardId();
			$this->id = $add_card->getIdNew();
			unset($add_card);
		}

		public function test_show($arr)
		{
			//$this->getId();
			//$this->createLog();
			//$this->insertIntoMysql($arr);
		}
	}
?>

<?php
$asdf=array("train_number"=>"G7140","when_to_fly"=>"1614","the_date"=>"20180819");

$asd=new AddACard("trains");
$asd->commitChange($asdf);
?>