<?php
session_start();
include('config/db.php');

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if event ID is passed
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$event_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch event details
$stmt = $mysqli->prepare("SELECT * FROM events WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $event_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "Event not found or access denied.";
    exit();
}

$event = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $event_location = $_POST['event_location'];
    $event_description = $_POST['event_description'];

    $update = $mysqli->prepare("UPDATE events SET event_name = ?, event_date = ?, event_time = ?, event_location = ?, event_description = ? WHERE id = ? AND user_id = ?");
    $update->bind_param("sssssii", $event_name, $event_date, $event_time, $event_location, $event_description, $event_id, $user_id);

    if ($update->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Error updating event: " . $update->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Event - EventHive</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<?php include('components/header.php'); ?>

<div class="container">
    <h2>Edit Event</h2>
    <link rel="stylesheet" href="styles/styles.css">
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="event_name" value="<?php echo htmlspecialchars($event['event_name']); ?>" required><br>
        <input type="date" name="event_date" value="<?php echo $event['event_date']; ?>" required><br>
        <input type="time" name="event_time" value="<?php echo $event['event_time']; ?>" required><br>
        <input type="text" name="event_location" value="<?php echo htmlspecialchars($event['event_location']); ?>" required><br>
        <textarea name="event_description" rows="4" required><?php echo htmlspecialchars($event['event_description']); ?></textarea><br>
        <button type="submit">Update Event</button>
    </form>
</div>

<?php include('components/footer.php'); ?>
</body>
</html>
