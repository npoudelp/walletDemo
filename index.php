<?php
session_start();

$userCount = 0;

include_once('./include/dbConn.inc.php');
$sql = "SELECT COUNT(uid) AS userCount FROM users;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$userCount = $row['userCount'];




?>
<html lang="en">

<head>
    <link rel="shortcut icon" href="./images/icon.ico" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cello</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <script src="./js/jQuery.js"></script>
    <script src="./js/bootstrap.min.js"></script>

</head>

<body>
    <!-- navbar starts here -->
    <div class="nav navbar navbar-expand-lg bg-dark navbar-dark py-3">
        <div class="container">
            <a href="./" class="navbar-brand text-warning">cell 'O' Pay</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navlink">
                <i class="bi bi-grid-3x3-gap"></i>
            </button>
            <div class="container collapse navbar-collapse justify-content-center" id="navlink">
                <div class="d-lg-flex">
                    <div class="container">
                        <ul class="navbar-nav lead">
                            <li class="nav-item">
                                <a href="./index.php" class="nav-link active">Home</a>
                            </li>
                            <li class="nav-item disabled">
                                <a href="#" class="nav-link disabled"></a>
                            </li>
                            <li class="nav-item disabled">
                                <a href="#" class="nav-link disabled"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="container">
                        <li class="nav-item">
                            <a href="./pages/login.php" class="btn btn-outline-warning">Sign In</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- navbar ends here -->

    <!-- display board starts here -->
    <section class="bg-dark text-light p-lg-3 p-5 text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1><span class="text-warning">Upgrade your payment style to</span> <span class="text-danger">cell 'O' Pay</span></h1>
                    <p class="lead my-4">
                        Why visit your bank if you can carry one on your phone?<br>
                        Be smart choose<span class="text-warning h4 logo" style="font-family: anand;"> cell 'O' Pay</span>
                    </p>
                    <a href="./pages/register.php" class="btn btn-outline-warning">Join Us</a>
                </div>
                <div class="col-md-6 align-content-center align-text-center">
                    <img class="img-fluid w-50 d-none d-md-block" src="./images/showcase.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- display board ends here -->

    <!-- Achievement starts here -->
    <section class="bg-light lead p-2">
        <div class="container">
            <p class="text-center h3 my-3 border-bottom">About Us</p>
            <p class="lead">
                "But I must explain to you how all this mistaken idea of denouncing
                pleasure and praising pain was born and I will give you a complete
                account of the system, and expound the actual teachings of the great
                explorer of the truth, the master-builder of human happiness. No one
                rejects, dislikes, or avoids pleasure itself, because it is pleasure,
                but because those who do not know how to pursue pleasure rationally
                encounter consequences that are extremely painful. Nor again is there
                anyone who loves or pursues or desires to obtain pain of itself, because
                it is pain, but because occasionally circumstances occur in which toil
                and pain can procure him some great pleasure. To take a trivial example,
                which of us ever undertakes laborious physical exercise, except to
                obtain some advantage from it? But who has any right to find fault with
                a man who chooses to enjoy a pleasure that has no annoying consequences,
                or one who avoids a pain that produces no resultant pleasure?"
            </p>

        </div>
    </section>


    <!-- mail section starts here -->
    <!-- <section class="bg-warning p-5">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center">
                <div>
                    <span class="text-dark h3 mb-3 mb-md-0">Get connected to our network</span>
                </div>

                <div class="input-group">
                    <input type="email" class="form-control" id="email" placeholder="@email address">
                    <div class="input-group-append">
                        <button class="btn btn-dark" onclick="send()" type="button">Send</button>
                    </div>
                </div>
            </div>
            <span id="display" class="lead text-danger"></span>
        </div>
    </section> -->
    <!-- mail section ends here -->


    <!-- mapping starts here -->
    <section class="bg-dark py-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-md text-light">
                    <h2 class="mb-4">
                        Contact Info
                    </h2>
                    <i class="bi bi-geo-alt h1 text-warning">&nbsp;&nbsp;</i><span class="lead">Biratnagar, Province 1, Nepal</span><br>
                    <i class="bi bi-envelope h1 text-warning">&nbsp;&nbsp;</i><span class="lead">info@cello.com</span><br>
                    <i class="bi bi-telephone h1 text-warning">&nbsp;&nbsp;</i><span class="lead">+977-9800110011</span>
                </div>
                <div class="col-md text-light ">
                    <iframe class="h-100 w-100 my-0 mx-0" src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d3572.3040646729582!2d87.2755849!3d26.445926!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2snp!4v1643798027732!5m2!1sen!2snp" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- mapping ends here -->

    <!-- misc section -->
    <section class="p-1 bg-warning">
        <div class="container text-dark text-center">
            <span class="h1 lead fw-bold text-dark">
                <?php $year = date("F");
                $month = date("jS");
                $day = date("Y");
                echo $year . " " . $month . " " . $day;
                ?>
                <?php $year = date("l");
                echo $year;
                ?><span class="text-warning h4" style="font-family: anand;">pwf/f]</span>
        </div>
    </section>
    <!-- misc ends -->

    <!-- footer starts here -->
    <footer class="p-1 bg-dark text-white text-center position-relative">
        <div class="container">
            <p class="lead">Copyright&copy; <span class="text-warning">cello</span> <?php echo Date("Y"); ?><strong> <span class="text-warning h3 logo"></span></p>
            <a href="#navlink" class="position-absolute end-0 bottom-0 p-1 my-1 h1 text-warning">
                <i class="bi bi-arrow-up-circle"></i>
            </a>
        </div>
    </footer>

    <script type="text/javascript">
        // send = () => {
        //     let email = $("input").val();
        //     if (email.includes('@') && (email.includes('.com') || email.includes('.org') || email.includes('com.np') || email.includes('in') || email.includes('edu.np'))) {
        //         $.ajax({
        //             type: 'POST',
        //             url: './include/connectedEmails.php?q=' + email,
        //             success: (data) => {
        //                 $("#display").text(data);
        //             }
        //         })
        //     } else {
        //         alert("Unsupported format of email");
        //     }
        //     setTimeout(() => {
        //         $("#display").text("");
        //     }, 5000);

        // }

        // $(document).ready(() => {

        //     $('#userCount').each(function() {
        //         var $this = $(this),
        //             countTo = $this.attr('data-count');

        //         $({
        //             countNum: $this.text()
        //         }).animate({
        // countNum: 
        //         }, {
        //             duration: 1000,
        //             easing: 'linear',
        //             step: function() {
        //                 $this.text(Math.floor(this.countNum));
        //             },
        //             complete: function() {
        //                 $this.text(this.countNum);
        //             }
        //         });
        //     });

        //     $('#tCount').each(function() {
        //         var $this = $(this),
        //             countTo = $this.attr('data-count');

        //         $({
        //             countNum: $this.text()
        //         }).animate({
        //             countNum: 
        //         }, {
        //             duration: 1000,
        //             easing: 'linear',
        //             step: function() {
        //                 $this.text(Math.floor(this.countNum));
        //             },
        //             complete: function() {
        //                 $this.text(this.countNum);
        //             }
        //         });
        //     });


        //     $('#tCostomer').each(function() {
        //         var $this = $(this),
        //             countTo = $this.attr('data-count');

        //         $({
        //             countNum: $this.text()
        //         }).animate({
        //             countNum: 
        //         }, {
        //             duration: 1000,
        //             easing: 'linear',
        //             step: function() {
        //                 $this.text(Math.floor(this.countNum));
        //             },
        //             complete: function() {
        //                 $this.text(this.countNum);
        //             }
        //         });
        //     });

        // })
    </script>

</body>

</html>