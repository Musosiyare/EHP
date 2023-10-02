<style>
    /* Add this CSS to position the users menu under the header */
    .users-menu {
        position: absolute;
        top: 50px;
        /* Position it just below the header */
        right: 0;
        z-index: 999;
        margin-right: 10px;
        /* Adjust the z-index to make sure it's above other content */
    }

    .users-menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .users-menu li {
        padding:0;
        text-align: center;
        color: blue;
        margin-left: 5px;
        
    }

    .users-menu li a {
        
        color: orange;
        /* Menu item text color */
        text-decoration: none;
    }

    .users-menu li a:hover {
        color:orange;
        font-size: 15px;
    }
</style>
<div class="header">
    <div class="container">
        <div class="header-top-grids">
            <div class="agileits-logo">
                <h1><a href="index.php">EHP </a></h1>
            </div>
            <div class="top-nav">
                <nav class="navbar navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
                        <nav>
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="index.php">Home</a></li>
                                <li><a href="about.php">About</a></li>
                                <li><a href="services.php">Events</a></li>
                                <?php if (strlen($_SESSION['obbsuid'] != 0)) { ?>
                                    <li class=""><a href="#" class="dropdown-toggle hvr-bounce-to-bottom"
                                            data-toggle="dropdown" role="button" aria-haspopup="true"
                                            aria-expanded="false">My Account<span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="hvr-bounce-to-bottom" href="profile.php">Profile</a></li><hr>
                                            <li><a class="hvr-bounce-to-bottom" href="booking-history.php">Booking
                                                    History</a></li><hr>
                                            <li><a class="hvr-bounce-to-bottom" href="change-password.php">Change
                                                    Password</a></li><hr>
                                            <li><a class="hvr-bounce-to-bottom" href="logout.php">Logout</a></li>
                                        </ul>
                                    </li>
                                <?php } ?>

                                <li><a href="mail.php">Mail Us</a></li>

                            </ul>
                        </nav>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
            </div>
            <br>
            <?php if (strlen($_SESSION['obbsuid']) == 0) { ?>
                <div class="users-menu">
                    <ul class="nav navbar-nav">
                        <!-- Add your User-related menu items here -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle hvr-bounce-to-bottom" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false"><strong>Users</strong><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a class="hvr-bounce-to-bottom" href="login.php">Login</a></li><hr>
                                <li><a class="hvr-bounce-to-bottom" href="signup.php">Register</a></li><hr>
                                <li><a class="hvr-bounce-to-bottom" href="admin/login.php">Admin</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            <?php } ?>
            </ul>

        </div>
    </div>
    <div class="clearfix"> </div>
</div>
</div>