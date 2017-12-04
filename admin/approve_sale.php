<?php
include "../db.php";

$sale_id = $_SESSION['sale_id'];

$result = $db->query("update sales set accept_status = 1 where sales_id = $sale_id");

if($result)
{
    $_SESSION['showAlertModal'] = true;
    $_SESSION['alertModalHeading'] = "Success!";
    $_SESSION['alertModalBody'] = "Sale was successfully approved.";
    $row = $db->query("select user_id from sales where sales_id = $sale_id")->fetch_array();
    $user_id = $row[0];
    $row = $db->query("select sales from Users where user_id = $user_id")->fetch_array();
    $currentSales = $row[0];
    $row = $db->query("select subtotal from sales WHERE sales_id = $sale_id")->fetch_array();
    $newSale = $row[0];
    $saleTotal = $currentSales + $newSale;
    $db->query("update Users set sales = $saleTotal WHERE user_id = $user_id");
    header("Location: sales.php");
}
else
{
    echo $db->error;
}
