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
	<style>
		@keyframes moveIcon {
			0% {
				transform: translateX(0);
			}

			50% {
				transform: translateX(20px);
			}

			100% {
				transform: translateX(0);
			}
		}

		/* Apply the animation to the image */
		#animated-icon {
			animation: moveIcon 2s infinite;
		}
	</style>
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
												$bookingButton = '<button class="btn btn-danger" disabled sty=""><span style="margin:10px;color:yellow; "><i class="fa fa-warning mx-5"></i></span>NO BOOKING</button>';
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
						echo '<div id="no-events" style="background-color: orangered; color: white; padding: 50px; text-align: center; position: relative;">No Event Posted today !!!<img src="images/gif1.png" alt="Animated Icon" style="animation: moveIcon 2s infinite;"><button onclick="closeNoEvents()" style="position: absolute; top: 5px; right: 5px; color: black; padding: 10px;">Close</button></div>';
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