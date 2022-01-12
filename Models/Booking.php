<?php 

$conn = new Connection;

class Booking extends Connection{ 


	public function showCategory() {
		$categoryQuery = mysqli_query($this->connect(), "SELECT * FROM category ORDER BY category_name");
		return $categoryQuery; 
	}


// -------------------------Booking of SEA VIEW, DINE IN, TAKEAWAY STARTS----------------------
	public function bookOrder($userId, $date, $time, $person, $ages, $bookingType, $bookingTimeLimit, $payment ) {
		if($ages != NULL) {
			$ages = implode(',', $ages);
		}


		$sql = "INSERT INTO booking (`user_id`, `booking_date`, `booking_time`, `noOfPerson`, `person_ages`, `booking_type`, `booking_limit`, `payment_amount`) VALUES
					('$userId', '$date', '$time', '$person', '$ages', '$bookingType', '$bookingTimeLimit', '$payment')";
		$query = mysqli_query($this->connect(), $sql);	
		if($query) {
			$lastId = $this->conn->insert_id;
			return $lastId;
		}else{
			return false;
		}		
	}


	public function foodOrder($menus, $qty, $bookedId) {
		$sum = 0;
    	foreach($qty as $key => $q){
    		if(in_array($key, $menus)){
    			$query = mysqli_query($this->connect(), "SELECT * FROM menu WHERE menu_id = '$key'");
        		$row = mysqli_fetch_assoc($query);

        		$sum = $sum + ($row['menu_price'] * $q);
				
				$sql2 = "INSERT INTO foodbooking (food_id, booked_id, food_name, food_price, food_qty) VALUES ('$key','$bookedId', '$row[menu_name]', '$row[menu_price]', '$q')"; 
			    $query2 = mysqli_query($this->connect(), $sql2);
    		}
        }
    	// Update amount
        $query = mysqli_query($this->connect(), " UPDATE booking SET payment_amount = '$sum', payment_status = 'unpaid' WHERE booking_id = '$bookedId' ");
        if($query) {
        	return true;
        }else{
        	return false;
        }
	}
// ------------------------Booking of SEA VIEW, DINE IN, TAKEAWAY ENDS------------------



// ------------------VIEW Booking of SEA VIEW, DINE IN, TAKEAWAY Starts--------------
	public function viewMyBookings() { 
		$query1 = mysqli_query($this->connect(), "SELECT * FROM booking WHERE user_id = '$_SESSION[user_id]' ORDER BY booking.booking_id DESC");
		return $query1;
	} 
// ------------------VIEW Booking of SEA VIEW, DINE IN, TAKEAWAY Ends-------------



// ---------------VIEW DETAIL BOOKINGS STARTS
	public function showBookingDetail($bookingId, $bookingType) {
		$query = mysqli_query($this->connect(), "
				SELECT * FROM foodbooking
				LEFT JOIN menu ON menu.menu_id = foodbooking.food_id 
				WHERE foodbooking.booked_id = '$bookingId' 
				 ");
		return $query;
	}

	public function showSeaViewDetail($bookingId, $bookingType) {
		$query = mysqli_query($this->connect(), "
				SELECT * FROM booking WHERE booking_id = '$bookingId' 
				 ");
		return $query;
	}
// ---------------VIEW DETAIL BOOKINGS ENDS

	public function checkPaymentStatus($id){
        $query = mysqli_query($this->connect(), "SELECT payment_status, booking_type FROM  booking WHERE booking_id = '$id'");
        return $query;
    }

// ----------------GET ORDERS TO SEND IN MAIL
    public function getOrders($id){
    	$orderquery = mysqli_query($this->connect(), "SELECT * FROM foodbooking WHERE booked_id = '$id'");
    	return $orderquery;
    }

// ---------------REORDER STARTS--------------------
    public function reorder($id, $type) {
		$sql1 = "SELECT * FROM booking WHERE booking_id = '$id'";
        $query1 = mysqli_query($this->connect(), $sql1);
        if($query1) {
        	$rw = mysqli_fetch_assoc($query1);
        	$sql2 = "INSERT INTO booking (`user_id`, `booking_date`, `booking_time`, `noOfPerson`, `person_ages`, `booking_type`, `booking_limit`, `payment_amount`, `payment_status`) VALUES
					('$_SESSION[user_id]', '$rw[booking_date]', '$rw[booking_time]', '$rw[noOfPerson]', '$rw[person_ages]', '$type', '$rw[booking_limit]', '$rw[payment_amount]', 'unpaid')";
        	$query2 = mysqli_query($this->connect(), $sql2);
        	if($query2){
    	    	$booking_id = $this->conn->insert_id;
    	    	if($type == 'dineIn' || $type == 'takeAway'){
	    	    	
	    	    	// foodbooking for dineIn or takeaway
	    	    	// step 1. get all the food id ordered previsously
	    	    	$sql3 = "SELECT * FROM foodbooking WHERE booked_id  = '$id' ";
	        		$query3 = mysqli_query($this->connect(), $sql3);
	        		
	        		$sum = 0;

	        		while ($rw3 = mysqli_fetch_assoc($query3)) {
	        			$sum += $rw3['food_price'] * $rw3['food_qty'] ;
	        			echo "<p>$rw3[food_name] $rw3[food_price] $rw3[food_qty]</p>";
						$sql4 = "INSERT INTO foodbooking 
						(food_id, booked_id, food_name, food_price, food_qty) 
						VALUES 
						( '$rw3[food_id]', '$booking_id', '$rw3[food_name]', '$rw3[food_price]', '$rw3[food_qty]' )"; 
					    $query5 = mysqli_query($this->connect(), $sql4);
	        		}

	        		echo $sum;

		        	// Update amount
	        		mysqli_query($this->connect(), " UPDATE booking SET payment_amount = '$sum', payment_status = 'unpaid' WHERE booking_id = '$booking_id' ");
		        	return $booking_id;
        		}elseif($type == 'seaView'){
		        	return $booking_id;
        		}
        	}
        }		
	}

	public function updateReorderTime($date, $time, $bookingId){
        $query = mysqli_query($this->connect(), "UPDATE booking SET booking_date='$date', booking_time='$time' WHERE booking_id = '$bookingId'");
        return $query;
	}


// ----------------------DELETE OLD BOOKINGS--------------------------------	
	public function deleteOldBookings(){
		$n = date('Y-m-d H:i:s');
		$now =  strtotime($n);	// if delay is of 1 hour then delete it
		// echo $n;
		$query = mysqli_query($this->connect(), "SELECT * FROM booking WHERE user_id = '$_SESSION[user_id]' AND payment_status = 'unpaid' ");
		if(mysqli_num_rows($query) > 0){
			while ($r = mysqli_fetch_assoc($query)) {
				$tm = strtotime($r['booking_date'].' '.$r['booking_time']);
				if($now > $tm + 900) { // 15 minutes
					// echo "<p>".$now . " ( ". date('d-m-y h:i', $tm) ." ) </p>";
					
					$q = mysqli_query($this->connect(), "DELETE FROM foodbooking WHERE booked_id  = '$r[booking_id]' ");
					if($q) {
						$q2 = mysqli_query($this->connect(), "DELETE FROM booking WHERE booking_id = '$r[booking_id]' ");
						if($q2) {
							echo "<p style='text-center'>Your previous bookings due to unpaid has been cancelled</p>";
						}

					}

				} 
				// echo "<p>Your Booking id: $r[booking_id] got deleted as payment was not made.</p>";
			}
		}	
	}	

}