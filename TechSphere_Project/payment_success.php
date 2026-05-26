<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include __DIR__ . "/db.php";

$total = $_POST['total'];

$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$payment_method = "Online Payment";
$payment_status = "Paid";

$transaction_id = $_POST['transaction_id'];
$account_number = $_POST['account_number'];

/* -----------------------
   SAVE ORDER
------------------------*/

$sql = "INSERT INTO orders
(customer_name, phone, address, total,
payment_method, payment_status, transaction_id, account_number)

VALUES
('$name', '$phone', '$address', '$total',
'$payment_method', 'Pending',
'$transaction_id', '$account_number')";

mysqli_query($conn, $sql);

/* -----------------------
   CLEAR CART
------------------------*/

unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment Success</title>
<link rel="stylesheet" href="css/style.css">
<style>

body{
    font-family:Arial;
    background:#f4f6fb;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.success-box{
    background:white;
    padding:40px;
    border-radius:18px;
    text-align:center;
    width:420px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.check{
    font-size:70px;
    color:#60bb46;
}

.amount{
    color:#60bb46;
    font-size:28px;
    font-weight:bold;
    margin:15px 0;
}

.txn{
    background:#f7f9fc;
    padding:12px;
    border-radius:10px;
    margin-top:15px;
    color:#444;
}

.btn{
    display:inline-block;
    margin-top:20px;
    background:#3498db;
    color:white;
    padding:12px 18px;
    border-radius:10px;
    text-decoration:none;
}

</style>

</head>
<body>
<?php include __DIR__ . "/includes/sidebar.php"; ?>
<div class="success-box">

<div class="check">✔</div>

<h2>Payment Successful</h2>

<div class="amount">
Rs <?php echo $total; ?>
</div>

<p>Your TechSphere order has been confirmed.</p>

<div class="txn">
Transaction ID:
<strong><?php echo $transaction_id; ?></strong>
</div>

<a class="btn" href="index.php">
Continue Shopping
</a>

</div>

</body>
</html>