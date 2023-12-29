<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard");
    exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="../public/assets/styles/login.css">
    <title>Login Page</title>
</head>
<body>
<div class="login-container">
    <form class="login-form" method="post" action="service/process_login.php">
        <h1>Login</h1>
        <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            if ($error == 'InvalidCredentials') {
                echo '<p class="error-message">Invalid username or password. Please try again.</p>';
            } elseif ($error == 'InvalidRequest') {
                echo '<p class="error-message">Invalid request. Please try again.</p>';
            }
        }
        ?>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
