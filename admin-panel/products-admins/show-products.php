<?php include("../layouts/header.php") ?>
<?php include("../../config/config.php") ?>
<?php
//only access this page if user loged in
if (!isset($_SESSION["adminName"])) {
  header("location: " . ADMINURL . "/admins/login-admins.php");
}

$products = $conn->query("SELECT * FROM products");
$products->execute();

$allProducts = $products->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Foods</h5>
          <a href="create-products.php" class="btn btn-primary mb-4 text-center float-right">Create Products</a>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Type</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($allProducts as $product) : ?>
                <tr>
                  <th scope="row"><?php echo $product->id; ?></th>
                  <td><?php echo $product->name; ?></td>
                  <td><img width="60" height="60" style="object-fit: cover;" src="http://localhost/coffee-blend/images/<?php echo $product->image; ?>" /></td>
                  <td><?php echo numFormat($product); ?></td>
                  <td><?php echo $product->type; ?></td>
                  <td><a href="delete-products.php?id=<?php echo $product->id; ?>" class="btn btn-danger  text-center ">Delete</a></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>



</div>
<script type="text/javascript">
</script>
</body>

</html>