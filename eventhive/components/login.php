<?php
// Start the session
session_start();

// Include the database connection
include('../db.php');

// Check if the user is already logged in, redirect to index.php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: ../index.php");
    exit();
}

// Handle the login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a query to check the user's credentials
    $stmt = $mysqli->prepare("SELECT id, username, password, first_name FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if a user with the entered username exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username_db, $password_db, $first_name);
        $stmt->fetch();

        // Verify the entered password with the hashed password in the database
        if (password_verify($password, $password_db)) {
            // Start the session and set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $id; // ✅ This works because $id was fetched with bind_result()



            // Redirect to index.php after successful login
            header("Location: ../index.php");
            exit();
        } else {
            // Invalid password
            $error_message = "Invalid password!";
        }
    } else {
        // Invalid username
        $error_message = "Username not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <h1>Login</h1>

    <!-- Login Form -->
    <form method="POST" action="login.php">
        <label>Username:</label>
        <input type="text" name="username" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Log In</button>
    </form>

    <!-- Display error message if login fails -->
    <?php if (isset($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>
