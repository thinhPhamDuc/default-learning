<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include '../../../database/database.php';
include '../../../function/function.php';


$sql = "SELECT * FROM products order by id DESC";
$result = $conn->query($sql);

$sql = "SELECT * FROM products_categories ORDER BY id DESC";
$categories = $conn->query($sql);

$sql = "SELECT * FROM products_tags ORDER BY name ASC";
$tags = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sản phẩm</title>
    <!-- Custom fonts for this template-->
    <link href="../../../resource/backend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../../resource/backend/css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <?php include '../layouts/sidebar.php'?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?php include'../layouts/topbar.php'?>

            <!--bắt đầu làm từ đây-->
            <h2>Bảng sản phẩm</h2>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addproducts">Thêm</button>
            <!-- add product Modal -->
            <div class="modal fade" id="addproducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../products/add.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group position-relative text-center">
                                    <img class="imagesForm" style="width: 100px; height: 100px;" src="../../../resource/backend/images/products/default-image.jpg"/>
                                    <label class="formLabel" for="fileToAddProduct"><i class="fas fa-pen"></i><input
                                                style="display: block" type="file" id="fileToAddProduct"
                                                name="fileToUpload"></label>
                                </div>
                                <div class="form-group">
                                    <label for="nameLabel">Name</label>
                                    <input name="name" type="text" class="form-control" id="nameProduct" aria-describedby="emailHelp" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="descriptionLabel">Description</label>
                                    <input name="description" type="text" class="form-control" id="" placeholder="Description">
                                </div>
                                <div class="form-group">
                                    addProduct
                                </div>
                                <div class="form-group">
                                    <label for="descriptionLabel">CPU name</label>
                                    <input name="cpuname" type="text" class="form-control" id="" placeholder="CPU-Name">
                                </div>
                                <div class="form-group">
                                    <label for="descriptionLabel">RAM</label>
                                    <input name="ram" type="text" class="form-control" id="" placeholder="RAM">
                                </div>
                                <div class="form-group">
                                    <label for="descriptionLabel">Hard disk </label>
                                    <input name="harddisk" type="text" class="form-control" id="" placeholder="Hard-disk">
                                </div>
                                <div class="form-group">
                                    <label for="descriptionLabel">Card</label>
                                    <input name="card" type="text" class="form-control" id="" placeholder="Card">
                                </div>
                                <div class="form-group">
                                    <label for="descriptionLabel">Screen </label>
                                    <input name="screen" type="number" class="form-control" id="" placeholder="Screen number">
                                </div>
                                <div class="form-group">
                                    <label for="descriptionLabel">Content</label>
                                    <input name="content" type="text" class="form-control" id="" placeholder="Content">
                                </div>
                                <div class="form-group">
                                    <label for="tags_addProduct">Tags:</label>
                                    <?php
                                    $list_tags = [];
                                    if ($tags->num_rows > 0) {
                                        while ($row = $tags->fetch_assoc()) {
                                            echo '<label style="display: block;"><input style="margin-right: 5px;" name="tags[]" type="checkbox" value="' . $row['id'] . '">' . $row['name'] .  '</label>';
                                            $list_tags[] = $row;
                                        }
                                    }
                                    ?>
                                </div>
                                <button type="submit" class="btn btn-primary" name="addProduct">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--edit product Modal-->
            <div class="modal fade" id="editProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="../products/edit.php" method="post" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="id_editProduct" name="id_editProduct">
                                <div class="form-group position-relative text-center">
                                    <img class="form__img" width="100" id="img_editProduct">
                                    <label for="fileProduct" class="form__label">
                                        <i class="fas fa-pen"></i>
                                        <input type="file" name="fileProduct" id="fileProduct">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name_editProduct">Name:</label>
                                    <input type="text" name="name_editProduct" id="name_editProduct" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="description_editProduct">Description:</label>
                                    <input type="text" name="description_editProduct" id="description_editProduct" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="cpuname_editProduct">CPU-Name:</label>
                                    <input type="text" name="cpuname_editProduct" id="cpuname_editProduct" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="ram_editProduct">Ram:</label>
                                    <input type="text" name="ram_editProduct" id="ram_editProduct" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="harddisk_editProduct">Hard-disk:</label>
                                    <input type="text" name="harddisk_editProduct" id="harddisk_editProduct" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="card_editProduct">Card:</label>
                                    <input type="text" name="card_editProduct" id="card_editProduct" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="screen_editProduct">Screen:</label>
                                    <input type="text" name="screen_editProduct" id="screen_editProduct" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="content_editProduct">Content:</label>
                                    <input type="text" name="content_editProduct" id="content_editProduct" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="category_editProduct">Category:</label>
                                    <select name="category_editProduct" id="category_editProduct" class="form-control">
                                        <?php echo productCategoryTree()?>
                                    </select>
                                </div>
                                <div class="form-group form-tag">
                                    <label for="tags_editProduct">Tags:</label>
                                    <?php
                                    foreach ($list_tags as $item) {
                                        echo '<label style="display: block;"><input style="margin-right: 5px;" name="tags[]" class="tag-' . $item['id'] . '" type="checkbox" value="' . $item['id'] . '">' . $item['name'] . '</label>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="editProduct">Save changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!--delete product Modal-->
            <div class="modal fade" id="deleteProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="../products/delete.php" method="post" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5>Are you sure?</h5>
                                <input type="hidden" id="id_deleteProduct" name="id_deleteProduct">
                                <div class="form-group">
                                    <input type="hidden" name="fileProduct" id="fileProduct">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="deleteProduct" class="btn btn-primary">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--table-->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table table-striped table-bordered" cellspacing="0" style="width:100%">
                            <thead>
                            <tr>
                                <th style="display:none;">ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th style="display:none;">CPU-Name</th>
                                <th style="display:none;">Ram</th>
                                <th style="display:none;">Hard-disk</th>
                                <th style="display:none;">Card</th>
                                <th>Screen</th>
                                <th style="display: none">Content</th>
                                <th>Category</th>
                                <th>Tag</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td style="display:none;"><?php echo $row['id']?></td>
                                        <td class="imgProductBtn"><img  src="<?php if ($row['images']) {
                                                echo $row['images'];
                                            } else {
                                                echo '../public/images/product/default-image.jpg';
                                            } ?>" style="width: 100px; height: 100px;" alt=""></td>
                                        <td><?php echo $row['name']?></td>
                                        <td class="comment"><?php echo $row['description']?></td>
                                        <td style="display:none;"><?php echo $row['cpuname']?></td>
                                        <td style="display:none;"><?php echo $row['ram']?></td>
                                        <td style="display:none;"><?php echo $row['harddisk']?></td>
                                        <td style="display:none;"><?php echo $row['card']?></td>
                                        <td><?php echo $row['screen']?> Inch</td>
                                        <td style="display: none"><?php echo $row['content']?></td>
                                        <?php
                                        $cate = getProductCategory($row['category_id']);
                                        ?>
                                        <td class="field-category" data-category_id="<?php if ($cate['id']) echo $cate['id'] ?>">
                                            <?php if ($cate['name']) echo $cate['name'] ?></td>
                                        <?php
                                        $tags = getProductTags($row['id']);
                                        ?>
                                        <td class="field-tag" data-tag_id="<?php foreach ($tags as $tag) {
                                            if ($tag['id']) {
                                                echo $tag['id'] . ',';
                                            }
                                        } ?>">
                                            <?php foreach ($tags as $tag) {
                                                if ($tag['name']) {
                                                    echo $tag['name'] . ',';
                                                }
                                            } ?>
                                        </td>
                                        <?php
                                        $status = $row['status'];
                                        if ($status == 0) {
                                            $strStatus = "<a class='btn btn-secondary' href=../products/activate.php?id=" . $row['id'] . ">Deactivate</a>";
                                        }
                                        if ($status == 1) {
                                            $strStatus = "<a class='btn btn-warning text-white' href=../products/deactivate.php?id=" . $row['id'] . ">Active</a>";
                                        }
                                        ?>
                                        <td><?php echo $strStatus ?></td>
                                        <td>
                                            <!-- chưa xử lí phần điều hướng trang edit và delete -->
                                            <!-- Button trigger edit modal -->
                                            <button type="button" class="btn btn-success editProductBtn" data-toggle="modal" data-target="#editProducts" >Edit</button>
                                            <!-- Button trigger delete modal -->
                                            <button type="button" class="btn btn-danger deleteProductBtn" data-toggle="modal" data-target="#deleteProduct">Delete</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="display:none;">ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th style="display:none;">CPU-Name</th>
                                <th style="display:none;">Ram</th>
                                <th style="display:none;">Hard-disk</th>
                                <th style="display:none;">Card</th>
                                <th>Screen</th>
                                <th style="display: none">Content</th>
                                <th>Category</th>
                                <th>Tag</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!--end table-->
            <!--kết thúc-->
        </div>
        <!-- End of Main Content -->

        <?php include '../layouts/footer.php'?>

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<?php include '../layouts/modal-scroll.php'?>
<!-- Bootstrap core JavaScript-->
<!-- Bootstrap core JavaScript-->
<script src="../../../resource/backend/vendor/jquery/jquery.min.js"></script>
<script src="../../../resource/backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../../resource/backend/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../../resource/backend/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../../../resource/backend/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../../../resource/backend/js/demo/chart-area-demo.js"></script>
<script src="../../../resource/backend/js/demo/chart-pie-demo.js"></script>
</html>