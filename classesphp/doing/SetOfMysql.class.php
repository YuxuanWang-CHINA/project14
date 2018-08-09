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
			include_once "../something/GetSomething.class.php";
			include_once "../../configs/things_list.php";
			$get_thing = new \Project\Something\GetSomething(\Project\Something\UDATETIME);
			$upload_time = $get_thing->show_thing();
			unset($get_thing);
			$sql = "UPDATE user SET last_login='".$upload_time."' WHERE user_name='".$username."'";
			$this->connect->query($sql);
		}

		public function reUserAdd($username_input, $password_input)
		{
			include_once "../something/GetSomething.class.php";
			include_once "../../configs/things_list.php";	
			$object_now_date = new \Project\Something\GetSomething(\Project\Something\UDATE);
			$object_now_datetime = new \Project\Something\GetSomething(\Project\Something\UDATETIME);
			$now_date = $object_now_date->show_thing();
			$now_datetime = $object_now_datetime->show_thing();
			unset($object_now_date);
			unset($object_now_datetime);
			$sql = "INSERT INTO user (user_name,passwords,create_time,last_login) VALUES ('".$username_input."','".$password_input."','".$now_date."','".$now_datetime."')";
			$this->connect->query($sql);
		}
	}
?>
<?php
//$asd=new SetOfMysql();
?>