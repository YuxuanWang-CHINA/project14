<?php
	$xml_card_id = new SimpleXMLElement("../fixed/card_id.xml", NULL, TRUE);
	$new_id_now = $xml_card_id->id_now + 1;
	$xml_card_id->id_now = $new_id_now;
	//更改id_now元素

	$add_group = $xml_card_id->addChild("group");
	$add_group->addChild("id_pub",$new_id_now);
	$add_group->addChild("user_name","void");
	//添加记录
	
	$modi=$xml_card_id->asXML();
	file_put_contents("../fixed/card_id.xml", $modi);
?>