<?php

function editImages($folder, $location, $table, $id)
{
    include '../../../database/database.php';
    $file_name = uniqid() . "." . pathinfo($_FILES['fileProduct']['name'], PATHINFO_EXTENSION);
    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $file_size = $_FILES['fileProduct']['size'];
    $file_tem_loc = $_FILES['fileProduct']['tmp_name'];
    $file_store = $folder . $file_name;
    $uploadOk = 1;

    if (!is_uploaded_file($file_tem_loc)) {
    $query = mysqli_query($conn, "SELECT images FROM $table where id='$id'");
    $row = $query->fetch_assoc();
    $file_store = $row['images'];
    } else {
    if (($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg"
    && $file_type != "gif" && $file_type != "webp")) {
    echo "<script>alert('Xin lỗi, chỉ chấp nhận JPG, JPEG, PNG & GIF.'); window.location = $location;</script>";
    $uploadOk = 0;
    }
    if ($file_size > 500000) {
    echo "<script>alert('Xin lỗi, ảnh của bạn quá lớn.'); window.location = $location;</script>";
    $uploadOk = 0;
    }
    if ($uploadOk !== 0) {
    $sql1 = "SELECT * FROM $table WHERE id = '$id'";
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql1));
    if ($row['images']) {
    unlink($row['images']);
    }
    move_uploaded_file($file_tem_loc, $file_store);
    }
}
return $file_store;
}
function getProductCategory($category_id){
    include '../../../database/database.php';
    $sql = "SELECT * FROM products_categories WHERE id = " . $category_id;
    $categories = $conn->query($sql);


    if (is_object($categories)) {
        if ($categories->num_rows > 0) {
            $category = $categories->fetch_array();
            return $category;
        }
    }
    return false;
}
function productCategoryTree($parent_id = 0, $sub_mark = "")
{
    include '../../../database/database.php';
    $sql = "SELECT * FROM products_categories WHERE parent_id = $parent_id ORDER BY name ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['id'] . '">' . $sub_mark . $row['name'] . '</option>';
            productCategoryTree($row['id'], $sub_mark . '--');
        }
    }
}
function getProductTags($product_id)
{
    include '../../../database/database.php';
    $sql = "SELECT products_tags.id, products_tags.name FROM products_tags INNER JOIN link_products_tags ON link_products_tags.tag_id = products_tags.id INNER JOIN products ON link_products_tags.product_id = products.id WHERE products.id = " . $product_id;
    $result = $conn->query($sql);

    $tags = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tags[] = $row;
        }
    }
    return $tags;
}