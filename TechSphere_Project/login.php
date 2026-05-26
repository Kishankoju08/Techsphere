<?php
session_start();
include "db.php";

$error = "";

if(isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $role = mysqli_real_escape_string($conn, $_POST['role']); // IMPORTANT

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if($user && password_verify($password, $user['password'])) {

        if($user['role'] == $role) {

            $_SESSION['user'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == 'admin') {
                header("Location: admin/admin_dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit();

        } else {
            $error = "Invalid login type selected!";
        }

    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/auth_style.css">
<title>Login - TechSphere</title>

<link rel="stylesheet" href="auth_style.css">

<style>
/* EXTRA LOGIN TYPE STYLE */
.role-box {
    text-align: left;
    margin-top: 8px;
}

.role-box label {
    font-size: 13px;
    color: #444;
    font-weight: 600;
}

.role-box select {
    width: 100%;
    padding: 12px;
    margin-top: 6px;
    border: 1px solid #ddd;
    border-radius: 10px;
    outline: none;
    background: #fff;
    cursor: pointer;
}

.role-box select:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 5px rgba(79,70,229,0.2);
}
</style>

</head>

<body>
    <div id="loader">
    <div class="spinner"></div>
    <h3>Loading TechSphere...</h3>
</div>

<div class="container">

    <!-- LEFT SIDE -->
    <div class="left">
        <div class="logo"><img src="images/logo.png" alt="" width="200px", height="200px"></div>
        <h1>TechSphere</h1>
        <p>Welcome back! Login to continue shopping.</p>
    </div>

    <!-- RIGHT SIDE -->
    <div class="right">

        <div class="card">

            <h2>Login</h2>

            <?php if($error) echo "<div class='error'>$error</div>"; ?>

            <form method="POST">

                <input type="email" name="email" placeholder="Email" required>

                <input type="password" name="password" placeholder="Password" required>

                <!-- LOGIN TYPE -->
                <div class="role-box">
                    <label>Select Login Type</label>
                    <select name="role" required>
                        <option value="">Select Login Type</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button type="submit" name="login">Login</button>

            </form>

            <a href="register.php">Don't have an account? Register</a>

        </div>

    </div>

</div>

</body>
<script>
window.addEventListener("load", function() {
    const loader = document.getElementById("loader");
    loader.style.display = "none";
});
</script>
</html>