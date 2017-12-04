<?php
include "../db.php";
$item_id = $_SESSION['item_id'];
$heading = $_POST['heading'];
$body = $_POST['body'];
$urgency = $_POST['urgency'];
$dueDate = $_POST['dueDate'];
$user = $_POST['assigned'];

$db->query("update assignments set heading = '$heading', body = '$body', urgency = '$urgency', dueDate = '$dueDate',
                   user_id = $user WHERE assignment_id = $item_id");
echo $db->error;
header("Location: tasks.php");