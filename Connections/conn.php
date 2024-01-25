<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$hostname_conn = "sql310.infinityfree.com";
$database_conn = "if0_35859875_wisata_jogja";
$username_conn = "if0_35859875";
$password_conn = "y3I3pwNkdy";

// Create connection
$conn = new mysqli($hostname_conn, $username_conn, $password_conn, $database_conn);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Now you can use $conn for your database operations

?>
