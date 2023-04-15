<?php 

	session_start();

	$_SESSION = array();

	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-86400, '/');
	}

	session_destroy();

	// препращане на потребителя към заглавната страница
	header('Location: login.php?action=logout');

 ?>