<?php
session_start();
include(__DIR__ . "/../db.php");

$result = mysqli_query($conn, "SELECT * FROM users");

/* SECURITY CHECK */
if(!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

/* SIMPLE STATS */
$users = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$products = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard - TechSphere</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    display: flex;
    background: #f4f6fb;
}

/* SIDEBAR */
.sidebar {
    width: 240px;
    height: 100vh;
    background: linear-gradient(180deg, #111827, #1f2937);
    color: white;
    padding: 20px;
    position: fixed;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #4f46e5;
}

.sidebar a {
    display: block;
    color: #ddd;
    text-decoration: none;
    padding: 12px;
    margin: 6px 0;
    border-radius: 8px;
    transition: 0.3s;
}

.sidebar a:hover {
    background: #4f46e5;
    color: white;
}

/* MAIN */
.main {
    margin-left: 240px;
    padding: 30px;
    width: 100%;
}

/* HEADER */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.header h1 {
    font-size: 26px;
}

.logout {
    background: #ef4444;
    color: white;
    padding: 10px 15px;
    border-radius: 8px;
    text-decoration: none;
}

/* CARDS */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    text-align: center;
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

.card h3 {
    font-size: 16px;
    color: #555;
}

.card h1 {
    margin-top: 10px;
    color: #4f46e5;
}

/* TABLE SECTION */
.section {
    margin-top: 30px;
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.section h2 {
    margin-bottom: 15px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    padding: 12px;
    border-bottom: 1px solid #eee;
    text-align: left;
}

table th {
    background: #f3f4f6;
}
</style>

</head>

<body>
<?php include("includes/admin_navbar.php"); ?>

<!-- MAIN -->
<div class="main">

    <div class="header">
        <h1>Dashboard</h1>

    </div>

    <!-- STATS -->
    <div class="cards">

        <div class="card">
            <h3>Total Users</h3>
            <h1><?= $users ?></h1>
        </div>

        <div class="card">
            <h3>Total Products</h3>
            <h1><?= $products ?></h1>
        </div>

        <div class="card">
            <h3>Orders</h3>
            <h1>0</h1>
        </div>

        <div class="card">
            <h3>Revenue</h3>
            <h1>Rs 0</h1>
        </div>

    </div>

    <!-- USERS TABLE -->
    <div class="section">

        <h2>Recent Users</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>

            <?php
            $result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC LIMIT 5");
            while($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['role'] ?></td>
            </tr>
            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>