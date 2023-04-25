<?php
session_start();
error_reporting(0);
include('../../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  echo '<script>window.location = "../login.php";</script>';
} else { ?>




  <!DOCTYPE html>
  <!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Files | Mudra Publications</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../images/favi.jpg" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
    <script src="ckeditor_4.19.1_standard/ckeditor/ckeditor.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>

  <body>

    <?php
    if (isset($_SESSION["categoryAdd"]) == "success") { ?>
  <script>
    swal({
        title: "Success!",
        text: "New Category added Successfully ",
        icon: "success",
        button: "OK",
    });
 </script>
    <?php
      unset($_SESSION["categoryAdd"]);
    }
    if (isset($_SESSION["categoryAdd"]) == "notsuccess") { ?>
  <script>
    swal("Something went wrong !", "Please try after some time!", "error");
  </script>
    <?php unset($_SESSION["categoryAdd"]);
    }
    ?>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <?php include('../admin-partials/side-nav.php') ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <?php include('../admin-partials/header.php') ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="container-xxl flex-grow-1 container-p-y">
          <a href="new-file.php"  class="float-end btn btn-primary">New</a>
              <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Admin / </span>Files</h4>
              
              <!-- Basic Layout -->
              <div class="card">
                <h5 class="card-header">File</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>File Name</th>
                        <th>Category</th>
                        <th>File Number</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                    <?php
                    $cnt = 1;
                    $sql = "SELECT * from files ";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    if ($query->rowCount() > 0) {
                      foreach ($results as $result) {
                    ?>
                                                    
                      <tr>
                      <?php
                        $heading =  substr($result->name, 0, 65);
                      ?>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong> <?php echo  $heading ?></strong>
                        </td>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo  $result->category ?></strong>
                        </td>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo  $result->filenumber ?></strong>
                        </td>

                       
                       
                            <?php
                            $activeStatus = $result->status;
                            if ($activeStatus == '1') {
                              $idE = $result->id;  ?>
                        <td>
                            <div class="form-check form-switch ">
                            <input onclick="location.href ='file-status-activate.php?idE=<?php echo $idE ?>';"
                             class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                            </div>
                         </td>
                            <?php } elseif ($activeStatus == '0') {
                              $idD = $result->id; ?>
                        <td>
                            <div class="form-check form-switch ">
                            <input onclick="location.href ='file-status-activate.php?idD=<?php echo $idD ?>';"
                            class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                             </div>
                        </td>
                            <?php }
                            ?>
                            <td>
                         <a  onclick="location.href = 'edit-file.php?id=<?php echo   $result->id ?>';" class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                        </td>
                      </tr>
                        <?php }
                    }
                        ?>
                         </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <?php include('../admin-partials/footer.php') ?>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
<?php
}
?>