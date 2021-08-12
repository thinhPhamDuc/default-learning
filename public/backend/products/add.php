<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include '../../../database/database.php';
include '../../../function/function.php';

if (isset($_POST['addProduct'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $cpuname = $_POST['cpuname'];
    $ram = $_POST['ram'];
    $harddisk = $_POST['harddisk'];
    $card = $_POST['card'];
    $screen = $_POST['screen'];
    $content = $_POST['content'];
    $category=$_POST['category'];
    $file_name = uniqid() . "." . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tem_loc = $_FILES['fileToUpload']['tmp_name'];
    $file_store = "../../../resource/backend/images/products/" . $file_name;
    $uploadOk = 1;
    // kiểm tra xem các điều kiện đã đúng hay chưa
    if (!is_uploaded_file($file_tem_loc)) {
        $file_store = null;
    } else {
        if (($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg"
            && $file_type != "gif")) {
            echo "<script>alert('Xin lỗi, chỉ chấp nhận JPG, JPEG, PNG & GIF.'); window.location = '../main-view/manage-products.php';</script>";
            $uploadOk = 0;
        }
        if ($file_size > 500000) {
            echo "<script>alert('Xin lỗi, ảnh của bạn quá lớn.'); window.location = '../main-view/manage-products.php';</script>";
            $uploadOk = 0;
        }
        if ($uploadOk !== 0) {
            //  Kiểm tra điều kiện bắt buộc phải chèn dữ liệu vào input
            move_uploaded_file($file_tem_loc, $file_store);
        }
    }
    if ($category!=="" && $name !== "" && $description !== "" && $cpuname !== "" && $ram !== "" && $harddisk !== "" && $card !== ""&& $screen !== "" && $content !== "") {
        $sql = "INSERT INTO products (name,description,cpuname,ram,harddisk,card,screen,content,images,category_id) VALUES ('$name', '$description','$cpuname','$ram','$harddisk','$card','$screen','$content', '$file_store','$category')";
        if ($conn->query($sql) === TRUE) {
            $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 1";
            $products = $conn->query($sql);
            $products = $products->fetch_array();
            $product_id = $products['id'];
            $tags = $_POST['tags'];
            if (!empty($tags)) {
                foreach ($tags as $tag_id) {
                    $sql = "INSERT INTO link_products_tags (product_id, tag_id) VALUES ('$product_id', '$tag_id')";
                    $conn->query($sql);
                }
            }
            echo "<script>alert('Insert Success'); window.location='../main-view/manage-products.php';</script>";
        } else {
            echo "Error : " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Please Enter Information'); window.location='../main-view/manage-products.php';</script>";
    }
}