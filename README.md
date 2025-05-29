# 🎓 Student Management System (PHP + MySQL)

A complete full-stack **Student Management System** built using **PHP**, **MySQL**, **HTML/CSS**, **Bootstrap**, **Chart.js**, and **DataTables**. This project allows for efficient management of student records including **student profiles**, **subjects**, **marks**, and **attendance tracking** with visual data insights and full CRUD functionality.

## 📌 Features

- 👤 Add, View, Edit, Delete Student Records
- 📚 Add and Manage Subjects
- 📝 Enter and View Marks for Each Subject
- 📆 Record and Track Attendance
- 📊 Bar Graph of Student Year Distribution using Chart.js
- 🔎 Searchable and Sortable Tables using DataTables
- 🔐 Admin Login System with Logout Functionality
- 📁 Modular File Structure & Clean UI with Bootstrap
- 🌐 Fully Ready for Hosting or Resume Showcase

## 💻 Tech Stack

| Layer       | Tools Used                         |
|-------------|----------------------------------|
| Frontend    | HTML, CSS, Bootstrap, JavaScript |
| Backend     | PHP (Procedural)                  |
| Database    | MySQL via phpMyAdmin              |
| UI Add-ons  | DataTables, Chart.js              |
| Local Server| XAMPP (Apache + MySQL)            |

## 🗃️ Database Schema

### `students` Table

sql
CREATE TABLE students (
  student_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100),
  email VARCHAR(100),
  course VARCHAR(50),
  year INT
);

subjects Table
CREATE TABLE subjects (
  subject_id INT PRIMARY KEY AUTO_INCREMENT,
  subject_name VARCHAR(100),
  course VARCHAR(50)
);

marks Table
CREATE TABLE marks (
  mark_id INT PRIMARY KEY AUTO_INCREMENT,
  student_id INT,
  subject_id INT,
  marks_obtained INT
);

attendance Table
CREATE TABLE attendance (
  attendance_id INT PRIMARY KEY AUTO_INCREMENT,
  student_id INT,
  date DATE,
  status ENUM('Present', 'Absent')
);

📂 Project Structure
student-management/
│
├── index.php              
├── students.php           
├── student_add.php        
├── student_edit.php       
├── student_delete.php     
│
├── subjects.php           
├── marks.php              
├── attendance.php         
│
├── login.php              
├── logout.php             
├── dashboard.php          
│
├── db_connect.php         
├── style.css              
└── new-zealand-*.jpg      

🧪 How to Run Locally (XAMPP)
1. Clone this repo or download ZIP

2. Move folder into:
C:/xampp/htdocs/student-management/

3. Start Apache and MySQL via XAMPP

4. Import student_management.sql into phpMyAdmin

5. Open in browser:
http://localhost/student-management/

📄 Author
Janani S – BCA Student
GitHub: @janani2004-crypto

📜 License
This project is open source and available under the MIT License.
