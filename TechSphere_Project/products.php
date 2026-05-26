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

$category = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : null;

if($category) {
    $result = mysqli_query($conn,
        "SELECT * FROM products WHERE category='$category'"
    );
} else {
    $result = mysqli_query($conn, "SELECT * FROM products");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Products - TechSphere</title>
    <?php if($category) { ?>
    <a href="products.php" style="
        display:inline-block;
        margin-bottom:15px;
        padding:8px 12px;
        background:#111827;
        color:white;
        border-radius:8px;
        text-decoration:none;
    ">
        ← View All Products
    </a>
<?php } ?>
    <link rel="stylesheet" href="css/style.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html, body{
    overflow-x:hidden;
}
/* PAGE */
body{
    margin:0;
    font-family:Segoe UI, sans-serif;
    background:#f4f6fb;
}

/* MAIN CONTENT */
.main{
    margin-left:230px;
    padding:25px;
}

/* PAGE TITLE */
.page-title{
    margin-bottom:25px;
    color:#111827;
    font-size:32px;
}

/* PRODUCT GRID */
.product-container{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
}

/* PRODUCT CARD */
.product-card{
    background:white;
    border-radius:18px;
    padding:10px;
    border:1px solid #e5e7eb;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
    transition:0.3s;

    display:flex;
    flex-direction:column;
    justify-content:space-between;

    height:100%;
}

.product-card:hover{
    transform:translateY(-6px);
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

/* IMAGE BOX */
/* IMAGE BOX */
/* IMAGE BOX */
.product-image{
    width:100%;
    height:250px;
    background:#f8fafc;
    border-radius:14px;
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
    margin-bottom:10px;
    padding:10px;
}

/* IMAGE */
.product-image img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:0.3s;
}

/* IMAGE HOVER */
.product-card:hover .product-image img{
    transform:scale(1.05);
}

/* INFO */
.product-info{
    text-align:center;

    display:flex;
    flex-direction:column;
    flex:1;
}
.product-info h3{
    font-size:17px;
    margin-bottom:6px;
    min-height:45px;
}

/* PRICE */
.price{
    font-size:22px;
    color:#16a34a;
    font-weight:bold;
    margin-bottom:10px;
}

/* BUTTONS */
.button-group{
    display:flex;
    gap:10px;

    margin-top:auto;
}

/* BUTTON */
.btn{
    flex:1;
    text-align:center;
    padding:10px;
    border-radius:10px;
    text-decoration:none;
    font-size:14px;
    font-weight:600;
    transition:0.3s;
}

/* VIEW */
.view-btn{
    background:#eff6ff;
    color:#2563eb;
}

/* CART */
.cart-btn{
    background:#fef3c7;
    color:#d97706;
}

/* BUY */
.buy-btn{
    background:#2563eb;
    color:white;
}

/* HOVER */
.btn:hover{
    transform:translateY(-2px);
}

/* TABLET */
@media(max-width:1100px){

    .product-container{
        grid-template-columns:repeat(3,1fr);
    }

}

/* MOBILE */
@media(max-width:768px){

    .main{
        margin-left:200px;
    }

    .product-container{
        grid-template-columns:repeat(2,1fr);
    }

}

/* SMALL MOBILE */
@media(max-width:500px){

    .main{
        margin-left:0;
        padding:15px;
    }

    .product-container{
        grid-template-columns:1fr;
    }

}

</style>

</head>

<body>

<!-- SIDEBAR -->
<?php include __DIR__ . "/includes/sidebar.php"; ?>

<!-- MAIN -->
<div class="main">

    <h1 class="page-title">
        🛍 Products

        <?php if($category) { ?>
            - <?php echo $category; ?>
        <?php } ?>
    </h1>

    <div class="product-container">

    <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <div class="product-card">

            <!-- IMAGE -->
            <div class="product-image">

                <img src="images/<?php echo $row['image']; ?>">

            </div>

            <!-- INFO -->
            <div class="product-info">

                <h3>
                    <?php echo $row['name']; ?>
                </h3>

                <div class="price">
                    Rs <?php echo $row['price']; ?>
                </div>

                <!-- BUTTONS -->
                <div class="button-group">

                    <a class="btn view-btn"
                       href="product.php?id=<?php echo $row['id']; ?>">
                       View
                    </a>

                    <a class="btn cart-btn"
                       href="cart.php?action=add&id=<?php echo $row['id']; ?>">
                       Cart
                    </a>

                    <a class="buy-btn"
                        href="buy_now.php?id=<?php echo $row['id']; ?>">
                        Buy Now
                    </a>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

</body>
</html>