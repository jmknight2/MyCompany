<?php
include "../db.php";

$sale_id = $_SESSION['sale_id'];

$result = $db->query("delete from sales where sales_id = $sale_id");

if($result)
{
    $_SESSION['showAlertModal'] = true;
    $_SESSION['alertModalHeading'] = "Success!";
    $_SESSION['alertModalBody'] = "Sale was successfully rejected.";
    header("Location: sales.php");
}
else
{
    echo $db->error;
}