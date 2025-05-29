<?php
require_once 'db_connect.php';

/* insert */
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name = mysqli_real_escape_string($conn,$_POST['subject_name']);
  $course = mysqli_real_escape_string($conn,$_POST['course']);
  mysqli_query($conn,
    "INSERT INTO subjects(subject_name,course) VALUES('$name','$course')"
  );
  header("Location: subjects.php"); exit;
}
$subs = mysqli_query($conn,"SELECT * FROM subjects");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Subjects</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>*{font-family:'Poppins',sans-serif}</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <div class="container-fluid">
  <a class="navbar-brand" href="index.php">Student Manager</a>
  <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
  <div class="collapse navbar-collapse" id="nav">
   <ul class="navbar-nav ms-auto">
     <li class="nav-item"><a class="nav-link" href="students.php">Students</a></li>
     <li class="nav-item"><a class="nav-link active" href="subjects.php">Subjects</a></li>
     <li class="nav-item"><a class="nav-link" href="marks.php">Marks</a></li>
     <li class="nav-item"><a class="nav-link" href="attendance.php">Attendance</a></li>
     <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
   </ul>
  </div>
 </div>
</nav>

<div class="container mt-5">
  <h2 class="text-center text-success fw-semibold mb-4">📚 Subjects</h2>

  <!-- add subject -->
  <div class="card shadow-sm mb-4">
   <div class="card-header bg-success text-white">Add Subject</div>
   <div class="card-body">
     <form class="row g-3" method="POST">
       <div class="col-md-6">
         <label class="form-label">Subject Name</label>
         <input type="text" name="subject_name" class="form-control" required>
       </div>
       <div class="col-md-4">
         <label class="form-label">Course</label>
         <input type="text" name="course" class="form-control" required>
       </div>
       <div class="col-md-2 d-flex align-items-end">
         <button class="btn btn-success w-100">Add</button>
       </div>
     </form>
   </div>
  </div>

  <!-- list -->
  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">📋 Subject List</div>
    <div class="card-body p-0">
      <table class="table table-striped table-hover m-0 text-center align-middle">
        <thead class="table-dark"><tr><th>ID</th><th>Name</th><th>Course</th></tr></thead>
        <tbody>
          <?php while($row=mysqli_fetch_assoc($subs)):?>
          <tr>
            <td><?=$row['subject_id']?></td>
            <td><?=$row['subject_name']?></td>
            <td><?=$row['course']?></td>
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
