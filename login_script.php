<?php include "db.php" ?>

<?php
    if(!empty($_POST['email']) && !empty($_POST['pwd']))
    {
        $email = $db->real_escape_string($_POST['email']);
        $pwd = md5($db->real_escape_string($_POST['pwd']));

        $checklogin = $db->query("SELECT * FROM Users WHERE email = '".$email."' AND pwd = '".$pwd."'");

        if($checklogin->num_rows == 1)
        {
            $row = $checklogin->fetch_array();
            $userID = $row[0];
            $fName = $row[1];
            $lName = $row[2];
            $email = $row[3];

            $_SESSION['email'] = $email;
            setcookie("LoggedIn", 1, time() + (86400 * 30), "/");
            setcookie("fName", $fName, time() + (86400 * 30), "/");
            setcookie("lName", $lName, time() + (86400 * 30), "/");
            setcookie("email", $email, time() + (86400 * 30), "/");
            setcookie("userID", $userID, time() + (86400 * 30), "/");

            if($userID == 7)
            {
                header("Location: http://ps11.pstcc.edu/~c2375a08/final/admin/admin_main.php");
                die();
            }
            else
            {
                header("Location: http://ps11.pstcc.edu/~c2375a08/final/user_mainpage.php");
                die();
            }
        }
        else
        {
            $_SESSION['showModal'] = true;
            echo $_SESSION['showModal'];
            header("Location: http://ps11.pstcc.edu/~c2375a08/final/login.php");
            die();
        }
    }
?>
