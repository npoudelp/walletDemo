<?php

if (isset($_POST['submit'])) {
    $accountExists = false;

    $details;

    $ipaddress = $_POST['ip'];

    $email = $_POST['email'];
    $address = $_POST['address'];
    $passwd = $_POST['passwd'];
    $checkbox = "";
    $checkbox = $_POST['checkbox'];

    include_once('./dbConn.inc.php');
    $sql = "SELECT * FROM users WHERE email = '$email';";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $hash = $row["passwd"];
            $passwdH = password_verify($passwd, $hash);
            if ($row["email"] == $email && $passwdH == 1) {
                session_start();
                $_SESSION['logged'] = true;
                $_SESSION['uid'] = $row["uid"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["name"] = $row["name"];
                $_SESSION["address"] = $row["address"];
                $_SESSION["phone"] = $row["phone"];

                $uid = $_SESSION['uid'];

                $checkAccount = "SELECT * FROM account WHERE uid=$uid;";
                $check = mysqli_query($conn, $checkAccount);
                while($accountData = mysqli_fetch_assoc($check)){
                    if($accountData['uid'] == $uid){
                        $accountExists = true;
                    }
                }
                if($accountExists == false){
                    $balance = 0;
                    $addAccount = "INSERT INTO account (uid, balance) VALUE ($uid, $balance);";
                    $createAccount = mysqli_query($conn, $addAccount);
                }

                $details = "Logged in with ip : " . $ipaddress;
                $date = date("d-m-Y");
                $time = date("h:i:sa");

                $log = "INSERT INTO userLog (uid, details, date, time, address) VALUES ($uid, '{$details}', '{$date}', '{$time}', '{$address}');";
                $insertLog = mysqli_query($conn, $log);

                if ($checkbox == 'set') {

                    setcookie("email", $row["email"], time() + (86400 * 30), "/");
                    setcookie("passwd", $passwd, time() + (86400 * 30), "/");
                }
                header('location: ../pages/profile.php');
            } else {
                header('location: ../pages/login.php?password_not_matched');
            }
        }
    } else {
        header('location: ../pages/login.php?email_not_matched');
    }

    mysqli_close($conn);
} else {
    header('location: ../pages/login.php');
}
