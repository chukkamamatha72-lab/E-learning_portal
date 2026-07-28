<?php
session_start();
include("../includes/config.php");


if(!isset($_SESSION['student_id']))
{
    header("Location: ../login.php");
    exit();
}


$course_id = $_GET['id'];

$sql = "SELECT * FROM courses WHERE id='$course_id'";

$result = mysqli_query($conn,$sql);

$course = mysqli_fetch_assoc($result);


?>


<!DOCTYPE html>
<html>

<head>

<title>Course Details</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body>


<div class="container mt-5">


<h2>
<?php echo $course['course_name']; ?>
</h2>


<div class="card p-4">


<h4>Description</h4>

<p>
<?php echo $course['description']; ?>
</p>


<h5>
Duration:
</h5>

<p>
<?php echo $course['duration']; ?>
</p>


<h5>
Instructor:
</h5>

<p>
<?php echo $course['instructor']; ?>
</p>


<?php
if(!empty($course['image']))
{
?>

<img src="../uploads/<?php echo $course['image']; ?>"
width="300"
height="200">

<?php
}
?>


<br><br>


<a href="my_courses.php" class="btn btn-primary">
Back to My Courses
</a>


</div>


</div>


</body>

</html>