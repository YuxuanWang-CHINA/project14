<?php
const UDATE = "getDateUniform";

	final class getSomething
	{
		function __construct($what)
		{
			echo $this->$what();
		}

		public function getDatetimeUniform()
		{
			$date = new \DateTime();
			return $date->format('Y-m-d H:i:s');
		}

		public function getDateUniform()
		{
			$date = new \DateTime();
			return $date->format('Y-m-d');
		}
	}

$asd=new getSomething(UDATE);
?>