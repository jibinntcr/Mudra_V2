<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:login.php');
} else { ?>




  <!DOCTYPE html>
  <!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard | MetaValley TBI</title>

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
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

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
  if (isset($_SESSION["statusCheckDisabled"]) == "success") { ?>
<script>
    swal({
        title: "Disabled!",
        text: "Item disabled successfully",
        icon: "success",
        button: "OK",
    });
 </script>
<?php unset($_SESSION["statusCheckDisabled"]);
  }
  if (isset($_SESSION["statusCheckEnabled"]) == "success") { ?>
<script>
    swal({
        title: "Enabled!",
        text: "Item enabled successfully",
        icon: "success",
        button: "OK",
    });
 </script>
<?php unset($_SESSION["statusCheckEnabled"]);
  }
  if (isset($_SESSION["statusCheckError"]) == "success") { ?>
<script>
   swal("Something went wrong !", "Please try after some time!", "error");
 </script>
<?php unset($_SESSION["statusCheckError"]);
  }
?>


    <?php
    if (isset($_SESSION["eventAdd"]) == "success") { ?>
  <script>
    swal({
        title: "Success!",
        text: "New item added Successfully ",
        icon: "success",
        button: "OK",
    });
 </script>
    <?php
      unset($_SESSION["eventAdd"]);
    }
    if (isset($_SESSION["eventAdd"]) == "notsuccess") { ?>
  <script>
    swal("Something went wrong !", "Please try after some time!", "error");
  </script>
    <?php unset($_SESSION["eventAdd"]);
    }
    ?>

<?php
  if (isset($_SESSION["eventedited"]) == "success") { ?>
  <script>
    swal({
        title: "Success!",
        text: "Item edited Successfully ",
        icon: "success",
        button: "OK",
    });
 </script>
    <?php
    unset($_SESSION["eventedited"]);
  }
  if (isset($_SESSION["eventedited"]) == "notsuccess") { ?>
  <script>
    swal("Something went wrong !", "Please try after some time!", "error");
  </script>
    <?php unset($_SESSION["eventedited"]);
  }
    ?>


    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <?php include('admin-partials/side-nav.php') ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <!-- <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div> -->
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">Admin</span>
                            <small class="text-muted">MetaValley</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="logout.php">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="container-xxl flex-grow-1 container-p-y">
          <a href="create-new-gallery.php"  class="float-end btn btn-primary">New</a>
              <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Admin / </span>Gallery</h4>
              
              <!-- Basic Layout -->
              <div class="card">
                <h5 class="card-header">News &amp; Events</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Date</th>                        
                        <th>Status</th>                    
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                    <?php
                    $cnt = 1;
                    $sql = "SELECT * from gallery ";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    if ($query->rowCount() > 0) {
                      foreach ($results as $result) {
                        $name =  substr($result->name, 0, 65);
                    ?>
                                                    
                      <tr>
        
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong> <?php echo  $name ?></strong></td>
                        <?php
                        $date = date_create($result->date);
                        ?>
                        <td> <?php echo date_format($date, "d/m/Y"); ?></td>
                       
                            <?php
                            $activeStatus = $result->status;
                            if ($activeStatus == '1') {
                              $idE = $result->id;  ?>
                        <td>
                            <div class="form-check form-switch ">
                            <input onclick="location.href ='gallerystatusactivate.php?idE=<?php echo   $idE ?>';"
                             class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                            </div>
                         </td>
                            <?php } elseif ($activeStatus == '0') {
                              $idD = $result->id; ?>
                        <td>
                            <div class="form-check form-switch ">
                            <input onclick="location.href ='gallerystatusactivate.php?idD=<?php echo   $idD ?>';"
                            class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                             </div>
                        </td>
                            <?php }
                            ?>
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
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  MetaValley TBI | Designed By
                  <a href="https://infinio.co.in" target="_blank" class="footer-link fw-bolder">Infinio Technology Solutions</a>
                </div>
                
              </div>
            </footer>
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
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
<?php
}
?>