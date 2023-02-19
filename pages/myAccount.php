<?php
session_start();

if ($_SESSION['logged'] != true) {
    header("location: ../");
}

include_once("../include/dbConn.inc.php");

$uid = $_SESSION['uid'];
$name = $_SESSION['name'];

$sql = "SELECT * FROM account WHERE uid=$uid;";
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
                            <a href="./sendMoney.php" class="nav-link mx-2">Transfer</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="./myAccount.php" class="text-light text-decoration-none">
                                <i class="bi bi-person-circle h3" style="color: #0d6efd;" onMouseOver="this.style.color='#FFF'" onMouseOut="this.style.color='#0d6efd'"></i>
                            </a>
                        </li>
                        <li class="nav-item border-bottom border-warning">
                            <span class="nav-link text-light mx-3"><?php echo $name; ?></span>
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
    <section>
        <p class="text-success"></p>
        <?php

        if ($msg == "old_passowrd_not_matched") {
        ?>
            <p class="text-center text-danger">Old password does not match</p>
        <?php
        }
        if ($msg == "success") {
        ?>
            <p class="text-center text-success">Password changed sucessfully</p>
        <?php
        }

        ?>
    </section>

    <div class="container">
        <div class="row">
            <div class="col md-6">
                <span class="text-dark h4">Name: </span><span class="lead"><?php  echo $_SESSION['name'] ?></span><br>
                <span class="text-dark h4">Phone: </span><span class="lead"><?php  echo $_SESSION['phone'] ?></span><br>
                <span class="text-dark h4">Email: </span><span class="lead"><?php  echo $_SESSION['email'] ?></span><br>
                <span class="text-dark h4">Address: </span><span class="lead"><?php  echo $_SESSION['address'] ?></span>
            </div>

            <div class="col-md-6">

                <div class="row text-center border-bottom border-dark d-print-table">
                    <span class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#changePasswd">
                        <span class="lead">Change Password</span> <i class="bi bi-chevron-double-down"></i> <br>
                    </span> <br>
                    <div class="container collapse navbar-collapse  justify-content-center" id="changePasswd">

                        <form action="../include/resetPasswd.inc.php" method="POST">
                            <div class="form-group">
                                <label for="passwordO">Old Password</label>
                                <input type="password" id="passwordO" name="oldPasswd" class="form-control mb-3" placeholder="Old Password" minlength="4" required>
                            </div>

                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" id="password" name="passwd" class="form-control mb-3" placeholder="New Password" minlength="4" required>
                            </div>

                            <div class="form-group">
                                <label for="passwordR">Confirm New Password</label>
                                <input type="password" name="passwdr" id="passwdr" onkeyup="checkPassword(this.value)" class="form-control mb-3" placeholder="Confirm New Password" required>
                            </div>
                            <span id="displayP"></span><br>
                            <button type="submit" name="submit" class="btn btn-outline-danger">Submit</button>
                        </form>
                    </div>
                </div><br>

            </div>
        </div>
    </div>

    <!-- User activity logs -->
    <section class="p-3">
        <div class="container">
            <div class="row text-center border-bottom border-dark d-print-table">
                <span class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#transactionLogs">
                    <span class="lead">Transaction History</span> <i class="bi bi-chevron-double-down"></i> <br>
                </span> <br>
                <div class="container collapse navbar-collapse  justify-content-center" id="transactionLogs">
                    <span class="btn btn-outline-secondary"><button class="btn btn-secondary" onclick="window.print()"><i class="bi bi-printer"></i></button></span>
                    <span class="text-warning"></span>
                    <table class="table" class="print-container" width='100%'>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">SN</th>
                                <th scope="col">Date/Time</th>
                                <th scope="col">Sender</th>
                                <th scope="col">Receiver</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Balance</th>
                                <th scope="col">Type</th>
                            </tr>
                        </thead>
                        <?php
                        $sn = 1;
                        $getAccountLogSql = "SELECT * FROM accountLog WHERE uid=$uid ORDER BY alid DESC ;";
                        $getAccountLog = mysqli_query($conn, $getAccountLogSql);
                        if (mysqli_num_rows($getAccountLog) > 0) {
                            while ($accountLog = mysqli_fetch_assoc($getAccountLog)) {
                                echo ' 
                                <tr>
                                <td scope="row">' . $sn . '</td>
                                <td scope="row">' . $accountLog['date'] . '/' . $accountLog['time'] . '</td>
                                <td scope="row">' . $accountLog['sender'] . '</td>
                                <td scope="row">' . $accountLog['receiver'] . '</td>
                                <td scope="row">' . $accountLog['amount'] . '</td>
                                <td scope="row">' . $accountLog['newAmount'] . '</td>
                                <td scope="row">' . $accountLog['type'] . '</td>
                                </tr>';
                                if ($sn >= 50) {
                                    break;
                                }
                                $sn++;
                            }
                        } else {
                            echo "<span class='text-danger'>No transaction logs available</span>";
                        }
                        ?>

                    </table><br>
                </div>
            </div><br>
        </div>
    </section>

    <!-- User activity log -->

    <section class="p-3">
        <div class="container">
            <div class="row text-center border-bottom border-dark d-print-table">
                <span class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#UserLogs">
                    <span class="lead">User Activity Logs</span> <i class="bi bi-chevron-double-down"></i> <br>
                </span> <br>
                <div class="container collapse navbar-collapse  justify-content-center" id="UserLogs">
                    <span class="btn btn-outline-secondary"><button class="btn btn-secondary" onclick="window.print()"><i class="bi bi-printer"></i></button></span>
                    <span class="text-warning"></span>
                    <table class="table" class="print-container" width='100%'>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">SN</th>
                                <th scope="col">Date/Time</th>
                                <th scope="col">Details</th>
                                <th scope="col">Address <small class="text-muted">Network Location</small> </th>
                            </tr>
                        </thead>
                        <?php
                        $sn = 1;
                        $getUserLogSql = "SELECT * FROM userLog WHERE uid=$uid ORDER BY ulid DESC ;";
                        $getUserLog = mysqli_query($conn, $getUserLogSql);
                        if (mysqli_num_rows($getUserLog) > 0) {
                            while ($userLog = mysqli_fetch_assoc($getUserLog)) {
                                echo ' 
                                <tr>
                                <td scope="row">' . $sn . '</td>
                                <td scope="row">' . $userLog['date'] . '/' . $userLog['time'] . '</td>
                                <td scope="row">' . $userLog['details'] . '</td>
                                <td scope="row">' . $userLog['address'] . '</td>
                                </tr>';
                                if ($sn >= 50) {
                                    break;
                                }
                                $sn++;
                            }
                        } else {
                            echo "<span class='text-danger'>No transaction logs available</span>";
                        }
                        ?>

                    </table><br>
                </div>
            </div><br>
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


    <script>
        checkPassword = (passwordR) => {
            let $password = $("#password").val();
            if ($password != passwordR) {
                $("#displayP").css("color", "red");
                $("#displayP").text("Your password does not match");
            } else {
                $("#displayP").text("");
            }

        }
    </script>

</body>

</html>