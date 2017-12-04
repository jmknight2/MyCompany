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
        </style>
    </head>
    <body class="body-offcanvas">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../../js/bootstrap.offcanvas.js"></script>
    <script src="../../js/file_select.js"></script>
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
                    <a href="../change_doc_filter.php?filter=all"><button class="btn btn-primary btn-lg btn-block" style="margin-bottom: 20px;">All Documents</button></a>
                    <a href="../change_doc_filter.php?filter=contracts"><button class="btn btn-primary btn-lg btn-block" style="margin-bottom: 20px;">Contracts</button></a>
                    <a href="../change_doc_filter.php?filter=flyers"><button class="btn btn-primary btn-lg btn-block" style="margin-bottom: 20px;">Flyers</button></a>
                    <a href="../change_doc_filter.php?filter=info_sheets"><button class="btn btn-primary btn-lg btn-block" style="margin-bottom: 20px;">Information Sheets</button></a>
                </div>
            </div>
            <div class="col-md-8" style="padding: 10px;">
                <div style="width: 100%; padding: 20px; background-color: #23b3e0; box-shadow: 5px 5px 5px #0f5f8a; border-radius: 5px;">
                    <h2 style="margin: 0; margin-bottom: 20px; text-align:center; color: white; font-weight: bold">Documents</h2>
                    <button class="btn btn-success btn-lg btn-block" style="margin-top: 20px; margin-bottom: 20px; box-shadow: 2px 2px 0px #1a1a1a;" data-toggle="modal" data-target="#uploadModal">+ Upload New Document</button>
                    <table class="table">

                        <?php
                        if(@$_SESSION['document_filter'] == "contracts")
                        {
                            $result = $db->query("select file_name, doc_category from documents where doc_category = 'contracts'");
                        }
                        else if(@$_SESSION['document_filter'] == "flyers")
                        {
                            $result = $db->query("select file_name, doc_category from documents where doc_category = 'flyers'");
                        }
                        else if(@$_SESSION['document_filter'] == "info_sheets")
                        {
                            $result = $db->query("select file_name, doc_category from documents where doc_category = 'info_sheets'");
                        }
                        else
                        {
                            $result = $db->query("select file_name, doc_category from documents");
                        }

                        $rows = array();
                        while($row = $result->fetch_assoc())
                        {
                            $rows[] = $row;
                        }

                        $length = count($rows);
                        for ($i = 0; $i < $length; $i++)
                        {
                            $fileName = $rows[$i]['file_name'];
                            $fileHeading = preg_replace('/_/', " ", $fileName);
                            $fileHeading = substr($fileHeading, 0, strpos($fileHeading, "."));
                            $fileHeading = ucfirst($fileHeading);

                            echo "
                                <tr>
                                    <td><h3 style=\"margin: 0; color: white; display: inline\">$fileHeading</h3></td>
                                    <td>
                                        <a href=\"download.php?download_file=$fileName\"><button style=\"display: inline; float: right; margin-left: 10px;\" class=\"btn btn-primary btn-lg\">Download</button></a>
                                        <a href=\"view_document.php?file_name=$fileName\" target=\"_blank\"><button style=\"display: inline; float: right;\" class=\"btn btn-primary btn-lg\">View</button></a>
                                    </td>
                                </tr>
                                ";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        </div>

        <!-- Upload Modal -->
        <div id="uploadModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Upload Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Upload</h4>
                    </div>
                    <form class="form-group" action="pdf_upload.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <label for="pdfFile">Document:</label><br/>
                            <div class="input-group">
                                <label class="input-group-btn">
                                <span class="btn btn-primary">
                                    Upload Document... <input type="file" name="pdfFile" style="display: none; width: 80%;" required>
                                </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>

                            <br/>

                            <label for="category">Document Category:</label><br/>
                            <select class="form-control" name="category">
                                <option value="contracts">Contracts</option>
                                <option value="flyers">Flyers</option>
                                <option value="info_sheets">Information Sheets</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit"class="btn btn-default btn-success">Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>

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
                <a href="delete_document.php"><button type="button" class="btn btn-danger">Delete</button></a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>

          </div>
        </div>

        <?php
        if($_SESSION['showModal'] == true)
        {
            ?>
            <script>
                $('#deleteModal').modal('show');
            </script>
        <?php }
        $_SESSION['showModal'] = false?>
    </body>
</html>