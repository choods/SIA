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

// Check if the task ID is provided in the query string
if (isset($_GET['id'])) {
    $taskId = $_GET['id'];

    // Prepare SQL statement to delete task with the provided ID
    $sql = 'DELETE FROM tasks WHERE id = $1';
    $result = pg_query_params($conn, $sql, array($taskId));

    // Check if the deletion was successful
    if ($result) {
        // Check if any rows were affected (i.e., if the task was deleted)
        if (pg_affected_rows($result) > 0) {
            // Task deleted successfully
            http_response_code(204); // No content
        } else {
            // Task not found
            http_response_code(404); // Not found
            echo json_encode(array('message' => 'Task not found.'));
        }
    } else {
        // Error occurred while executing the statement
        http_response_code(500); // Internal server error
        echo json_encode(array('message' => 'Unable to delete task. ' . pg_last_error($conn)));
    }
} else {
    // Task ID not provided
    http_response_code(400); // Bad request
    echo json_encode(array('message' => 'Task ID is required.'));
}

// Close the database connection
pg_close($conn);
?>
