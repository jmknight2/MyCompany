<?php
include "db.php";

$user_id = $_COOKIE['userID'];
$result = $db->query("select image from Users where user_id = $user_id")->fetch_array();
$imageName = $result[0];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MyCompany</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css//bootstrap.offcanvas.css">
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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../js/bootstrap.offcanvas.js"></script>
        <script src="../js/bootstrap-datepicker.js"></script>
        <script src="../js/file_select.js"></script>


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
            <div class="inner" style="background-color: #23b3e0; min-height: 50%; margin: auto; border-radius: 5px; box-shadow: 5px 5px 5px #0f5f8a;">
                <h2 style="margin: 0; text-align:center; color: white; font-weight: bold">Submit A Sale</h2>
                <form action="submit_sale_script.php" method="post" style="margin: 20px; padding-bottom: 20px;" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="bsnName" style="font-size: 20px">Business Name:</label>
                    <input type="text" class="form-control" id="bsnName" name="bsnName"  required>
                  </div>
                  <div class="form-group">
                    <label for="saleDate" style="font-size: 20px">Sale Date:</label>
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" id="saleDate" name="saleDate"  required>
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </div>
                    </div>
                    <p style="font-size: 20px; margin: 0; margin-top: 10px;"><b>Item Information</b></p>
                    <div class="form-group form-inline" style="border: 2px solid #d1ecfa; border-radius: 3px; padding: 10px;">
                        <label for="itemName">Item Name: </label>
                        <select name="item" id="item" class="form-control">
                        <?php

                        $result = $db->query("select item_id, name, price from items");

                        $select= '';
                        if($result->num_rows)
                        {

                            while($rs=$result->fetch_array())
                            {
                                $select.='<option value="' . $rs['item_id'] . '" id="' . $rs['price'] . '">'.$rs['name'] . '</option>';
                            }
                        }
                        echo $select;
                        ?>
                        </select>
                        <label for="quantity">Quantity: </label>
                        <input class="form-control" type="number" id="quantity" name="quantity" value="1" min="1" style="width: 70px; margin-right: 15px;" required>
                        <label for="unitPrice">Unit Price: $</label>
                        <input class="form-control" type="text" id="unitPrice" name="unitPrice" value="0.00" style="width: 80px; margin-right: 15px;" required readonly>
                        <label for="discount">Discount: $</label>
                        <input class="form-control" type="text" id="discount" name="discount" value="0.00" style="width: 80px; margin-right: 15px;" required>
                        <label>Subtotal: $</label>
                        <input class="form-control" type="text" id="subtotal" name="subtotal" value="$0.00" style="width: 80px; margin-right: 15px;" readonly><br/>
                        <hr/>
                        <!--<div style="text-align: center; margin-top: 10px;"><button class="btn btn-default" style="margin: auto;">+ Add Item</button></div>-->
                    </div>
                    <div class="input-group">
                        <label class="input-group-btn">
                            <span class="btn btn-primary">
                                Upload Contract... <input type="file" style="display: none" name="contract" required>
                            </span>
                        </label>
                        <input type="text" class="form-control" disabled readonly>
                    </div>

                    <label for="notes" style="font-size: 20px">Notes:</label>
                    <textarea class="form-control" rows="5" id="notes" name="notes" required></textarea>
                  </div> 
                  <button type="submit" class="btn btn-primary btn-block btn-lg">Submit Sale</button>
                </form>
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

        <?php
        if(@$_SESSION['showAlertModal'] == true)
        {?>
            <script>
                $('#alertModal').modal('show');</script>
        <?php }
        $_SESSION['showAlertModal'] = false;?>

        <script>
            function updateValues()
            {
                $("#unitPrice").val($('option:selected').attr('id'));
                var unitPrice = parseFloat($("#unitPrice").val());
                var discount;
                var quantity = parseInt($("#quantity").val());
                var subtotal;

                if($("#discount").val() != '')
                {
                    discount = parseFloat($("#discount").val());
                }
                else
                {
                    discount = 0;
                }

                subtotal = (unitPrice - discount) * quantity;
                subtotal =  subtotal.toFixed(2);

                $("#subtotal").val(subtotal);
            }

            $(document).ready(function() {

                updateValues();

                $("#item").change(function () {
                    updateValues();
                });

                $("#discount").on('keyup paste',updateValues);

                $("#quantity").change(function () {
                    updateValues();
                });
            });
        </script>
    </body>
</html>