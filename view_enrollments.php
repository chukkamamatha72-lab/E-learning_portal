<?php
session_start();
include("../includes/config.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

$sql = "SELECT
users.full_name,
users.email,
courses.course_name,
enrollments.enrolled_on

FROM enrollments

JOIN users
ON enrollments.student_id = users.id

JOIN courses
ON enrollments.course_id = courses.id";

$result = mysqli_query($conn,$sql);
if(!$result)
{
    die("SQL Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>

<html>

<head>

<title>Student Enrollments</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">Student Enrollments</h2>

<table class="table table-bordered table-striped">

<tr>

<th>Student Name</th>

<th>Email</th>

<th>Course</th>

<th>Enrolled On</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['course_name']; ?></td>

<td><?php echo $row['enrolled_on']; ?></td>

</tr>

<?php
}
?>

</table>

</div>

</body>

</html>