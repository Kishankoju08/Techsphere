<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "db.php";

/* Example: get product id from URL */
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

$product = null;

if($product_id) {
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$product_id");
    $product = mysqli_fetch_assoc($result);
}

/* Fake order ID */
$order_id = rand(100000, 999999);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<title>Order Success - TechSphere</title>

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

/* CARD */
.success-box{
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    text-align:center;
    max-width:600px;
    margin:auto;
}

/* CHECK ICON */
.icon{
    font-size:60px;
    color:#16a34a;
}

/* TITLE */
h1{
    margin:10px 0;
    color:#111827;
}

/* ORDER BOX */
.order-details{
    margin-top:20px;
    text-align:left;
    background:#f9fafb;
    padding:15px;
    border-radius:12px;
}

/* BUTTON */
.btn{
    display:inline-block;
    margin-top:20px;
    padding:12px 18px;
    background:#2563eb;
    color:white;
    text-decoration:none;
    border-radius:10px;
    font-weight:600;
}

/* MOBILE */
@media(max-width:768px){
    .main{
        margin-left:0;
        padding:15px;
    }
}
</style>

</head>
<?php include __DIR__ . "/includes/sidebar.php"; ?>
<body>

<div class="main">
<div class="success-box">

    <div class="icon">✔</div>

    <h1>Order Placed Successfully!</h1>

    <p>Thank you for shopping with TechSphere 🎉</p>

    <p><b>Order ID:</b> #<?php echo $order_id; ?></p>

    <?php if($product) { ?>

    <div class="order-details">

        <h3>Product Details</h3>

        <p><b>Name:</b> <?php echo $product['name']; ?></p>

        <p><b>Price:</b> Rs <?php echo $product['price']; ?></p>

        <p><b>Status:</b> Processing</p>

    </div>

    <?php } ?>

    <a href="products.php" class="btn">
        Continue Shopping
    </a>

</div>

</div>

</body>
</html>