<?php
session_start();
$doc_id = $_GET['doc_id'];
$_SESSION['doc_id'] = $doc_id;
$_SESSION['showModal'] = true;
echo "Show modal: ".$_SESSION['showModal'];
header("Location: documents.php");
?>
