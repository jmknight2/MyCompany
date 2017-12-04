<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MyCompany</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            .col-centered
            {
                margin: 0 auto;
                top: auto;
                bottom: auto;
                float: none;
            }
            
            body
            {
                background-color: #b7e9f7;
                font-family: "Lato", sans-serif;
            }
        </style>
    </head>
    <body style="background-color: #b7e9f7;">
        
        <nav class="navbar navbar-default" style="background-color: #1481ba; border: none; border-radius: 0px;">
          <div class="container-fluid">
            <div class="navbar-header" style="padding-bottom: 10px;">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand"><h1 style="margin: 0 auto; padding-bottom: 10px; color: white; font-weight: bold">My Company</h1></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav navbar-right">
                  <li><a href="login.php"><button class="btn btn-lg btn-primary" style="box-shadow: 2px 2px 0px #1a1a1a"><span class="glyphicon glyphicon-user"></span> Login</button></a></li>
                  <li><a href="register.php"><button class="btn btn-lg btn-success" style="box-shadow: 2px 2px 0px #1a1a1a"><span class="glyphicon glyphicon-pencil"></span> Sign-Up</button></a></li>
              </ul>
            </div>
          </div>
        </nav>
        
        <div class="container-fluid">
            <div class="row" style="text-align: center; margin: 0 auto;">
            <div class="col-8-sm col-centered" style="max-width: 400px; background-color: #23b3e0; padding: 15px; border-radius: 5px; box-shadow: 5px 5px 10px #1a1a1a;">
              <h2 style="margin-top: 0px; font-weight: bold; color: white">Login To MyCompany</h2>
              <form action="login_script.php" method="post">
                <div class="form-group" style="text-align: left; margin: 0 auto;">
                  <label for="email"><h3>Email</h3></label>
                  <input style="max-width: 400px" type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                </div>
                <div class="form-group" style="text-align: left">
                    <label for="pwd"><h3>Password:</h3></label>
                  <input style="max-width: 400px" type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
                </div>
                <div class="checkbox" style="text-align: left">
                  <label><input type="checkbox" name="remember"> Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg" style="margin: 0 auto; width: 75%">Login</button>
              </form>
            </div>
            </div>
        </div>



        <!-- Modal -->
        <div id="errorModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Login Error</h4>
                    </div>
                    <div class="modal-body">
                        <p>Unfortunately that info did not match any of our records. Please try again.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <?php
        if(@$_SESSION['showModal'] == true)
        {
        ?>
            <script>
                $('#errorModal').modal('show');
            </script>
        <?php
        }
        $_SESSION['showModal'] = false;
        ?>

    </body>
</html>