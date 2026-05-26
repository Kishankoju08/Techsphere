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
$result = mysqli_query($conn, "SELECT * FROM products LIMIT 6");
?>

<!DOCTYPE html>
<html>
<head>
<title>TechSphere</title>
<link rel="stylesheet" href="css/style.css">
<style>
</style>

</head>
<?php include __DIR__ . "/includes/sidebar.php"; ?>
<body>
<!-- MAIN -->
<div class="main">

    <!-- HERO SECTION -->
<div class="hero-section">

    <div class="hero-left">

        <span class="tag">
            🚀 Next Generation Tech Store
        </span>

        <h1>
            Upgrade Your <span>Digital Lifestyle</span>
        </h1>

        <p>
            Discover premium gadgets, accessories and smart technology
            products with modern shopping experience.
        </p>

        <div class="hero-buttons">
            <a href="products.php" class="shop-btn">
                Shop Now
            </a>

            <a href="#" class="explore-btn">
                Explore
            </a>
        </div>

    </div>

    <div class="hero-right">

        <div class="floating-card card1">
            💻 Laptops
        </div>

        <div class="floating-card card2">
            🎧 Headphones
        </div>

        <div class="floating-card card3">
            📱 Smartphones
        </div>

        <img src="images/logo.png" class="hero-image">

    </div>

</div>

<!-- SEARCH BAR -->
<div class="search-box">

    <input type="text" placeholder="Search latest gadgets...">

    <button>
        Search
    </button>

</div>

<!-- CATEGORY SECTION -->
<h2 class="section-title">
    🔥 Popular Categories
</h2>

<div class="category-grid">

    <a href="products.php?category=Laptops" class="category-card">
        <div class="icon">💻</div>
        <h3>Laptops</h3>
    </a>

    <a href="products.php?category=Mobiles" class="category-card">
        <div class="icon">📱</div>
        <h3>Mobiles</h3>
    </a>

    <a href="products.php?category=Smart Watch" class="category-card">
        <div class="icon">⌚</div>
        <h3>Smart Watch</h3>
    </a>

    <a href="products.php?category=Audio" class="category-card">
        <div class="icon">🎧</div>
        <h3>Audio</h3>
    </a>

</div>

<!-- FEATURED PRODUCTS -->
<h2 class="section-title">
    ⭐ Featured Products
</h2>

<div class="product-grid">

<?php while($row = mysqli_fetch_assoc($result)) { ?>

    <div class="product-card">

        <div class="product-image">

            <img src="images/<?php echo $row['image']; ?>">

        </div>

        <div class="product-info">

            <h3><?php echo $row['name']; ?></h3>

            <div class="price">
                Rs <?php echo $row['price']; ?>
            </div>

            <div class="buttons">

                <a class="view-btn"
                   href="product.php?id=<?php echo $row['id']; ?>">
                   View
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