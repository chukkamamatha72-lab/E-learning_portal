<?php
session_start();
include("../includes/config.php");

if(!isset($_SESSION['student_id']))
{
    header("Location: ../login.php");
    exit();
}

$student_id = $_SESSION['student_id'];


// Fetch student details
$sql = "SELECT * FROM users WHERE id='$student_id'";

$result = mysqli_query($conn,$sql);

if(!$result)
{
    die(mysqli_error($conn));
}

$user = mysqli_fetch_assoc($result);

// Update profile
if(isset($_POST['update']))
{
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];

    $update = "UPDATE users 
               SET full_name='$full_name',
                   phone='$phone'
               WHERE id='$student_id'";

    $result2 = mysqli_query($conn,$update);

    if($result2)
    {
        echo "<script>
        alert('Profile Updated Successfully');
        window.location='profile.php';
        </script>";
    }
    else
    {
        echo "Update Failed";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Student Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>My Profile</h2>

<form method="POST">


<div class="mb-3">
<label>Name</label>

<input type="text" 
name="full_name"
class="form-control"
value="<?php echo $user['full_name']; ?>">

</div>


<div class="mb-3">
<label>Email</label>

<input type="email"
class="form-control"
value="<?php echo $user['email']; ?>"
readonly>

</div>


<div class="mb-3">
<label>Phone</label>

<input type="text"
name="phone"
class="form-control"
value="<?php echo $user['phone']; ?>">

</div>


<button type="submit" 
name="update"
class="btn btn-primary">

Update Profile

</button>


</form>

</div>
<footer class="bg-dark text-white text-center p-3 mt-5">

<p>
© 2026 E-Learning Portal | All Rights Reserved
</p>

</footer>
</body>
</html>