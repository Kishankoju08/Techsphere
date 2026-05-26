
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

$total = isset($_GET['total']) ? $_GET['total'] : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>eSewa Payment - TechSphere</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            background:#f4f6fb;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .payment-container{
            width:420px;
            background:white;
            border-radius:18px;
            overflow:hidden;
            box-shadow:0 10px 25px rgba(0,0,0,0.1);
        }

        .top-bar{
            background:#60bb46;
            color:white;
            padding:20px;
            text-align:center;
        }

        .top-bar h2{
            font-size:28px;
            margin-bottom:5px;
        }

        .top-bar p{
            font-size:14px;
            opacity:0.9;
        }

        .payment-body{
            padding:25px;
        }

        .amount-box{
            background:#f7f9fc;
            padding:18px;
            border-radius:12px;
            margin-bottom:20px;
            text-align:center;
        }

        .amount-box h3{
            color:#333;
            margin-bottom:8px;
        }

        .amount-box .price{
            font-size:30px;
            color:#60bb46;
            font-weight:bold;
        }

        .input-group{
            margin-bottom:16px;
        }

        .input-group label{
            display:block;
            margin-bottom:6px;
            color:#444;
            font-weight:600;
        }

        .input-group input{
            width:100%;
            padding:12px;
            border:1px solid #ccc;
            border-radius:10px;
            outline:none;
            transition:0.3s;
        }

        .input-group input:focus{
            border-color:#60bb46;
        }

        .pay-btn{
            width:100%;
            background:#60bb46;
            color:white;
            border:none;
            padding:14px;
            border-radius:12px;
            font-size:16px;
            cursor:pointer;
            transition:0.3s;
        }

        .pay-btn:hover{
            background:#4fa53a;
        }

        .secure-text{
            text-align:center;
            margin-top:15px;
            color:#777;
            font-size:13px;
        }

        .logo-circle{
            width:70px;
            height:70px;
            background:white;
            border-radius:50%;
            margin:auto;
            display:flex;
            justify-content:center;
            align-items:center;
            margin-bottom:10px;
            font-size:28px;
            font-weight:bold;
            color:#60bb46;
        }
        .qr-section{
    text-align:center;
    margin-bottom:20px;
}

.qr-section img{
    width:220px;
    border-radius:12px;
    border:3px solid #60bb46;
    padding:10px;
    background:white;
}

.scan-text{
    margin-top:10px;
    color:#555;
    font-size:14px;
}

.bank-info{
    background:#f7f9fc;
    padding:15px;
    border-radius:10px;
    margin-bottom:18px;
    font-size:14px;
    color:#333;
    line-height:1.8;
}

input[type="file"]{
    border:none !important;
    padding:5px;
}
    </style>
</head>
<body>

<div class="payment-container">

    <div class="top-bar">
        <div class="logo-circle">e</div>
        <h2>eSewa</h2>
        <p>Digital Payment Partner</p>
    </div>

    <div class="payment-body">

        <div class="amount-box">
            <h3>Total Payment</h3>
            <div class="price">Rs <?php echo $total; ?></div>
        </div>

        <form action="payment_success.php" method="POST" enctype="multipart/form-data">

    <!-- HIDDEN DATA -->
    <input type="hidden" name="total" value="<?php echo $total; ?>">

    <input type="hidden" name="name" value="<?php echo $_SESSION['checkout_name']; ?>">

    <input type="hidden" name="phone" value="<?php echo $_SESSION['checkout_phone']; ?>">

    <input type="hidden" name="address" value="<?php echo $_SESSION['checkout_address']; ?>">

    <!-- QR SECTION -->
    <div class="qr-section">

        <img src="images/esewaqr.png" alt="QR Payment">

        <p class="scan-text">
            Scan this QR using eSewa / Mobile Banking
        </p>

    </div>

    <!-- ACCOUNT INFO -->
    <div class="bank-info">
        <p><strong>Account Name:</strong> TechSphere Pvt Ltd</p>
        <p><strong>eSewa Number:</strong> 9800000000</p>
    </div>

    <!-- TRANSACTION ID -->
    <div class="input-group">
        <label>Transaction ID</label>
        <input type="text" name="transaction_id"
               placeholder="Enter transaction code" required>
    </div>

    <!-- ACCOUNT NUMBER -->
    <div class="input-group">
        <label>Your Account Number</label>
        <input type="text" name="account_number"
               placeholder="Enter sender account number" required>
    </div>

    <!-- SCREENSHOT -->
    <div class="input-group">
        <label>Payment Screenshot</label>
        <input type="file" name="payment_image">
    </div>

    <button class="pay-btn" type="submit">
        Verify Payment
    </button>

</form>

        <div class="secure-text">
            🔒 100% Secure Payment Gateway
        </div>

    </div>

</div>

</body>
</html>
