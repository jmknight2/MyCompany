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
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.offcanvas.css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src='lib/moment.min.js'></script>
        <script src='fullcalendar/fullcalendar.js'></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../js/bootstrap.offcanvas.js"></script>

        <style>
            body
            {
                background-color: #b7e9f7;
                font-family: "Lato", sans-serif;
            }

            #calendar
            {
                background-color: #dfebf7;
                border-radius: 10px;
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

            #style-7::-webkit-scrollbar-track
            {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                background-color: #F5F5F5;
                border-radius: 10px;
            }

            #style-7::-webkit-scrollbar
            {
                width: 10px;
                background-color: #F5F5F5;
            }

            #style-7::-webkit-scrollbar-thumb
            {
                border-radius: 10px;
                background-image: -webkit-gradient(linear,
                left bottom,
                left top,
                color-stop(0.44, rgb(122,153,217)),
                color-stop(0.72, rgb(73,125,189)),
                color-stop(0.86, rgb(28,58,148)));
            }
        </style>
    </head>
    <body class="body-offcanvas">

    <script>
        $(document).ready(function() {

            <?php
            $user_id = $_COOKIE['userID'];
            $result = $db->query("select * from assignments where user_id = $user_id ORDER BY dueDate DESC ");
            $rows = array();
            while($row = $result->fetch_assoc())
            {
                $rows[] = $row;
            }

            $length = count($rows);
            echo "console.log('Length: ' + '$length');
                ";
            // page is now ready, initialize the calendar...

            echo "$('#calendar').fullCalendar({";



            if($length > 0)
            {
                echo "events: [";
                for ($i = 0; $i < $length; $i++)
                {
                    $heading = $rows[$i]['heading'];
                    $body = $rows[$i]['body'];
                    $task_id = $rows[$i]['assignment_id'];

                    @$now = time();
                    @$your_date = $rows[$i]['dueDate'];

                    echo "{
                                        title: '$heading',
                                        start: '$your_date',
                                        id: $task_id
                                      }";

                    if ($i === $length - 1)
                    {
                        echo "]";
                    }
                    else
                    {
                        echo ", 
                                         ";
                    }
                }
            }
            ?>
        });
        });
    </script>
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
            <div class="col-md-8" style="padding: 10px;">
                <div style="width: 100%; padding: 20px; background-color: #23b3e0; box-shadow: 5px 5px 5px #0f5f8a; border-radius: 5px;">
                    <h2 style="margin: 0; text-align:center; color: white; font-weight: bold">Calendar</h2>
                    <div id="calendar"></div>

                </div>
            </div>
            <div class="col-md-4" style="padding: 10px;">
                <div style="width: 100%; background-color: #23b3e0; padding: 20px; box-shadow: 5px 5px 5px #0f5f8a; border-radius: 5px;">
                    <h2 style="margin: 0; text-align:center; color: white; font-weight: bold">Upcoming Deadlines</h2>
                    <div id="style-7" style="width: 100%; max-height: 600px; background-color: #23b3e0; overflow-y: scroll;">
                        <?php
                        $user_id = $_COOKIE['userID'];
                        $result = $db->query("select * from assignments where user_id = $user_id ORDER BY dueDate DESC ");
                        $rows = array();
                        while($row = $result->fetch_assoc())
                        {
                            $rows[] = $row;
                        }

                        $length = count($rows);

                        if($length > 0)
                        {
                            for ($i = 0; $i < $length; $i++)
                            {
                                $heading = $rows[$i]['heading'];
                                $body = $rows[$i]['body'];

                                @$now = time();
                                @$your_date = strtotime($rows[$i]['dueDate']);
                                $datediff = floor(($your_date - $now) / (60 * 60 * 24));

                                if ($datediff == 0)
                                {
                                    $datediff = "Due by Today";
                                }
                                else if($datediff < 0)
                                {
                                    $datediff = "Past Due";
                                }
                                else
                                {
                                    $datediff = "Due in " . $datediff . " days";
                                }

                                echo <<<HEREDOC
<div style="margin: auto; width: 95%; min-height: 100px; background-color: #dfebf7; border-radius: 5px; margin-top: 10px; padding: 5px; box-shadow: 5px 5px 2px #1481ba;">
    <h4 style="font-weight: bold; padding: 0; margin: 0; display: inline-block; float: left;">$heading</h4>
    <h5 style="padding: 0; margin: 0; display: inline-block; float: right;"><span class="glyphicon glyphicon-time"></span> $datediff</h5>
    <br/>
    <hr style="border-color: black; margin-top: 5px; display: block;"/>
    <p>$body</p>
</div>
HEREDOC;
                            }
                        }
                        else
                        {
                            echo <<<HEREDOC
<br/>
<h3 style="margin: 0; text-align:center; font-weight: bold">Nothing to show here...</h3>
HEREDOC;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>