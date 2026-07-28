<?php

include("../includes/config.php");


$id=$_GET['id'];


$query="SELECT * FROM courses WHERE id=$id";

$result=mysqli_query($conn,$query);

$row=mysqli_fetch_assoc($result);



if(isset($_POST['update']))
{

$name=$_POST['course_name'];
$desc=$_POST['description'];
$duration=$_POST['duration'];


$sql="UPDATE courses SET 
course_name='$name',
description='$desc',
duration='$duration'
WHERE id=$id";


mysqli_query($conn,$sql);


header("Location: manage_courses.php");

}

?>


<!DOCTYPE html>

<html>

<head>

<title>Edit Course</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body>


<div class="container mt-5">


<h2>Edit Course</h2>


<form method="POST">


<input type="text" 
name="course_name"
class="form-control mb-3"
value="<?php echo $row['course_name']; ?>">



<textarea name="description"
class="form-control mb-3">

<?php echo $row['description']; ?>

</textarea>



<input type="text"
name="duration"
class="form-control mb-3"
value="<?php echo $row['duration']; ?>">



<button name="update"
class="btn btn-success">

Update Course

</button>


</form>


</div>


</body>

</html>