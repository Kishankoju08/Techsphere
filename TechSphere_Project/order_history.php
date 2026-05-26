<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "db.php";

/* protect page */
if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Orders - TechSphere</title>

<style>
body{
    margin:0;
    font-family:Segoe UI;
    background:#f4f6fb;
}

/* MAIN */
.main{
    margin-left:230px;
    padding:30px;
}

/* TITLE */
h1{
    margin-bottom:20px;
    color:#111827;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

th, td{
    padding:14px;
    text-align:left;
    border-bottom:1px solid #eee;
    font-size:14px;
}

th{
    background:#2563eb;
    color:white;
}

/* BADGES */
.badge{
    padding:5px 10px;
    border-radius:8px;
    font-size:12px;
    color:white;
}

.success{
    background:#16a34a;
}

.pending{
    background:#f59e0b;
}

.failed{
    background:#dc2626;
}

/* PAYMENT TYPE */
.online{
    color:#2563eb;
    font-weight:bold;
}

.cod{
    color:#111827;
    font-weight:bold;
}

/* MOBILE */
@media(max-width:768px){
    .main{
        margin-left:0;
        padding:15px;
    }

    table{
        font-size:12px;
    }
}
</style>

</head>

<body>

<?php include "includes/sidebar.php"; ?>

<div class="main">

<h1>📦 My Orders</h1>

<table>

<tr>
    <th>Order ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Total</th>
    <th>Payment</th>
    <th>Status</th>
    <th>Transaction ID</th>
    <th>Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>

    <td>#<?php echo $row['id']; ?></td>

    <td><?php echo $row['customer_name']; ?></td>

    <td><?php echo $row['phone']; ?></td>

    <td>Rs <?php echo $row['total']; ?></td>

    <td>
        <?php echo $row['payment_method']; ?>
    </td>

    <td>
        <?php if($row['payment'] == "Success") { ?>
            <span class="badge success">Success</span>
        <?php } elseif($row['payment'] == "Pending") { ?>
            <span class="badge pending">Pending</span>
        <?php } else { ?>
            <span class="badge failed">Failed</span>
        <?php } ?>
    </td>

    <td>
        <?php echo $row['transaction_id'] ? $row['transaction_id'] : '-'; ?>
    </td>

    <td>
        <?php echo $row['order_date']; ?>
    </td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>