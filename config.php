<?php
	// db_info
	$host 		= "localhost"; 	
	$username 	= ""; // 帳號	
	$password 	= ""; // 密碼	
	$db_name 	= ""; // 資料庫       
 	$baseurl 	= "http://localhost/"; // 預設路徑 

	$link = new mysqli($host, $username, $password, $db_name);
	@mysqli_set_charset($link,"utf8mb4");
