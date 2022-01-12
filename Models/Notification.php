<?php 

$conn = new Connection;

class Notification extends Connection {

	public function countpending(){
		$query = mysqli_query($this->connect(), "SELECT count(booking_id) as total FROM booking WHERE payment_status = 'pending'");
        $row = mysqli_fetch_assoc($query);
		$totTBooking = $row['total'];
        return $totTBooking;
	}

	public function countpendingtakeAway(){
		$query = mysqli_query($this->connect(), "SELECT count(booking_id) as total FROM booking WHERE booking_type ='takeAway' AND payment_status = 'pending'");
        $row = mysqli_fetch_assoc($query);
		$totTBooking = $row['total'];
        return $totTBooking;
	}

	public function countpendingdineIn(){
		$query = mysqli_query($this->connect(), "SELECT count(booking_id) as total FROM booking WHERE booking_type ='dineIn'  AND payment_status = 'pending' ");
        $row = mysqli_fetch_assoc($query);
		$totDBooking = $row['total'];
        return $totDBooking;
	}

	public function countpendingseaview(){
		$query = mysqli_query($this->connect(), "SELECT count(booking_id) as total FROM booking WHERE booking_type ='seaView'  AND payment_status = 'pending'");
        $row = mysqli_fetch_assoc($query);
		$totSBooking = $row['total'];
        return $totSBooking;
	}
}