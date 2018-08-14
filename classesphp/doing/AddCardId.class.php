<?php
	namespace Project\Doing;

	final class AddCardId
	{
		public $file_path;
		public $xml_card_id;

		function __construct()
		{
			$this->file_path = "../../changes/card_id.xml";
			$this->xml_card_id = new \SimpleXMLElement($this->file_path, NULL, TRUE);
		}

		function __destruct()
		{
			unset($this->xml_card_id);
		}

		public function addALog($username, $card_type)
		{
			$id_value = $this->addToXml($username);
			$this->addLogToMysql($username, $card_type, $id_value);
		}

		private function addToXml($username)
		{
			$new_id_now = $this->xml_card_id->id_now + 1;
			$this->xml_card_id->id_now = $new_id_now;
			//更改id_now元素

			$add_group = $this->xml_card_id->addChild("group");
			$add_group->addChild("id_pub", $new_id_now);
			$add_group->addChild("user_name", $username);
			//添加记录

			$xml_file=$this->xml_card_id->asXML();
			file_put_contents($this->file_path, $xml_file);
			return $new_id_now;
		}

		private function addLogToMysql($username, $card_type, $id_value)
		{
			include_once "../doing/SetOfMysql.class.php";
			$go_mysql = new \Project\Doing\SetOfMysql();
			$go_mysql->reAddLogToMysql($username, $card_type, $id_value);
			unset($go_mysql);
		}

		public function getIdNew()
		{
			$return_array = array();
			$id_now = $this->xml_card_id->id_now;
			$id_new = $id_now + 1;
			$return_array[0] = $id_new;
			$return_array[1] = md5($id_new);
			return $id_new;
		}
	}
?>
<?php
//$asd=new AddCardId("wyx");
?>	