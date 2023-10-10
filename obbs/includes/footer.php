<!-- copyright -->
<div class="agileits-w3layouts">
    <div class="container">
        <p>© 2023 <span><a href="index.php" style="color:skyblue;font-weight:bold;font-size:20px;">EHP</a></span>. All
            rights reserved | <a href="login.php"><span style="color:orange;font-size:15px;font-weight:bold;">User
                    Panel</span></a> <i class="fa fa-user" style="color:white;font-size:25px;"></i> </p>
        <hr>
        <div class="banner-address">
            <?php
            $sql = "SELECT * from tblpage where PageType='contactus'";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            $cnt = 1;
            if ($query->rowCount() > 0) {
                foreach ($results as $row) { ?>
                    <div class="col-md-4 banner-address-left">
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i>
                            <?php echo htmlentities($row->PageDescription); ?>
                            .
                        </p>
                    </div>
                    <div class="col-md-4 banner-address-left">
                        <p><i class="fa fa-envelope" aria-hidden="true"></i>
                            <?php echo htmlentities($row->Email); ?>
                        </p>
                    </div>
                    <div class="col-md-4 banner-address-left">
                        <p><i class="fa fa-phone" aria-hidden="true"></i> +
                            <?php echo htmlentities($row->MobileNumber); ?>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                    <?php $cnt = $cnt + 1;
                }
            } ?>
        </div>
    </div>
    <div style="margin-left:10px;">
        <a href="https://facebook.com"><i class="fa fa-facebook"
                style="color:blue; font-size:25px;margin-left:20px;"></i></a>
        <a href="https://twitter.com"><i class="fa fa-twitter"
                style="color:blue; font-size:25px;margin-left:20px;"></i></a>
        <a href="https://instagram.com"><i class="fa fa-instagram"
                style="color:red; font-size:25px;margin-left:20px;"></i></a>
        <a href="https://linkedin.com"><i class="fa fa-linkedin"
                style="color:skyblue; font-size:25px;margin-left:20px;"></i></a>
        <a href="https://youtube.com"><i class="fa fa-youtube"
                style="color:red; font-size:25px;margin-left:20px;"></i></a>
        <span style="color:white; font-size:30px;">|</span><span style="color:skyblue;font-weight:bold;">
            EHP@Rwanda</span>
    </div>
</div>
</div>
<!-- //copyright -->