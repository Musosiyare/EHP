<?php
session_start();
error_reporting(0);
include "pay.php";
include('includes/dbconnection.php');
// Check if the user is logged in
if (strlen($_SESSION['obbsuid'] == 0)) {
	header('location:logout.php');
} else {
	if (isset($_POST['submit'])) {
		$bid = $_GET['serviceID']; // Service ID of the event
		$uid = $_SESSION['obbsuid'];
		$ppe = $_POST['ppe'];
		$tp = $_POST['tp'];
		$eventtype = $_POST['eventtype'];
		$nop = $_POST['nop'];
		$message = $_POST['message'];
		$bookingid = mt_rand(100000000, 999999999);
		$phone = $_POST["phone"];
		$amount = $_POST["tp"];
		// Retrieve the current number of available seats from the database
		$sqlGetAvailableSeats = "SELECT seats FROM tblevents WHERE ID = :bid";
		$queryGetAvailableSeats = $dbh->prepare($sqlGetAvailableSeats);
		$queryGetAvailableSeats->bindParam(':bid', $bid, PDO::PARAM_STR);
		$queryGetAvailableSeats->execute();
		$row = $queryGetAvailableSeats->fetch(PDO::FETCH_ASSOC);
		$currentAvailableSeats = $row['seats'];

		// Validate Number of Guests (only accept numbers and not less than 1)
		if (!is_numeric($nop) || $nop < 1 || $nop > $currentAvailableSeats) {
			echo '<script>alert("Enter a valid number not greater than available seats and not less than 1")</script>';
		} else {
			// Validate Message (only characters, special characters, and spaces with a minimum length of 3)
			if (!preg_match("/^[a-zA-Z\s\W]{3,}$/", $message)) {
				echo '<script>alert("Message should only contain characters, special characters, and spaces (minimum 3 characters).")</script>';
			} else {
				// Calculate the updated available seats after booking
				$updatedAvailableSeats = $currentAvailableSeats - $nop;

				// Update the 'seats' column in the database with the new available seat count
				$sqlUpdateAvailableSeats = "UPDATE tblevents SET seats = :updatedAvailableSeats WHERE ID = :bid";
				$queryUpdateAvailableSeats = $dbh->prepare($sqlUpdateAvailableSeats);
				$queryUpdateAvailableSeats->bindParam(':updatedAvailableSeats', $updatedAvailableSeats, PDO::PARAM_INT);
				$queryUpdateAvailableSeats->bindParam(':bid', $bid, PDO::PARAM_STR);
				$queryUpdateAvailableSeats->execute();
				//generate unique transaction reference without using payment class
				$transaction_ref = "PAYMENT-" . rand(100000, 999999);
				//REQUEST PAYMENT 
				$pay = hdev_payment::pay($phone, $amount, $transaction_ref, "");
				// check if payment is successful
				if ($pay->status != "success") {
					echo "<script>alert('" . $pay->message . "')</script>";
					return;
				} else {
					// end payment
					// Proceed with inserting the booking record
					// Proceed with inserting the booking record
					$sql = "INSERT INTO tblbooking (BookingID, ServiceID, UserID, PricePerEvent, TotalPrice, EventType, Numberofguest, Message) VALUES (:bookingid, :bid, :uid, :ppe, :tp, :eventtype, :nop, :message)";
					$query = $dbh->prepare($sql);
					$query->bindParam(':bookingid', $bookingid, PDO::PARAM_STR);
					$query->bindParam(':bid', $bid, PDO::PARAM_STR);
					$query->bindParam(':uid', $uid, PDO::PARAM_STR);
					$query->bindParam(':ppe', $ppe, PDO::PARAM_STR);
					$query->bindParam(':tp', $tp, PDO::PARAM_STR);
					$query->bindParam(':eventtype', $eventtype, PDO::PARAM_STR);
					$query->bindParam(':nop', $nop, PDO::PARAM_STR);
					$query->bindParam(':message', $message, PDO::PARAM_STR);

					$query->execute();
					$LastInsertId = $dbh->lastInsertId();
					if ($LastInsertId > 0) {
						echo "<script>alert('payment initiated wait for confirmation')</script>";
						echo "<script>window.location.href='wait.php?pay_ref=" . $transaction_ref . "'</script>";
					} else {
						echo '<script>alert("Something Went Wrong. Please try again")</script>';
					}
				}
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Event Handler Platform | Book Services</title>
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- bootstrap-css -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!--// bootstrap-css -->
	<!-- css -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!--// css -->
	<!-- font-awesome icons -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome icons -->
	<!-- font -->
	<link href='//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i'
		rel='stylesheet'>
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300'
		rel='stylesheet' type='text/css'>
	<!-- //font -->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({ scrollTop: $(this.hash).offset().top }, 1000);
			});

			// Calculate total price live
			$("#nop").on("input", function () {
				var ppe = parseFloat($("#ppe").val()) || 1;
				var nop = parseInt($(this).val()) || 1;
				var total = ppe * nop;
				$("#tp").val(total.toFixed(2));
			});

			// Set the initial total price
			var initialPPE = parseFloat($("#ppe").val()) || 1;
			var initialNOP = parseInt($("#nop").val()) || 1;
			var initialTotal = initialPPE * initialNOP;
			$("#tp").val(initialTotal.toFixed(2) + "Frw");
		});
	</script>
	<style>
		.agile-contact-form {
			background-color: #f0f0f0;
			/* Grayish white background color */
			padding: 30px;
			border-radius: 5px;
		}

		.agileinfo-contact-form-grid input[type="text"],
		.agileinfo-contact-form-grid textarea {
			background-color: white;
			/* White background for input fields and textareas */
			border: 1px solid #ccc;
			padding: 10px;
			width: 100%;
			margin-bottom: 20px;
			border-radius: 3px;
			font-size: 20px;
		}
	</style>
