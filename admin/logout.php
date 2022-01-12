<?php

	$view = new stdClass();
	session_start();
	session_destroy();

	header('Location:index.php?msg=Thankyou for visiting us.');