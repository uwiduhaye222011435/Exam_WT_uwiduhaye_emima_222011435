<?php
// Connection details
$host = "localhost";
$user = "uwiduhaye";
$pass = "222011435"; // Corrected: Removed space between quotes
$database = "virtual_uxandui_courses_design_platform";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
