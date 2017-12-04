<?php
include "../db.php";
if(!isset($_COOKIE["LoggedIn"]))
{
    header("Location: http://ps11.pstcc.edu/~c2375a08/final/login.php");
}
else {

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
            body {
                background-color: #b7e9f7;
                font-family: "Lato", sans-serif;
            }

            .navbar-brand, .navbar-nav li a {
                line-height: 43px;
                font-size: 18px;
            }

            .dropdown-menu > li > a:hover {
                background-color: #23b3e0;
                background-image: none;
            }

            .inner {
                width: 85%;
            }

            @media only screen and (max-width: 500px) {
                .inner {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body class="body-offcanvas">
    <header class="clearfix">
        <button type="button" class="navbar-toggle offcanvas-toggle" data-toggle="offcanvas"
                data-target="#js-bootstrap-offcanvas" style="float: left; background-color: #1481ba; color: white;">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <nav class="navbar navbar-default navbar-offcanvas navbar-offcanvas-touch" role="navigation"
             id="js-bootstrap-offcanvas" style="background-color: #1481ba;">
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
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white">Admin <img
                                        class="img-circle" src="../../images/blank_avatar.gif" width="40px"/></a>
                            <ul class="dropdown-menu" style="background-color: #1481ba;">
                                <li><a href="../logout.php" style="color: white"><span
                                                class="glyphicon glyphicon-log-out"></span> Logout</a></li>
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
                <div class="inner"
                     style="background-color: #23b3e0; margin: auto; padding: 20px; border-radius: 5px; box-shadow: 5px 5px 5px #0f5f8a;">
                    <h2 style="margin: 0; text-align:center; color: white; font-weight: bold">Announcements</h2>
                    <div style="margin-bottom: 20px;">
                        <br/>
                        <button class="btn btn-success btn-lg btn-block"
                                style="display: inline; box-shadow: 2px 2px 0px #1a1a1a;" data-toggle="modal"
                                data-target="#createModal">+ New Announcement
                        </button>
                    </div>

                    <?php

                    $result = $db->query("select * from announcements");
                    $rows = array();
                    while ($row = $result->fetch_assoc()) {
                        $rows[] = $row;
                    }

                    $length = count($rows);
                    for ($i = 0; $i < $length; $i++)
                    {
                        $heading = $rows[$i]['heading'];
                        $body = $rows[$i]['body'];
                        $id = $rows[$i]['announcement_id'];

                        @$now = time();
                        @$your_date = strtotime($rows[$i]['created']);
                        $datediff = floor(($now - $your_date) / (60 * 60 * 24));

                        if ($datediff == 0)
                        {
                            $datediff = "Today";
                        }
                        else
                        {
                            $datediff .= "Day(s) ago";
                        }

                        echo <<<HEREDOC
<div style="margin: auto; width: 95%; min-height: 100px; background-color: #dfebf7; border-radius: 5px; margin-top: 10px; padding: 5px; box-shadow: 5px 5px 2px #1481ba;" xmlns="http://www.w3.org/1999/html">
    <h4 style="font-weight: bold; padding: 0; margin: 0; display: inline-block; float: left;">$heading</h4>
    <a href="set_selected_id.php?item_id=$id&item_type=announcement&item_action=delete"><button style="float: right; font-size: 20px; color: red; margin-left: 5px;" type="button" class="close">&times;</button></a>
    <a style="float: right; font-size: 20px; color: black; margin-left: 5px;" href="set_selected_id.php?item_id=$id&item_type=announcement&item_action=edit"><span class="glyphicon glyphicon-pencil"></span></a>
    <h5 style="padding: 0; margin: 0; display: inline-block; float: right;"><span class="glyphicon glyphicon-time"></span> $datediff</h5>
    <br/>
    <hr style="border-color: black; margin-top: 5px; display: block;"/>
    <p>$body</p>
</div>
HEREDOC;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Delete Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this item?</p>
                </div>
                <div class="modal-footer">
                    <a href="delete_item.php?item_type=announcement"><button type="button" class="btn btn-danger">Delete</button></a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Edit ann Modal -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Edit ann Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Announcement</h4>
                </div>
                <form class="form-group" action="edit_announcement.php" method="post">
                    <div class="modal-body">

                        <label for="heading">Heading:</label>
                        <input name="heading" class="form-control" type="text" value="<?php echo $_SESSION['heading']?>">
                        <br/>
                        <label for="body">Body:</label>
                        <textarea name="body" class="form-control" rows="5"><?php echo $_SESSION['body']?></textarea>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create announcements Modal -->
    <div id="createModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Edit announcements Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create Announcement</h4>
                </div>
                <form class="form-group" action="create_announcement.php" method="post">
                    <div class="modal-body">

                        <label for="heading">Heading:</label>
                        <input name="heading" id="heading" class="form-control" type="text" required>
                        <br/>
                        <label for="body">Body:</label>
                        <textarea name="body" id="body" class="form-control" rows="5" required></textarea>

                    </div>
                    <div class="modal-footer">
                        <button type="submit"class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>

            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../../js/bootstrap.offcanvas.js"></script>

    <?php
    if($_SESSION['showDeleteModal'] == 1)
    {?>
        <script>
            $('#deleteModal').modal('show');
        </script>
    <?php }
    $_SESSION['showDeleteModal'] = false;?>

    <?php
    if($_SESSION['showEditModal'] == 1)
    {?>
        <script>
            $('#editModal').modal('show');
        </script>
    <?php }
    $_SESSION['showEditModal'] = false;?>

    </body>
    </html>
    <?php
}
    ?>