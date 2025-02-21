<?php include("../layouts/header.php") ?>
<?php include("../../config/config.php") ?>
<?php

if (!isset($_SERVER["HTTP_REFERER"])) {
  //redirect them to desired location
  header("location: " . ADMINURL . "/index.php");
  exit;
}

//only access this page if user loged in
if (!isset($_SESSION["adminName"])) {
  header("location: " . ADMINURL . "");
}

$deleteOrder = $conn->query("DELETE FROM orders WHERE id='$_GET[id]'");
$deleteOrder->execute();

header("location: show-orders.php");
