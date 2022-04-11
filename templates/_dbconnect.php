<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "domain_db";
// $database = "dbms_domain";

// $database = "dbms_project";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
