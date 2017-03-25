<?php
	// db_info
	$host 		= "localhost";
	$username 	= "root";
	$password 	= "123456";
	$db_name 	= "draw";
	$baseurl 	= "http://localhost/draw/"; 

	$link = new mysqli($host, $username, $password, $db_name);
	@mysqli_set_charset($link,"utf8mb4");
