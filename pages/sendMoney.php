<?php
session_start();

if ($_SESSION['logged'] != true) {
    header("location: ../");
}

include_once("../include/dbConn.inc.php");

$sql = "SELECT * FROM account WHERE uid={$_SESSION['uid']};";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $_SESSION['balance'] = $row['balance'];
}

$msg = "";
if (isset($_REQUEST['msg'])) {
    $msg = $_REQUEST['msg'];
}

?>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../images/icon.ico" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cello</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/jQuery.js"></script>
    <script src="../js/bootstrap.min.js"></script>

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
                    <ul class="navbar-nav lead">
                        <li class="nav-item">
                            <a href="./profile.php" class="nav-link mx-2">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="./sendMoney.php" class="nav-link active mx-2">Transfer</a>
                        </li>
                        <li class="nav-item mx-3 text-danger">
                            <a href="./myAccount.php" class="text-light text-decoration-none">
                                <i class="bi bi-person-circle h3" onMouseOver="this.style.color='#0d6efd'" onMouseOut="this.style.color='#FFF'"></i>
                            </a>
                        </li>
                        <li class="nav-item border-bottom border-warning">
                            <span class="nav-link text-light mx-3"><?php echo $_SESSION['name']; ?></span>
                        </li>
                        <li class="nav-item border-top border-warning">
                            <span class="nav-link text-light mx-3">Rs: <?php echo $_SESSION['balance']; ?></span>
                        </li>
                        <li class="nav-item">
                            <a href="../include/logout.inc.php" class="btn btn-outline-warning mx-5">Log Out</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- navbar ends here -->

    <section class="p-5 text-center">
        <div class="container shadow-lg">
            <div class="text-center container p-3 lead">
                <p class="h3 text-center">Send Money via <span class="text-warning">cell 'O' Pay</span></p>
                <form class="form-signin" method="post" action="../include/sendMoney.inc.php">
                    <?php
                    if ($msg == 'insufficient_balance') {
                        echo '<p class="lead text-danger">Insufficient balance</p>';
                    }
                    if ($msg == 'incorrect_receiver_information') {
                        echo '<p class="lead text-danger">Incorrect receiver information</p>';
                    }
                    if ($msg == 'success') {
                        echo '<p class="lead text-success">Successfully transfered your fund</p>';
                    }
                    if ($msg == 'invalid_amount') {
                        echo '<p class="lead text-danger">Invalid numbers in amount</p>';
                    }
                    if ($msg == 'error_101') {
                        echo '<p class="lead text-danger">Error updating sender data</p>';
                    }
                    if ($msg == 'error_202') {
                        echo '<p class="lead text-success">Error updating receiver data</p>';
                    }
                    if ($msg == 'invalid_receiver') {
                        echo '<p class="lead text-danger">Cannot send fund to self</p>';
                    }
                    ?>
                    <label for="sName" class="sr-only">Sender Name</label>
                    <input type="text" disabled id="sName" class="form-control mb-3" name="sName" value="<?php echo $_SESSION['name']; ?>" placeholder="Sender Name" required>
                    <label for="sPhone" class="sr-only">Sender Phone</label>
                    <input type="text" disabled id="sPhone" class="form-control mb-3" name="sPhone" value="<?php echo $_SESSION['phone']; ?>" placeholder="Sender Name" required>
                    <label for="rName" class="sr-only">Receiver Name</label>
                    <input type="text" id="rName" class="form-control mb-3" name="rName" placeholder="Receiver Name" autofocus required>
                    <label for="rPhone" class="sr-only">Receiver Phone</label>
                    <input type="text" id="rPhone" class="form-control mb-3" name="rPhone" placeholder="Receiver Phone" required>
                    <label for="amount" class="sr-only">Amount</label>
                    <input type="text" id="amount" class="form-control mb-3" name="amount" placeholder="Amount" required><br>

                    <button class="btn btn-lg btn-outline-warning btn-block" type="submit" name="submit">Transfer</button>

                </form>
            </div>
        </div>
    </section>

    <!-- footer starts here -->
    <footer class="p-1 bg-dark text-white text-center position-relative">
        <div class="container">
            <p class="lead">Copyright&copy; <span class="text-warning">cello</span> <?php echo Date("Y"); ?><strong> <span class="text-warning h3 logo"></span></p>
            <a href="#navlink" class="position-absolute end-0 bottom-0 p-1 my-1 h1 text-warning">
                <i class="bi bi-arrow-up-circle"></i>
            </a>
        </div>
    </footer>


</body>

</html>