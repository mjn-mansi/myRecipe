<?php 

require('User.php');

$conn = new Connection;


class Customer extends User {

    public function passwordMatch($password ,$cpassword){
    	if ($password !== $cpassword) {
    		$passwordErr = "Password do not match";
    		return $passwordErr;
    	}
    }

	public function register($name, $email, $phone, $address, $password) {
        $pass = md5($password);
        $sql = "INSERT INTO users (name, email, phone, address,password, type) VALUES
					('$name', '$email','$phone','$address','$pass', 'member')";
        $query = mysqli_query($this->connect(), $sql);

        return $query;
    }

    public function guestLogin($name, $email, $phone, $role) { 

        $query1 = mysqli_query($this->connect(), "SELECT * FROM users WHERE (email = '$email' OR phone = '$phone') AND type = '$role' ");
        if(mysqli_num_rows($query1) >= 1) {
            return $query1;
        }else{
            $query2 = mysqli_query($this->connect(), "INSERT INTO users (name, email, phone, type) VALUES
                    ('$name', '$email','$phone', '$role')"); 
            if($query2) {
                $uid = $this->conn->insert_id;
                $query3 = mysqli_query($this->connect(), "SELECT * FROM users WHERE id = '$uid' ");
                return $query3;
            }
        }
    }

}
 