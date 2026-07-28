<?php

include("../includes/config.php");


$id=$_GET['id'];


$query="DELETE FROM courses WHERE id=$id";


mysqli_query($conn,$query);


header("Location: manage_courses.php");


?>