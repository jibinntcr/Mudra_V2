<?php
session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  echo '<script>window.location = "../login.php";</script>';
} else {
  if (isset($_POST['fileBTN'])) {
    $premium = $_POST['premium'];
    if ($premium == 'No') {
      $premium = 0;
    } else if ($premium == 'Yes') {
      $premium = 1;
    }
    if (($_FILES["image"]["error"]) == '0') { //with image     
      $id = $_POST['id'];
      // $image = $_POST['OldImage'];

      $filenameEN = $_POST['filenameEn'];
      $filenameML = $_POST['filenameMl'];
      $fileNumber = $_POST['filenumber'];
      $slug = strtolower(preg_replace('/[^a-zA-Z0-9\-]/', '', preg_replace('/\s+/', '-', $filenameEN)));
      $category = $_POST['category'];
      $subcategory = $_POST['subcat'];
      $date = $_POST['date'];
      $content = $_POST['content'];


      $folder = '../../uploads/';

      $file = $folder . basename($_FILES["image"]["name"]);
      move_uploaded_file($_FILES['image']['tmp_name'], $file);
      $image = basename($_FILES["image"]["name"]);

      $sql = "UPDATE  files SET name=:filenameEN,nameML='$filenameML',filenumber='$fileNumber',slug='$slug',image='$image', category='$category',rsubcategory='$subcategory',date='$date',premium='$premium',content='$content' where id='$id'";

      $query = $dbh->prepare($sql);
      $query->bindParam(':filenameEN', $filenameEN, PDO::PARAM_STR);
      $result = $query->execute();
      if ($query->rowCount() > 0) {
        echo '<script>alert("Success")</script>';
        echo '<script>window.location = "files.php";</script>';
      } else {
        echo '<script>alert("something went wrong please try again")</script>';
        echo '<script>window.location = "files.php";</script>';
      }
    } else if (($_FILES["image"]["error"]) == '4') { // without image

      $id = $_POST['id'];
      $image = $_POST['OldImage'];

      $filenameEN = $_POST['filenameEn'];
      $filenameML = $_POST['filenameMl'];
      $fileNumber = $_POST['filenumber'];
      $slug = strtolower(preg_replace('/[^a-zA-Z0-9\-]/', '', preg_replace('/\s+/', '-', $filenameEN)));
      $category = $_POST['category'];
      $subcategory = $_POST['subcat'];
      $date = $_POST['date'];
      $content = $_POST['content'];
      // $premium = $_POST['premium'];

      $sql = "UPDATE  files SET name=:filenameEN, nameML='$filenameML',filenumber='$fileNumber',slug='$slug',image='$image', category='$category',rsubcategory='$subcategory',date='$date',premium='$premium',content='$content' where id='$id'";

      // print_r($sql);
      // exit();
      $query = $dbh->prepare($sql);
      $query->bindParam(':filenameEN', $filenameEN, PDO::PARAM_STR);
      $result = $query->execute();
      if ($query->rowCount() > 0) {
        echo '<script>alert("Success")</script>';
        echo '<script>window.location = "files.php";</script>';
      } else {
        echo '<script>alert("something went wrong please try again")</script>';
        echo '<script>window.location = "files.php";</script>';
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

    <title>Edit Files | Mudra Publications</title>

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
    <script src="../ssets/js/config.js"></script>
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
                <span class="text-muted fw-light">Admin / </span> Edit Files</h4>
              
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <!-- <h5 class="mb-0">Edit Category</h5> -->
                      <!-- <small class="text-muted float-end">Default label</small> -->
                    </div>
                    <div class="card-body">
                    <form class="forms-sample" enctype="multipart/form-data" method="POST">
                                <?php
                                $id = $_GET['id'];
                                $sql = "SELECT * from files where id=$id ";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $userArr = $query->fetchAll(PDO::FETCH_OBJ);
                                if ($query->rowCount() > 0) {
                                ?>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">File Name in English</label>
                        <input type="hidden" id="id" name="id" value="<?php echo htmlentities($userArr[0]->id); ?>" />
                        <input type="hidden" id="OldImage" name="OldImage" value="<?php echo ($userArr[0]->image); ?>" />
                        <input type="text" class="form-control" id="filenameEn" name="filenameEn" placeholder="File Name In English" value="<?php echo htmlentities($userArr[0]->name); ?>">
                    </div>
                    
                    <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">File Name in Malayalam</label>
                          <input type="text" class="form-control" id="filenameMl" name="filenameMl" placeholder="File Name in Malayalam" value="<?php echo htmlentities($userArr[0]->nameML); ?>">
                    </div>

                    <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">File Number</label>
                          <input type="text" class="form-control" id="filenumber" name="filenumber" placeholder="File Number" value="<?php echo htmlentities($userArr[0]->filenumber); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Category</label>
                    <div class="input-group">
                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                            <select class="form-select" id="category" name="category">
                            <option selected="true" value="<?php echo ($userArr[0]->category); ?>"><?php echo ($userArr[0]->category); ?></option>
                            <?php
                                  $cnt = 1;
                                  $sql = "SELECT name from category ";
                                  $query = $dbh->prepare($sql);
                                  $query->execute();
                                  $results = $query->fetchAll(PDO::FETCH_OBJ);

                                  if ($query->rowCount() > 0) {
                                    foreach ($results as $catresult) {
                            ?>
                            <!-- <option selected="true" disabled="disabled">Choose..</option> -->
                              <option value="<?php echo $catresult->name ?>"><?php echo $catresult->name ?></option>
                            <?php }
                                  } ?>
                            </select>
                      </div>
                    </div>

                    <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Sub Category</label>
                          <input type="text" class="form-control" id="subcat" name="subcat" placeholder="Sub Category" value="<?php echo ($userArr[0]->rsubcategory); ?>">
                    </div>
                    <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Date</label>
                          <input type="date" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo $userArr[0]->date ?>">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Is This Premium Content ?</label>
                      <div class="input-group">
                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                            <select class="form-select" id="premium" name="premium">
                            <!-- <option selected="true" disabled="disabled">Choose..</option> -->

                            <?php
                                  $prcontent = $userArr[0]->premium;
                                  if ($prcontent == 0) {
                                    $prc = 'No';
                                  } else if ($prcontent == 1) {
                                    $prc = 'Yes';
                                  }
                            ?>
                
                            <option selected="true" value="<?php echo $prc; ?>"><?php echo $prc; ?></option>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                          </div>
                      </div>
                      <div class="mb-3">
                          <label class="form-label" for="basic-default-message">Content</label>
                          <textarea class="form-control" name="content" id="content"><?php echo ($userArr[0]->content); ?></textarea>
                        </div>
                        <div class="mb-3">
                        <label for="formFile" class="form-label">File : <?php echo $userArr[0]->image; ?></label>
                        <input class="form-control" type="file" name="image" id="image" name="image" >
                      </div>
                        <button type="submit" name="fileBTN" id="fileBTN" class="btn btn-primary">Save</button><?php }
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