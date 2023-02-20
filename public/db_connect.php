<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cct";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Establish a database connection using PDO
$pdo = new PDO('mysql:host='.$servername.';dbname='.$dbname, $username, $password);

?>
