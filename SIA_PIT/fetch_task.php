<?php
session_start();

$host = "localhost";
$port = "5432";
$dbname = "task_management";
$user = "postgres";
$password = "143546";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Fetch tasks from database
$sql = "SELECT * FROM tasks";
$result = pg_query($conn, $sql);

// Store fetched tasks in an array
$tasks = array();
while ($row = pg_fetch_assoc($result)) {
    $tasks[] = $row;
}

// Close connection
pg_close($conn);

// Return tasks as JSON
echo json_encode($tasks);
?>
