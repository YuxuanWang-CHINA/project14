<?php
	namespace Project\Users;
	session_start();

	class UserLogin
	{
		public $username;

		function __construct($username_input, $password_input)
		{
			$this->username = $username_input;
			$check_back = $this->loginCheck($password_input);
			if ($check_back == TRUE)
			{
				$this->checkRight();
			} else {
				$this->checkWrong();
			}
		}

		private function loginCheck($password)
		{
			include_once "../doing/SetOfMysql.class.php";
			$go_mysql = new \Project\Doing\SetOfMysql();
			$return_bool = $go_mysql->reLoginCheck($this->username, $password);
			unset($go_mysql);
			return $return_bool;
		}

		private function checkRight()
		{
			$_SESSION['username'] = $this->username;
			$this->addLog();
			echo "right";
		}

		private function checkWrong()
		{
			echo "wrong";
		}

		private function addLog()
		{
			include_once "../doing/SetOfMysql.class.php";
			$go_mysql = new \Project\Doing\SetOfMysql();
			$go_mysql->reAddLoginLog($this->username);
			unset($go_mysql);
		}

		public function test_show()
		{

		}
	}
?>
<?php
$asd=new UserLogin("wyx","154yjf6jf");
?>