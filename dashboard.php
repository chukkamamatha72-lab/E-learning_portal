<?php
session_start();
include("../includes/config.php");

if(!isset($_SESSION['student_id']))
{
    header("Location: ../login.php");
    exit();
}
?>
<?php

$student_id = $_SESSION['student_id'];


// Total Courses

$course_query = "SELECT COUNT(*) AS total FROM courses";

$course_result = mysqli_query($conn,$course_query);

$course_row = mysqli_fetch_assoc($course_result);

$total_courses = $course_row['total'];



// Enrolled Courses

$enroll_query = "SELECT COUNT(*) AS total 
                 FROM enrollments 
                 WHERE student_id='$student_id'";

$enroll_result = mysqli_query($conn,$enroll_query);

$enroll_row = mysqli_fetch_assoc($enroll_result);

$total_enrolled = $enroll_row['total'];



// Completed Courses

$complete_query = "SELECT COUNT(*) AS total 
                   FROM enrollments 
                   WHERE student_id='$student_id'
                   AND status='completed'";

$complete_result = mysqli_query($conn,$complete_query);

$complete_row = mysqli_fetch_assoc($complete_result);

$total_completed = $complete_row['total'];

?>
?>

<!DOCTYPE html>
<html>
<head>

<title>Student Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="d-flex">

<?php include("sidebar.php"); ?>

<div class="container-fluid p-4">

<h2>
Welcome,
<?php echo $_SESSION['student_name']; ?>
</h2>

<p>
Today:
<?php echo date("d-m-Y"); ?>
</p>

<hr>

<div class="row">

<div class="col-md-4">

<div class="card bg-primary text-white">

<div class="card-body">

<h3>
<?php echo $total_courses; ?>
</h3>

<p>Total Courses</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card bg-success text-white">

<div class="card-body">

<h3>
<?php echo $total_enrolled; ?>
</h3>

<p>Enrolled Courses</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card bg-warning text-dark">

<div class="card-body">

<h3>
<?php echo $total_completed; ?>
</h3>

<p>Completed Courses</p>

<a href="view_courses.php" class="btn btn-primary me-2">
View Courses
</a>
<a href="my_courses.php" class="btn btn-success">
My Courses
</a>
<a href="profile.php" class="btn btn-primary">
My Profile
</a>
<a href="change_password.php">Change Password</a>

</div>


</div>

</div>

</div>

</div>

</div>

<footer class="bg-dark text-white text-center p-3 mt-5">

<p>
© 2026 E-Learning Portal | All Rights Reserved
</p>

</footer>
</body>
</html>