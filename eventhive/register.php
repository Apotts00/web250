<?php
session_start();
include('config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $mysqli->prepare("INSERT INTO users (username, email, password, first_name, last_name) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $username, $email, $password, $first_name, $last_name);

    if ($stmt->execute()) {
    $_SESSION['loggedin'] = true;
    $_SESSION['user_id'] = $mysqli->insert_id; // Get the new user's ID
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - EventHive</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php include('components/header.php'); ?>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" action="register.php">
    <input type="text" name="first_name" placeholder="First Name" required><br>
    <input type="text" name="last_name" placeholder="Last Name" required><br>
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
</form>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </div>
    <?php include('components/footer.php'); ?>
</body>
</html>
