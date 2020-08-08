<?php
//Establish connection parameters
$serverName="localhost";
$username="root";
$password="root";
$dbName="trianglebookstore";

//Create database connection
$conn = new mysqli($serverName; $username; $password; $dbName);

//Test database connection
if($conn->connect_error){
    die("Connection error".$conn->connect_error);
}