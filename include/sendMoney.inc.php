<?php
session_start();

if ($_SESSION['logged'] != true) {
    header("location: ../");
}

include_once("../include/dbConn.inc.php");

if (isset($_POST['submit'])) {
    $userExists = false;

    $receiverUid;

    $balance = $_SESSION['balance'];
    $uid = $_SESSION['uid'];

    $sender = $_SESSION['name'];
    $receiverName = $_POST['rName'];
    $receiverNameToLower = strtolower($receiverName);
    $receiverPhone = $_POST['rPhone'];
    $amount = $_POST['amount'];

    if($_SESSION['phone'] == $receiverPhone){
        header("location: ../pages/sendMoney.php?msg=invalid_receiver");
        die();
    }

    if(!(is_numeric($amount))){
        header("location: ../pages/sendMoney.php?msg=invalid_amount");
        die();
    }

    $date = date("d-m-Y");
    $time = date("h:i:sa");

    $checkReceiverExistSql = "SELECT * FROM users WHERE phone='$receiverPhone';";
    $checkReceiverExists = mysqli_query($conn, $checkReceiverExistSql);
    if (mysqli_num_rows($checkReceiverExists) > 0) {
        while ($row = mysqli_fetch_assoc($checkReceiverExists)) {
            if (strtolower($row['name']) == $receiverNameToLower && $row['phone'] == $receiverPhone) {
                $userExists = true;
                $receiverUid = $row['uid'];
            }
        }
    } else {
        header("location: ../pages/sendMoney.php?msg=incorrect_receiver_information");
        die();
    }

    $getReceiverBalanceInformationSql = "SELECT * FROM account WHERE uid=$receiverUid;";
    $getReceiverBalanceInformation = mysqli_query($conn, $getReceiverBalanceInformationSql);
    $receiverBalanceInformation = mysqli_fetch_assoc($getReceiverBalanceInformation);
    $receiverBalance = $receiverBalanceInformation['balance'];



    if ($amount <= $balance) {
        if ($userExists == true) {
            $newSenderBalance = $balance - $amount;
            $updateSenderBalanceSql = "UPDATE account SET balance=$newSenderBalance WHERE uid=$uid;";
            $updateSenderBalance = mysqli_query($conn, $updateSenderBalanceSql);

            $verifySenderBalanceSql = "SELECT balance FROM account WHERE uid=$uid";
            $verifySenderBalance = mysqli_query($conn, $verifySenderBalanceSql);
            $newSenderBalanceCheck = mysqli_fetch_assoc($verifySenderBalance);
            // echo $newSenderBalance;
            if ($newSenderBalanceCheck['balance'] == $newSenderBalance) {
                $newReceiverBalance = $receiverBalance + $amount;
                $updateReceiverBalanceSql = "UPDATE account SET balance=$newReceiverBalance WHERE uid=$receiverUid;";
                $updateReceiverBalance = mysqli_query($conn, $updateReceiverBalanceSql);

                $verifyReceiverBalanceSql = "SELECT balance FROM account WHERE uid=$receiverUid";
                $verifyReceiverBalance = mysqli_query($conn, $verifyReceiverBalanceSql);
                $newReceiverBalanceCheck = mysqli_fetch_assoc($verifyReceiverBalance);

                if ($newReceiverBalanceCheck['balance'] == $newReceiverBalance) {

                    $senderLogSql = "INSERT INTO accountLog (uid, sender, receiver, amount, newAmount, date, time, type) VALUE ($uid, '$sender', '$receiverName', $amount, $newSenderBalance, '$date', '$time', 'sent');";
                    $senderLog = mysqli_query($conn, $senderLogSql);

                    $receiverLogSql = "INSERT INTO accountLog (uid, sender, receiver, amount, newAmount, date, time, type) VALUE ($receiverUid, '$sender', '$receiverName', $amount, $newReceiverBalance, '$date', '$time', 'received');";
                    $receiverLog = mysqli_query($conn, $receiverLogSql);

                    header("location: ../pages/sendMoney.php?msg=success");
                } else {
                    $revertReceiverAmount = $newReceiverBalanceCheck - $amount;
                    $revertReceiverSql = "UPDATE account SET balance = $revertReceiverAmount WHERE uid=$receiverUid;";
                    $revertReceiver = mysqli_query($conn, $revertReceiverSql);
                    header("location: ../pages/sendMoney.php?msg=error_201");
                    die();
                }
            } else {
                $revertSenderAmount = $newSenderBalanceCheck + $amount;
                $revertSenderSql = "UPDATE account SET balance = $revertSenderAmount WHERE uid=$uid;";
                $revertSender = mysqli_query($conn, $revertSenderSql);
                header("location: ../pages/sendMoney.php?msg=error_101");
                die();
            }
        } else {
            header("location: ../pages/sendMoney.php?msg=incorrect_receiver_information");
            die();
        }
    } else {
        header("location: ../pages/sendMoney.php?msg=insufficient_balance");
    }
    mysqli_close($conn);
} else {
    header("location: ../");
}
