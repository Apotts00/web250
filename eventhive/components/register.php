<?php
// Start the session
session_start();

// Include the database connection
include('../db.php');

// Handle the registration form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash the password for security
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Check if the username already exists
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error_message = "Error: The username already exists. Please choose a different username.";
    } else {
        // Insert user data into the users table
        $stmt = $mysqli->prepare("INSERT INTO users (username, password, email, first_name, last_name) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $password, $email, $first_name, $last_name);

        if ($stmt->execute()) {
            // Log the user in immediately after registration
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['first_name'] = $first_name;

            // Redirect to index.php after successful registration and login
            header("Location: ../index.php");
            exit();
        } else {
            $error_message = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <h1>User Registration</h1>

    <!-- Registration Form -->
    <form method="POST" action="register.php">
        <label>Username:</label>
        <input type="text" name="username" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>First Name:</label>
        <input type="text" name="first_name"><br>

        <label>Last Name:</label>
        <input type="text" name="last_name"><br>

        <button type="submit">Register</button>
    </form>

    <!-- Display error message if registration fails -->
    <?php if (isset($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>

    <p>Already have an account? <a href="login.php">Log in here</a></p>
</body>
</html>
