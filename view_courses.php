<?php
session_start();
include("../includes/config.php");

if(!isset($_SESSION['student_id']))
{
    header("Location: login.php");
    exit();
}

$courses = mysqli_query($conn,"SELECT * FROM courses");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Available Courses</h2>

<table class="table table-bordered">

<tr>
    <th>Course</th>
    <th>Description</th>
    <th>Duration</th>
    <th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($courses)){ ?>

<tr>

<td><?php echo $row['course_name']; ?></td>

<td><?php echo $row['description']; ?></td>

<td><?php echo $row['duration']; ?></td>

<td>

<a href="enroll.php?id=<?php echo $row['id']; ?>" class="btn btn-success">
Enroll
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>