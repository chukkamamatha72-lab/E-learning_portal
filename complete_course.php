<?php

session_start();

include("../includes/config.php");


if(!isset($_SESSION['student_id']))
{
    header("Location: ../login.php");
    exit();
}


$student_id = $_SESSION['student_id'];

$course_id = $_GET['id'];



$sql = "UPDATE enrollments
        SET status='completed'
        WHERE student_id='$student_id'
        AND course_id='$course_id'";


$result = mysqli_query($conn,$sql);



if($result)
{
    echo "<script>
    alert('Course Completed Successfully');
    window.location='my_courses.php';
    </script>";
}

else
{
    echo "Failed to update course";
}

?>