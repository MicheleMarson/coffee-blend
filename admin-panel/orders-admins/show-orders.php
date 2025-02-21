<?php include("../layouts/header.php") ?>
<?php include("../../config/config.php") ?>
<?php
//only access this page if user loged in
if (!isset($_SESSION["adminName"])) {
  header("location: " . ADMINURL . "/admins/login-admins.php");
}

$orders = $conn->query("SELECT * FROM orders");
$orders->execute();

$allOrders = $orders->fetchAll(PDO::FETCH_OBJ);

?>
<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card-list">
          <div class="card-body">
            <h5 class="card-title mb-4 d-inline">Orders</h5>

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Full Name</th>
                  <th scope="col">Town</th>
                  <th scope="col">State</th>
                  <th scope="col">Zip</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Street Address</th>
                  <th scope="col">Total Price</th>
                  <th scope="col">Status</th>
                  <th scope="col">Change Status</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($allOrders as $order) : ?>
                  <tr>
                    <th scope="row"><?php echo $order->id; ?></th>
                    <td><?php echo $order->firstname . " " . $order->lastname; ?></td>
                    <td><?php echo $order->town; ?></td>
                    <td><?php echo $order->state; ?></td>
                    <td>
                      <?php echo $order->zipCode; ?>
                    </td>
                    <td><?php echo $order->phone; ?></td>
                    <td><?php echo $order->address; ?></td>
                    <td><?php echo $order->totalPrice; ?></td>

                    <td><?php echo $order->status; ?></td>
                    <td><a href="change-status.php?id=<?php echo $order->id; ?>" class="btn btn-warning  text-center ">Change</a></td>
                    <td><a href="delete-orders.php?id=<?php echo $order->id; ?>" class="btn btn-danger  text-center ">Delete</a></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">

</script>
</body>

</html>