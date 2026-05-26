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


if(isset($_GET['id'])){

    $id = $_GET['id'];

    // clear old cart
    $_SESSION['cart'] = [];

    // add current product
    $_SESSION['cart'][$id] = 1;

    // redirect to checkout
    header("Location: checkout.php");
    exit();

} else {

    echo "Product ID missing";

}
?>