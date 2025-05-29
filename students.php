<?php
require_once 'db_connect.php';

$search = $_GET['search'] ?? '';
$result = mysqli_query($conn,
    "SELECT * FROM students WHERE name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'"
);

/* Chart data */
$yearResult = mysqli_query($conn,"SELECT year,COUNT(*) total FROM students GROUP BY year");
$yearData = [];
while($row=mysqli_fetch_assoc($yearResult)){ $yearData[$row['year']]=$row['total']; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Students</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<style>
 * { font-family: 'Poppins', sans-serif; }
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <div class="container-fluid">
  <a class="navbar-brand" href="index.php">Student Manager</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="nav">
   <ul class="navbar-nav ms-auto">
     <li class="nav-item"><a class="nav-link active" href="students.php">Students</a></li>
     <li class="nav-item"><a class="nav-link" href="subjects.php">Subjects</a></li>
     <li class="nav-item"><a class="nav-link" href="marks.php">Marks</a></li>
     <li class="nav-item"><a class="nav-link" href="attendance.php">Attendance</a></li>
     <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
   </ul>
  </div>
 </div>
</nav>

<div class="container mt-5">
  <h2 class="text-center mb-4 text-primary fw-semibold">📋 Student List</h2>

  <!-- Search -->
  <form class="row g-2 justify-content-center mb-4" method="GET">
      <div class="col-md-6">
          <input type="text" name="search" placeholder="Search by name"
                 value="<?=htmlspecialchars($search)?>" class="form-control">
      </div>
      <div class="col-md-auto">
          <button class="btn btn-primary px-4">Search</button>
      </div>
  </form>

  <!-- Add Button -->
  <div class="d-flex justify-content-end mb-3">
      <a href="student_add.php" class="btn btn-success">➕ Add New Student</a>
  </div>

  <!-- Chart -->
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h5 class="card-title text-primary">📊 Student Year Distribution</h5>
      <canvas id="yearChart"></canvas>
    </div>
  </div>

  <!-- Table -->
  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table table-striped m-0 text-center align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Year</th><th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row=mysqli_fetch_assoc($result)):?>
          <tr>
            <td><?=$row['student_id']?></td>
            <td><?=$row['name']?></td>
            <td><?=$row['email']?></td>
            <td><?=$row['course']?></td>
            <td><?=$row['year']?></td>
            <td>
              <a href="student_edit.php?id=<?=$row['student_id']?>" class="btn btn-sm btn-primary">Edit</a>
              <a href="student_delete.php?id=<?=$row['student_id']?>" class="btn btn-sm btn-danger"
                 onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
            </td>
          </tr>
          <?php endwhile;?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
new Chart(document.getElementById('yearChart'),{
  type:'bar',
  data:{
    labels:<?=json_encode(array_keys($yearData))?>,
    datasets:[{label:'Students',data:<?=json_encode(array_values($yearData))?>,
      backgroundColor:'rgba(13,110,253,.6)'}]
  },
  options:{scales:{y:{beginAtZero:true,precision:0}}}
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
