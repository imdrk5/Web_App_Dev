<?php

	session_start();
	
	unset($_POST);
	unset($_SESSION['userID']);
	
	header("Location: ../../");