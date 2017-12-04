<?php
session_start();
include "db.php";

$userId = $_COOKIE['userID'];
$bsnName = $db->real_escape_string($_POST['bsnName']);
$saleDate = $db->real_escape_string($_POST['saleDate']);
@$saleDate = $db->real_escape_string(date("Y-m-d", strtotime($saleDate)));
$itemName = $db->real_escape_string($_POST['item']);
$quantity = $db->real_escape_string($_POST['quantity']);
$unitPrice = $db->real_escape_string($_POST['unitPrice']);
$discount = $db->real_escape_string($_POST['discount']);
$subtotal = $db->real_escape_string($_POST['subtotal']);
$fileName = fileHandler();
$notes = $_POST['notes'];

$query = "insert into sales (`user_id`,`bName`, `sale_date`, `item_id`,
                   `quantity`, `discount`,
                   `subtotal`, `accept_status`, `contract_name`,
                   `notes`) 
                   values('$userId','$bsnName', '$saleDate', '$itemName',
                          $quantity, $discount,  
                          $subtotal, false, '$fileName',
                          '$notes')";

$result = $db->query($query);

if(!$result)
{
    echo $db->error;
}
else
{
    $_SESSION['showAlertModal'] = true;
    $_SESSION['alertModalHeading'] = "Success!";
    $_SESSION['alertModalBody'] = "Sale was successfully submitted.";
    header("Location: submit_a_sale.php");
}


function fileHandler()
{
    $target_dir = "contracts/";
    $uploadOk = 1;
    $fileType = pathinfo(basename( $_FILES['contract']['name']),PATHINFO_EXTENSION);
    $newName = time() . "." . $fileType;
    $target_file = $target_dir . $newName;

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0)
    {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    }
    else
    {
        if (move_uploaded_file($_FILES["contract"]["tmp_name"], $target_file))
        {
            echo "The file ". basename( $_FILES["contract"]["name"]). " has been uploaded.";
            return $newName;
        }
        else
        {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}