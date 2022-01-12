<?php  


$conn = new Connection;
 

class Dashboard extends Connection {

	public function unpaidSeaView() {
		$query = mysqli_query($this->connect(), "SELECT count(booking_id), * FROM booking WHERE booking_type = 'seaView' AND payment_status = 'unpaid'");
	}

	public function countCategory(){
		$query = mysqli_query($this->connect(), "SELECT count(category_id) as total FROM category");
		$row = mysqli_fetch_assoc($query);
		$totCat = $row['total'];
        return $totCat;
	}

	public function countMenu(){
		$query = mysqli_query($this->connect(), "SELECT count(menu_id) as total FROM menu");
        $row = mysqli_fetch_assoc($query);
		$totMenu = $row['total'];
        return $totMenu;
	}

	public function countUsers(){
		$query = mysqli_query($this->connect(), "SELECT count(id) as total FROM users WHERE type IN ('guest', 'member')");
        $row = mysqli_fetch_assoc($query);
		$totUsers = $row['total'];
        return $totUsers;
	}

	public function counttakeAway(){
		$query = mysqli_query($this->connect(), "SELECT count(booking_id) as total FROM booking WHERE booking_type ='takeAway' ");
        $row = mysqli_fetch_assoc($query);
		$totTBooking = $row['total'];
        return $totTBooking;
	}

	public function countdineIn(){
		$query = mysqli_query($this->connect(), "SELECT count(booking_id) as total FROM booking WHERE booking_type ='dineIn' ");
        $row = mysqli_fetch_assoc($query);
		$totDBooking = $row['total'];
        return $totDBooking;
	}

	public function countseaview(){
		$query = mysqli_query($this->connect(), "SELECT count(booking_id) as total FROM booking WHERE booking_type ='seaView' ");
        $row = mysqli_fetch_assoc($query);
		$totSBooking = $row['total'];
        return $totSBooking;
	}


}