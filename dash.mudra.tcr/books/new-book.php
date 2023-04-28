<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    echo '<script>window.location = "../login.php";</script>';
} else {
    if (isset($_POST['BookBTN'])) {

        $bookname = $_POST['bookname'];
        $isbn = $_POST['isbn'];
        $slug = strtolower(preg_replace('/[^a-zA-Z0-9\-]/', '', preg_replace('/\s+/', '-', $bookname)));
        $category = $_POST['category'];
        $authername1 = $_POST['authername1'];
        $authername2 = $_POST['authername2'];
        $authername3 = $_POST['authername3'];
        $authername4 = $_POST['authername4'];
        $authername5 = $_POST['authername5'];
        $authername6 = $_POST['authername6'];
        $date = $_POST['date'];
        $price = $_POST['price'];
        $edition = $_POST['edition'];
        $description = $_POST['content'];

        $folder = '../../uploads/';
        $file = $folder . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES['image']['tmp_name'], $file);
        $image = basename($_FILES["image"]["name"]);

        $status = '1';
        $sql = "INSERT INTO books(name,isbn,slug,category,authername1,authername2,authername3,authername4,authername5,authername6,pdate,price,edition,description,image,status) VALUES (:bookname,'" . $isbn . "','" . $slug . "','" . $category . "','" . $authername1 . "','" . $authername2 . "','" . $authername3 . "','" . $authername4 . "','" . $authername5 . "','" . $authername6 . "','" . $date . "','" . $price . "','" . $edition . "','" . $description . "','" . $image . "','" . $status . "')";
        // print_r($sql);
        // exit();
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
        $result = $query->execute();
        if ($query->rowCount() > 0) {
            echo '<script>alert("Success")</script>';
            echo '<script>window.location = "books.php";</script>';
        } else {
            echo '<script>alert("something went wrong please try again")</script>';
            echo '<script>window.location = "books.php";</script>';
        }
    } ?>




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

    <title>Create New Book | Mudra Publications</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../images/favi.jpg" />

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
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
    <script src="../ckeditor_4.19.1_standard/ckeditor/ckeditor.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>

  <body>
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
                      <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Admin / </span>Create New Book</h4>
              
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <!-- <h5 class="mb-0">Create New</h5> -->
                      <!-- <small class="text-muted float-end">Default label</small> -->
                    </div>
                    <div class="card-body">
                    <form class="forms-sample" enctype="multipart/form-data" method="POST">
                        
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Book Name</label>
                        <input type="text" class="form-control" id="bookname" name="bookname" placeholder="Book Name" required>
                    </div>
                    
                    <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">ISBN Number</label>
                          <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN Number">
                    </div>                    
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Category</label>
                    <div class="input-group">
                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                            <select class="form-select" id="category" name="category" required>
                            <?php
                            $cnt = 1;
                            $sql = "SELECT * from bookcategory ";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {
                            ?>
                            <!-- <option selected="true" disabled="disabled">Choose..</option> -->
                              <option value="<?php echo $result->name ?>"><?php echo $result->name ?></option>
                            <?php }
                            } ?>
                            </select>
                      </div>
                    </div>

                    <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Auther Name 1</label>
                          <input type="text" class="form-control" id="authername1" name="authername1" placeholder="Auther Name 1">
                    </div>
                    <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Auther Name 2</label>
                          <input type="text" class="form-control" id="authername2" name="authername2" placeholder="Auther Name 2">
                    </div>
                    <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Auther Name 3</label>
                          <input type="text" class="form-control" id="authername3" name="authername3" placeholder="Auther Name 3">
                    </div>
                    <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Auther Name 4</label>
                          <input type="text" class="form-control" id="authername4" name="authername4" placeholder="Auther Name 4">
                    </div>
                    <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Auther Name 5</label>
                          <input type="text" class="form-control" id="authername5" name="authername5" placeholder="Auther Name 5">
                    </div>
                    <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Auther Name 6</label>
                          <input type="text" class="form-control" id="authername6" name="authername6" placeholder="Auther Name 6">
                    </div>
                    <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Published Date</label>
                          <input type="date" class="form-control" id="date" name="date" placeholder="Date" required>
                    </div>
                    <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Book Price</label>
                          <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
                    </div>
                    <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Current Edition</label>
                          <input type="text" class="form-control" id="edition" name="edition" placeholder="Current Edition" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="formFile" class="form-label">Is This Premium Content ?</label>
                      <div class="input-group">
                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                            <select class="form-select" id="premium" name="premium" required>
                                                         <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                          </div>
                      </div> -->
                      <div class="mb-3">
                          <label class="form-label" for="basic-default-message">Description</label>
                          <textarea class="form-control" name="content" id="content" required></textarea>
                        </div>
                        <div class="mb-3">
                        <label for="formFile" class="form-label">Book Thumbnail</label>
                        <input class="form-control" type="file" name="image" id="image" name="image" required>
                      </div>
                        <button type="submit" name="BookBTN" id="BookBTN" class="btn btn-primary">Save</button>
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