<?php
// Start the session
session_start();

// Include the database connection file
include('config/db.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input and sanitize it
    $username = $_POST['username'] ?? '';  // Use the null coalescing operator to avoid warnings
    $password = $_POST['password'] ?? '';  // Default to an empty string if the value isn't set

    // Simple validation (you can improve this)
    if (!empty($username) && !empty($password)) {
        // Prepare the SQL query to check if the username exists
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Check if user exists and verify the password
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // If the password matches, set session variables and redirect
            if (password_verify($password, $user['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['user_id'] = $user['id']; 

                
                header("Location: index.php");
                exit();
            } else {
                $error_message = "Invalid username or password!";
            }
        } else {
            $error_message = "Invalid username or password!";
        }
    } else {
        $error_message = "Please fill in both fields.";
    }
}

// Logout logic
if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - EventHive</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <main>
        <h1>🎉 Welcome to EventHive 🎉</h1>
        <?php
// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    echo '<p>Welcome, ' . htmlspecialchars($_SESSION['first_name']) . '!</p>';
    echo '<p><a href="create_event.php">Create a New Event</a></p>';  // Link to create event
    echo '<p><a href="dashboard.php" class="btn btn-primary">View Dashboard</a></p>';  

    // Fetch events for the logged-in user
    $user_id = $_SESSION['user_id']; // Get user ID from session
    $stmt = $mysqli->prepare("SELECT * FROM events WHERE user_id = ? ORDER BY event_date ASC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $events_result = $stmt->get_result();
}
?>

        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?= htmlspecialchars($error_message) ?></p>
        <?php endif; ?>

        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
            <p><a href="index.php?logout=true">Log Out</a></p>

   <?php if (isset($events_result) && $events_result->num_rows > 0): ?>
    <h3>Your Upcoming Events:</h3>
    <table border="1" cellpadding="10" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Event Date</th>
                <th>Event Time</th>
                <th>Event Location</th>
                <th>Event Description</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($event = $events_result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($event['event_name']) ?></td>
                    <td><?= date("m/d/Y", strtotime($event['event_date'])) ?></td>
                    <td><?= date("g:i A", strtotime($event['event_time'])) ?></td>
                    <td><?= htmlspecialchars($event['event_location']) ?></td>
                    <td><?= htmlspecialchars($event['event_description']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>You have no upcoming events.</p>
<?php endif; ?>


        <?php else: ?>
            <h2>Login</h2>
            <form method="post" action="index.php">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Log In">
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        <?php endif; ?>
    </main>
</body>
</html>
