<?php
	namespace Project\Doing;

	final class AddCardId
	{
		public $xml_card_id;

		function __construct()
		{
			$file_path = "../../changes/card_id.xml";
			$this->$xml_card_id = new \SimpleXMLElement($file_path, NULL, TRUE);
		}

		private function addToXml($username)
		{
			$new_id_now = $this->$xml_card_id->id_now + 1;
			$this->$xml_card_id->id_now = $new_id_now;
			//更改id_now元素

			$add_group = $this->$xml_card_id->addChild("group");
			$add_group->addChild("id_pub", $new_id_now);
			$add_group->addChild("user_name", $username);
			//添加记录

			$xml_file=$this->$xml_card_id->asXML();
			file_put_contents($file_path, $xml_file);
		}

		public function getIdNow()
		{
			$return_array = array();
			$id_now = $this->$xml_card_id->id_now;
			$return_array[0] = $id_now;
			$return_array[1] = md5($id_now);
			return $return_array;
		}
	}
?>
<?php
//$asd=new AddCardId("wyx");
?>	