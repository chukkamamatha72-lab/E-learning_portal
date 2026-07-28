<?php
session_start();
include("../includes/config.php");

if(!isset($_SESSION['student_id']))
{
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];
$course_id = $_GET['id'];

$check = mysqli_query($conn,
"SELECT * FROM enrollments
WHERE student_id='$student_id'
AND course_id='$course_id'");

if(mysqli_num_rows($check)==0)
{
    mysqli_query($conn,
    "INSERT INTO enrollments(student_id,course_id)
    VALUES('$student_id','$course_id')");

    echo "<script>
    alert('Enrollment Successful');
    window.location='courses.php';
    </script>";
}
else
{
    echo "<script>
    alert('You are already enrolled in this course');
    window.location='courses.php';
    </script>";
}
?>