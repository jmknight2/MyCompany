<?php
session_start();
include "../db.php";
$doc_id = $_SESSION['doc_id'];

$row = $db->query("select file_name from documents WHERE document_id = $doc_id")->fetch_array();
$file_name = $row[0];
unlink("../documents/$file_name");

$db->query("delete from documents where document_id = $doc_id");
echo $db->error;
header("Location: documents.php");