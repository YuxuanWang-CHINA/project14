<?php
	namespace Project\Something;

	final class getSomething
	{
		function __construct()
		{
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
?>
<?php
//$asd=new getSomething();
//$asd->getDateUniform();
?>