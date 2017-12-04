<?php
include "../db.php";
$item_id = $_SESSION['item_id'];

if($_GET['item_type'] == "announcement")
{
    $db->query("delete from announcements where announcement_id = $item_id");
    header("Location: announcements.php");
}
else if($_GET['item_type'] == "task")
{
    $db->query("delete from assignments where assignment_id = $item_id");
    header("Location: tasks.php");
}
