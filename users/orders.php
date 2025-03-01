<?php include("../includes/header.php") ?>
<?php
if (!isset($_SESSION["id"])) {
  header("location: " . APPURL . "");
}
$orders = $conn->query("SELECT * FROM orders WHERE userId='$_SESSION[id]'");
$orders->execute();

$allOrders = $orders->fetchAll(PDO::FETCH_OBJ);
?>

<?php
$heroVar = (object)["title" => "Your Orders"];
include("../includes/hero.php");
?>

<section class="ftco-section ftco-cart">
  <div class="container">
    <?php if (count($allOrders)) : ?>
      <div class="row">
        <div class="col-md-12 ftco-animate">
          <div class="cart-list">
            <table class="table">
              <thead class="thead-primary">
                <tr class="text-center">
                  <!-- <th>&nbsp;</th> -->
                  <th>Full Name</th>
                  <th>State</th>
                  <th>Address</th>
                  <th>Town</th>
                  <th>Phone</th>
                  <th>Status</th>
                  <th>Price</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($allOrders as $order) : ?>
                  <tr class="text-center">
                    <!-- <td class="product-remove"><a href="delete-product.php?id=<?php echo $product->id; ?>"><span class="icon-close"></span></a></td> -->
                    <td><?php echo $order->firstname . " " . $order->lastname; ?></td>
                    <td><?php echo $order->state; ?></td>
                    <td><?php echo $order->address; ?></td>
                    <td><?php echo $order->town; ?></td>
                    <td><?php echo $order->phone; ?></td>
                    <td><?php echo $order->status; ?></td>
                    <td><?php echo number_format((float)$order->totalPrice, 2, '.', '') . "€"; ?></td>
                    <?php if ($order->status == "Delivered") : ?>
                      <td class="product-remove"><a href="<?php echo APPURL; ?>/reviews/write-review.php">Write review</a></td>
                    <?php endif ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php else : ?>
      <div class="mx-auto col-md-8 col-sm-12 text-center ftco-animate fadeInUp ftco-animated">
        <p class="mb-4 mb-md-5">No orders</p>
        <a href="<?php echo APPURL; ?>" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order now</a>
      </div>
    <?php endif ?>
  </div>
</section>

<?php include("../includes/footer.php") ?>