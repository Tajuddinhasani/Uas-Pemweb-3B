<?php 
  $host = 'localhost';
  $user = 'root';
  $password = '';
  $db = 'projectm';
  
  $conn = mysqli_connect($host, $user, $password, $db);
  
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Fetch the number of users from the database
  $query = "SELECT COUNT(*) as total_users FROM users";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $totalUsers = $row['total_users'];

  // Fetch the number of orders from the database
  $query = "SELECT COUNT(*) as total_orders FROM orders";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $totalOrders = $row['total_orders'];

  // Fetch orders data from the database
  $queryOrdersData = "SELECT * FROM orders ORDER BY timestamp_column";
  $resultOrdersData = mysqli_query($conn, $queryOrdersData);

  include "include/header.php"
?>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->
      <!-- End Navbar -->

      <!-- Sidebar -->
      <!-- ============================================================== -->
      <!-- Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <?php include "include/sidebar.php" ?>
      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <!-- End Sidebar -->

      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <?php include "include/breadcrumb.php" ?>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->

        <!-- Content -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <div class="card-group">
            <div class="card border-right m-1">
              <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                  <div>
                    <div class="d-inline-flex align-items-center">
                      <h2 class="text-dark mb-1 font-weight-medium"><?php echo $totalUsers; ?></h2>
                    </div>
                    <h6
                      class="text-muted font-weight-normal mb-0 w-100 text-truncate">
                      Users
                    </h6>
                  </div>
                  <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-7 text-muted"
                      ><i data-feather="users"></i
                    ></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card border-right m-1">
              <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                  <div>
                    <div class="d-inline-flex align-items-center">
                      <h2 class="text-dark mb-1 font-weight-medium"><?php echo $totalOrders; ?></h2>
                    </div>
                    <h6
                      class="text-muted font-weight-normal mb-0 w-100 text-truncate"
                    >
                      Penjualan hari ini
                    </h6>
                  </div>
                  <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-7 text-muted"
                      ><i data-feather="shopping-cart"></i
                    ></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- *************************************************************** -->
          <!-- End First Cards -->
          <!-- *************************************************************** -->
          <!-- *************************************************************** -->
          <!-- Start Location and Earnings Charts Section -->
          <!-- *************************************************************** -->
          <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Latest Orders</h4>
                      <?php
                      while ($order = mysqli_fetch_assoc($resultOrdersData)) {
                          $productName = $order['nominal'];
                          $paymentMethod = $order['payment_method'];
                          $user_id = $order['user_id']; // Change this line to use user_id
                          $formattedTimestamp = date('Y-m-d H:i:s', strtotime($order['timestamp_column']));
                      ?>
                          <div class="d-flex align-items-start border-left-line pb-3">
                              <div>
                                  <a href="sales/detail.php?id=<?php echo $order['id']; ?>" class="btn btn-info btn-circle mb-2 btn-item">
                                      <i data-feather="shopping-cart"></i>
                                  </a>
                              </div>
                              <div class="ml-3 mt-2">
                                  <h5 class="text-dark font-weight-medium mb-2">
                                      Penjualan <?php echo $productName; ?>
                                  </h5>
                                  <p class="font-14 mb-2 text-muted">
                                      <?php echo $paymentMethod . ' - User ID: ' . $user_id; ?>
                                      <!-- Remove the amount display -->
                                  </p>
                                  <span class="font-weight-light font-14 text-muted"><?php echo $formattedTimestamp; ?></span>
                              </div>
                          </div>
                      <?php
                      }
                      ?>
                  </div>
              </div>
          </div>
      </div>

          <!-- *************************************************************** -->
          <!-- End Location and Earnings Charts Section -->
          <!-- *************************************************************** -->
          <!-- *************************************************************** -->
          <!-- Start List Users -->
          <!-- *************************************************************** -->

          <!-- *************************************************************** -->
          <!-- End List Users -->
          <!-- *************************************************************** -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- End Content -->

        <?php include "include/footer.php" ?>