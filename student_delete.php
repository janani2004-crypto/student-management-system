<?php
require_once 'db_connect.php';

if (!isset($_GET['id'])) {
    echo "No student ID provided.";
    exit;
}

$id = (int)$_GET['id'];

// Delete student
$query = "DELETE FROM students WHERE student_id = $id";
if (mysqli_query($conn, $query)) {
    header("Location: students.php");
    exit;
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>
