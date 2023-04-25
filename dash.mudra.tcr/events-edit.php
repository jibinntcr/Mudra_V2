<?php
session_start();
error_reporting(0);
include('../ncludes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:login.php');
} else {
  if (isset($_POST['EditNaEBTN'])) {
    if (($_FILES["image"]["error"]) == '0') { //with image     
      if ($_POST['landingPageCheck'] == 'on') {
        $homePageShow = '1';
      } else {
        $homePageShow = '0';
      }


      $id = $_POST['id'];
      // $image = $_POST['OldImage'];

      $title = $_POST['title'];
      $date = $_POST['date'];
      $content = $_POST['content'];
      $category = $_POST['category'];

      $folder = '../uploads/';

      $file = $folder . basename($_FILES["image"]["name"]);
      move_uploaded_file($_FILES['image']['tmp_name'], $file);
      $image = basename($_FILES["image"]["name"]);

      $sql = "UPDATE  news SET heading='$title',content='$content',date='$date',image='$blogimage',image='$image', category='$category',landingStatus='$homePageShow' where id='$id'";

      $query = $dbh->prepare($sql);
      $result = $query->execute();
      if ($query->rowCount() > 0) {
        $_SESSION["eventedited"] = "success";
        echo '<script>window.location = "index.php";</script>';
      } else {
        $_SESSION["eventedited"] = "notsuccess";
        echo '<script>window.location = "index.php";</script>';
      }
    } else if (($_FILES["image"]["error"]) == '4') { // without image
      if ($_POST['landingPageCheck'] == 'on') {
        $homePageShow = '1';
      } else {
        $homePageShow = '0';
      }


      $id = $_POST['id'];
      $image = $_POST['OldImage'];

      $title = $_POST['title'];
      $date = $_POST['date'];
      $content = $_POST['content'];
      $category = $_POST['category'];

      $sql = "UPDATE  news SET heading='$title',content='$content',date='$date',image='$image', category='$category',landingStatus='$homePageShow' where id='$id'";

      $query = $dbh->prepare($sql);
      $result = $query->execute();
      if ($query->rowCount() > 0) {
        $_SESSION["eventedited"] = "success";
        echo '<script>window.location = "index.php";</script>';
      } else {
        $_SESSION["eventedited"] = "notsuccess";
        echo '<script>window.location = "index.php";</script>';
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

    <title>Edit News and Events  | MetaValley TBI</title>

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

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.php" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="../images/logo/logo.png">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">MetaValley</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">News And Events</div>
              </a>
            </li>
          </ul>
        </aside>
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
                <span class="text-muted fw-light">Admin / </span> Edit News &amp; Events</h4>
              
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Edit News &amp; Events</h5>
                      <!-- <small class="text-muted float-end">Default label</small> -->
                    </div>
                    <div class="card-body">
                    <form class="forms-sample" enctype="multipart/form-data" method="POST">
                                <?php
                                $id = $_GET['id'];
                                $sql = "SELECT * from news where id=$id ";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $userArr = $query->fetchAll(PDO::FETCH_OBJ);
                                if ($query->rowCount() > 0) {
                                ?>

                        <div class="mb-3">
                        <input type="hidden" id="id" name="id" value="<?php echo ($userArr[0]->id); ?>" />
                        <input type="hidden" id="OldImage" name="OldImage" value="<?php echo ($userArr[0]->image); ?>" />
                          <label class="form-label" for="basic-default-fullname">Title</label>
                          <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo ($userArr[0]->heading); ?>">
                        </div>
                        <div class="mb-3">
                        <label for="html5-date-input" class="form-label">Date</label>
                        <input class="form-control" type="date" id="date" name="date" value="<?php echo ($userArr[0]->date); ?>">
                        </div>
                        <div class="mb-3">
                        <label for="formFile" class="form-label">Image (size : 1920 X 1440px)</label>
                        <input class="form-control" type="file" name="image" id="image" name="image" value="<?php echo ($userArr[0]->image); ?>">
                      </div>
                      <div class="mb-3">
                        <label for="formFile" class="form-label">Category</label>
                      <div class="input-group">
                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                            <select class="form-select" id="inputGroupSelect01" name="category">
                            <option selected="true" value="<?php echo ($userArr[0]->category); ?>"><?php echo ($userArr[0]->category); ?></option>
                              <option value="News">News</option>
                              <option value="Events">Events</option>
                            </select>
                          </div>
                      </div>
                      <?php
                                  if (($userArr[0]->landingStatus) == '0') {
                      ?>
                      <div class="mb-3">
                        <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="landingPageCheck" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Need to Show on Home Page ?</label>
                        </div>
                      </div>
                      <?php } else if (($userArr[0]->landingStatus) == '1') {
                      ?>
                      <div class="mb-3">
                        <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="landingPageCheck" id="flexSwitchCheckChecked" checked="">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Need to Show on Home Page ?</label>
                        </div>
                      </div>
                      <?php }
                      ?>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-message">Content</label>
                          <textarea class="form-control" name="content" id="content"><?php echo ($userArr[0]->content); ?></textarea>
                        </div>
                        <button type="submit" name="EditNaEBTN" id="EditNaEBTN" class="btn btn-primary">Save</button>
                    <?php }
                    ?>
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