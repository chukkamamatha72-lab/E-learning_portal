<?php
include("includes/config.php");
include("send_otp.php");

if(isset($_POST['register']))
{

$fullname=mysqli_real_escape_string($conn,$_POST['fullname']);

$email=mysqli_real_escape_string($conn,$_POST['email']);

$phone=mysqli_real_escape_string($conn,$_POST['phone']);

$password=$_POST['password'];

$confirm_password=$_POST['confirm_password'];

if($password!=$confirm_password)
{

echo "<script>alert('Passwords do not match');</script>";

}
else
{

$check=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check)>0)
{

echo "<script>alert('Email already exists');</script>";

}
else
{

$hashedPassword=password_hash($password,PASSWORD_DEFAULT);

$sql="INSERT INTO users(full_name,email,phone,password)
VALUES('$fullname','$email','$phone','$hashedPassword')";

if(mysqli_query($conn,$sql))
{

$otp=rand(100000,999999);

$expiry=date("Y-m-d H:i:s",strtotime("+10 minutes"));

mysqli_query($conn,"INSERT INTO otp_verification(email,otp,expiry)
VALUES('$email','$otp','$expiry')");

if(sendOTP($email,$otp))
{
    session_start();

    $_SESSION['email'] = $email;

    header("Location: verify_otp.php");
    exit();
}
else
{
    echo "<script>alert('OTP Email Sending Failed');</script>";
}


} 
}
}
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header text-center">
<h3>Student Registration</h3>
</div>

<div class="card-body">

<form action="" method="POST">

<div class="mb-3">
<label>Full Name</label>
<input type="text" name="fullname" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Phone Number</label>
<input type="text" name="phone" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="mb-3">
<label>Confirm Password</label>
<input type="password" name="confirm_password" class="form-control" required>
</div>

<button type="submit" name="register" class="btn btn-primary w-100">
Register
</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>