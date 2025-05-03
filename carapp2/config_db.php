<?php
// config_db.php

$host = 'sql109.infinityfree.com';
$user = 'if0_38695703';
$password = 'Micaiahg11';
$database = 'if0_38695703_Cars';

$mysqli = new mysqli($host, $user, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}
?>
