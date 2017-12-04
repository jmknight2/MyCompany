<?php
include "db.php";

$curPwd = md5($_POST['curPwd']);
$newPwd = $_POST['newPwd'];
$rePwd = $_POST['rePwd'];
$userID = $_COOKIE['userID'];

$result = $db->query("select * from Users where `user_id` = $userID");
$row = $result->fetch_array();
echo $row[4];

if($row[4] == $curPwd)
{
    if($newPwd == $rePwd)
    {
        $newPwd = md5($newPwd);
        $result = $db->query("update Users set pwd = '$newPwd' where user_id = $userID");
        $_SESSION['showModal'] = true;
        $_SESSION['modalTitle'] = "Success";
        $_SESSION['modalMessage'] = "Your password was successfully changed." . $db->error;
        header("Location: http://ps11.pstcc.edu/~c2375a08/final/account_management.php");
    }
    else
    {
        $_SESSION['showModal'] = true;
        $_SESSION['modalTitle'] = "Error";
        $_SESSION['modalMessage'] = "Please ensure that the passwords you entered match.";
        header("Location: http://ps11.pstcc.edu/~c2375a08/final/account_management.php");
    }
}
else
{
    $_SESSION['showModal'] = true;
    $_SESSION['modalTitle'] = "Error";
    $_SESSION['modalMessage'] = "Please ensure you entered your current password correctly.";
    header("Location: http://ps11.pstcc.edu/~c2375a08/final/account_management.php");
}
