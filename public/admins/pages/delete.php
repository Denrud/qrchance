<?php include "../db_config/connect.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Мягкий знак admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../css/add_custom_css.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.php"><h1 class="italik_font text-white">Мягкий знак</h1></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-xl-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search products">
              </div>
            </form>
          </div>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include "../partials/_sidebar.php"; ?>
        <!-- partial:partials/_sidebar.html end-->
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="d-xl-flex justify-content-between align-items-start">
              <h2 class="text-dark font-weight-bold mb-2"> Обзорная панель </h2>
            </div>
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Стол продуктов</h4>
                <table class="table table-dark table-responsive">
                  <thead>
                    <tr>
                      <th class="col"> # </th>
                      <th class="col"> Название </th>
                      <th class="col"> Опиции </th>
                      <th class="col"> Цена </th>
                      <th class="col"> Статус на скаде </th>
                      <th class="col"> Id продукта </th>
                      <th class="col"> Описание </th>
                      <th class="col"> Картинка </th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $sql = "SELECT * FROM `products`";
                      $result = $conn->query($sql);
                      $num = 0;
                      while ($row = mysqli_fetch_assoc($result)) {
                          $status  = null; // variable for change color in column "status in stock"
                          $num++; // number of products in column "#"
                          if ($row["status"] == 0) {
                              $status = "text-danger"; // color red
                          }
                          else {
                              $status = "text-success"; // color green
                          }
                          ?>
                          <tr>
                               <td> <?php echo $num; ?> </td>
                               <td> <?php echo $row['title'];?> </td>
                               <td>
                                   <a class="badge badge-primary text-wrap" style="width: 6rem;" href="pages/product-edit/edit.php">редактировать</a>
                                       <br><br>
                                   <a class="badge badge-primary text-wrap" style="width: 6rem;" href="pages/delete.php">удалить</a>
                               </td>
                               <td> <?php echo "$ " . $row['price'];?> </td>
                               <td class="<?php echo $status; ?>"><?php echo $row['status']; ?></td>
                               <td> <?php echo $row['id']; ?> </td>
                               <td><?php echo $row['description'] ?></td>
                         </tr>
                          <?php
                      }
                       ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="footer-inner-wraper">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019 <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap Dash</a>. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
              </div>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/jquery-circle-progress/js/circle-progress.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
