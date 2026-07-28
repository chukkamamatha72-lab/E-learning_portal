<?php

session_start();

include("includes/config.php");

if(isset($_POST['login']))
{

$email=mysqli_real_escape_string($conn,$_POST['email']);

$password=$_POST['password'];

$sql=mysqli_query($conn,"SELECT * FROM users
WHERE email='$email'");

if(mysqli_num_rows($sql)>0)
{

$user=mysqli_fetch_assoc($sql);

if($user['is_verified']==0)
{

echo "<script>alert('Please verify your email first');</script>";

}
else
{

if(password_verify($password,$user['password']))
{

$_SESSION['student_id']=$user['id'];

$_SESSION['student_name']=$user['full_name'];

header("Location: student/dashboard.php");

exit();

}
else
{

echo "<script>alert('Incorrect Password');</script>";

}

}

}
else
{

echo "<script>alert('Email Not Registered');</script>";

}

}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header text-center">
<h3>Student Login</h3>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Email</label>

<input type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input type="password"
name="password"
class="form-control"
required>

</div>

<button
type="submit"
name="login"
class="btn btn-primary w-100">

Login

</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>