<?php
require_once 'db_connect.php';

/* Insert new attendance */
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $sid = mysqli_real_escape_string($conn,$_POST['student_id']);
    $date= mysqli_real_escape_string($conn,$_POST['date']);
    $sta = mysqli_real_escape_string($conn,$_POST['status']);

    mysqli_query($conn,
        "INSERT INTO attendance(student_id,date,status)
         VALUES('$sid','$date','$sta')"
    );
    header("Location: attendance.php"); exit;
}

/* Lists */
$students = mysqli_query($conn,"SELECT student_id,name FROM students");
$records  = mysqli_query($conn,
   "SELECT a.attendance_id,s.name student,a.date,a.status
    FROM attendance a
    JOIN students s ON s.student_id=a.student_id
    ORDER BY a.date DESC"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Attendance</title>

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
     <li class="nav-item"><a class="nav-link" href="subjects.php">Subjects</a></li>
     <li class="nav-item"><a class="nav-link" href="marks.php">Marks</a></li>
     <li class="nav-item"><a class="nav-link active" href="attendance.php">Attendance</a></li>
     <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
   </ul>
  </div>
 </div>
</nav>

<div class="container mt-5">
  <h2 class="text-center text-warning fw-semibold mb-4">🗓️ Attendance Management</h2>

  <!-- Form -->
  <div class="card shadow-sm mb-4">
   <div class="card-header bg-warning text-dark">Mark Attendance</div>
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
         <label class="form-label">Date</label>
         <input type="date" name="date" class="form-control" required>
       </div>
       <div class="col-md-4">
         <label class="form-label">Status</label>
         <select name="status" class="form-select" required>
           <option value="Present">Present</option>
           <option value="Absent">Absent</option>
         </select>
       </div>
       <div class="col-12 text-end">
         <button class="btn btn-warning text-white mt-2">Mark</button>
       </div>
     </form>
   </div>
  </div>

  <!-- Table -->
  <div class="card shadow-sm">
   <div class="card-header bg-dark text-white">📋 Attendance Records</div>
   <div class="card-body p-0">
     <table class="table table-striped table-hover m-0 text-center align-middle">
       <thead class="table-dark"><tr><th>ID</th><th>Student</th><th>Date</th><th>Status</th></tr></thead>
       <tbody>
         <?php while($row=mysqli_fetch_assoc($records)):?>
          <tr>
            <td><?=$row['attendance_id']?></td>
            <td><?=$row['student']?></td>
            <td><?=$row['date']?></td>
            <td><?=$row['status']?></td>
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
