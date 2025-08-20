<?php
session_start();

// Username and password
$USERNAME = 'admin';
$HASHED_PASSWORD = '$2y$10$DzRH46v4Q8zQz7ZD6fOodurDoN/6yPSfSbw9CHLOvFLcG1Babf8Ya';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === $USERNAME && password_verify($_POST['password'], $HASHED_PASSWORD)) {
        $_SESSION['logged_in'] = true;
        header('Location: proxy.php');
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <h2>Login</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <label>Username: <input type="text" name="username" required></label><br><br>
        <label>Password: <input type="password" name="password" required></label><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
