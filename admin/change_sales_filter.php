<?php
session_start();
$filter = $_GET['filter'];

if($filter === "pending")
{
    $_SESSION['showPendingSales'] = true;
    $_SESSION['showCompletedSales'] = false;
    $_SESSION['filterHeading'] = "Pending Sales";
}
elseif ($filter === "completed")
{
    $_SESSION['showCompletedSales'] = true;
    $_SESSION['showPendingSales'] = false;
    $_SESSION['filterHeading'] = "Completed Sales";
}

echo "complete: ". $_SESSION['showCompletedSales'];

header("Location: sales.php");