<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['obbsuid'] == 0)) {
	header('location:logout.php');
} else {
	$uid = $_SESSION['obbsuid'];
	$userFullName = "";

	// Fetch the user's full name
	$sql = "SELECT FullName FROM tbluser WHERE ID=:uid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':uid', $uid, PDO::PARAM_STR);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);
	if ($result) {
		$userFullName = $result['FullName'];
	}

	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<script type="application/x-javascript">
				addEventListener("load", function () {
					setTimeout(hideURLbar, 0);
				}, false);

				function hideURLbar() {
					window.scrollTo(0, 1);
				}
			</script>
		<title>Booking Report For
			<?php echo $userFullName; ?>
		</title>
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
		<link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i"
			rel="stylesheet">
		<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300'
			rel='stylesheet' type='text/css'>
		<!-- //font -->
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				$(".scroll").click(function (event) {
					event.preventDefault();
					$('html,body').animate({
						scrollTop: $(this.hash).offset().top
					}, 1000);
				});
			});
		</script>
		<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
		<style type="text/css">
			@media print {

				/* Hide unwanted elements when printing */
				body * {
					visibility: hidden;
				}

				.print-section,
				.print-section * {
					visibility: visible;
				}

				.print-section {
					position: absolute;
					left: 0;
					top: 0;
				}

				/* Hide the title from the print */
				.print-title {
					display: none;
				}
			}
		</style>
	</head>

	<body>
		<!-- banner -->
		<?php include_once('includes/header.php'); ?>
		<div class="wthree-heading">
			<h2 class="print-title" style="color:black;">View Booking</h2>
			<hr>
		</div>
		<!-- //banner -->
		<!-- about -->
		<!-- about-top -->
		<div class="about-top">
			<div class="container">
				<div class="wthree-services-bottom-grids" style="margin-top:-50px;">

					<p class="wow fadeInUp animated" data-wow-delay=".5s"><strong>View Your Booking Details.</strong></p>
					<div class="bs-docs-example wow fadeInUp animated" data-wow-delay=".5s">
						<?php
						$uid = $_SESSION['obbsuid'];

						$sql = "SELECT tbluser.FullName,tbluser.MobileNumber,tbluser.Email,tblbooking.BookingID,tblbooking.BookingDate,tblbooking.PricePerEvent,tblbooking.TotalPrice,tblbooking.EventType,tblbooking.Numberofguest,tblbooking.Message, tblbooking.Remark,tblbooking.Status,tblbooking.UpdationDate,tblservice.ServiceName,tblservice.SerDes,tblservice.ServiceDate,tblservice.ServiceTime,tblservice.Location,Remark from tblbooking join tblservice on tblbooking.ServiceID=tblservice.ID join tbluser on tbluser.ID=tblbooking.UserID  where tblbooking.UserID=:uid";
						$query = $dbh->prepare($sql);
						$query->bindParam(':uid', $uid, PDO::PARAM_STR);
						$query->execute();
						$results = $query->fetchAll(PDO::FETCH_OBJ);

						$cnt = 1;
						if ($query->rowCount() > 0) {
							foreach ($results as $row) { ?>
								<div class="print-section">
									<table border="1"
										class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
										<tr>
											<th colspan="5" style="text-align: center;font-size: 20px;color: blue;">Booking Code:
												<?php echo $row->BookingID; ?>
											</th>
										</tr>
										<tr>
											<th>Customer Name</th>
											<td style="color:orange;font-weight:bold;font-size:15px;">
												<?php echo $row->FullName; ?>
											</td>
											<th>Mobile Number</th>
											<td style="color:orange;font-weight:bold;font-size:15px;">
												(+250)
												<?php echo $row->MobileNumber; ?>
											</td>
										</tr>


										<tr>

											<th>Email</th>
											<td style="color:blue;font-weight:bold;font-size:15px;">
												<?php echo $row->Email; ?>
											</td>
											<th>Number of Guest</th>
											<td style="color:orange;font-weight:bold;font-size:15px;">
												<?php echo $row->Numberofguest; ?> Seat(s)
											</td>
										</tr>
										<tr>

											<th>Event Name</th>
											<td>
												<?php echo $row->EventType; ?>
											</td>
											<th>Message</th>
											<td>
												<?php echo $row->Message; ?>
											</td>
										</tr>
										<tr>

											<th>Event Name</th>
											<td>
												<?php echo $row->ServiceName; ?>
											</td>
											<th>Event Description</th>
											<td>
												<?php echo $row->SerDes; ?>
											</td>
										</tr>
										<tr>

											<th>Event Date</th>
											<td>
												<?php echo $row->ServiceDate; ?>
											</td>
											<th>Event Time</th>
											<td>
												<?php echo $row->ServiceTime; ?>
											</td>
										</tr>
										<tr>

											<th>Event Location</th>
											<td>
												<?php echo $row->Location; ?>
											</td>


											<th>Booking Date</th>
											<td>
												<?php echo $row->BookingDate; ?>
											</td>


										</tr>
										<tr>
											<th>Event Price</th>
											<td><span class="text-danger">Frw</span>
												<?php echo $row->PricePerEvent; ?>
											</td>

											<th>Total Price</th>
											<td><span class="text-danger">Frw</span>
												<?php echo $row->TotalPrice; ?>
											</td>

										</tr>

										<tr>

											<th>Order Final Status</th>

											<td style="color:orange;font-weight:bold;font-size:15px;">
												<?php
												if ($row->Status == "Approved") {
													echo "Approved";
												} elseif ($row->Status == "Cancelled") {
													echo "Cancelled";
												} else {
													echo "Not Response Yet";
												}
												?>
											</td>
											<th>Admin Remark</th>
											<td>
												<?php
												if ($row->Status == "") {
													echo "Not Updated Yet";
												} else {
													echo htmlentities($row->Remark);
												}
												?>
											</td>
										</tr>
									</table>
								</div>
								<button id="printButton" class="btn btn-primary">Get Proof</button>
								<script>
									// Function to print the report when the button is clicked
									document.getElementById('printButton').addEventListener('click', function () {
										// Use JavaScript to print the content of the table
										window.print();
									});
								</script>
								<?php $cnt = $cnt + 1;
							}
						} ?>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
		<!-- //about-top -->

		<!-- //about -->
		<!-- footer -->
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
		<!-- here starts scrolling icon -->
		<script type="text/javascript">
			$(document).ready(function () {
				$().UItoTop({ easingType: 'easeOutQuart' });
			});
		</script>
		<!-- //here ends scrolling icon -->
		<script src="js/modernizr.custom.js"></script>
	</body>

	</html>
<?php } ?>