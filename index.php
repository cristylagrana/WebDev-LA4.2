<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Welcome</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>

<?php if (isset($_SESSION['register_success'])): ?>
    <div id="notification" class="success">Registration successful!</div>
    <?php unset($_SESSION['register_success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['login_success'])):
    $user = $_SESSION['user_info'];
?>
    <div id="notification" class="success">
        Login successful!<br>
        First Name: <?php echo htmlspecialchars($user['firstName']); ?><br>
        Last Name: <?php echo htmlspecialchars($user['lastName']); ?><br>
        Course: <?php echo htmlspecialchars($user['course']); ?><br>
        Year Level: <?php echo htmlspecialchars($user['yearLevel']); ?><br>
        Section: <?php echo htmlspecialchars($user['section']); ?>
    </div>
    <?php
    unset($_SESSION['login_success']);
    unset($_SESSION['user_info']);
    ?>
<?php endif; ?>

<div style="max-width: 400px; margin: 30px auto; text-align:center;">
    <a href="register.php">Register</a> | <a href="login.php">Login</a>
</div>

<script>
setTimeout(() => {
    const notif = document.getElementById('notification');
    if (notif) {
        notif.style.display = 'none';
    }
}, 7000);
</script>

</body>
</html>
