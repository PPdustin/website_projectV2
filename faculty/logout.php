<?php
	session_start();
	session_unset();
	header("Location: ../login/login.html");
	exit;
?>