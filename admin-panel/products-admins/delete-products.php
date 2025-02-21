<?php
include("../layouts/header.php");
include("../../config/config.php");

// Only allow access if an admin is logged in
if (!isset($_SESSION["adminName"])) {
  header("Location: " . ADMINURL . "/admins/login-admins.php");
}

// Check if product ID is provided
if (isset($_GET["id"])) {
  $id = $_GET["id"];

  // Get the product's image filename
  $stmt = $conn->prepare("SELECT image FROM products WHERE id = :id");
  $stmt->execute([":id" => $id]);
  $product = $stmt->fetch(PDO::FETCH_OBJ);

  if ($product) {
    $image_path = $_SERVER['DOCUMENT_ROOT'] . "/coffee-blend/images/" . $product->image;

    // Check if the image file exists before deleting it
    if (file_exists($image_path)) {
      unlink($image_path); // Delete the image file
    }

    // Delete the product from the database
    $delete = $conn->prepare("DELETE FROM products WHERE id = :id");
    $delete->execute([":id" => $id]);

    header("location: " . ADMINURL . "/products-admins/show-products.php");
  } else {
    echo "<script>alert('Product not found');</script>";
  }
} else {
  echo "<script>alert('No product ID provided');</script>";
}
