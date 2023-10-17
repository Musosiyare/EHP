<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Event Handler Platform || Service</title>

	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- Bootstrap CSS -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!-- Font Awesome Icons -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- Google Fonts -->
	<link href='//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i'
		rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300'
		rel='stylesheet' type='text/css'>
	<!-- JavaScript -->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({ scrollTop: $(this.hash).offset().top }, 1000);
			});
		});
	</script>
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<![endif]-->

</head>

<body>
	<!-- Banner -->
	<?php include_once('includes/header.php'); ?>

	<div class="wthree-heading">
		<h2 style="color:black;">Events Posted <a href="services.php"><i class="fa fa-calendar"></i></a></h2>
		<hr>
	</div>

	<div class="about-top">
		<div class="container">
			<div class="wthree-services-bottom-grids">
				<div class="bs-docs-example wow fadeInUp animated" data-wow-delay=".5s" style="margin-top:-50px;">
					<?php
					$currentDateTime = date('Y-m-d H:i:s'); // Get the current date and time in 'Y-m-d H:i:s' format
					$sql = "SELECT * FROM tblevents WHERE CONCAT(ServiceDate, ' ', ServiceTime) > :currentDateTime";
					$query = $dbh->prepare($sql);
					$query->bindParam(':currentDateTime', $currentDateTime, PDO::PARAM_STR);
					$query->execute();
					$results = $query->fetchAll(PDO::FETCH_OBJ);

					if ($query->rowCount() > 0) {
						?>
						<table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
							<thead>
								<div style="color:gray;">
									<i class="fa fa-bell" style="color:orange; font-size:20px;"></i>
									Now You Can Select And Book Your Favourite Event. <br>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We Serve Better!
								</div>
								<tr>
									<th>#</th>
									<th>EVENT NAME</th>
									<th>DESCRIPTION</th>
									<th>PRICE</th>
									<th>DATE</th>
									<th>TIME</th>
									<th>LOCATION</th>
									<th>AVAILABLE SEATS</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$cnt = 1;
								foreach ($results as $row) {
									$serviceID = $row->ID;
									$availableSeats = $row->Seats; // Get available seats for the event
							
									// Check if there are available seats
									if ($availableSeats >= 1) {
										$bookingButton = '<a href="book-services.php?serviceID=' . $serviceID . '" class="btn btn-danger"><span style="margin:10px;color:green; font-size:20px;"><i class="fa fa-check mx-5"></i></span>BOOK NOW</a>';
									} else {
										$bookingButton = '<button class="btn btn-danger" disabled>No available seats</button>';
									}
									?>
									<tr>
										<td>
											<?php echo htmlentities($cnt); ?>
										</td>
										<td>
											<?php echo htmlentities($row->ServiceName); ?>
										</td>
										<td style="font-weight:bold;">
											<?php echo htmlentities($row->SerDes); ?>
										</td>
										<td><span class="text-danger" style="font-weight:bold;">Frw</span>
											<?php echo htmlentities($row->ServicePrice); ?>
										</td>
										<td style="color:skyblue;font-weight:bold;">
											<?php echo htmlentities($row->ServiceDate); ?>
										</td>
										<td style="color:skyblue;font-weight:bold;">
											<?php echo htmlentities($row->ServiceTime); ?>
										</td>
										<td>
											<?php echo htmlentities($row->Location); ?>
										</td>
										<td>
											<?php
											$availableSeats = $row->Seats; // Get available seats for the event
									
											// Check if there are available seats
											if ($availableSeats >= 1) {
												echo '<span class="badge badge-primary">' . htmlentities($availableSeats) . '</span>';
												$bookingButton = '<a href="book-services.php?serviceID=' . $serviceID . '" class="btn btn-primary"><span style="margin:10px; "><i class="fa fa-cart-plus mx-5"></i></span>Book Now</a>';
											} else {
												echo '<span class="badge badge-danger">No seats available </span>';
												$bookingButton = '<button class="btn btn-danger" disabled sty=""><span style="margin:10px;color:yellow; "><i class="fa fa-warning mx-5"></i></span>Not Available</button>';
											}
											?>
										</td>
										<td>
											<?php echo $bookingButton; ?>
										</td>
									</tr>
									<?php
									$cnt = $cnt + 1;
								}
								?>
							</tbody>
						</table>
						<?php
					} else {
						// Display a message if no events are posted 
						?>
						<div class="alert alert-danger" style="padding:20px;">
							<button type="button" class="close" data-dismiss="alert"
								style="color:red; font-size:30px;margin-top:-20px;">&times;</button>
							<i class="fa fa-warning" style="font-size:32px;color:orange;"></i>
							&nbsp;&nbsp;&nbsp;&nbsp; <strong
								style="font-size:18px;">Sorry! &nbsp;&nbsp;</strong> <span style="color:gray; font-size:15px;">No event
								posted today.</span>
						</div>
						<?php
					}
					?>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php include_once('includes/footer.php'); ?>

	<!-- JavaScript -->
	<script type="text/javascript">
		function closeNoEvents() {
			document.getElementById("no-events").style.display = "none";
		}
	</script>
</body>

</html>