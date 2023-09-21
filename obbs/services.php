<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Event Handler Platform|| Service </title>

	<script
		type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
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
				$('html,body').animate({ scrollTop: $(this.hash).offset().top }, 1000);
			});
		});
	</script>
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
</head>

<body>
	<!-- banner -->
	<div class="banner jarallax">
		<div class="agileinfo-dot">
			<?php include_once('includes/header.php'); ?>
			<div class="wthree-heading">
				<h2>Services</h2>
			</div>
		</div>
	</div>
	<!-- //banner -->
	<!-- about -->
	<!-- about-top -->
	<div class="about-top">
		<div class="container">
			<div class="wthree-services-bottom-grids">

				<p class="wow fadeInUp animated" data-wow-delay=".5s">List of services which is prvided by us.</p>
				<div class="bs-docs-example wow fadeInUp animated" data-wow-delay=".5s">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Event Name</th>
								<th>Description</th>
								<th>Price</th>
								<th>Date</th>
								<th>Time</th>
								<th>Location</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							<!-- ... (Previous code) ... -->

							<!-- Loop through the services and create booking links -->
							<?php
							$currentDate = date('y:m:d');
							$sql = "SELECT * FROM tblservice WHERE ServiceDate > '$currentDate'";
							$query = $dbh->prepare($sql);
							$query->execute();
							$results = $query->fetchAll(PDO::FETCH_OBJ);
							$cnt = 1;
							if ($query->rowCount() > 0) {
								foreach ($results as $row) {
									$serviceID = $row->ID;
									?>
									<tr>
										<td>
											<?php echo htmlentities($cnt); ?>
										</td>
										<td>
											<?php echo htmlentities($row->ServiceName); ?>
										</td>
										<td>
											<?php echo htmlentities($row->SerDes); ?>
										</td>
										<td><span class="text-danger">Frw</span>
											<?php echo htmlentities($row->ServicePrice); ?>
										</td>
										<td>
											<?php echo htmlentities($row->ServiceDate); ?>
										</td>
										<td>
											<?php echo htmlentities($row->ServiceTime); ?>
										</td>
										<td>
											<?php echo htmlentities($row->Location); ?>
										</td>
										<?php if ($_SESSION['obbsuid'] == "") { ?>
											<td><a href="login.php" class="btn btn-primary">Book Service</a></td>
										<?php } else { ?>
											<td><a href="book-services.php?serviceID=<?php echo $serviceID; ?>"
													class="btn btn-danger">Book Service</a></td>
										<?php } ?>
									</tr>
									<?php
									$cnt = $cnt + 1;
								}
							}
							?>
							<!-- ... (Rest of your code) ... -->

						</tbody>
					</table>
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
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function () {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/

			$().UItoTop({ easingType: 'easeOutQuart' });

		});
	</script>
	<!-- //here ends scrolling icon -->
	<script src="js/modernizr.custom.js"></script>

</body>

</html>