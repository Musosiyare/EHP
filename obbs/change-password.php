<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['obbsuid'] == 0)) {
	header('location:logout.php');
} else {
	if (isset($_POST['submit'])) {
		$uid = $_SESSION['obbsuid'];
		$cpassword = md5($_POST['currentpassword']);
		$newpassword = md5($_POST['newpassword']);
		$sql = "SELECT ID FROM tbluser WHERE ID=:uid and Password=:cpassword";
		$query = $dbh->prepare($sql);
		$query->bindParam(':uid', $uid, PDO::PARAM_STR);
		$query->bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);

		if ($query->rowCount() > 0) {
			$con = "update tbluser set Password=:newpassword where ID=:uid";
			$chngpwd1 = $dbh->prepare($con);
			$chngpwd1->bindParam(':uid', $uid, PDO::PARAM_STR);
			$chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
			$chngpwd1->execute();

			echo '<script>alert("Your password successully changed")</script>';
		} else {
			echo '<script>alert("Your current password is wrong")</script>';

		}



	}
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Event Handler Platform | Change Password</title>

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

		<script type="text/javascript">
			function checkpass() {
				if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
					alert('New Password and Confirm Password field does not match');
					document.changepassword.confirmpassword.focus();
					return false;
				}
				return true;
			}

		</script>
		<style>
			.agile-contact-form {
				background-color: #f0f0f0;
				/* Grayish white background color */
				padding: 30px;
				border-radius: 5px;
			}

			.agileinfo-contact-form-grid input[type="password"],
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
			<h2 style="color:black;">Change Password</h2>
			<hr>
		</div>
		<!-- //banner -->
		<!-- contact -->
		<div class="contact">
			<div class="container">
				<div class="agile-contact-form" style="margin-top:-50px;">

					<div class="col-md-6 contact-form-right">
						<div class="contact-form-top">
							<h3 style="color:orange;">User Profile </h3>
						</div>
						<div class="agileinfo-contact-form-grid">
							<form method="post" onsubmit="return checkpass();" name="changepassword">
								<div class="form-group row">
									<label class="col-form-label col-md-4">Current Password:</label>
									<div class="col-md-10">
										<input type="password" class="form-control" style="font-size: 20px" required="true"
											name="currentpassword">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-md-4">New Password:</label>
									<div class="col-md-10">
										<input type="password" class="form-control" required="true" name="newpassword"
											style="font-size: 20px">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-md-4">Confirm Password:</label>
									<div class="col-md-10">
										<input type="password" class="form-control" required="true" name="confirmpassword"
											style="font-size: 20px">
									</div>
								</div>

								<br>
								<div class="tp">

									<button type="submit" class="btn btn-primary" name="submit">
									<i class="fa fa-save mr-5"></i> Save
									</button>
								</div>
							</form>

						</div>
					</div>

					<div class="clearfix"> </div>
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
<?php } ?>