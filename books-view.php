<?php include('includes/config.php'); ?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Book | Mudra Publications </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/price_rangs.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <?php include('partials/header.php') ?>
    <main>

        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center"
                data-background="assets/img/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <?php
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM books where id=$id ";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $userArr = $query->fetchAll(PDO::FETCH_OBJ);
                                if ($query->rowCount() > 0) {

                                ?>
                                <h2><?php echo ($userArr[0]->name); ?></h2>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
        <!-- job post company Start -->
        <div class="job-post-company pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-between">
                    <!-- Left Content -->
                    <div class="col-xl-7 col-lg-8">
                        <!-- job single -->
                        <div class="single-job-items mb-50">
                            <div class="job-items">
                                <div class="company-img company-img-details">
                                    <a href="#"><img src="assets/img/icon/job-list1.png" alt=""></a>
                                </div>
                                <div class="job-tittle">
                                    <a href="#">
                                        <h4><?php echo ($userArr[0]->name); ?></h4>
                                    </a>
                                    <ul>

                                        <li><?php echo ($userArr[0]->category); ?></li>

                                        <!-- <li>File Number</li>
                                        <li><i class="fa fa-calendar"></i>31/10/2023</li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- job single End -->

                        <div class="job-post-details">
                            <div class="post-details1 mb-50">
                                <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4>Description</h4>
                                </div>
                                <p><?php echo ($userArr[0]->description); ?></p>
                            </div>
                        </div>

                    </div>
                    <!-- Right Content -->
                    <div class="col-xl-4 col-lg-4">
                        <div class="post-details3  mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Book Details</h4>
                            </div>
                            <ul>
                                <li>Book Name : <span><?php echo ($userArr[0]->name);   ?></span></li>
                                <?php
                                    $authername1 = $userArr[0]->authername1;
                                    $authername2 = $userArr[0]->authername2;
                                    $authername3 = $userArr[0]->authername3;
                                    $authername4 = $userArr[0]->authername4;
                                    $authername5 = $userArr[0]->authername5;
                                    $authername6 = $userArr[0]->authername6;
                                ?>
                                <li>Auther Name : <span><?php echo ($userArr[0]->authername1) ?>
                                        <?php
                                        if (!empty($authername2)) {
                                            echo $authername2;
                                        } ?> <?php
                                                if (!empty($authername3)) {
                                                    echo $authername2;
                                                } ?> <?php
                                                        if (!empty($authername4)) {
                                                            echo $authername4;
                                                        } ?> <?php
                                                                if (!empty($authername5)) {
                                                                    echo $authername5;
                                                                } ?> <?php
                                                                        if (!empty($authername6)) {
                                                                            echo $authername6;
                                                                        } ?></span></li>
                                <li>Category : <span><?php echo ($userArr[0]->category) ?></span></li>
                                <li>Published Date : <span><?php echo ($userArr[0]->pdate); ?></span></li>
                                <li>ISBN : <span><?php echo ($userArr[0]->isbn); ?></span></li>
                                <li>Current Edition : <span><?php echo ($userArr[0]->edition); ?></span></li>
                                <li>Price : <span><?php echo ($userArr[0]->price); ?></span></li>
                                <!-- <li>Job nature : <span>Full time</span></li>
                                <li>Salary : <span>$7,800 yearly</span></li>
                                <li>Application date : <span>12 Sep 2020</span></li> -->
                            </ul>
                            <div class="apply-btn2">
                                <a target="_blank" href="uploads/<?php echo ($userArr[0]->image); ?>" class="btn">Oder
                                    Now</a>
                            </div>
                        </div>
                        <?php }
                    ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- job post company End -->

    </main>
    <?php include('partials/footer.php') ?>

    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <script src="./assets/js/price_rangs.js"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>

</body>

</html>