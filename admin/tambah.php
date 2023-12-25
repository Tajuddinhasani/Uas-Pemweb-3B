<?php 

  include "connect.php";
  include "include/header.php";
  include "include/sidebar.php"; 

    $id ='';
    $product_name = '';
    $product_code = '';
    $product_description = '';
    $product_status = '';
    $product_type = '';

  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'add') {
        // Get data from the form
        $product_name = $_POST['product_name'];
        $product_code = $_POST['product_code'];
        $product_description = $_POST['product_description'];
        $product_status = $_POST['product_status'];
        $product_type = $_POST['product_type'];

        // Upload thumbnail
        $thumbnail = '';
        if (!empty($_FILES['thumbnail']['name'])) {
            $thumbnail = uploadThumbnail();
            if (!$thumbnail) {
                // If upload thumbnail fails
                header("Location: product.php?error=thumbnail_error");
                exit();
            }
        }

        // Query to add data to the table
        $query = "INSERT INTO data_product (product_name, product_code, product_description, product_status, product_type, thumbnail) 
                  VALUES ('$product_name', '$product_code', '$product_description', '$product_status', '$product_type', '$thumbnail')";

        // Execute the query
        if (mysqli_query($conn, $query)) {
            
            echo "<script>
                alert ('Data Akun Berhasil Ditambahkan');
                document.location.href = 'product.php';
            </script>";
        } else {
            echo "<script>
                alert ('Data Akun Berhasil Ditambahkan');
                document.location.href = 'product.php';
            </script>";
        }
    }
}

// Function to upload thumbnail
function uploadThumbnail()
{
    $targetDir = "img/";
    $thumbnailName = basename($_FILES['thumbnail']['name']);
    $targetFilePath = $targetDir . $thumbnailName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $targetFilePath)) {
            return $thumbnailName;
        }
    }
    return false;
}

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4"> Tambah Data</h4>
                        <!-- Form untuk menambahkan data -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $id; ?>" name="id_product">
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-2">Nama Produk</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" name="product_name" class="form-control" required="1" placeholder="Nama Produk" value="<?php echo $product_name; ?>" />
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-2">Kode (API)</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" name="product_code" class="form-control" placeholder="Masukan alamat email aktif" required="1" value="<?php echo $product_code; ?>" />
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-2">Deskripsi</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <textarea type="text" name="product_description" class="form-control" placeholder="Deskripsi" cols="5"><?php echo $product_description; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-2">Mode Transaksi</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select class="form-control" name="product_type" id="product_type">
                                                        <option <?php if ($product_type == '1') {
                                                                        echo "selected";
                                                                    } ?> value="1">AUTO</option>
                                                        <option <?php if ($product_type == '2') {
                                                                        echo "selected";
                                                                    } ?> value="2">MANUAL</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-2">Thumbnail</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php if (isset($_GET['edit'])) { ?>
                                                        <img src="img/<?php echo $result['thumbnail'] ?>" width="20%" class="border border-primary mb-2">
                                                    <?php } ?>
                                                    <input <?php if (!isset($_GET['edit'])) {
                                                                echo "required";
                                                            } ?> type="file" name="thumbnail" class="form-control" accept="image/png, image/jpg, image/jpeg" />
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-2">Status</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <select class="form-control" name="product_status" id="product_status">
                                                            <option <?php if ($product_status == "1") {
                                                                            echo "selected";
                                                                        } ?> value="1">Active</option>
                                                            <option <?php if ($product_status == "2") {
                                                                            echo "selected";
                                                                        } ?> value="2">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="text-right">
                                    <?php if (isset($_POST['add'])) { ?>
                                        <button type="submit" name="action" value="edit" class="btn btn-info">Simpan Perubahan</button>
                                    <?php } else { ?>
                                        <button type="submit" name="action" value="add" class="btn btn-info">Tambahkan</button>
                                    <?php } ?>
                                    <a href="product.php" class="btn btn-dark"><i class="fa fa-reply"></i> Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer text-center text-muted">
          All Rights Reserved by TopupKu.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Main Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/popper.js/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="assets/js/app-style-switcher.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="assets/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="assets/extra-libs/c3/d3.min.js"></script>
    <script src="assets/extra-libs/c3/c3.min.js"></script>

    <!-- Grafik di dashboard -->
    <script src="assets/libs/chartist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/js/pages/dashboards/dashboard.js"></script>

    <!-- Cetak struk -->
    <script>
      function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
      }
    </script>

    <!-- Tabel inventory pakai data table -->
  </body>
</html>

<!-- Bagian setelahnya -->
