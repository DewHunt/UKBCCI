<!-- nav -->

<div class="col col-lg-12 col-md-12 col-sm-12 col-xl-12">
    <nav class="navbar navbar-expand-lg navbar-light d-flex" style="background-color: #78a5c8;">
        <a class="navbar-brand ml-5" href="../admin/index.php">
            <img src="../assets/images/avater.png" width="80" height="80" alt="Swiss Collection">
        </a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>

        <div class="nav-btns">
            <?php
            if(isset($_SESSION['user_id'])) {
                ?>
                <a href="" style="text-decoration:none;">
                    <i class="fa fa-user mr-5" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
                </a>
                <?php
            } else {
                ?>
                <a href="../admin/logout.php" style="text-decoration:none;">
                    <i class="fa fa-sign-in mr-5" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
                </a>
                <?php
            } ?>
        </div>
    </nav>
</div>