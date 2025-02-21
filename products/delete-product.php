<?php include("../includes/header.php") ?>
<?php include("../config/config.php") ?>
<?php

if (!isset($_SESSION["id"])) {
  header("location: " . APPURL . "");
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];

  $deleteProduct = $conn->query("DELETE FROM cart WHERE id='$id'");
  $deleteProduct->execute();
  header("location: cart.php");
}
