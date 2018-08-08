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

		public function reLoginCheck($username, $password_wait)
		{
			$sql = "SELECT passwords FROM user WHERE user_name='".$username."'";
			$result = $this->connect->query($sql);
			$return_array = $result->fetch_array();
			$return_bool = $this->verifyCheck($password_wait, $return_array["passwords"]);
			return $return_bool;
		} 

		private function verifyCheck($password_wait, $password_password)
		{
			return password_verify($password_wait, $password_password);
		}

		public function reAddLoginLog($username)
		{
			include_once "../something/getSomething.class.php";
			$get_thing = new \Project\Something\getSomething();
			$upload_time = $get_thing->getDatetimeUniform();
			unset($get_thing);
			$sql = "UPDATE user SET last_login='".$upload_time."' WHERE user_name='".$username."'";
			$this->connect->query($sql);
		}

		public function reUserLogin($username_input, $password_input)
		{
			include_once "../something/getSomething.class.php";
			$get_thing = new \Project\Something\getSomething();
			$now_date = $get_thing->getDateUniform();
			$now_datetime = $get_thing->getDatetimeUniform();
			$sql = "INSERT INTO user (user_name,passwords,create_time,last_login) VALUES ('".$username_input."','".$password_input."','".$now_date."','".$now_datetime."')";
			$this->connect->query($sql);
		}
	}
?>
<?php
//$asd=new SetOfMysql();
?>