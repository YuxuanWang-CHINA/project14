<?php
	namespace Project\Something;

	final class GetSomething
	{
		private $re_thing;

		function __construct($what)
		{
			$this->re_thing = $this->$what();
		}

		function show_thing()
		{
			return $this->re_thing;
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