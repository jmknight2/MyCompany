<?php
include "../db.php";

$heading = $_POST['heading'];
$body = $_POST['body'];
$dueDate = $_POST['dueDate'];
$assignedTo = $_POST['assigned'];
$urgency = $_POST['urgency'];

$dueDate = date("Y-m-d", strtotime($dueDate));

$result = $db->query("insert into assignments (`user_id`, `dueDate`, `urgency`, `heading`, `body`) 
                             values('$assignedTo', '$dueDate', '$urgency', '$heading', '$body')");

if($result)
{
    header("Location: http://ps11.pstcc.edu/~c2375a08/final/admin/tasks.php");
    die();
}
else
{
    echo $db->error;
}
