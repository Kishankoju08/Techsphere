<?php
include "db.php";

$error = "";
$success = "";

if(isset($_POST['register'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if($password != $cpassword) {
        $error = "Passwords do not match!";
    } else {

        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if(mysqli_num_rows($check) > 0) {
            $error = "Email already exists!";
        } else {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            mysqli_query($conn,
                "INSERT INTO users (name, email, password, role)
                 VALUES ('$name', '$email', '$hash', '$role')"
            );

            $success = "Account created successfully!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/auth_style.css">
<title>Register - TechSphere</title>

<style>
<?php include "auth_style.css"; ?>
</style>

</head>
<body>

<div class="container">

    <div class="left">
        <div class="logo"><img src="images/logo.png" alt="" width="200px", height="200px"></div>
        <h1>TechSphere</h1>
        <p>Create account and start exploring tech products.</p>
    </div>

    <div class="right">

        <div class="card">

            <h2>Register</h2>

            <?php if($error) echo "<div class='error'>$error</div>"; ?>
            <?php if($success) echo "<div class='success'>$success</div>"; ?>

            <form method="POST">

                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="cpassword" placeholder="Confirm Password" required>

                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>

                <button type="submit" name="register">Create Account</button>

            </form>

            <a href="login.php">Already have an account? Login</a>

        </div>

    </div>

</div>

</body>
</html>