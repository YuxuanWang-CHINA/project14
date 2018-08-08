<?php
	namespace Project\Doing;

	final class AddCardId
	{
		function __construct($username)
		{
			$this->addToXml($username);
		}

		private function addToXml($username)
		{
			$file_path = "../../changes/card_id.xml";
			$xml_card_id = new \SimpleXMLElement($file_path, NULL, TRUE);
			$new_id_now = $xml_card_id->id_now + 1;
			$xml_card_id->id_now = $new_id_now;
			//更改id_now元素

			$add_group = $xml_card_id->addChild("group");
			$add_group->addChild("id_pub", $new_id_now);
			$add_group->addChild("user_name", $username);
			//添加记录

			$xml_file=$xml_card_id->asXML();
			file_put_contents($file_path, $xml_file);

		}
	}
?>
<?php
//$asd=new AddCardId("wyx");
?>	