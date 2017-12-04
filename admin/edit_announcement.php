<?php
include "../db.php";
$item_id = $_SESSION['item_id'];
$heading = $_POST['heading'];
$body = $_POST['body'];

$db->query("update announcements set heading = '$heading', body = '$body' WHERE announcement_id = $item_id");
header("Location: announcements.php");