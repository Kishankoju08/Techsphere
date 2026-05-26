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
include "db.php";

/* INIT CART */
if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* ADD TO CART */
if(isset($_GET['action']) && $_GET['action'] == "add") {

    $id = $_GET['id'];

    if(isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }

    header("Location: cart.php");
    exit();
}

/* REMOVE ITEM */
if(isset($_GET['action']) && $_GET['action'] == "remove") {

    $id = $_GET['id'];
    unset($_SESSION['cart'][$id]);

    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
<meta charset="UTF-8">
<title>Cart - TechSphere</title>

<style>
body{
    margin:0;
    font-family:Segoe UI;
    background:#f4f6fb;
}

/* MAIN */
.container{
    width:90%;
    margin:auto;
    padding:30px 0;
    display:flex;
    gap:20px;
}

/* CART ITEMS */
.cart-items{
    flex:2;
}

/* CART CARD */
.cart-card{
    background:white;
    padding:15px;
    border-radius:16px;
    display:flex;
    gap:15px;
    margin-bottom:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
    align-items:center;
}

/* IMAGE */
.cart-card img{
    width:90px;
    height:90px;
    object-fit:cover;
    border-radius:10px;
}

/* INFO */
.info{
    flex:1;
}

.info h3{
    margin:0;
    font-size:18px;
}

.price{
    color:green;
    font-weight:bold;
    margin-top:5px;
}

/* BUTTON */
.remove{
    background:red;
    color:white;
    padding:6px 10px;
    border-radius:8px;
    text-decoration:none;
    font-size:14px;
}

/* SUMMARY */
.summary{
    flex:1;
    background:white;
    padding:20px;
    border-radius:16px;
    height:fit-content;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

.summary h2{
    margin-top:0;
}

.checkout{
    width:100%;
    padding:12px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:10px;
    margin-top:10px;
    cursor:pointer;
}

/* EMPTY */
.empty{
    text-align:center;
    font-size:18px;
    margin-top:50px;
}

/* MOBILE */
@media(max-width:768px){
    .container{
        flex-direction:column;
    }
}
</style>
</head>

<body>
<?php include __DIR__ . "/includes/sidebar.php"; ?>
<div class="main">
    <div class="container">

<div class="cart-items">

<?php
$total = 0;

if(empty($_SESSION['cart'])) {
    echo "<div class='empty'>Your cart is empty 🛒</div>";
} else {

foreach($_SESSION['cart'] as $id => $qty) {

    $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    $subtotal = $row['price'] * $qty;
    $total += $subtotal;
?>

<div class="cart-card">

    <img src="images/<?php echo $row['image']; ?>">

    <div class="info">
        <h3><?php echo $row['name']; ?></h3>
        <div class="price">
            Rs <?php echo $row['price']; ?> x <?php echo $qty; ?>
        </div>
    </div>

    <a class="remove" href="cart.php?action=remove&id=<?php echo $id; ?>">
        Remove
    </a>

</div>

<?php } } ?>

</div>

<!-- SUMMARY -->
<div class="summary">

    <h2>Order Summary</h2>

    <p>Total Items: <?php echo count($_SESSION['cart']); ?></p>

    <h3>Total: Rs <?php echo $total; ?></h3>

    <a class="buy-btn"
         href="checkout.php?id=<?php echo $row['id']; ?>">
         Proceed to checkout
    </a>

</div>

</div>
</div>
</body>
</html>