<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['odmsaid'] == 0)) {
    header('location:logout.php');
} else {
    $sername = $serdes = $serprice = $serdate = $sertime = $serlocation = '';
    $sernameErr = $serdesErr = $serpriceErr = $serdateErr = $sertimeErr = $serlocationErr = '';
    $errorMessage = ''; // Initialize the error message

    if (isset($_POST['submit'])) {
        $sername = $_POST['sername'];
        $serdes = $_POST['serdes'];
        $serprice = $_POST['serprice'];
        $serdate = $_POST['serdate'];
        $sertime = $_POST['sertime'];
        $serlocation = $_POST['serlocation'];

        $isValid = true; // Variable to track overall form validity

        // Check for empty values
        if (empty($sername)) {
            $sernameErr = "Service Name is required.";
            $isValid = false;
        }
        if (empty($serdes)) {
            $serdesErr = "Service Description is required.";
            $isValid = false;
        }
        if (empty($serprice)) {
            $serpriceErr = "Service Price is required.";
            $isValid = false;
        }
        if (empty($serdate)) {
            $serdateErr = "Service Date is required.";
            $isValid = false;
        }
        if (empty($sertime)) {
            $sertimeErr = "Service Time is required.";
            $isValid = false;
        }
        if (empty($serlocation)) {
            $serlocationErr = "Service Location is required.";
            $isValid = false;
        }

        // Validation for Service Name (only chars and spaces, minimum 3 characters)
        if (!preg_match("/^[a-zA-Z ]{3,}$/", $sername)) {
            $sernameErr = "Service Name should only contain alphabets and spaces (minimum 3 characters).";
            $isValid = false;
        }
        // Validation for Service Description (only chars, spaces, and special chars, minimum 3 characters)
        if (!preg_match("/^[a-zA-Z\s\W]{3,}$/", $serdes)) {
            $serdesErr = "Service Description should only contain alphabets, spaces, and special characters (minimum 3 characters).";
            $isValid = false;
        }
        // Validation for Service Price (only numbers and minimum value of 100)
        if (!is_numeric($serprice) || $serprice < 100) {
            $serpriceErr = "Service Price should be a valid number and not less than 100.";
            $isValid = false;
        }
        // Validation for Service Location (only chars and spaces, minimum 3 characters)
        if (!preg_match("/^[a-zA-Z ]{3,}$/", $serlocation)) {
            $serlocationErr = "Service Location should only contain alphabets and spaces (minimum 3 characters).";
            $isValid = false;
        }

        if ($isValid) {
            $sql = "INSERT INTO tblservice(ServiceName,SerDes,ServicePrice,ServiceDate,ServiceTime,Location) VALUES(:sername,:serdes,:serprice,:serdate,:sertime,:serlocation)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':sername', $sername, PDO::PARAM_STR);
            $query->bindParam(':serdes', $serdes, PDO::PARAM_STR);
            $query->bindParam(':serprice', $serprice, PDO::PARAM_STR);
            $query->bindParam(':serdate', $serdate, PDO::PARAM_STR);
            $query->bindParam(':sertime', $sertime, PDO::PARAM_STR);
            $query->bindParam(':serlocation', $serlocation, PDO::PARAM_STR);

            $query->execute();

            $LastInsertId = $dbh->lastInsertId();
            if ($LastInsertId > 0) {
                echo '<script>alert("Service has been added.")</script>';
                echo "<script>window.location.href ='add-services.php'</script>";
            } else {
                echo '<script>alert("Something Went Wrong. Please try again")</script>';
            }
        } else {
            // Set the error message
            $errorMessage = 'Please correct the errors below and try again.';
        }
    }
    ?>
    <!doctype html>
    <html lang="en" class="no-focus">

    <head>
        <title>Event Handler Platform - Add Services</title>
        <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">
        <!-- JavaScript validation functions -->
        <script>
            // JavaScript validation functions
            function validateServiceName(input) {
                // Reset error message for Service Name
                document.getElementById('sernameErr').textContent = '';
                // Validation for Service Name (only chars and spaces, minimum 3 characters)
                if (!/^[a-zA-Z ]{3,}$/.test(input.value)) {
                    document.getElementById('sernameErr').textContent = 'Service Name should only contain alphabets and spaces (minimum 3 characters).';
                }
            }

            function validateServiceDescription(input) {
                // Reset error message for Service Description
                document.getElementById('serdesErr').textContent = '';
                // Validation for Service Description (only chars, spaces, and special chars, minimum 3 characters)
                if (!/^[a-zA-Z\s\W]{3,}$/.test(input.value)) {
                    document.getElementById('serdesErr').textContent = 'Service Description should only contain alphabets, spaces, and special characters (minimum 3 characters).';
                }
            }

            function validateServicePrice(input) {
                // Reset error message for Service Price
                document.getElementById('serpriceErr').textContent = '';
                // Validation for Service Price (only numbers and minimum value of 100)
                var price = parseFloat(input.value);
                if (isNaN(price) || price < 100) {
                    document.getElementById('serpriceErr').textContent = 'Service Price should be a valid number and not less than 100.';
                }
            }

            function validateServiceDate(input) {
                // Reset error message for Service Date
                document.getElementById('serdateErr').textContent = '';
                // Validation for Service Date (do not accept past date)
                var currentDate = new Date();
                var inputDate = new Date(input.value);
                if (inputDate < currentDate) {
                    document.getElementById('serdateErr').textContent = 'Service Date cannot be in the past.';
                }
            }

            function validateServiceLocation(input) {
                // Reset error message for Service Location
                document.getElementById('serlocationErr').textContent = '';
                // Validation for Service Location (only chars and spaces, minimum 3 characters)
                if (!/^[a-zA-Z ]{3,}$/.test(input.value)) {
                    document.getElementById('serlocationErr').textContent = 'Service Location should only contain alphabets and spaces (minimum 3 characters).';
                }
            }

            function closeErrorMessage() {
                // Hide the error message div
                document.getElementById('error-message').style.display = 'none';
            }

            function validateForm() {
                // This function is called on form submission to perform all validations.
                var sernameInput = document.getElementsByName('sername')[0];
                var serdesInput = document.getElementsByName('serdes')[0];
                var serpriceInput = document.getElementsByName('serprice')[0];
                var serdateInput = document.getElementsByName('serdate')[0];
                var sertimeInput = document.getElementsByName('sertime')[0];
                var serlocationInput = document.getElementsByName('serlocation')[0];

                // Reset all error messages
                document.getElementById('sernameErr').textContent = '';
                document.getElementById('serdesErr').textContent = '';
                document.getElementById('serpriceErr').textContent = '';
                document.getElementById('serdateErr').textContent = '';
                document.getElementById('sertimeErr').textContent = '';
                document.getElementById('serlocationErr').textContent = '';

                var isValid = true; // Variable to track overall form validity

                // Check for empty values
                if (sernameInput.value.trim() === '') {
                    document.getElementById('sernameErr').textContent = 'Service Name is required.';
                    isValid = false;
                }
                if (serdesInput.value.trim() === '') {
                    document.getElementById('serdesErr').textContent = 'Service Description is required.';
                    isValid = false;
                }
                if (serpriceInput.value.trim() === '') {
                    document.getElementById('serpriceErr').textContent = 'Service Price is required.';
                    isValid = false;
                }
                if (serdateInput.value.trim() === '') {
                    document.getElementById('serdateErr').textContent = 'Service Date is required.';
                    isValid = false;
                }
                if (sertimeInput.value.trim() === '') {
                    document.getElementById('sertimeErr').textContent = 'Service Time is required.';
                    isValid = false;
                }
                if (serlocationInput.value.trim() === '') {
                    document.getElementById('serlocationErr').textContent = 'Service Location is required.';
                    isValid = false;
                }

                // Perform other validations (same as before)

                // Return the overall form validity
                return isValid;
            }
        </script>
    </head>

    <body>
        <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">
            <?php include_once('includes/sidebar.php'); ?>
            <?php include_once('includes/header.php'); ?>
            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="content">
                    <!-- Register Forms -->
                    <h2 class="content-heading">Add Services</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Bootstrap Register -->
                            <div class="block block-themed">
                                <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">Add Services</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                            data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                            data-action="content_toggle"></button>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <form method="post" onsubmit="return validateForm()">
                                        <!-- Error Message -->
                                        <div id="error-message"
                                            style="display: <?php echo empty($errorMessage) ? 'none' : 'block'; ?>;"
                                            class="alert alert-danger" role="alert">
                                            <button type="button" class="close" aria-label="Close"
                                                onclick="closeErrorMessage()">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <?php echo $errorMessage; ?>
                                        </div>
                                        <!-- Service Name -->
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">Service Name:</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control" name="sername"
                                                    value="<?php echo $sername; ?>" onblur="validateServiceName(this)">
                                                <span id="sernameErr" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <!-- Service Description -->
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">Service Description:</label>
                                            <div class="col-12">
                                                <textarea type="text" class="form-control" name="serdes"
                                                    onblur="validateServiceDescription(this)"><?php echo $serdes; ?></textarea>
                                                <span id="serdesErr" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <!-- Service Price -->
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-password">Service Price:</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control" name="serprice"
                                                    onblur="validateServicePrice(this)" value="<?php echo $serprice; ?>">
                                                <span id="serpriceErr" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <!-- Service Date -->
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-password">Service Date:</label>
                                            <div class="col-12">
                                                <input type="date" class="form-control" name="serdate"
                                                    onblur="validateServiceDate(this)" value="<?php echo $serdate; ?>">
                                                <span id="serdateErr" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <!-- Service Time -->
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-password">Service Time:</label>
                                            <div class="col-12">
                                                <input type="time" class="form-control" name="sertime"
                                                    onblur="validateServiceTime(this)" value="<?php echo $sertime; ?>">
                                                <span id="sertimeErr" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <!-- Service Location -->
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-password">Service Location:</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control" name="serlocation"
                                                    onblur="validateServiceLocation(this)"
                                                    value="<?php echo $serlocation; ?>">
                                                <span id="serlocationErr" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-alt-success" name="submit">
                                                    <i class="fa fa-plus mr-5"></i> Add
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END Bootstrap Register -->
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->
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
<?php } ?>