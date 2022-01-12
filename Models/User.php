<?php 

// require('database/connection.php');

$conn = new Connection;
 

class User extends Connection {

	public function emailExists($user, $role) {
		$query = mysqli_query($this->connect(), " SELECT * FROM users WHERE email = '$user' AND type = '$role' ");

        if(mysqli_num_rows($query) == 1) {
        	return $query;
        }else{
        	return false;
        }
	}

	public function phoneExists($user, $role) {
		$query = mysqli_query($this->connect(), " SELECT * FROM users WHERE phone = '$user' AND type = '$role' ");

        if(mysqli_num_rows($query) == 1) {
        	return $query;
        }else{
        	return false;
        }
	}

	public function login($user, $password, $role) {
		$query = mysqli_query($this->connect(), " SELECT * FROM users WHERE (email = '$user' OR phone = '$user') AND password = '$password' AND type = '$role' ");

        if(mysqli_num_rows($query) == 1) {
        	return $query;
        }else{
        	return false;
        }
	}	

}