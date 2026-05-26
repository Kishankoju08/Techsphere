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

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
<meta charset="UTF-8">
<title><?php echo $product['name']; ?> - TechSphere</title>

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
.product-box{
    background:white;
    display:flex;
    gap:30px;
    padding:25px;
    border-radius:18px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

/* IMAGE */
.product-box img{
    width:400px;
    height:400px;
    object-fit:contain;
    border-radius:12px;
    background:#f8fafc;
}

/* INFO */
.info h1{
    margin:0;
    font-size:28px;
}

.price{
    font-size:26px;
    color:green;
    font-weight:bold;
    margin:15px 0;
}

.desc{
    color:#555;
    margin-bottom:20px;
    line-height:1.5;
}

/* BUTTONS */
.btn{
    display:inline-block;
    padding:12px 18px;
    border-radius:10px;
    text-decoration:none;
    margin-right:10px;
    font-weight:600;
}

.buy{
    background:#2563eb;
    color:white;
}

.cart{
    background:#fbbf24;
    color:black;
}

/* MOBILE */
@media(max-width:768px){
    .main{
        margin-left:0;
        padding:15px;
    }

    .product-box{
        flex-direction:column;
        align-items:center;
        text-align:center;
    }

    .product-box img{
        width:100%;
        height:auto;
    }
}
</style>

</head>

<body>

<?php include "includes/sidebar.php"; ?>

<div class="main">

<div class="product-box">

    <img src="images/<?php echo $product['image']; ?>">

    <div class="info">

        <h1><?php echo $product['name']; ?></h1>

        <div class="price">
            Rs <?php echo $product['price']; ?>
        </div>

        <div class="desc">
            <?php echo $product['description']; ?>
        </div>

        <a class="btn buy"
           href="buy_now.php?id=<?php echo $product['id']; ?>">
           Buy Now
        </a>

        <a class="btn cart"
           href="cart.php?action=add&id=<?php echo $product['id']; ?>">
           Add to Cart
        </a>

    </div>

</div>

</div>

</body>
</html>