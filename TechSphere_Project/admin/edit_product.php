
<?php
include "../db.php";

$id = $_GET['id'];

// fetch product
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($result);

// update logic
if(isset($_POST['update'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // IF NEW IMAGE UPLOADED
    if($_FILES['image']['name'] != "") {

        // delete old image
        unlink("../uploads/" . $product['image']);

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "../uploads/" . $image);

        $query = "UPDATE products SET 
                  name='$name',
                  price='$price',
                  description='$description',
                  image='$image'
                  WHERE id=$id";

    } else {

        $query = "UPDATE products SET 
                  name='$name',
                  price='$price',
                  description='$description'
                  WHERE id=$id";
    }

    mysqli_query($conn, $query);

    header("Location: products.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f6f9;
        }

        .main-content {
            margin-left: 220px;
            padding: 30px;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-container {
            max-width: 500px;
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            outline: none;
        }

        textarea {
            height: 100px;
            resize: none;
        }

        input:focus, textarea:focus {
            border-color: #3b82f6;
        }

        .current-img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .btn-update {
            width: 100%;
            padding: 12px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-update:hover {
            background: #2563eb;
        }

        .sidebar-note {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>

<body>

<?php include("includes/admin_navbar.php"); ?>

<div class="main-content">

    <div class="page-title">✏ Edit Product</div>

    <div class="form-container">

        <form method="POST" enctype="multipart/form-data">

            <input type="text" name="name" 
                   value="<?php echo $product['name']; ?>" 
                   required>

            <input type="number" name="price" 
                   value="<?php echo $product['price']; ?>" 
                   required>

            <textarea name="description"><?php echo $product['description']; ?></textarea>

            <!-- CURRENT IMAGE -->
            <img class="current-img" 
                 src="../images/<?php echo $product['image']; ?>">

            <input type="file" name="image">

            <div class="sidebar-note">
                Leave image empty if you don’t want to change it
            </div>

            <br>

            <button class="btn-update" type="submit" name="update">
                Update Product
            </button>

        </form>

    </div>

</div>

</body>
</html>