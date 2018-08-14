<?php
	namespace Project\Doing;
	include_once "./OneCard.class.php";

	final class ReadSomeCards extends OneCard
	{
		function pleaseRead($log_name)
		{

		}

		function findUserCards($username, $numbers = 10)
		{
			include_once "../doing/SetOfMysql.class.php";
			$go_mysql = new \Project\Doing\SetOfMysql();
			$the_result = $go_mysql->reFindUserCards($username, $numbers);
			unset($go_mysql);
			var_dump($the_result);
		}
	}	
?>