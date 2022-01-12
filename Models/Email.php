<?php 

$conn = new Connection;

class Email extends Connection{ 

	public function sendConfirmationMail($bookingId , $bookingType, $user) {
		echo "<p>$bookingId</p>";
		echo "<p>$bookingType</p>";
		echo "<p>$user</p>";
		
		if($bookingType == 'takeAway' || $bookingType == 'dineIn'){

			$orderLists = mysqli_query($this->connect(), "SELECT * FROM foodbooking WHERE booked_id = '$bookingId'");
			$sum  = 0;
			$lists = "";
			$lists.= "<tr><th>Item</th><th>Price*qty</th></tr>";
			while ($order = mysqli_fetch_assoc($orderLists)) {
				$lists .= "<tr><td style='border:solid 1px #ccc;padding: 5px;'>$order[food_name]</td> <td style='border:solid 1px #ccc;padding: 5px;'> $$order[food_price] * $order[food_qty]</td></tr>";
				$sum += $order['food_price'] * $order['food_qty'];
			}
			$showList = $lists . "<tr><td style='border:solid 1px #ccc;padding: 5px;'><b>Total: </b></td><td style='border:solid 1px #ccc;padding: 5px;'>$".$sum."</td></tr>";
		}else{
			$showList = "
			<tr><td style='border:solid 1px #ccc;padding: 5px;'>Order</td> <td style='border:solid 1px #ccc;padding: 5px;'> Amount</td></tr>
			<tr><td style='border:solid 1px #ccc;padding: 5px;'>Sea view</td> <td style='border:solid 1px #ccc;padding: 5px;'> $19</td></tr>";
		}

		if($_SESSION['user_type'] == 'admin') {
			include '../mail.php';
		}else{
			include 'mail.php';
		}
				// $em = $_SESSION['user_email'];
    	$mail->addAddress($user);  

		$mail->Subject = 'Booking Confirmation';


		$message = "<html><body>
				<div style='width: 80%; margin: auto;'>	
					<table width='100%' style='color: #585858; font-weight: 400; font-size: 14px; line-height: 1.6;' cellpadding='10px'>
						<tr>
							<td style='color: #007290;font-size: 30px;font-weight: bold;text-align: center;'>CAFE COFFE DAY</td>
						</tr>
						<tr>
							<td><hr></td>
						</tr>
						<tr>
							<td>
								Hi User,
								<p>Thanks for using us. Your payment has been made. </p>
								<p>Looking forward to serve you again.</p>
							</td>
						</tr>
						<tr>
							<td>
								<table width='30%' cellpadding='5px'>
									<tr>
										<td style='font-size: 18px; margin-top: 20px;'><b>Order No: </b></td><td><b>$bookingId</b></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table width='30%' style='border:solid 1px #ccc; border-collapse:collapse;'>
							$showList</table></td>
						</tr>
					</table>
				</div>
				</body></html>";
	    
	    $mail->Body = $message;

	    $mailSend = $mail->send();

	    return $mailSend;
	}

}