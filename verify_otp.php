<?php
session_start();
echo "Session Email: ";
var_dump($_SESSION['email']);
echo "<br>";

include("includes/config.php");

if (!isset($_SESSION['email'])) {
    header("Location: register.php");
    exit();
}

if(isset($_POST['verify']))
{
    $email = $_SESSION['email'];
    $otp = $_POST['otp'];

    $sql = mysqli_query($conn, "SELECT * FROM otp_verification
    WHERE email='$email' AND otp='$otp'");

    if(mysqli_num_rows($sql) > 0)
    {
        $row = mysqli_fetch_assoc($sql);

        if(strtotime($row['expiry']) >= time())
        {
            mysqli_query($conn, "UPDATE users
            SET is_verified=1
            WHERE email='$email'");

            mysqli_query($conn, "DELETE FROM otp_verification
            WHERE email='$email'");

            echo "<script>
            alert('Email Verified Successfully');
            window.location='login.php';
            </script>";
        }
        else
        {
            echo "<script>alert('OTP Expired');</script>";
        }
    }
    else
    {
        echo "<script>alert('Invalid OTP');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h3>Email Verification</h3>
                </div>

                <div class="card-body">
                    <form method="POST">

                        <label>Enter OTP</label>

                        <input type="text"
                               name="otp"
                               class="form-control"
                               maxlength="6"
                               required>

                        <br>

                        <button type="submit"
                                name="verify"
                                class="btn btn-success w-100">
                            Verify OTP
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>