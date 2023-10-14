<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['obbsuid'] == 0)) {
	header('location:logout.php');
} else {
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Event Handler Platform || Booking History</title>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
		<link href="css/font-awesome.css" rel="stylesheet">
		<link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i"
			rel="stylesheet">
		<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300'
			rel='stylesheet' type='text/css'>
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
		<?php include_once('includes/header.php'); ?>
		<div class="wthree-heading">
			<h2 style="color: black;">Booking History <a href="booking-history.php"><i class="fa fa-history"></i></a></h2>
			<hr>
		</div>
		<div class="about-top">
			<div class="container">
				<div class="wthree-services-bottom-grids" style="margin-top: -50px;">
					<p class="wow fadeInUp animated" data-wow-delay=".5s" style="color: orange;">List of booking.</p>
					<div class="bs-docs-example wow fadeInUp animated" data-wow-delay=".5s">
						<table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Booking ID</th>
									<th class="d-none d-sm-table-cell">Customer Name</th>
									<th class="d-none d-sm-table-cell">Mobile Number</th>
									<th class="d-none d-sm-table-cell">Email</th>
									<th class="d-none d-sm-table-cell">Booking Date</th>
									<th class="d-none d-sm-table-cell">Process</th>
									<th class="d-none d-sm-table-cell">Action</th> <!-- New column for Process -->
								</tr>
							</thead>
							<tbody>
								<?php
								$uid = $_SESSION['obbsuid'];
								$sql = "SELECT tbluser.FullName, tbluser.MobileNumber, tbluser.Email, tblbooking.BookingID, tblbooking.BookingDate, tblbooking.Status, tblbooking.ID from tblbooking join tbluser on tbluser.ID=tblbooking.UserID where tblbooking.UserID='$uid'";
								$query = $dbh->prepare($sql);
								$query->execute();
								$results = $query->fetchAll(PDO::FETCH_OBJ);

								$cnt = 1;
								if ($query->rowCount() > 0) {
									foreach ($results as $row) { ?>
										<tr>
											<td class="text-center" style="font-weight: bold;">
												<?php echo htmlentities($cnt); ?>
											</td>
											<td class="font-w600">
												<?php echo htmlentities($row->BookingID); ?>
											</td>
											<td class="font-w600" style="color: orange; font-weight: bold; font-size: 16px;">
												<?php echo htmlentities($row->FullName); ?>
											</td>
											<td class="font-w600">
												<?php echo htmlentities($row->MobileNumber); ?>
											</td>
											<td class="font-w600" style="color: blue; font-weight: bold; font-size: 16px;">
												<?php echo htmlentities($row->Email); ?>
											</td>
											<td class="font-w600">
												<span class="badge badge-primary">
													<?php echo htmlentities($row->BookingDate); ?>
												</span>
											</td>
											<td class="d-none d-sm-table-cell">
												<?php
												if ($row->Status == "Approved") {
													echo '<span class="badge badge-success">Booked <i class="fa fa-check"></i></span>';
												} elseif ($row->Status == "Cancelled") {
													echo '<span class="badge badge-danger">Request Cancelled <i class="fa fa-close"></i></span>';
												} else {
													echo '<span class="badge badge-warning">Request Pending</span>';
												}
												?>
											</td>
											<td class="d-none d-sm-table-cell">
												<a
													href="view-booking-detail.php?editid=<?php echo htmlentities($row->ID); ?>&&bookingid=<?php echo htmlentities($row->BookingID); ?>"><i
														class="fa fa-eye" aria-hidden="true"></i></a>
											</td>
										</tr>
										<?php $cnt = $cnt + 1;
									}
								} ?>
							</tbody>
						</table>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<?php include_once('includes/footer.php'); ?>
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
		<script src="js/SmoothScroll.min.js"></script>
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$().UItoTop({ easingType: 'easeOutQuart' });
			});
		</script>
		<script src="js/modernizr.custom.js"></script>
	</body>

	</html>
<?php } ?>