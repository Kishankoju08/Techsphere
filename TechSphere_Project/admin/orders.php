<?php
include(__DIR__ . "/../db.php");

$result = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Orders</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background:#f4f6f9;
}

.main-content{
    margin-left:220px;
    padding:20px;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

th, td{
    padding:12px;
    text-align:left;
    border-bottom:1px solid #eee;
}

th{
    background:#111827;
    color:white;
}

/* BADGES */
.badge{
    padding:5px 10px;
    border-radius:8px;
    font-size:12px;
    color:white;
}

.cod{
    background:#f59e0b;
}

.online{
    background:#3b82f6;
}

.paid{
    background:#22c55e;
}

.pending{
    background:#ef4444;
}

.processing{
    background:#6366f1;
}
</style>

</head>

<body>

<?php include("includes/admin_navbar.php"); ?>

<div class="main-content">

<h2>📦 Orders</h2>

<table>

<tr>
    <th>ID</th>
    <th>Customer</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Total</th>
    <th>Payment</th>
    <th>Status</th>
    <th>Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['customer_name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td>Rs. <?php echo $row['total_amount']; ?></td>

    <!-- PAYMENT METHOD -->
    <td>
        <span class="badge <?php echo strtolower($row['payment_method']); ?>">
            <?php echo $row['payment_method']; ?>
        </span>
    </td>

    <!-- PAYMENT STATUS -->
    <td>
        <span class="badge <?php echo strtolower($row['payment_status']); ?>">
            <?php echo $row['payment_status']; ?>
        </span>
    </td>

    <td><?php echo $row['created_at']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>