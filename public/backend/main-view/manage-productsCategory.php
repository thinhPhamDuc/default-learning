<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include '../../../database/database.php';
include '../../../function/function.php';




$sql = "SELECT * FROM products_categories ORDER BY id DESC";
$result = $conn->query($sql);


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
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">

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
            <button class="btn btn-primary addProductCategorybtn" data-toggle="modal" data-target="#addProductCategory">Thêm</button>
            <!--Add Modal -->
            <div class="modal fade" id="addProductCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="../productCategory/add.php" method="post">
                        <div class="modal-body">

                                <div class="form-group">
                                    <label for="nameLabel">Tên danh mục</label>
                                    <input name="nameProductCategory" type="text" class="form-control" id="nameProductCategory" aria-describedby="emailHelp" placeholder="Nhập tên danh mục sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="descriptionLabel">Danh mục cha</label>
                                    <select name="categoryParent" id="category" class="form-control">
                                        <?php echo productCategoryTree()?>
                                    </select>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addProductCategory">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--Edit Modal -->
            <div class="modal fade" id="editProductsCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="../productCategory/edit.php" method="POST">
                            <div class="modal-body">
                                <input type="text" id="id_editProductCategory" name="id_editProductCategory">
                                <div class="form-group">
                                    <label for="name_editProductCategory">Name:</label>
                                    <input type="text" name="name_editProductCategory" id="name_editProductCategory" class="form-control">
                                </div>
                                <div class="form-group">
                                    <select name="category_editProductCategory" id="category_editProductCategory" class="form-control">
                                        <option value="0"><b>Select Category Parents:</b></option>
                                        <?php
                                        echo productCategoryTree();
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="editProductCategory">Save changes</button>
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
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id']?></td>
                                        <td class="category"><?php echo $row['name']?></td>
                                        <td>
                                            <button type="button" class="btn btn-success editProductsCategoryBtn" data-toggle="modal" data-target="#editProductsCategory" >Edit</button>
                                            <button type="button" class="btn btn-danger deleteProductsCategoryBtn" data-toggle="modal" data-target="#deleteProductsCategory">Delete</button>
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
                                <th>ID</th>
                                <th>Name</th>
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
<script src="../../../resource/backend/js/main.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

</html>