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

$result = mysqli_query($conn, "SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TechSphere | Categories</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f7f9fc;
        }

        .header {
            background: white;
            padding: 20px;
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .header span { color: #007bff; }

        .container {
            width: 90%;
            margin: auto;
            padding: 30px 0;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .icon {
            font-size: 40px;
        }

        .card a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<div class="header">
    Tech<span>Sphere</span> Categories
</div>

<div class="container">

    <div class="grid">

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

            <div class="card">
                <div class="icon">
                    <?php echo $row['icon']; ?>
                </div>

                <h3><?php echo $row['name']; ?></h3>

                <p><?php echo $row['description']; ?></p>

                <a href="products.php?category=<?php echo $row['name']; ?>">
                    Explore
                </a>
            </div>

        <?php } ?>

    </div>
</div>

</body>
</html>