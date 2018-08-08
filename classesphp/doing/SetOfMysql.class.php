<?php
	namespace Project\Doing;

	final class SetOfMysql
	{	
		public $connect;

		function __construct()
		{
			include_once "../../configs/mysql_set.php";
			$this->connect = new \mysqli(MYSQL_SERVER_NAME, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
			//echo $this->connect->stat();
		}

		function __destruct()
		{
			$this->connect->close();
		}

		public function reLoginCheck($username)
		{
			$sql = "SELECT passwords FROM user WHERE user_name='".$username."'";
			$result = $this->connect->query($sql);
			$return_array = $result->fetch_array();
			return $return_array["passwords"];
		} 

		public function reAddLog($username)
		{
			include_once "../something/getSomething.class.php";
			$get_thing = new \Project\Something\getSomething();
			$upload_time = $get_thing->getDateUniform();
			$sql = "UPDATE user SET last_login='".$upload_time."' WHERE user_name='".$username."'";
			$this->connect->query($sql);
		}
	}
?>
<?php
//$asd=new SetOfMysql();
?>