<?php
include "../db.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MyCompany</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.offcanvas.css">
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
            .dropdown-menu > li > a:hover 
            {
                background-color: #23b3e0;
                background-image: none;
            }
            @media only screen and (min-width: 768px)
            {
                .modal-dialog
                {
                    width: 50%;
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
                        <a class="navbar-brand" style="color: white; font-size: 28px" href="admin_main.php">MyCompany</a>
                    </div>
                    <div>
                        <ul class="nav navbar-nav">
                            <li><a href="sales.php" style="color: white">Sales</a></li>
                            <li><a href="calendar.php" style="color: white">Calendar</a></li>
                            <li><a href="tasks.php" style="color: white">Tasks</a></li>
                            <li><a href="announcements.php" style="color: white">Announcements</a></li>
                            <li><a href="documents.php" style="color: white">Documents</a></li>
                            <li><a href="sales_board.php" style="color: white">Sales Boards</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white">Admin   <img class="img-circle" src="../../images/blank_avatar.gif" width="40px"/></a>
                                <ul class="dropdown-menu" style="background-color: #1481ba;">
                                    <li><a href="../logout.php" style="color: white"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-4" style="padding: 10px;">
                <div style="width: 100%; padding: 20px; background-color: #23b3e0; box-shadow: 5px 5px 5px #0f5f8a; border-radius: 5px;">
                    <h2 style="margin: 0; margin-bottom: 20px; text-align:center; color: white; font-weight: bold">Categories</h2>
                    <a href="change_sales_filter.php?filter=pending"><button class="btn btn-primary btn-lg btn-block" style="margin-bottom: 20px;">Pending Sales</button></a>
                    <a href="change_sales_filter.php?filter=completed"><button class="btn btn-primary btn-lg btn-block" style="">Completed Sales</button></a>
                </div>
            </div>
            <div class="col-md-8" style="padding: 10px;">
                <div style="width: 100%; padding: 20px; padding-bottom: 40px; background-color: #23b3e0; box-shadow: 5px 5px 5px #0f5f8a; border-radius: 5px;">
                    <h2 style="margin: 0; margin-bottom: 20px; text-align:center; color: white; font-weight: bold">
                        <?php
                        if(@$_SESSION['filterHeading'])
                        echo $_SESSION['filterHeading'];
                        else
                        echo "Pending Sales";?>
                    </h2>

                    <?php
                    if(@$_SESSION['showCompletedSales'])
                    {
                        $result = $db->query("select * from sales where accept_status = 1");
                    }
                    else
                    {
                        $result = $db->query("select * from sales where accept_status = 0");
                    }
                        $rows = array();
                        while ($row = $result->fetch_assoc())
                        {
                            $rows[] = $row;
                        }

                        $length = count($rows);
                        for ($i = 0; $i < $length; $i++)
                        {
                            $id = $rows[$i]['user_id'];


                            $user = $db->query("select fName, lName from Users where user_id = $id")->fetch_array();

                            $fName = $user[0];
                            $lName = $user[1];
                            $sale_id = $rows[$i]['sales_id'];

                            echo <<<HEREDOC
<div style="line-height: 45px;">
    <h3 style="margin: 0; color: white; display: inline">$fName $lName</h3>
    <a href="select_sale.php?sale_id=$sale_id"><button style="display: inline; float: right;" class="btn btn-primary btn-lg">View</button></a>
</div>
<hr style="margin-top: 20px;"/>
HEREDOC;
                        }

                    ?>
                </div>
            </div>
        </div>
        </div>
        
        <!-- Pending Modal -->
        <div id="pendingModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">

            <!-- Pending Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sales Ticket Details</h4>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="bsnName" style="font-size: 20px">Business Name:</label>
                    <input type="text" class="form-control" id="bsnName" readonly value="<?php echo $_SESSION['bsnName'];?>">
                  </div>
                  <div class="form-group">
                    <label for="saleDate" style="font-size: 20px">Sale Date:</label>
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" id="saleDate" readonly value="<?php echo $_SESSION['saleDate'];?>">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </div>
                    </div>
                    <p style="font-size: 20px; margin: 0; margin-top: 10px;"><b>Item Information</b></p>
                    <div class="form-group form-inline" style="border: 2px solid grey; border-radius: 3px; padding: 10px;">
                        <label for="itemName">Item Name: </label>
                        <input class="form-control" id="itemName" value="<?php echo $_SESSION['itemName'];?>" readonly style="margin-right: 15px; width: 80px;">
                        <label for="quantity">Quantity: </label>
                        <input class="form-control" type="number" id="quantity" value="<?php echo $_SESSION['quantity'];?>" readonly style="width: 70px; margin-right: 15px;">
                        <label for="unitPrice">Unit Price: </label>
                        <input class="form-control" type="text" disabled id="unitPrice" value="<?php echo $_SESSION['unitPrice'];?>" style="width: 80px; margin-right: 15px;"><br/>
                        <label for="discount">Discount: </label>
                        <input class="form-control" type="text" id="discount" value="<?php echo $_SESSION['discount'];?>" readonly style="width: 80px; margin-right: 15px;">
                        <label for="subtotal">Subtotal: </label>
                        <input class="form-control" type="text" id="subtotal" value="<?php echo $_SESSION['subtotal'];?>" readonly style="width: 80px; margin-right: 15px;">
                        <hr/>
                    </div>
                    <p style="font-size: 20px; font-weight: bold; display: inline;">Contract:&emsp;</p>
                    <div class="input-group">
                    <input type="text" class="form-control" value="<?php echo $_SESSION['contract'];?>" readonly>
                        <div class="input-group-addon" style="background-color: #006dcc;"><a href="../contracts/<?php echo $_SESSION['contract'];?>" target="_blank" style="color: white">View Contract</a></div>
                    </div>
                    <label for="notes" style="font-size: 20px">Notes:</label>
                    <textarea class="form-control" rows="5" id="notes" readonly><?php echo $_SESSION['notes'];?></textarea>
                  </div> 
              </div>
              <div class="modal-footer">
                  <a href="approve_sale.php"><button type="button" class="btn btn-success">Approve</button></a>
                  <a href="reject_sale.php"><button type="button" class="btn btn-danger">Deny</button></a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>

          </div>
        </div>


        <!-- Pending Modal -->
        <div id="alertModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Pending Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?php echo $_SESSION['alertModalHeading'];?></h4>
                    </div>
                    <div class="modal-body">
                        <?php echo $_SESSION['alertModalBody'];?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                    </div>
                </div>

            </div>
        </div>

        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../../js/bootstrap.offcanvas.js"></script>

        <?php
        if(@$_SESSION['showAlertModal'] == true)
        {?>
            <script>
                $('#alertModal').modal('show');</script>
        <?php }
        $_SESSION['showAlertModal'] = false;?>

        <?php
        if(@$_SESSION['showModal'] == true)
        {?>
            <script>
                $('#pendingModal').modal('show');</script>
        <?php }
        $_SESSION['showModal'] = false;?>

        <script>

        </script>
    </body>
</html>