<?php
session_start();
include("../includes/config.php");

if(!isset($_SESSION['student_id']))
{
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$sql = "SELECT courses.id,
               courses.course_name,
               courses.description,
               courses.duration,
               enrollments.enrolled_on,
               enrollments.status
        FROM enrollments
        JOIN courses
        ON enrollments.course_id = courses.id
        WHERE enrollments.student_id='$student_id'";

$result = mysqli_query($conn,$sql);
if(!$result)
{
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
<title>My Courses</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>My Enrolled Courses</h2>

<table class="table table-bordered">

<tr>
<th>Course</th>
<th>Description</th>
<th>Duration</th>
<th>Enrolled On</th>
<th>status</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['course_name']; ?></td>

<td><?php echo $row['description']; ?></td>

<td><?php echo $row['duration']; ?></td>

<td><?php echo $row['enrolled_on']; ?></td>
<td><?php echo $row['status']; ?> </td>
<td>

<a href="complete_course.php?id=<?php echo $row['id']; ?>"
class="btn btn-success">

Complete Course

</a>

</td>
<td>

<a href="course_details.php?id=<?php echo $row['id']; ?>" 
class="btn btn-success">

View Course

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

<footer class="bg-dark text-white text-center p-3 mt-5">

<p>
© 2026 E-Learning Portal | All Rights Reserved
</p>

</footer>
</body>
</html>