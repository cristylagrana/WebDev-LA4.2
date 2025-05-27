<?php
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Collect and sanitize inputs
    $firstName = trim(htmlspecialchars($_POST['firstName']));
    $lastName = trim(htmlspecialchars($_POST['lastName']));
    $course = trim(htmlspecialchars($_POST['course']));
    $yearLevel = trim(htmlspecialchars($_POST['yearLevel']));
    $section = trim(htmlspecialchars($_POST['section']));
    $userName = trim(htmlspecialchars($_POST['userName']));
    $password = $_POST['password']; // Password will be hashed
    $pinCode = trim($_POST['pinCode']);

    // Validate pin code length
    if (strlen($pinCode) > 8) {
        $message = "Pin Code must be a maximum of 8 characters.";
    }
    // Check if username already exists in session
    else if (isset($_SESSION['user']) && $_SESSION['user']['userName'] === $userName) {
        $message = "Username already registered. Please choose a different username.";
    }
    else {
        // Store user info in session
        $_SESSION['user'] = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'course' => $course,
            'yearLevel' => $yearLevel,
            'section' => $section,
            'userName' => $userName,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'pinCode' => $pinCode
        ];

        // Success message
        $message = "Registration successful!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="container">
        <h3>Register</h3>
        <form action="register.php" method="post">
            <input name="firstName" required placeholder="First Name" />
            <input name="lastName" required placeholder="Last Name" />
            <input name="course" required placeholder="Course" />
            <input name="yearLevel" required placeholder="Year Level" />
            <input name="section" required placeholder="Section" />
            <input name="userName" required placeholder="Username" />
            <input name="password" type="password" required placeholder="Password" />
            <input name="pinCode" required maxlength="8" placeholder="Pin Code (max 8)" />
            <button type="submit" name="register">Register</button>
        </form>
        <?php if($message): ?>
            <p class="notification"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
