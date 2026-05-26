<?php
include(__DIR__ . "/../db.php");

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Products</title>

<style>
body{
    margin:0;
    font-family: Arial, sans-serif;
    background:#f4f6f9;
}

/* TOP BAR */
.header{
    background:#111827;
    color:white;
    padding:15px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.header h2{
    margin:0;
}

.add-btn{
    background:#22c55e;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:8px;
    font-weight:bold;
}

/* GRID */
.container{
    padding:20px;
}

.grid{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap:20px;
}

/* PRODUCT CARD */
.card{
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 4px 10px rgba(0,0,0,0.08);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card img{
    width:100%;
    height:180px;
    object-fit:cover;
}

/* CARD CONTENT */
.content{
    padding:15px;
}

.name{
    font-size:16px;
    font-weight:bold;
    margin-bottom:5px;
}

.price{
    color:#16a34a;
    font-weight:bold;
    margin-bottom:10px;
}

/* BUTTON */
.delete-btn{
    display:inline-block;
    padding:8px 12px;
    background:#ef4444;
    color:white;
    text-decoration:none;
    border-radius:8px;
    font-size:13px;
}

.delete-btn:hover{
    background:#dc2626;
}
.container {
    margin-left: 80px; /* same width as sidebar */
    padding: 10px;
}
.edit-btn {
    display:inline-block;
    padding:8px 12px;
    background:#3b82f6;
    color:white;
    text-decoration:none;
    border-radius:8px;
    font-size:13px;
    margin-right:5px;
}

.edit-btn:hover {
    background:#2563eb;
}

.delete-btn {
    display:inline-block;
    padding:8px 12px;
    background:#ef4444;
    color:white;
    text-decoration:none;
    border-radius:8px;
    font-size:13px;
}

.delete-btn:hover {
    background:#dc2626;
}
</style>

</head>

<body>
<?php include("includes/admin_navbar.php"); ?>
<div class="main-content">
    <div class="container">

        <div class="grid">

            <?php while($row = mysqli_fetch_assoc($result)) { ?>

            <div class="card">

                <img src="../images/<?php echo $row['image']; ?>">

                <div class="content">

                    <div class="name"><?php echo $row['name']; ?></div>
                    <div class="price">Rs. <?php echo $row['price']; ?></div>

                    <!-- EDIT BUTTON -->
                    <a class="edit-btn"
                    href="edit_product.php?id=<?php echo $row['id']; ?>">
                    Edit
                    </a>

                    <!-- DELETE BUTTON -->
                    <a class="delete-btn"
                    href="delete_product.php?id=<?php echo $row['id']; ?>"
                    onclick="return confirm('Delete this product?')">
                    Delete
                    </a>

                </div>

            </div>

            <?php } ?>

        </div>

    </div>
</div>

</body>
</html>