<style>
	body{
		background: #fff;
	}
	
	
	.mail-tbl {
		
	}
	.big-text{
	    
	}
</style>
<?php  

if(isset($_GET['booking_id'])){
	/*$sendMail = $bookingObj->sendMail($_GET['booking_id']);
	$send = mysqli_fetch_assoc($sendMail);
	echo $send['booking_id'];*/

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
				<p>Looking forward to serving you again.</p>
			</td>
		</tr>
		<tr>
			<td>
				<table width='30%' cellpadding='10px'>
					<tr>
						<td style='font-size: 18px; margin-top: 20px;'><b>Order No: </b></td><td><b><?= $_GET[booking_id]; ?></b></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
</body></html>";

}
?>