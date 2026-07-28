<?php
session_start();
include("../includes/config.php");

if(isset($_POST['login']))
{
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = $_POST['password'];

    $sql = mysqli_query($conn,"SELECT * FROM users
    WHERE email='$email' AND role='admin'");

    if(mysqli_num_rows($sql)>0)
    {
        $admin = mysqli_fetch_assoc($sql);

        if(password_verify($password,$admin['password']))
        {
            $_SESSION['admin_id']=$admin['id'];
            $_SESSION['admin_name']=$admin['full_name'];

            header("Location: dashboard.php");
            exit();
        }
        else
        {
            echo "<script>alert('Wrong Password');</script>";
        }
    }
    else
    {
        echo "<script>alert('Admin Not Found');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header text-center">
<h3>Admin Login</h3>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" name="login" class="btn btn-primary w-100">
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