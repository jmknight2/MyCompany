<?php
include "db.php";
$user_id = $_COOKIE['userID'];
$result = $db->query("select image from Users where user_id = $user_id")->fetch_array();
$imageName = $result[0]
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MyCompany</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.offcanvas.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap-datepicker.css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <style>            
            body
            {
                background-color: #b7e9f7;
                font-family: "Lato", sans-serif;
            }
            .navbar-brand, .navbar-nav li a 
            {
                line-height: 43px;
                font-size: 18px;
            }
            .btn-file 
            {
                position: relative;
                overflow: hidden;
            }
            .btn-file input[type=file] 
            {
                position: absolute;
                top: 0;
                right: 0;
                min-width: 100%;
                min-height: 100%;
                font-size: 100px;
                text-align: right;
                filter: alpha(opacity=0);
                opacity: 0;
                outline: none;
                background: white;
                cursor: inherit;
                display: block;
            }
            
            .dropdown-menu > li > a:hover 
            {
                background-color: #23b3e0;
                background-image: none;
            }
            
            .dropdown .open
            {
                background-color: #23b3e0;
                background-image: none;
            }
            .inner
            {
                width: 85%;
            }
            
            @media only screen and (max-width: 500px) 
            {
                .inner
                {
                    width: 100%;
                }
            } 
        </style>
    </head>
    <body class="body-offcanvas"> 
        <header class="clearfix">
            <button type="button" class="navbar-toggle offcanvas-toggle" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas" style="float: left; background-color: #1481ba; color: white;">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <nav class="navbar navbar-default navbar-offcanvas navbar-offcanvas-touch" role="navigation" id="js-bootstrap-offcanvas" style="background-color: #1481ba;">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" style="color: white; font-size: 28px" href="user_mainpage.php">MyCompany</a>
                    </div>
                    <div>
                        <ul class="nav navbar-nav">
                            <li><a href="submit_a_sale.php" style="color: white">Submit a Sale</a></li>
                            <li><a href="calendar.php" style="color: white">Calendar</a></li>
                            <li><a href="assigned_tasks.php" style="color: white">Assigned Tasks</a></li>
                            <li><a href="documents.php" style="color: white">Documents</a></li>
                            <li><a href="sales_board.php" style="color: white">Sales Boards</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;"><?php echo $_COOKIE['fName'] . " " . $_COOKIE['lName'];?>

                                    <?PHP

                                    echo "<div class=\"img-circle\" style='display: inline-block; width: 40px; height: 40px; background-color: #1a1a1a; overflow: hidden;'><img src=\"images/$imageName\" style='height: 100%; width: 100%;'/></div>";
                                    ?>
                                </a>
                                <ul class="dropdown-menu" style="background-color: #1481ba;">
                                    <li><a href="account_management.php" style="color: white"><span class="glyphicon glyphicon-user"></span> Account</a></li>
                                    <li><a href="logout.php" style="color: white"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header> 
        
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" style="padding: 10px; height: 100%">
            <div class="inner" style="background-color: #23b3e0; margin: auto; border-radius: 5px; box-shadow: 5px 5px 5px #0f5f8a;">
                <?PHP
                $user_id = $_COOKIE['userID'];

                echo "<div class=\"img-circle\" style='width: 300px; height: 300px; background-color: #1a1a1a; overflow: hidden; margin: auto; margin-top: 20px; margin-bottom: 10px'><img src=\"images/$imageName\" style='height: 100%; width: 100%;'/></div>";
                ?>
                <h3 style="margin-bottom: 5px; margin-left: 20%;">Change Profile Picture</h3>
                <form action="image_upload_script.php" method="post" class="form-group" style="margin-left: 20%; margin-right: 20%; text-align: center;" enctype="multipart/form-data">
                    <!--<input type="file" name="fileToUpload">-->
                    <div class="input-group">
                        <label class="input-group-btn">
                            <span class="btn btn-primary">
                                Upload Image... <input type="file" name="fileToUpload" style="display: none;">
                            </span>
                        </label>
                        <input type="text" class="form-control" disabled readonly>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg" style="margin-top: 15px;">Confirm</button>
                </form>
                <hr/>
                <h3 style="text-align: center;">Update Personal Information</h3>
                <form  action="update_personal_info.php" method="post" class="form-group" style="margin-left: 5%; margin-right: 30%;">
                    <label for="fName" style="font-size: 20px;">First Name</label>
                    <input class="form-control" type="text" id="fName" name="fName" value="<?php echo $_COOKIE['fName'];?>" required>
                    <label for="lName" style="font-size: 20px;">Last Name</label>
                    <input class="form-control" type="text" id="lName" name="lName" value="<?php echo $_COOKIE['lName'];?>" required>
                    <label for="email" style="font-size: 20px;">E-Mail</label>
                    <input class="form-control" type="email" id="email" name="email" value="<?php echo $_COOKIE['email'];?>" required>
                    <button type="submit" class="btn btn-primary btn-lg" style="margin-top: 15px;">Update</button>
                </form>   
                <hr/>
                <h3 style="text-align: center;">Update Password</h3>
                <form class="form-group" action="update_password.php" method="post" style="margin-left: 5%; margin-right: 30%;">
                    <label for="curPwd" style="font-size: 20px;">Current Password</label>
                    <input class="form-control" type="password" id="curPwd" name="curPwd" required>
                    <label for="newPwd" style="font-size: 20px;">New Password</label>
                    <input class="form-control" type="password" id="newPwd" name="newPwd" required>
                    <label for="rePwd" style="font-size: 20px;">New Password (Retype)</label>
                    <input class="form-control" type="password" id="rePwd" name="rePwd" required>
                    <button type="submit" class="btn btn-primary btn-lg" style="margin-top: 15px;">Update</button>
                </form>   
            </div>
            </div>    
        </div>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../js/bootstrap.offcanvas.js"></script>
        <script src="../js/bootstrap-datepicker.js"></script>
        <script src="../js/file_select.js"></script>

        <!-- Modal -->
        <div id="errorModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?php echo $_SESSION['modalTitle'];?></h4>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $_SESSION['modalMessage'];?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <?php
        if(@$_SESSION['showModal'] == true)
        {?>
            <script>
                $('#errorModal').modal('show');</script>
        <?php }
        $_SESSION['showModal'] = false;?>
    </body>
</html>