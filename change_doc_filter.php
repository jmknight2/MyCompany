<?php
session_start();
$_SESSION['document_filter'] = $_GET['filter'];

if($_COOKIE['userID'] == 7)
header("Location: admin/documents.php");
else
header("Location: documents.php");
