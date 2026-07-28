<?php
session_start();
include("../includes/config.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

if(isset($_POST['add_course']))
{
    $course_name = mysqli_real_escape_string($conn,$_POST['course_name']);
    $instructor = mysqli_real_escape_string($conn,$_POST['instructor']);
    $duration = mysqli_real_escape_string($conn,$_POST['duration']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);

    $sql = "INSERT INTO courses(course_name,instructor,duration,description)
            VALUES('$course_name','$instructor','$duration','$description')";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>alert('Course Added Successfully');</script>";
    }
    else
    {
        echo "<script>alert('Failed to Add Course');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="d-flex">

<?php include("sidebar.php"); ?>

<div class="container-fluid p-4">

<h2>Add New Course</h2>

<form method="POST">

<div class="mb-3">
<label>Course Name</label>
<input type="text" name="course_name" class="form-control" required>
</div>

<div class="mb-3">
<label>Instructor</label>
<input type="text" name="instructor" class="form-control" required>
</div>

<div class="mb-3">
<label>Duration</label>
<input type="text" name="duration" class="form-control" placeholder="Example: 8 Weeks" required>
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description" class="form-control" rows="5" required></textarea>
</div>

<button type="submit" name="add_course" class="btn btn-success">
Add Course
</button>

</form>

</div>

</div>

</body>
</html>