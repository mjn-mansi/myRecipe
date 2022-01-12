<?php  

if (!isset($_SESSION['user_type'])) {
	header('location:index.php');
}elseif (isset($_SESSION['user_type'])) {  
	if ($_SESSION['user_type'] != 'admin') { 
		header('location:index.php');
	} 
}