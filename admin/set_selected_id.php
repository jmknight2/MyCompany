<?php
session_start();
include "../db.php";
$item_id = $_GET['item_id'];
$_SESSION['item_id'] = $item_id;
if($_GET['item_type'] == "announcement" && $_GET['item_action'] == "delete")
{
    $_SESSION['showDeleteModal'] = true;
    header("Location: http://ps11.pstcc.edu/~c2375a08/final/admin/announcements.php");
    die();
}
elseif ($_GET['item_type'] == "announcement" && $_GET['item_action'] == "edit")
{
    $row = $db->query("select heading, body from announcements where announcement_id = $item_id")->fetch_array();
    $_SESSION['heading'] = $row[0];
    $_SESSION['body'] = $row[1];
    $_SESSION['showEditModal'] = true;
    header("Location: http://ps11.pstcc.edu/~c2375a08/final/admin/announcements.php");
    die();
}
if($_GET['item_type'] == "task" && $_GET['item_action'] == "delete")
{
    $_SESSION['showDeleteModal'] = true;
    header("Location: http://ps11.pstcc.edu/~c2375a08/final/admin/tasks.php");
    die();
}
elseif ($_GET['item_type'] == "task" && $_GET['item_action'] == "edit")
{
    $row = $db->query("select heading, body, urgency, dueDate, user_id from assignments where assignment_id = $item_id")->fetch_array();
    $_SESSION['heading'] = $row[0];
    $_SESSION['body'] = $row[1];
    $_SESSION['urgency'] = $row[2];
    $_SESSION['dueDate'] = $row[3];
    $_SESSION['user'] = $row[4];
    $_SESSION['showEditModal'] = true;
    echo $_SESSION['user'];
    header("Location: http://ps11.pstcc.edu/~c2375a08/final/admin/tasks.php");
    die();
}
