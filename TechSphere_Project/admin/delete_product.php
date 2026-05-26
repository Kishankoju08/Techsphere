<?php
include "../db.php";

$id = $_GET['id'];

// first get image
$get = mysqli_query($conn, "SELECT image FROM products WHERE id=$id");
$row = mysqli_fetch_assoc($get);

// delete image from folder
unlink("../uploads/" . $row['image']);

// delete from DB
mysqli_query($conn, "DELETE FROM products WHERE id=$id");

header("Location: products.php");
?>