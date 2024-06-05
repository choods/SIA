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

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters
    $stmt = pg_prepare($conn, "update_task", "UPDATE tasks SET title = $1, description = $2, date = $3, priority = $4, category = $5 WHERE id = $6");
    
    // Get form data
    $taskId = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $priority = $_POST['priority'];
    $category = $_POST['category'];

    // Execute the prepared statement
    $result = pg_execute($conn, "update_task", array($title, $description, $date, $priority, $category, $taskId));

    if ($result) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "error" => pg_last_error($conn)));
    }
}

// Close connection
pg_close($conn);
?>
