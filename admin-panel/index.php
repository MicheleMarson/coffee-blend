<?php require("./layouts/header.php"); ?>
<?php include("../config/config.php") ?>
<?php
//only access this page if user loged in
if (!isset($_SESSION["adminName"])) {
  header("location: " . ADMINURL . "/admins/login-admins.php");
}

function getObj($req)
{
  global $conn;
  $obj = $conn->query("SELECT COUNT(*) AS count FROM $req");
  $obj->execute();
  return $obj->fetch(PDO::FETCH_OBJ);
}

$productsCount = getObj("products");

$ordersCount = getObj("orders");

$bookingsCount = getObj("bookings");

$adminsCount = getObj("admins");

?>
<div class="container-fluid">

  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Products</h5>
          <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
          <p class="card-text">number of products: <?php echo $productsCount->count ?></p>

        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Orders</h5>

          <p class="card-text">number of orders: <?php echo $ordersCount->count ?></p>

        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Bookings</h5>

          <p class="card-text">number of bookings: <?php echo $bookingsCount->count ?></p>

        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Admins</h5>

          <p class="card-text">number of admins: <?php echo $adminsCount->count ?></p>

        </div>
      </div>
    </div>
  </div>
  <!--  <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table> -->
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">

</script>
</body>

</html>