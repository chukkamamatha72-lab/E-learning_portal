<?php

session_start();

include("../includes/config.php");


if(!isset($_SESSION['admin_id']))
{
    header("Location: ../login.php");
    exit();
}


// CSV file name

$filename = "enrollment_report.csv";


header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=$filename");


// Open output

$output = fopen("php://output","w");


// CSV headings

fputcsv($output, array(
    "Student Name",
    "Email",
    "Course Name",
    "Enrolled Date"
));



// Fetch enrollment details

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

    fputcsv($output,array(

        $row['full_name'],
        $row['email'],
        $row['course_name'],
        $row['enrolled_on']

    ));

}


fclose($output);

exit();

?>