<?php
require_once 'db_connect.php';

/* Totals */
$total = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM students")
)['total'] ?? 0;

/* By course */
$courses=[];$courseCounts=[];
$crs = mysqli_query($conn,"SELECT course,COUNT(*) cnt FROM students GROUP BY course");
while($row=mysqli_fetch_assoc($crs)){ $courses[]=$row['course']; $courseCounts[]=$row['cnt']; }

/* By year */
$years=[];$yearCounts=[];
$yrs = mysqli_query($conn,"SELECT year,COUNT(*) cnt FROM students GROUP BY year");
while($row=mysqli_fetch_assoc($yrs)){ $years[]="Year ".$row['year']; $yearCounts[]=$row['cnt']; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
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
     <li class="nav-item"><a class="nav-link" href="attendance.php">Attendance</a></li>
     <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
   </ul>
  </div>
 </div>
</nav>

<div class="container mt-5">
  <h2 class="text-center text-primary fw-semibold mb-4">📊 Student Dashboard</h2>

  <div class="row g-4">
    <div class="col-12">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <h5>Total Students</h5>
          <h2 class="fw-bold"><?=$total?></h2>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Students by Course</h5>
          <canvas id="courseChart"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Students by Year</h5>
          <canvas id="yearChart"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
new Chart(document.getElementById('courseChart'),{
  type:'pie',
  data:{labels:<?=json_encode($courses)?>,
        datasets:[{data:<?=json_encode($courseCounts)?>}]}
});
new Chart(document.getElementById('yearChart'),{
  type:'bar',
  data:{labels:<?=json_encode($years)?>,
        datasets:[{data:<?=json_encode($yearCounts)?>,
                   backgroundColor:'rgba(23,162,184,.7)'}]},
  options:{scales:{y:{beginAtZero:true,ticks:{stepSize:1}}}}
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
