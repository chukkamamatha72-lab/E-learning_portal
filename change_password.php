<?php
session_start();
include("../includes/config.php");


if(!isset($_SESSION['student_id']))
{
    header("Location: ../login.php");
    exit();
}


$student_id = $_SESSION['student_id'];


if(isset($_POST['change']))
{

    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];


    // Get current password
    $sql = "SELECT password FROM users WHERE id='$student_id'";

    $result = mysqli_query($conn,$sql);

    $user = mysqli_fetch_assoc($result);


    // Check old password
    if(password_verify($old_password,$user['password']))
    {

        if($new_password == $confirm_password)
        {

            $hashed_password = password_hash($new_password,PASSWORD_DEFAULT);


            $update = "UPDATE users 
                       SET password='$hashed_password'
                       WHERE id='$student_id'";


            if(mysqli_query($conn,$update))
            {
                echo "<script>
                alert('Password Changed Successfully');
                window.location='dashboard.php';
                </script>";
            }

        }
        else
        {
            echo "<script>
            alert('New Password and Confirm Password do not match');
            </script>";
        }

    }
    else
    {
        echo "<script>
        alert('Old Password is Incorrect');
        </script>";
    }

}

?>


<!DOCTYPE html>
<html>

<head>

<title>Change Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body>


<div class="container mt-5">

<h2>Change Password</h2>


<form method="POST">


<div class="mb-3">

<label>Old Password</label>

<input type="password"
name="old_password"
class="form-control"
required>

</div>


<div class="mb-3">

<label>New Password</label>

<input type="password"
name="new_password"
class="form-control"
required>

</div>


<div class="mb-3">

<label>Confirm New Password</label>

<input type="password"
name="confirm_password"
class="form-control"
required>

</div>


<button type="submit"
name="change"
class="btn btn-primary">

Change Password

</button>


</form>


</div>


</body>

</html>