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

// Fetch tasks from the database
$query = "SELECT title, date FROM tasks";
$result = pg_query($conn, $query);

if (!$result) {
    echo "An error occurred.\n";
    exit;
}

$tasks = [];
while ($row = pg_fetch_assoc($result)) {
    $tasks[] = [
        'title' => $row['title'],
        'start' => $row['date']
    ];
}

// Close connection
pg_close($conn);

// Return tasks as JSON
header('Content-Type: application/json');
echo json_encode($tasks);
?>
