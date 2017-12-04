<?php
include "../db.php";

$heading = $_POST['heading'];
$body = $_POST['body'];
@$now = date("Y-m-d");

$result = $db->query("insert into announcements (`heading`, `body`, `created`) values('$heading', '$body', CAST('$now' AS DATE))");

if($result)
{
    header("Location: http://ps11.pstcc.edu/~c2375a08/final/admin/announcements.php");
    die();
}
else
{
    echo $db->error;
}
