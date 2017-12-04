<?php
/**
 * Created by PhpStorm.
 * User: Jon
 * Date: 11/12/2017
 * Time: 4:16 AM
 */
setcookie("LoggedIn", "", time() - 3600, "/");
setcookie("fName", "", time() - 3600, "/");
setcookie("lName", "", time() - 3600, "/");
setcookie("userID", "", time() - 3600, "/");
header("Location: http://ps11.pstcc.edu/~c2375a08/final/login.php");
die();
?>