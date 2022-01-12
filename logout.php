<?php

	$view = new stdClass();
	session_start();
	session_destroy();

	header('Location:login.php?msg=Thankyou for visiting us.');