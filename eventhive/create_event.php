<?php
session_start();
include('config/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['event_name'];
    $date = $_POST['event_date'];
    $time = $_POST['event_time'];
    $location = $_POST['event_location'];
    $description = $_POST['event_description'];
    $user_id = $_SESSION['user_id'];

    $stmt = $mysqli->prepare("INSERT INTO events (event_name, event_date, event_time, event_location, event_description, user_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $name, $date, $time, $location, $description, $user_id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>

<!-- HTML form -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Event</title>
    <link rel="stylesheet" href="styles/styles.css"> <!-- optional CSS -->
</head>
<body>
    <header>
        <h1>Create a New Event</h1>
    </header>
    <main>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="create_event.php">
            <label for="event_name">Event Name:</label>
            <input type="text" name="event_name" required><br>

            <label for="event_date">Event Date:</label>
            <input type="date" name="event_date" required><br>

            <label for="event_time">Event Time:</label>
            <input type="time" name="event_time" required><br>

            <label for="event_location">Event Location:</label>
            <input type="text" name="event_location" required><br>

            <label for="event_description">Event Description:</label>
            <textarea name="event_description" rows="4" required></textarea><br>

            <button type="submit">Create Event</button>
            <a href="dashboard.php" style="margin-left: 10px;">
        <button type="button">Cancel</button>
    </a>
        </form>
    </main>
</body>
</html>
