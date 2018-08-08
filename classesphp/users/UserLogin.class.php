<?php
	namespace Project\Users;
	session_start();

	class UserLogin
	{
		public $username;

		function __construct($username_input, $password_input)
		{
			$this->username = $username_input;
			$password = md5($password_input);
			$password_back = $this->loginCheck($password);
			if ($password == $password_back) {
				$this->checkRight();
			} else {
				$this->checkWrong();
			}
		}

		private function loginCheck($password_md5)
		{
			include_once "../doing/SetOfMysql.class.php";
			$go_mysql = new \Project\Doing\SetOfMysql();
			$return_password_md5 = $go_mysql->reLoginCheck($this->username);
			unset($go_mysql);
			return $return_password_md5;
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
			$go_mysql->reAddLog($this->username);
		}

		public function test_show()
		{

		}
	}
?>
<?php
$asd=new UserLogin("wyx","154yjf6jf");
?>