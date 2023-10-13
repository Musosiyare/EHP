<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['odmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $upid = $_GET['upid'];
        $serName = $_POST['sername'];
        $serPrice = $_POST['serprice'];
        $serDate = $_POST['serdate'];
        $serTime = $_POST['sertime'];
        $Location = $_POST['location'];
        $serSeats = $_POST['serseats'];

        // Server-side validation
        $errors = serverSideValidation($serName, $serPrice, $serDate, $serTime, $serSeats);

        if (empty($errors)) {
            $sql = "UPDATE tblevents SET ServiceName=:sername, ServicePrice=:serprice, ServiceDate=:serdate, ServiceTime=:sertime, Location=:location,Seats=:serseats WHERE ID=:upid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':sername', $serName, PDO::PARAM_STR);
            $query->bindParam(':serprice', $serPrice, PDO::PARAM_STR);
            $query->bindParam(':serdate', $serDate, PDO::PARAM_STR);
            $query->bindParam(':sertime', $serTime, PDO::PARAM_STR);
            $query->bindParam(':location', $Location, PDO::PARAM_STR);
            $query->bindParam(':serseats', $serSeats, PDO::PARAM_STR);
            $query->bindParam(':upid', $upid, PDO::PARAM_STR);
            $query->execute();

            echo '<script>alert("Event has been updated")</script>';
            echo "<script>window.location.href ='manage-services.php'</script>";
        } else {
            // Display validation errors
            foreach ($errors as $field => $error) {
                echo '<script>alert("' . $error . '")</script>';
            }
        }
    }
}

function serverSideValidation($serName, $serPrice, $serDate, $serTime, $serSeats)
{
    $nameRegex = '/^[A-Za-z\s]{3,}$/';
    $priceRegex = '/^[0-9]+$/';
    $seatsRegex = '/^[0-9]+$/';
    $minPrice = 100;
    $minSeats = 1;

    $errors = [];

    if (!preg_match($nameRegex, $serName)) {
        $errors['sername'] = "Event Name must be at least 3 characters and spaces only.";
    }

    if (!preg_match($priceRegex, $serPrice) || $serPrice < $minPrice) {
        $errors['serprice'] = "Event Price must be a number not less than 100.";
    }
    if (!preg_match($seatsRegex, $serSeats) || $serSeats < $minSeats) {
        $errors['serprice'] = "Event Seats must be a number not less than 1.";
    }

    $currentDate = date('Y-m-d');
    $currentTime = date('H:i');

    if ($serDate < $currentDate) {
        $errors['serdate'] = "Event Date cannot be in the past.";
    } elseif ($serDate == $currentDate && $serTime < $currentTime) {
        $errors['sertime'] = "Event Time cannot be in the past.";
    }

    return $errors;
}
?>

<!DOCTYPE html>
<html lang="en" class="no-focus">

<head>
    <title>Event Handler Platform - Manage Services</title>
    <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">
    <style>
        .expired-event {
            color: red;
        }

        .active-event {
            color: green;
        }
    </style>
</head>

