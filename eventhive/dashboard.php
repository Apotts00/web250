<?php
session_start();
include('config/db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user's events
$stmt = $mysqli->prepare("SELECT * FROM events WHERE user_id = ? ORDER BY event_date ASC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Events - EventHive</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<?php include('components/header.php'); ?>

<div class="container mt-5">
    <h2 class="mb-4">My Events</h2>
    <a href="create_event.php" class="btn btn-primary mb-3">+ Create New Event</a>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($event = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($event['event_name']) ?></td>
                    <td><?= date("m/d/Y", strtotime($event['event_date'])) ?></td>
                    <td><?= date("g:i A", strtotime($event['event_time'])) ?></td>
                    <td><?= htmlspecialchars($event['event_location']) ?></td>
                    <td><?= htmlspecialchars($event['event_description']) ?></td>
                    <td>
                        <a href="edit_event.php?id=<?= $event['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete_event.php?id=<?= $event['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this event?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No events created yet.</p>
    <?php endif; ?>
</div>

<?php include('components/footer.php'); ?>
</body>
</html>
