<?php

require_once '../../Connections/conn.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa keberadaan pengguna
    $query = "SELECT * FROM users WHERE username='" . mysql_real_escape_string($username) . "'";
    $result = mysql_query($query);

    if (!$result) {
        die("Query failed: " . mysql_error());
    }

    if (mysql_num_rows($result) > 0) {
        $user = mysql_fetch_assoc($result);
        $hashedPassword = $user['password'];
        if (crypt($password, $hashedPassword) === $hashedPassword) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: ../dashboard");
            exit();
        } else {
            header("Location: ../login?error=InvalidCredentials");
            exit();
        }
    } else {
        header("Location: ../login?error=InvalidCredentials");
        exit();
    }
} else {
    header("Location: ../login?error=InvalidRequest");
    exit();
}

mysql_close($conn);
?>
