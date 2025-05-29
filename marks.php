<?php
require_once 'db_connect.php';

/* Insert new marks */
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $sid  = mysqli_real_escape_string($conn,$_POST['student_id']);
    $sub  = mysqli_real_escape_string($conn,$_POST['subject_id']);
    $mark = mysqli_real_escape_string($conn,$_POST['marks_obtained']);

    mysqli_query($conn,
        "INSERT INTO marks(student_id,subject_id,marks_obtained)
         VALUES('$sid','$sub','$mark')"
    );
    header("Location: marks.php"); exit;
}

/* Fetch lists */
$students = mysqli_query($conn,"SELECT student_id,name FROM students");
$subjects = mysqli_query($conn,"SELECT subject_id,subject_name FROM subjects");
$marksRes = mysqli_query($conn,
    "SELECT m.mark_id,s.name student,sub.subject_name subject,m.marks_obtained
     FROM marks m
     JOIN students s ON s.student_id=m.student_id
     JOIN subjects sub ON sub.subject_id=m.subject_id"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Marks</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>*{font-family:'Poppins',sans-serif}</style>
</head>
<body>
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <div class="container-fluid">
  <a class="navbar-brand" href="index.php">Student Manager</a>
  <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
  <div class="collapse navbar-collapse" id="nav">
   <ul class="navbar-nav ms-auto">
     <li class="nav-item"><a class="nav-link" href="students.php">Students</a></li>
     <li class="nav-item"><a class="nav-link" href="subjects.php">Subjects</a></li>
     <li class="nav-item"><a class="nav-link active" href="marks.php">Marks</a></li>
     <li class="nav-item"><a class="nav-link" href="attendance.php">Attendance</a></li>
     <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
   </ul>
  </div>
 </div>
</nav>

<div class="container mt-5">
  <h2 class="text-center text-primary fw-semibold mb-4">📑 Marks Entry</h2>

  <!-- Form -->
  <div class="card shadow-sm mb-4">
   <div class="card-header bg-primary text-white">Add Student Marks</div>
   <div class="card-body">
    <form class="row g-3" method="POST">
      <div class="col-md-4">
        <label class="form-label">Student</label>
        <select name="student_id" class="form-select" required>
          <option value="">-- Select Student --</option>
          <?php while($row=mysqli_fetch_assoc($students))
            echo "<option value='{$row['student_id']}'>{$row['name']}</option>"; ?>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Subject</label>
        <select name="subject_id" class="form-select" required>
          <option value="">-- Select Subject --</option>
          <?php while($row=mysqli_fetch_assoc($subjects))
            echo "<option value='{$row['subject_id']}'>{$row['subject_name']}</option>"; ?>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Marks</label>
        <input type="number" name="marks_obtained" class="form-control" required>
      </div>
      <div class="col-12 text-end">
        <button class="btn btn-success mt-2">Add Marks</button>
      </div>
    </form>
   </div>
  </div>

  <!-- List -->
  <div class="card shadow-sm">
    <div class="card-header bg-success text-white">📋 Marks List</div>
    <div class="card-body p-0">
      <table class="table table-striped table-hover m-0 text-center align-middle">
        <thead class="table-dark"><tr><th>ID</th><th>Student</th><th>Subject</th><th>Marks</th></tr></thead>
        <tbody>
        <?php while($row=mysqli_fetch_assoc($marksRes)):?>
          <tr>
            <td><?=$row['mark_id']?></td>
            <td><?=$row['student']?></td>
            <td><?=$row['subject']?></td>
            <td><?=$row['marks_obtained']?></td>
          </tr>
        <?php endwhile;?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
