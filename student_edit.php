<?php
require_once 'db_connect.php';

if (!isset($_GET['id'])) {
    echo "No student ID provided.";
    exit;
}

$id = (int)$_GET['id'];

// If form submitted, update record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name   = mysqli_real_escape_string($conn, $_POST['name']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $year   = (int)$_POST['year'];

    $query = "UPDATE students SET name='$name', email='$email', course='$course', year=$year 
              WHERE student_id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: students.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Get current student info
$result = mysqli_query($conn, "SELECT * FROM students WHERE student_id = $id");
$student = mysqli_fetch_assoc($result);
if (!$student) {
    echo "Student not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> * { font-family: 'Poppins', sans-serif; } </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <div class="container-fluid">
  <a class="navbar-brand" href="index.php">Student Manager</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="nav">
   <ul class="navbar-nav ms-auto">
     <li class="nav-item"><a class="nav-link" href="students.php">Students</a></li>
     <li class="nav-item"><a class="nav-link" href="subjects.php">Subjects</a></li>
     <li class="nav-item"><a class="nav-link" href="marks.php">Marks</a></li>
     <li class="nav-item"><a class="nav-link" href="attendance.php">Attendance</a></li>
     <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
   </ul>
  </div>
 </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center text-primary fw-semibold mb-4">✏️ Edit Student</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($student['name']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($student['email']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Course</label>
                    <input type="text" name="course" class="form-control" value="<?= htmlspecialchars($student['course']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Year</label>
                    <input type="number" name="year" class="form-control" value="<?= $student['year'] ?>" required>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Update Student</button>
                    <a href="students.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
