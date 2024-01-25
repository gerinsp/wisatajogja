<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$hostname_conn = "sql310.infinityfree.com";
$database_conn = "if0_35859875_wisata_jogja";
$username_conn = "if0_35859875";
$password_conn = "y3I3pwNkdy";

$conn = mysql_pconnect($hostname_conn, $username_conn, $password_conn) or trigger_error(mysql_error(),E_USER_ERROR);

if (!$conn) {
    die("Connection failed: " . mysql_error());
}

mysql_select_db($database_conn, $conn);

?>