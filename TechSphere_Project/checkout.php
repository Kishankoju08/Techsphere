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
?>
<?php
include __DIR__ . "/db.php";

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$total = 0;

// calculate total
foreach($cart as $id => $qty){
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    $total += $row['price'] * $qty;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout - TechSphere</title>
<link rel="stylesheet" href="css/style.css">
<style>
body{
    font-family: Arial;
    background:#f4f6fb;
}

.container{
    width:70%;
    margin:auto;
    background:white;
    padding:25px;
    margin-top:40px;
    border-radius:12px;
    box-shadow:0 6px 18px rgba(0,0,0,0.1);
}

input, textarea{
    width:100%;
    padding:10px;
    margin:10px 0;
    border:1px solid #ccc;
    border-radius:8px;
}

button{
    background:#2ecc71;
    color:white;
    padding:12px;
    border:none;
    width:100%;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
}

button:hover{
    background:#27ae60;
}
</style>

</head>
<body>
<?php include __DIR__ . "/includes/sidebar.php"; ?>
<div class="main">
<h2>Checkout</h2>

<h3>Total Amount: Rs <?php echo $total; ?></h3>

<form method="POST" action="place_order.php">

    <input type="text" name="name" placeholder="Your Name" required>

    <input type="text" name="phone" placeholder="Phone Number" required>

    <textarea name="address" placeholder="Delivery Address" required></textarea>

    <h3>Select Payment Method</h3>

    <div class="payment-box">
        <label>
            <input type="radio" name="payment" value="Cash on Delivery" required>
            Cash on Delivery (COD)
        </label>
    </div>

    <div class="payment-box">
        <label>
            <input type="radio" name="payment" value="Online Payment">
            Online Payment
        </label>
    </div>

    <button type="submit">Place Order</button>

</form>
</div>

</body>
</html>