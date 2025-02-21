<?php include("../layouts/header.php") ?>
<?php include("../../config/config.php") ?>
<?php
//only access this page if user loged in
if (!isset($_SESSION["adminName"])) {
  header("location: " . ADMINURL . "/admins/login-admins.php");
}

if (isset($_POST["submit"])) {
  if (
    empty($_POST["name"]) or empty($_POST["price"]) or empty($_FILES["image"]["name"])
    or empty($_POST["description"]) or empty($_POST["type"])
  ) {
    echo "<script>alert('one or more inputs are empty');</script>";
  } else {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $type = $_POST["type"];

    // Handle file upload
    $image = $_FILES["image"]["name"];
    $image_tmp = $_FILES["image"]["tmp_name"];
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/coffee-blend/images/";

    // Generate unique filename to avoid overwriting existing files
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $new_image_name = uniqid("product_", true) . "." . $image_ext;


    if (move_uploaded_file($image_tmp, $upload_dir . $new_image_name)) {
      // Insert into database
      $insert = $conn->prepare("INSERT INTO products(name, price, image, description, type)
      VALUES(:name, :price, :image, :description, :type)");

      $insert->execute([
        ":name" => $name,
        ":price" => $price,
        ":image" => $new_image_name, // Store only the new filename in DB
        ":description" => $description,
        ":type" => $type
      ]);

      header("location: " . ADMINURL . "/products-admins/show-products.php");
      exit;
    } else {
      echo "<script>alert('Error uploading image');</script>";
    }
  }
}
?>

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Create Product</h5>
          <form method="POST" action="create-products.php" enctype="multipart/form-data">
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
            </div>
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
            </div>
            <div class="form-outline mb-4 mt-4">
              <input type="file" name="image" id="form2Example1" class="form-control" />
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea name="description" class=" form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="form-outline mb-4 mt-4">
              <select name="type" class="form-select  form-control" aria-label="Default select example">
                <option disabled selected>Choose Type</option>
                <option value="drink">drink</option>
                <option value="dessert">dessert</option>
              </select>
            </div>
            <br>
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

</script>
</body>

</html>