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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and execute the SQL statement
    $stmt = pg_prepare($conn, "insert_task", "INSERT INTO tasks (title, description, date, priority, category) VALUES ($1, $2, $3, $4, $5)");

    // Set parameters from the form data
    $title = $_POST['taskTitle'];
    $description = $_POST['taskDescription'];
    $date = $_POST['taskDate'];
    $priority = $_POST['priority'];
    $category = $_POST['category'];

    // Execute the prepared statement
    $result = pg_execute($conn, "insert_task", array($title, $description, $date, $priority, $category));

    if ($result) {
        // Task added successfully, redirect to main.html
        header("Location: main.html");
        exit(); // Ensure script execution stops after redirection
    } else {
        echo "Error adding task: " . pg_last_error($conn);
    }
}
// Close connection
pg_close($conn);
?>
