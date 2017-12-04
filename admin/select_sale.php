<?php
session_start();
include "../db.php";
$sale_id = $_GET['sale_id'];

$result = $db->query("select * from sales where sales_id = $sale_id");
$row = array();
$row = $result->fetch_assoc();

$_SESSION['sale_id'] = $sale_id;
$_SESSION['bsnName'] = $row['bName'];
$_SESSION['saleDate'] = $row['sale_date'];
$item_id = $row['item_id'];
$_SESSION['quantity'] = $row['quantity'];
$_SESSION['discount'] = $row['discount'];
$_SESSION['subtotal'] = $row['subtotal'];
$_SESSION['contract'] = $row['contract_name'];
$_SESSION['notes'] = $row['notes'];


$result = $db->query("select * from items where item_id = $item_id");
$row = $result->fetch_assoc();
$_SESSION['itemName'] = $row['name'];
$_SESSION['unitPrice'] = $row['price'];

$_SESSION['showModal'] = true;
header("Location: sales.php");