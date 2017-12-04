<?php
session_start();
 
$dbHost     = 'localhost';
$dbUsername = 'c2375a08';
$dbPassword = 'c2375aU!';
$dbName     = 'c2375a08test';

//Create connection and select DB
@$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}
?>