<?php

session_start();

include("../includes/config.php");


if(!isset($_SESSION['admin_id']))
{
    header("Location: ../login.php");
    exit();
}


// Total students

$students = mysqli_query($conn,
"SELECT * FROM users WHERE role='student'");

$total_students = mysqli_num_rows($students);


// Total courses

$courses = mysqli_query($conn,
"SELECT * FROM courses");

$total_courses = mysqli_num_rows($courses);


// Total enrollments

$enrollments = mysqli_query($conn,
"SELECT * FROM enrollments");

$total_enrollments = mysqli_num_rows($enrollments);

?>


<!DOCTYPE html>
<html>

<head>

<title>Reports</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body>


<div class="container mt-5">


<h2>Admin Reports</h2>


<div class="row mt-4">


<div class="col-md-4">

<div class="card p-3 text-center">

<h4>Total Students</h4>

<h2>
<?php echo $total_students; ?>
</h2>

</div>

</div>



<div class="col-md-4">

<div class="card p-3 text-center">

<h4>Total Courses</h4>

<h2>
<?php echo $total_courses; ?>
</h2>

</div>

</div>



<div class="col-md-4">

<div class="card p-3 text-center">

<h4>Total Enrollments</h4>

<h2>
<?php echo $total_enrollments; ?>
</h2>

</div>

</div>


</div>



<hr>


<h3>Enrollment Report</h3>


<table class="table table-bordered">

<a href="export_report.php" class="btn btn-success mb-3">

Export Report

</a>
<tr>

<th>Student</th>

<th>Email</th>

<th>Course</th>

<th>Date</th>

</tr>



<?php

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


while($row=mysqli_fetch_assoc($result))

{

?>


<tr>

<td>
<?php echo $row['full_name']; ?>
</td>


<td>
<?php echo $row['email']; ?>
</td>


<td>
<?php echo $row['course_name']; ?>
</td>


<td>
<?php echo $row['enrolled_on']; ?>
</td>


</tr>


<?php

}

?>


</table>


</div>


<footer class="bg-dark text-white text-center p-3 mt-5">

<p>
© 2026 E-Learning Portal | All Rights Reserved
</p>

</footer>
</body>

</html>