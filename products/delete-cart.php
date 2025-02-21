<?php include("../includes/header.php") ?>
<?php include("../config/config.php") ?>
<?php

if (!isset($_SERVER["HTTP_REFERER"])) {
  //redirect them to desired location
  header("location: http://localhost/coffee-blend/index.php");
  exit;
}

//only access this page if user loged in
if (!isset($_SESSION["username"])) {
  header("location: " . APPURL . "");
}

$deleteAll = $conn->query("DELETE FROM cart WHERE userId='$_SESSION[id]'");
$deleteAll->execute();

header("location: cart.php");
