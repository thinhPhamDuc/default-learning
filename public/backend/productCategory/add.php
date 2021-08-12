<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include '../../../database/database.php';
include '../../../function/function.php';

if (isset($_POST['addProductCategory'])) {
    $name = $_POST['nameProductCategory'];
    $category = $_POST['categoryParent'];


    if ($category!=="" && $name !== "") {
        $sql = "INSERT INTO products_categories (name,parent_id) VALUES ('$name', '$category')";
        if ($conn->query($sql) === TRUE) {
            $sql = "SELECT * FROM products_categories ORDER BY id DESC LIMIT 1";
            $products = $conn->query($sql);
            $products = $products->fetch_array();
            $product_id = $products['id'];

            echo "<script>alert('Insert Success'); window.location='../main-view/manage-productsCategory.php';</script>";
        } else {
            echo "Error : " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Please Enter Information'); window.location='../main-view/manage-productsCategory.php';</script>";
    }
}