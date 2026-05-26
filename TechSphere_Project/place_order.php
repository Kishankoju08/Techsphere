<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . "/db.php";

/* -------------------------
   SAFE INPUT CHECK
--------------------------*/
$name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
$phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : '';
$address = isset($_POST['address']) ? mysqli_real_escape_string($conn, $_POST['address']) : '';
$payment = isset($_POST['payment']) ? mysqli_real_escape_string($conn, $_POST['payment']) : '';

/* -------------------------
   CHECK CART EXISTS
--------------------------*/
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Cart is empty!");
}

$cart = $_SESSION['cart'];
$total = 0;

/* -------------------------
   CALCULATE TOTAL
--------------------------*/
foreach($cart as $id => $qty){

    $id = (int)$id;

    $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    if($row) {
        $total += $row['price'] * $qty;
    }
}

/* -------------------------
   ONLINE PAYMENT FLOW
--------------------------*/
if($payment == 'Online Payment'){

    $_SESSION['checkout_name'] = $name;
    $_SESSION['checkout_phone'] = $phone;
    $_SESSION['checkout_address'] = $address;

    header("Location: esewa_payment.php?total=$total");
    exit();
}

/* -------------------------
   COD ORDER SAVE
--------------------------*/
$sql = "INSERT INTO orders 
(customer_name, phone, address, total_amount, payment_method) 
VALUES 
('$name', '$phone', '$address', '$total', '$payment')";

mysqli_query($conn, $sql);

/* -------------------------
   CLEAR CART
--------------------------*/
unset($_SESSION['cart']);

/* -------------------------
   REDIRECT TO SUCCESS PAGE
--------------------------*/
header("Location: order_success.php?total=$total");
exit();
?>