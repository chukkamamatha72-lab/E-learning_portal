<?php
session_start();
include("../includes/config.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM courses";
$result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Courses</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2 class="text-center mb-4">
Manage Courses
</h2>


<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Course Name</th>
<th>Description</th>
<th>Duration</th>
<th>Action</th>
</tr>


<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>


<td>
<?php echo $row['course_name']; ?>
</td>


<td>
<?php echo $row['description']; ?>
</td>


<td>
<?php echo $row['duration']; ?>
</td>


<td>

<a href="edit_course.php?id=<?php echo $row['id']; ?>" 
class="btn btn-primary btn-sm">
Edit
</a>


<a href="delete_course.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to delete?')">
Delete
</a>


</td>


</tr>


<?php
}
?>


</table>


</div>

</body>
</html>