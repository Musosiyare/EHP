<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['obbsuid'] == 0)) {
	header('location:logout.php');
} else {
	if (isset($_POST['submit'])) {
		$bid = $_GET['serviceID'];
		$uid = $_SESSION['obbsuid'];
		$ppe = $_POST['ppe'];
		$tp = $_POST['tp'];
		$eventtype = $_POST['eventtype'];
		$nop = $_POST['nop'];
		$message = $_POST['message'];
		$bookingid = mt_rand(100000000, 999999999);

		// Validate Number of Guests (only accept numbers and not less than 1)
		if (!is_numeric($nop) || $nop < 1) {
			echo '<script>alert("Number of Guests should be a valid number and not less than 1.")</script>';
		} else {
			// Validate Message (only characters, special characters, and spaces with minimum length of 3)
			if (!preg_match("/^[a-zA-Z\s\W]{3,}$/", $message)) {
				echo '<script>alert("Message should only contain characters, special characters, and spaces (minimum 3 characters).")</script>';
			} else {
				// Proceed with inserting the booking record
				$sql = "insert into tblbooking(BookingID,ServiceID,UserID,PricePerEvent,TotalPrice,EventType,Numberofguest,Message)values(:bookingid,:bid,:uid,:ppe,:tp,:eventtype,:nop,:message)";
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
					echo '<script>alert("Your Booking Request Has Been Sent. We Will Contact You Soon")</script>';
					echo "<script>window.location.href ='services.php'</script>";
				} else {
					echo '<script>alert("Something Went Wrong. Please try again")</script>';
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
				var ppe = parseFloat($("#ppe").val()) || 0;
				var nop = parseInt($(this).val()) || 0;
				var total = ppe * nop;
				$("#tp").val(total.toFixed(2));
			});

			// Set the initial total price
			var initialPPE = parseFloat($("#ppe").val()) || 0;
			var initialNOP = parseInt($("#nop").val()) || 0;
			var initialTotal = initialPPE * initialNOP;
			$("#tp").val(initialTotal.toFixed(2));
		});
	</script>
</head>

<body>
	<!-- banner -->
	<div class="banner jarallax">
		<div class="agileinfo-dot">
			<?php include_once('includes/header.php'); ?>
			<div class="wthree-heading">
				<h2>Book Event</h2>
			</div>
		</div>
	</div>
	<!-- //banner -->
	<!-- contact -->
	<div class="contact">
		<div class="container">
			<div class="agile-contact-form">
				<div class="col-md-6 contact-form-right">
					<div class="contact-form-top">
						<h3>Book Event</h3>
					</div>
					<div class="agileinfo-contact-form-grid">
						<form method="post">
							<div class="form-group row">
								<label class="col-form-label col-md-4">Event Name:</label>
								<div class="col-md-10">
									<select type="text" class="form-control" name="eventtype" required="true">
										<?php
										if (isset($_GET['serviceID'])) {
											$serviceID = $_GET['serviceID'];
											$sql2 = "SELECT * from tblservice where ID='$serviceID' ";
											$query2 = $dbh->prepare($sql2);
											$query2->execute();
											$result2 = $query2->fetchAll(PDO::FETCH_OBJ);

											foreach ($result2 as $row) {
												?>
												<option value="<?php echo htmlentities($row->ServiceName); ?>">
													<?php echo htmlentities($row->ServiceName); ?>
												</option>
											<?php }
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-4">Price/Event:</label>
								<div class="col-md-10">
									<input type="text" class="form-control" style="font-size: 20px" required="true"
										name="ppe" value="<?php echo $row->ServicePrice; ?>" id="ppe" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-4">Number of Guests:</label>
								<div class="col-md-10">
									<input type="text" class="form-control" style="font-size: 20px" name="nop" id="nop"
										onblur="validateNumberOfGuests(this)">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-4">Total Price:</label>
								<div class="col-md-10">
									<input type="text" class="form-control" style="font-size: 20px" name="tp" id="tp"
										readonly>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-4">Message (if any):</label>
								<div class="col-md-10">
									<textarea class="form-control" name="message" style="font-size: 20px"
										onblur="validateMessage(this)"></textarea>
								</div>
							</div>
							<br>
							<div class="tp">
								<button type="submit" class="btn btn-primary" name="submit">BOOK NOW</button>
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
				alert("Number of Guests should be a valid number and not less than 1.");
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