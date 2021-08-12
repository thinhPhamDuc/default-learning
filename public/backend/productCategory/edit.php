<?php
include '../../../database/database.php';
include '../../../function/function.php';

if (isset($_POST['editProductCategory'])) {
    $id = $_POST["id_editProductCategory"];
    $name = $_POST["name_editProductCategory"];
    $sql = mysqli_query($conn, "SELECT * FROM products_categories where name='$name'");
    if ($name === "") {
        echo "<script>alert('Không được để rỗng!'); window.location = '../main-view/manage-productsCategory.php';</script>";
        die;
    } else if ($sql) {
        if ($sql->num_rows > 0) {
            echo "<script>alert('Danh mục đã tồn tại!'); window.location = '../main-view/manage-productsCategory.php';</script>";
        }
        die;
    }

    $update = "UPDATE products_categories SET name='$name' WHERE id='$id'";
    if ($conn->query($update) === true) {
        echo "<script>window.location = '../main-view/manage-productsCategory.php';</script>";
    } else {
        echo "Lỗi";
    }
}