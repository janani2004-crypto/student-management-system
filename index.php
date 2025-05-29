<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Student Management System</title>

    <!-- Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        *{font-family:'Poppins',sans-serif}
        body,html{height:100%;margin:0}
        body{
            background:url('new-zealand-4827784_1280.jpg') no-repeat center/cover fixed;
        }
        .overlay{
            position:fixed;inset:0;background:rgba(0,0,0,.6)
        }
        .content{
            position:relative;z-index:1;top:50%;transform:translateY(-50%);
            color:#fff;text-align:center
        }
        h1{font-size:3.5rem;font-weight:600;margin-bottom:1.5rem}
        .btn{margin:0.4rem 0.6rem;padding:0.75rem 2rem;border-radius:30px;font-size:1.1rem}
    </style>
</head>
<body>
<div class="overlay"></div>

<div class="content">
    <h1>Welcome to the Student Management System</h1>
    <a href="students.php"   class="btn btn-outline-light">Students</a>
    <a href="subjects.php"   class="btn btn-outline-light">Subjects</a>
    <a href="marks.php"      class="btn btn-outline-light">Marks</a>
    <a href="attendance.php" class="btn btn-outline-light">Attendance</a>
    <a href="dashboard.php"  class="btn btn-outline-light">Dashboard</a>

<a href="logout.php" class="btn btn-danger btn-sm float-end">Logout</a>

</div>
</body>
</html>
