<?php 


$conn = new Connection;
 

class Admin extends Connection {


    public function showUsers(){
        $query = mysqli_query($this->connect(), " SELECT * FROM users WHERE type IN ('member', 'guest')");
        return $query;
    }

    public function showBookings($bookingType, $paymentStatus){
        if($paymentStatus == 'pending') {
            $status =  "'pending'"; 
        }else{
            $status = "'paid', 'unpaid', 'pending'";
        }
        $query = mysqli_query($this->connect(), "SELECT * FROM booking LEFT JOIN users ON booking.user_id = users.id WHERE booking_type = '$bookingType' AND payment_status IN ($status) ORDER BY booking.booking_id DESC");
        return $query;
    }

    public function confirmBookings($bookingType, $status, $confirm) {
        $query = mysqli_query($this->connect(), " UPDATE booking SET payment_status = 'paid' WHERE booking_id = '$confirm' ");
    }

}
