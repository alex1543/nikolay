<?php

	global $MySQLServer;
	global $MyUser;
	global $MyUserTable;
	global $MyPasswordSQL;

		$MyPWDEff = "8771";
		$MyFileName = "MyPW.txt";
		$MySpecValues = 10;
				
	$MySQLServer = "mysql.hostinger.ru";
	$MyUser = "u296292563_user";
	$MyUserTable = "u296292563_user";
	$MyPasswordSQL = "123456789q";

		if ($_SERVER['SERVER_NAME'] == "localhost") {
			$MySQLServer = "localhost";
			$MyUser = "root";
			$MyUserTable = "nikolay";
			$MyPasswordSQL = "";				
		}
?>

