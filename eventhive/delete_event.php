<?php
session_start();
include('config/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$event_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

// Make sure the event belongs to the user
$stmt = $mysqli->prepare("DELETE FROM events WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $event_id, $user_id);
$stmt->execute();

header("Location: dashboard.php?msg=deleted");
exit();
?>
