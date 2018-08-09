<?php
	namespace Project\Users;

	class UserAdd
	{
		function __construct($username_use ,$password_use)
		{
			include_once "../doing/SetOfMysql.class.php";
			$password_create = $this->createPassword($password_use);
			$go_mysql = new \Project\Doing\SetOfMysql();
			$go_mysql->reUserAdd($username_use, $password_create);
			unset($go_mysql);
		}

		private function createPassword($password)
		{
			$create_things = password_hash($password, PASSWORD_DEFAULT);
			return $create_things;
		}
	}
?>
<?php
//$asd=new UserAdd("wyx","154yjf6jf");
?>