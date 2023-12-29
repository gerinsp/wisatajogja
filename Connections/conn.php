<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$hostname_conn = "sql207.infinityfree.com";
$database_conn = "if0_35686716_wisata_jogja";
$username_conn = "if0_35686716";
$password_conn = "xthtsL4PQOn";

$conn = mysql_pconnect($hostname_conn, $username_conn, $password_conn) or trigger_error(mysql_error(),E_USER_ERROR);

if (!$conn) {
    die("Connection failed: " . mysql_error());
}

mysql_select_db($database_conn, $conn);

?>