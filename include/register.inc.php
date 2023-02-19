<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];
    $passwdR = $_POST['passwdR'];
    $address = $_POST['address'];
    $passwdH = password_hash($passwd, PASSWORD_DEFAULT);

    include_once('./dbConn.inc.php');

    $sql = "INSERT INTO users (name, address, phone, email, passwd) VALUE ('$name', '$address', '$phone', '$email', '$passwdH');";
    $sqlCheck = "SELECT phone FROM users WHERE phone = '$phone'";
    $chaeckPhone = mysqli_query($conn, $sqlCheck);
    if (mysqli_num_rows($chaeckPhone) > 0) {
        header('location: ../pages/register.php?msg=phone_already_exists');
    } else {
        $insert = mysqli_query($conn, $sql);
        if ($insert) {
            header('location: ../pages/login.php?user_created');
        } else {
            header('location: ../pages/register.php?error');
        }
    }

    mysqli_close($conn);
} else {
    header('location: ../pages/adminPages/register.php');
}
