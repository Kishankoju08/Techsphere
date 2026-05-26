
<?php
include "../db.php";

if(isset($_POST['submit'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // IMAGE UPLOAD
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $folder = "../uploads/" . $image;
    move_uploaded_file($tmp, $folder);

    $query = "INSERT INTO products(name, price, image, description)
              VALUES('$name','$price','$image','$description')";

    mysqli_query($conn, $query);

    header("Location: products.php");
}
?>
<style>
    body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f6f9;
}

/* MAIN CONTENT AREA (important for sidebar) */
.main-content {
    margin-left: 220px;
    padding: 30px;
}

/* PAGE TITLE */
.page-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #111827;
}

/* FORM CARD */
.form-container {
    max-width: 500px;
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}

/* INPUT FIELDS */
.form-container input[type="text"],
.form-container input[type="number"],
.form-container textarea,
.form-container input[type="file"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 10px;
    outline: none;
    font-size: 14px;
    transition: 0.3s;
}

.form-container input:focus,
.form-container textarea:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 5px rgba(59,130,246,0.3);
}

/* TEXTAREA */
.form-container textarea {
    resize: none;
    height: 100px;
}

/* SUBMIT BUTTON */
.btn-submit {
    width: 100%;
    padding: 12px;
    background: #22c55e;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.btn-submit:hover {
    background: #16a34a;
}

/* IMAGE PREVIEW (optional future feature) */
.preview-img {
    width: 100%;
    max-height: 200px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 15px;
}
</style>
<body>

<?php include("includes/admin_navbar.php"); ?>

<div class="main-content">

    <div class="page-title">➕ Add New Product</div>

    <div class="form-container">

        <form method="POST" enctype="multipart/form-data">

            <input type="text" name="name" placeholder="Product Name" required>

            <input type="number" name="price" placeholder="Price (Rs)" required>

            <textarea name="description" placeholder="Product Description"></textarea>

            <input type="file" name="image" required>

            <button class="btn-submit" type="submit" name="submit">
                Add Product
            </button>

        </form>

    </div>

</div>

</body>