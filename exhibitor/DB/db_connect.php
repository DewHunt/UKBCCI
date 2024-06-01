<?php
$servername = "sdb-54.hosting.stackcp.net";
$username   = "ukbcci_db-353030368eb3";
$password   = "sg1px35hmn";
$dbname     = "ukbcci_db-353030368eb3";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>