<?php
	namespace Project\Something;

	final class getSomething
	{
		function __construct()
		{

		}

		public function getDateUniform()
		{
			$date = new \DateTime();
			return $date->format('Y-m-d H:i:s');
		}
	}
?>
<?php
//$asd=new getSomething();
//$asd->getDateUniform();
?>