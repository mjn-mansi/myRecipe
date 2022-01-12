<?php 

$conn = new Connection;

class Payment extends Connection{ 

	public function makeCashPayment($mode, $id) {
        $query = mysqli_query($this->connect(), "UPDATE booking SET payment_mode='$mode', payment_status='pending' WHERE booking_id = '$id'");

        return $query;
    } 	

    public function makeIbanPayment($mode, $id, $fname, $lname, $cardNo, $cvv, $expiry) {
        $query = mysqli_query($this->connect(), "UPDATE booking SET payment_mode='$mode', payment_status='paid' WHERE booking_id = '$id'");
        if($query){
            // $bookingId = $this->conn->insert_id;
            $query1 = mysqli_query($this->connect(), "INSERT INTO `payment_detail`(`pay_booking_id`, `fname`, `lname`, `cardNo`, `cvv`, `expiry`) VALUES ('$id', '$fname', '$lname', '$cardNo', '$cvv', '$expiry')");
            return $query1;  
        }
        else{
            return false;
        }
    }

    

}