</head>

<body>
	<!-- banner -->
	<?php include_once('includes/header.php'); ?>
	<div class="wthree-heading">
		<h2 style="color:black;">Book Event</h2>
		<hr>
	</div>
	<!-- //banner -->
	<!-- contact -->
	<div class="contact">
		<div class="container">
			<div class="agile-contact-form" style="margin-top:-50px;">
				<div class="col-md-6 contact-form-right">
					<div class="contact-form-top">
						<h3>Book Now!</h3>
					</div>
					<div class="agileinfo-contact-form-grid">
						<form method="post">
							<div class="form-group row">
								<label class="col-form-label col-md-4">Event Name</label>
								<div class="col-md-10" style="font-size: 20px;color:orange;font-weight:bold;">
									<?php
									if (isset($_GET['serviceID'])) {
										$serviceID = $_GET['serviceID'];
										$sql2 = "SELECT * from tblevents where ID='$serviceID' ";
										$query2 = $dbh->prepare($sql2);
										$query2->execute();
										$result2 = $query2->fetchAll(PDO::FETCH_OBJ);

										foreach ($result2 as $row) {
											?>
											<?php echo htmlentities($row->ServiceName); ?>
										<?php }
									} ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-4">Price/Event</label>
								<div class="col-md-10">
									<input type="text" class="form-control"
										style="font-size: 18px;color:orange;font-weight:bold;" required="true"
										name="ppe" value="<?php echo $row->ServicePrice; ?> Frw" id="ppe" readonly>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-10">
									<input type="hidden" class="form-control" style="font-size: 18px" required="true"
										name="seats" value="<?php echo $row->Seats; ?>" id="seats" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-4">Number of Seats <span
										style="color:red;">*</span></label>
								<div class="col-md-10">
									<input type="text" class="form-control" style="font-size: 20px" name="nop" id="nop"
										placeholder="Maximum is <?php echo $row->Seats; ?> Seat(s)"
										onblur="validateNumberOfGuests(this)">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-4">Total Price</label>
								<div class="col-md-10">
									<input type="text" class="form-control"
										style="font-size: 18px;color:orange;font-weight:bold;" name="tp" id="tp"
										readonly>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-4">Phone To Pay On <span
										style="color:red;">*</span></label>
								<div class="col-md-10">
									<input type="text" class="form-control"
										style="font-size: 18px;color:orange;font-weight:bold;" name="phone" id="phone"
										placeholder="Eg:078..." pattern="[0-9]{10}" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-4">Message <span style="color:red;">*</span></label>
								<div class="col-md-10">
									<textarea class="form-control" name="message" placeholder="Message Goes Here!"
										onblur="validateMessage(this)"></textarea>
								</div>
							</div>
							<br>
							<div class="tp">
								<button type="submit" class="btn btn-primary" name="submit">
									<i class="fa fa-cart-plus"></i> Book Now
								</button>
							</div>
						</form>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- //contact -->
	<?php include_once('includes/footer.php'); ?>
	<!-- jarallax -->
	<script src="js/jarallax.js"></script>
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript">
		/* init Jarallax */
		$('.jarallax').jarallax({
			speed: 0.5,
			imgWidth: 1366,
			imgHeight: 768
		})
	</script>
	<!-- //jarallax -->
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script>
		function validateNumberOfGuests(input) {
			var nop = parseInt(input.value);
			if (isNaN(nop) || nop < 1) {
				alert("Number of Guests should be a valid number not less than 1");
				input.value = ''; // Clear the input
			}
		}

		function validateMessage(input) {
			// Regular expression to match characters, special characters, and spaces but not numbers
			var regex = /^[a-zA-Z\s\W]*$/;
			if (!regex.test(input.value)) {
				alert("Message should contain only characters, special characters, and spaces.");
				input.value = ''; // Clear the input
			}
		}
	</script>
</body>

</html>