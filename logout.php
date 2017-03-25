<?php
	session_start();
	unset($_SESSION['firstname']);
	unset($_SESSION['username']);
	echo '<meta http-equiv="refresh" content="0;url=index.php" />';
