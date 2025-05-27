<?php
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $userNameInput = trim(htmlspecialchars($_POST['userName']));
    $passwordInput = trim($_POST['password']);
    $pinCodeInput = trim($_POST['pinCode']);

    if (isset($_SESSION['user']) && $_SESSION['user']['userName'] === $userNameInput) {
        if (password_verify($passwordInput, $_SESSION['user']['password'])) {
            // Password correct, now check pinCode
            if ($_SESSION['user']['pinCode'] === $pinCodeInput) {
                // Login success
                $_SESSION['login_success'] = true;
                $_SESSION['user_info'] = $_SESSION['user'];
                header("Location: index.php");
                exit;
            } else {
                $message = "Incorrect Pin Code. Please try again.";
            }
        } else {
            $message = "Incorrect Username or Password. Please try again.";
        }
    } else {
        $message = "User not found. Please register first.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="container">
    <h3>Login</h3>

    <?php if ($message): ?>
        <div id="notification" class="error"><?php echo $message; ?></div>
    <?php endif; ?>

    <form action="login.php" method="post">
        <input name="userName" required placeholder="Username" />
        <input name="password" type="password" required placeholder="Password" />
        <input name="pinCode" required placeholder="Pin Code" />
        <button type="submit" name="login">Login</button>
    </form>

    <p style="text-align:center; margin-top:15px;">
        Don't have an account? <a href="register.php">Register here</a>
    </p>
</div>
</body>
</html>
