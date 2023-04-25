<?php

session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:login.php');
} else {
    $idE = $_GET["idE"];
    $idD = $_GET["idD"];
    if (!empty($idE)) {
        $status = '0';
        $sql = "UPDATE  news SET activeStatus='$status' WHERE id = '$idE'";
        // print_r($sql);
        // exit();
        $query = $dbh->prepare($sql);
        $query->execute();
        if ($query->rowCount() > 0) {
            $_SESSION["statusCheckDisabled"] = "success";
            echo '<script>window.location = "index.php";</script>';
        } else {
            $_SESSION["statusCheckError"] = "notsuccess";
            echo '<script>window.location = "index.php";</script>';
        }
    } elseif (!empty($idD)) {
        $status = '1';
        $sql = "UPDATE  news SET activeStatus='$status' WHERE id = '$idD'";
        // print_r($sql);
        // exit();
        $query = $dbh->prepare($sql);
        $query->execute();
        if ($query->rowCount() > 0) {
            $_SESSION["statusCheckEnabled"] = "notsuccess";
            echo '<script>window.location = "index.php";</script>';
        } else {
            $_SESSION["statusCheckError"] = "notsuccess";
            echo '<script>window.location = "index.php";</script>';
        }
    }
}
