<?php
$conn = mysqli_connect(
    "sql310.infinityfree.com",   // Host
    "if0_42021419",              // Username
    "YOUR_INFINITYFREE_PASSWORD",// Password (from vPanel login)
    "if0_42021419_techsphere"   // Database name
);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>