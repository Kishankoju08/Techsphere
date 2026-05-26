<div class="sidebar">
    <h2>TechSphere</h2>
    <?php if(isset($_SESSION['user'])) { ?>
    <div class="welcome">
    👋 Welcome, <?php echo $_SESSION['user']; ?>
</div>
<?php } ?>
    <a href="index.php">🏠 Home</a>
    <a href="products.php">🛍 Products</a>
    <a href="cart.php">🛒 Cart</a>
    <a href="checkout.php">💳 Checkout</a>
    <?php if(isset($_SESSION['user'])) { ?>
    <a href="logout.php" class="logout">🚪 Logout</a>
<?php } ?>
</div>