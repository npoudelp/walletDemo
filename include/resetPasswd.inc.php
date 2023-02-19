<?php
session_start();
if ($_SESSION['logged'] != true) {
    header('location: ../');
}
if (isset($_POST['submit'])) {
    $passwd = $_POST['passwd'];
    $passwdr = $_POST['passwdr'];
    $oldPasswd = $_POST['oldPasswd'];
    $uid = $_SESSION['uid'];

    include_once("./dbConn.inc.php");

    $check = "SELECT passwd AS P FROM users WHERE uid='{$uid}';";
    $result = mysqli_query($conn, $check);
    $row = mysqli_fetch_assoc($result);
    $hash = $row["P"];
    $passwordH = password_verify($oldPasswd, $hash);
    if ($passwordH == 1) {
        $passwordSet = password_hash($passwd, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET passwd = '{$passwordSet}' WHERE uid=$uid;";
        $set = mysqli_query($conn, $sql);
        header("location:../pages/myAccount.php?msg=success");
    } else {
        header("location:../pages/myAccount.php?msg=old_passowrd_not_matched");
    }

    mysqli_close($conn);
} else {
    header("location:../");
}
