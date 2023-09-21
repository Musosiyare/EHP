<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['odmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $upid = $_GET['upid'];
        $serName = $_POST['sername'];
        $serPrice = $_POST['serprice'];
        $serDate = $_POST['serdate'];
        $serTime = $_POST['sertime'];
        $Location = $_POST['location'];

        $sql = "update tblservice set ServiceName=:sername,ServicePrice=:serprice, ServiceDate=:serdate, ServiceTime=:sertime, Location=:location where ID=:upid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sername', $serName, PDO::PARAM_STR);
        $query->bindParam(':serprice', $serPrice, PDO::PARAM_STR);
        $query->bindParam(':serdate', $serDate, PDO::PARAM_STR);
        $query->bindParam(':sertime', $serTime, PDO::PARAM_STR);
        $query->bindParam(':location', $Location, PDO::PARAM_STR);
        $query->bindParam(':upid', $upid, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Event has been updated")</script>';
        echo "<script>window.location.href ='manage-services.php'</script>";
    }
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
                <h2 class="content-heading">Admin Profile</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="block block-themed">
                            <div class="block-header bg-gd-emerald">
                                <h3 class="block-title">Admin Profile</h3>
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
                                        $sql = "SELECT * from  tblservice where ID=:upid";
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
                                                        <input type="text" value="<?php echo $row->ServiceName; ?>" name="sername"
                                                            required="true" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-4">Event price</label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="serprice" class="form-control" required="true"
                                                            maxlength="10" pattern="[0-9]+"
                                                            value="<?php echo $row->ServicePrice; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row ">
                                                    <label class="col-form-label col-md-4">Event Date:</label>
                                                    <div class="col-md-12">
                                                        <input type="date" value="<?php echo $row->ServiceDate; ?>" name="serdate"
                                                            required="true" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row ">
                                                    <label class="col-form-label col-md-4">Event Time:</label>
                                                    <div class="col-md-12">
                                                        <input type="time" value="<?php echo $row->ServiceTime; ?>" name="sertime"
                                                            required="true" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row ">
                                                    <label class="col-form-label col-md-4">Event Location:</label>
                                                    <div class="col-md-12">
                                                        <input type="text" value="<?php echo $row->Location; ?>" name="location"
                                                            required="true" class="form-control">
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
                                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
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
    <script src="assets/js/codebase.js"></script>
</body>

</html>