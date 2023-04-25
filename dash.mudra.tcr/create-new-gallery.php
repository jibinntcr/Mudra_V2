<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:login.php');
} else {
  if (isset($_POST['GalleryBTN'])) {
    $name = $_POST['name'];

    // thumbnail
    $folder = '../uploads/';
    $file = $folder . basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES['file']['tmp_name'], $file);
    $photo = basename($_FILES["file"]["name"]);

    $status = '1';
    $sql = "INSERT INTO gallery(name,thumbnail,status) VALUES ('" . $name . "','" . $photo . "','" . $status . "')";

    // print_r($sql);
    // exit();
    $query = $dbh->prepare($sql);
    $result = $query->execute();
    if ($query->rowCount() > 0) {
      $last_id = $dbh->lastInsertId();
      $targetDir = "../galleryImages/";
      $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

      $images_arr = array();
      foreach ($_FILES['images']['name'] as $key => $val) {
        $image_name = $_FILES['images']['name'][$key];
        $tmp_name     = $_FILES['images']['tmp_name'][$key];
        $size         = $_FILES['images']['size'][$key];
        $type         = $_FILES['images']['type'][$key];
        $error         = $_FILES['images']['error'][$key];

        // File upload path
        $fileName = basename($_FILES['images']['name'][$key]);
        $targetFilePath = $targetDir . $fileName;

        // Check whether file type is valid
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (in_array($fileType, $allowTypes)) {
          // Store images on the server
          if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFilePath)) {
            $images_arr[] = $targetFilePath;

            $sql = "INSERT INTO gallerimages(galleryID,name,image) VALUES ('" . $last_id . "','" . $name . "','" . $targetFilePath . "')";
            $query = $dbh->prepare($sql);
            $result = $query->execute();
            if ($query->rowCount() > 0) {
              echo '<script>alert("Success")</script>';
              echo '<script>window.location = "gallery.php";</script>';
            } else {
              echo '<script>alert("something went wrong please try again")</script>';
              echo '<script>window.location = "gallery.php";</script>';
            }
          } else {
            echo '<script>alert("something went wrong please try again")</script>';
            echo '<script>window.location = "gallery.php";</script>';
          }
        }
      }
    }
  }


?>




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

    <title>Create Gallery  | MetaValley TBI</title>

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
                      <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Admin / </span>Create New Gallery</h4>
              
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Create New</h5>
                      <!-- <small class="text-muted float-end">Default label</small> -->
                    </div>
                    <div class="card-body">
                    <form class="forms-sample" enctype="multipart/form-data" method="POST">
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Title</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Title" required>
                        </div>
                        <div class="mb-3">
                        <label for="html5-date-input" class="form-label">Thumbnail(600x400 px)</label>
                        <input class="form-control" type="file" id="file" name="file" accept="image/gif, image/png, image/jpg, image/jpeg">
                        </div>
                        <div class="mb-3">
                        <label for="formFile" class="form-label">Images(600x400 px)</label>
                        <input class="form-control" type="file" name="images[]" multiple>
                      </div>
                     
                    
                        <button type="submit" name="GalleryBTN" id="GalleryBTN" class="btn btn-primary">Save</button>
                    </form>
                      <script>
                         CKEDITOR.replace('content');
                      </script>
                    </div>
                  </div>
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