<?php include "db.php"; ?>
        <?php
        if(!empty($_POST['email']) && !empty($_POST['pwd']))
        {
            $defaultImage = "blank_avatar.gif";
            $password = md5($db->real_escape_string($_POST['pwd']));
            $email = $db->real_escape_string($_POST['email']);
            $fName = $db->real_escape_string($_POST['fName']);
            $lName = $db->real_escape_string($_POST['lName']);

             $checkemail = $db->query("SELECT * FROM Users WHERE email = '".$email."'");

             if($checkemail->num_rows == 1)
             {
                $_SESSION['modalTitle'] = "Error";
                $_SESSION['modalMessage'] = "<p>Sorry, that email is already in use. Please try again.</p>";
             }
             else
             {
                $registerquery = $db->query("INSERT INTO Users (fName, lName, email, pwd, image, sales) VALUES('".$fName."', '".
                    $lName."', '".$email."', '".$password."', '$defaultImage', 0)");
                if($registerquery)
                {
                    $_SESSION['modalTitle'] = "Success";
                    $_SESSION['modalMessage'] = "<p>Your account was successfully created. Please <a href=\"login.php\">click here to login</a>.</p>";
                }
                else
                {
                    $_SESSION['modalTitle'] = "Error";
                    $_SESSION['modalMessage'] = "<p>Sorry, your registration failed. Please try again.</p>";
                }       
             }
             $_SESSION['showModal'] = true;
            header("Location: http://ps11.pstcc.edu/~c2375a08/final/register.php");
        }
        ?>
