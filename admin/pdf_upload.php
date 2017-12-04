<?php
include "../db.php";

$target_dir = "../documents/";
$user_id = $_COOKIE['userID'];
$name = $_FILES['pdfFile']['name'];
$category = $_POST['category'];
$target_file = $target_dir . $_FILES['pdfFile']['name'];

if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $target_file))
{
    echo "The file ". basename( $_FILES["pdfFile"]["name"]). " has been uploaded.";
    $db->query("insert into documents(`file_name`, `doc_category`) VALUES('$name', '$category')");
    header("Location: documents.php");
}
else
{
    echo "Sorry, there was an error uploading your file.";
    echo "<br/>" . $db->error;
}
