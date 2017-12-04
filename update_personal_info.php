<?php
include "db.php";

session_start();

$newFName = $_POST['fName'];
$newLName = $_POST['lName'];
$newEmail = $_POST['email'];
$userID = $_COOKIE['userID'];
setcookie("fName", $newFName, time() + (86400 * 30), "/");
setcookie("lName", $newLName, time() + (86400 * 30), "/");
setcookie("email", $newEmail, time() + (86400 * 30), "/");

$insert = $db->query("UPDATE Users set fName = '$newFName', lName = '$newLName', email = '$newEmail' WHERE user_id = $userID");


if($insert)
{
    echo "Yay!!";
    $_SESSION['showModal'] = true;
    $_SESSION['modalTitle'] = "Success";
    $_SESSION['modalMessage'] = "Your info was successfully updated!";
    header("Location: http://ps11.pstcc.edu/~c2375a08/final/account_management.php");
}
else
{
    echo "No!";
    echo $db->error;
}
?>