<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="sidebar">
    <h2>TechSphere</h2>
    Welcome, <?php echo $_SESSION['admin_name'] ?? 'Admin'; ?>
    <a href="admin_dashboard.php">🏠 Dashboard</a>
    <a href="products.php">📦 Products</a>
    <a href="add_product.php">➕ Add Product</a>
    <a href="orders.php">📑 Orders</a>
    <a href="../logout.php">🚪 Logout</a>

</div>

<style>
body{
    margin:0;
    font-family: Arial, sans-serif;
}

/* SIDEBAR */
.sidebar{
    position: fixed;
    left:0;
    top:0;
    width:220px;
    height:100vh;
    background:#111827;
    padding-top:20px;
    color:white;
}

/* TITLE */
.sidebar h2{
    text-align:center;
    margin-bottom:30px;
    font-size:22px;
}

/* LINKS */
.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:12px 20px;
    transition:0.3s;
}

.sidebar a:hover{
    background:#374151;
    padding-left:25px;
}
.sidebar {
    width: 220px;
    position: fixed;
    left: 0;
    top: 0;
    height: 100vh;
}

.main-content {
    margin-left: 220px;
}
</style>