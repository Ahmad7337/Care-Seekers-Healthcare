<?php
	function db(){
		$dbhost = "";
		$dbuser = "";
		$dbpass = "";
		$dbname = "";
		$conDB = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conDB -> error);
		return $conDB;
	}
?>