<body>
    <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">
        <?php include_once('includes/sidebar.php'); ?>
        <?php include_once('includes/header.php'); ?>
        <!-- Main Container -->
        <main id="main-container">
            <!-- Page Content -->
            <div class="content">
                <h2 class="content-heading"><strong>Admin Profile</strong></h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="block block-themed">
                            <div class="block-header bg-gd-emerald">
                                <h3 class="block-title"><strong>Admin Profile</strong></h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option"
                                        data-action="state_toggle" data-action-mode="demo">
                                        <i class="si si-refresh"></i>
                                    </button>
                                    <button type="button" class="btn-block-option" data-toggle="block-option"
                                        data-action="content_toggle"></button>
                                </div>
                            </div>
                            <form method="post">
                                <div class="block-content">
                                    <?php
                                    if (isset($_GET['upid'])) {
                                        $upid = $_GET['upid'];
                                        $sql = "SELECT * from  tblevents where ID=:upid";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':upid', $upid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) {
                                                $eventDate = $row->ServiceDate; // Assuming your event date is in a format like "Y-m-d"
                                                $isExpired = strtotime($eventDate) < strtotime(date('Y-m-d'));
                                                $statusClass = $isExpired ? 'expired-event' : 'active-event'; // Class for status text color
                                                $statusIcon = $isExpired ? 'fa-close' : 'fa-check'; // Icon for status
                                                ?>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-4">Event Name:</label>
                                                    <div class="col-md-12">
                                                        <input type="text" id="sername" value="<?php echo $row->ServiceName; ?>"
                                                            name="sername" class="form-control" minlength="3" pattern="[A-Za-z\s]+">
                                                        <span id="sername-error" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-4">Event price:</label>
                                                    <div class="col-md-12">
                                                        <input type="text" id="serprice" name="serprice" class="form-control"
                                                            maxlength="10" pattern="[0-9]+" min="100"
                                                            value="<?php echo $row->ServicePrice; ?>">
                                                        <span id="serprice-error" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row ">
                                                    <label class="col-form-label col-md-4">Event Date:</label>
                                                    <div class="col-md-12">
                                                        <input type="date" id="serdate" value="<?php echo $row->ServiceDate; ?>"
                                                            name="serdate" class="form-control">
                                                        <span id="serdate-error" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row ">
                                                    <label class="col-form-label col-md-4">Event Time:</label>
                                                    <div class="col-md-12">
                                                        <input type="time" id="sertime" value="<?php echo $row->ServiceTime; ?>"
                                                            name="sertime" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row ">
                                                    <label class="col-form-label col-md-4">Event Location:</label>
                                                    <div class="col-md-12">
                                                        <input type="text" id="location" value="<?php echo $row->Location; ?>"
                                                            name="location" class="form-control" minlength="3"
                                                            pattern="[A-Za-z\s]+">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-4">Event Seats:</label>
                                                    <div class="col-md-12">
                                                        <input type="text" id="serseats" name="serseats" class="form-control"
                                                            pattern="[0-9]+" min="1" value="<?php echo $row->Seats; ?>">
                                                        <span id="serprice-error" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-4" style="color: black;">Event
                                                        Status:</label>
                                                    <div class="col-md-12">
                                                        <span class="<?php echo $statusClass; ?>">
                                                            <?php echo $isExpired ? 'Expired' : 'Active'; ?>
                                                            <span class="mx-10" style="font-size: 20px;"><i
                                                                    class="fa <?php echo $statusIcon; ?>"
                                                                    aria-hidden="true"></i></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <?php
                                                $cnt = $cnt + 1;
                                            }
                                        }
                                    } ?>
                                    <br>
                                    <div class="tp">
                                        <button type="submit" class="btn btn-primary" name="submit"
                                            style="margin-bottom:20px;">
                                            <i class="fa fa-save mr-5"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- END Main Container -->
        <?php include_once('includes/footer.php'); ?>
    </div>
    <!-- END Page Container -->
    <!-- Codebase Core JS -->
    <script src="assets/js/core/jquery.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/core/jquery.slimscroll.min.js"></script>
    <script src="assets/js/core/jquery.scrollLock.min.js"></script>
    <script src="assets/js/core/jquery.appear.min.js"></script>
    <script src="assets/js/core/jquery.countTo.min.js"></script>
    <script src="assets/js/core/js.cookie.min.js"></script>
    <!-- Add the validation script -->
    // Add the validation script
    <script>
        $(document).ready(function () {
            // Handle form submission
            $('form').on('submit', function (e) {
                if (!validateForm()) {
                    e.preventDefault(); // Prevent form submission if validation fails
                }
            });

            function validateForm() {
                var sername = $("#sername").val();
                var serprice = $("#serprice").val();
                var serdate = $("#serdate").val();
                var sertime = $("#sertime").val();

                // Regular expressions for validation
                var nameRegex = /^[A-Za-z\s]{3,}$/;
                var priceRegex = /^[0-9]+$/;
                var minPrice = 100;

                // Validation messages
                var errors = [];

                if (!nameRegex.test(sername)) {
                    errors.push("Event Name must be at least 3 characters and spaces only.");
                    $("#sername-error").text("Event Name must be at least 3 characters and spaces only.");
                } else {
                    $("#sername-error").text("");
                }

                if (!priceRegex.test(serprice) || parseInt(serprice) < minPrice) {
                    errors.push("Event Price must be a number not less than 100.");
                    $("#serprice-error").text("Event Price must be a number not less than 100.");
                } else {
                    $("#serprice-error").text("");
                }

                var currentDate = new Date();
                var selectedDate = new Date(serdate + 'T' + sertime);

                if (selectedDate < currentDate) {
                    errors.push("Event Date and Time cannot be in the past.");
                    $("#serdate-error").text("Event Date and Time cannot be in the past.");
                } else {
                    $("#serdate-error").text("");
                }

                return errors.length === 0;
            }
        });
    </script>

    <script src="assets/js/codebase.js"></script>
</body>

</html>