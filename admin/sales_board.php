<?php
include "../db.php";

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

        .chart-container
        {
            position: relative;
            margin: auto;
            min-height: 600px;
            width: 100%;
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
        <div class="col-md-8" style="padding: 10px; height: 100%;">
            <div style="width: 100%; padding: 20px; height: 100%; background-color: #23b3e0; box-shadow: 5px 5px 5px #0f5f8a; border-radius: 5px;">
                <h2 style="margin: 0; text-align:center; color: white; font-weight: bold">Sales Board</h2>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
                <?php
                $result = $db->query("select user_id, fName, lName, sales from Users where user_id != 7 order by sales DESC limit 3");

                $i = 0;
                $names = new ArrayObject();
                $sales = new ArrayObject();

                if($result->num_rows)
                {
                    while($rs=$result->fetch_array())
                    {
                        $names[$i] = $rs[1] . " " . $rs[2];
                        $sales[$i] = $rs[3];
                        $i++;
                    }
                }

                echo "               
<div class=\"chart-container\">
    <canvas id=\"myChart\"></canvas>
</div>
<script>
    var data = {
        labels: [\"$names[0]\", \"$names[1]\", \"$names[2]\"],
        datasets: [{
            label: \"Sales\",
            backgroundColor: \"rgba(66, 244, 0,0.5)\",
            borderColor: \"rgba(0,0,100,1)\",
            borderWidth: 2,
            hoverBackgroundColor: \"rgba(66, 244, 90,1.0)\",
            hoverBorderColor: \"rgba(0,0,100,1)\",
            data: [$sales[0], $sales[1], $sales[2]],
        }]
    };

    var option = {
        maintainAspectRatio: false,
        scales: {
            yAxes: [{
                stacked: true,
                gridLines: {
                    display: true,
                    color: \"rgba(255,99,132,0.2)\"
                }
            }],
            xAxes: [{
                gridLines: {
                    display: false
                }
            }]
        }
    };

    Chart.Bar('myChart', {
        options: option,
        data: data
    });
</script>";
                ?>

                <!--<img class="img-rounded" style="margin: auto; margin-top: 20px; width: 100%; display: inline-block;" src="../images/barChart.png"/>-->
            </div>
        </div>
        <div class="col-md-4" style="padding: 10px;">
            <div style="width: 100%; padding: 10px; background-color: #23b3e0; box-shadow: 5px 5px 5px #0f5f8a; border-radius: 5px;">
                <h2 style="margin: 0; margin-bottom: 20px; text-align:center; color: white; font-weight: bold">Top Salespeople</h2>
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Sales</th>
                    </thead>

                    <?php

                    $length = $names->count();
                    for ($i=0; $i < $length; $i++)
                    {
                        echo "
                            <tr>
                                <td><h3>$names[$i]</h3></td>
                                <td><h3>$$sales[$i]</h3></td>
                            </tr>
                            ";
                    }

                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../../js/bootstrap.offcanvas.js"></script>
</body>
</html>