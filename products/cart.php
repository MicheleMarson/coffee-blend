<?php include("../includes/header.php") ?>
<?php

$delivery = number_format((float)10, 2, '.', '');
$discount = number_format((float)3, 2, '.', '');

if (!isset($_SESSION["id"])) {
	header("location: " . APPURL . "");
}
$products = $conn->query("SELECT * FROM cart WHERE userId='$_SESSION[id]'");
$products->execute();

$allProducts = $products->fetchAll(PDO::FETCH_OBJ);

//get total cart price
$cartTotal = $conn->query("SELECT SUM(quantity*price) AS price FROM cart  WHERE userId='$_SESSION[id]'");
$cartTotal->execute();

$allCartTotal = $cartTotal->fetch(PDO::FETCH_OBJ);

//proceed to checkout
if (isset($_POST["checkout"])) {
	$_SESSION["totalPrice"] = $_POST["totalPrice"];

	header("location: checkout.php");
}
?>

<?php
$heroVar = (object)["title" => "Cart"];
include("../includes/hero.php");
?>

<section class="ftco-section ftco-cart">
	<div class="container">
		<?php if (count($allProducts)) : ?>
			<div class="row">
				<div class="col-md-12 ftco-animate">
					<div class="cart-list">
						<table class="table">
							<thead class="thead-primary">
								<tr class="text-center">
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>Product</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($allProducts as $product) : ?>
									<tr class="text-center">
										<td class="product-remove"><a href="delete-product.php?id=<?php echo $product->id; ?>"><span class="icon-close"></span></a></td>
										<td class="image-prod">
											<div class="img" style="background-image:url(<?php echo APPURL; ?>/images/<?php echo $product->image; ?>);"></div>
										</td>
										<td class="product-name">
											<h3><?php echo $product->name; ?></h3>
											<p><?php echo $product->description; ?></p>
										</td>
										<td class="price"><?php echo numFormat($product); ?></td>
										<td>
											<div class="input-group mb-3">
												<input disabled type="text" name="quantity" class="quantity form-control input-number" value="<?php echo $product->quantity; ?>" min="1" max="100">
											</div>
										</td>
										<td class="total"><?php echo numFormat($product, $product); ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row justify-content-end">
				<div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
					<div class="cart-total mb-3">
						<h3>Cart Totals</h3>
						<p class="d-flex">
							<span>Subtotal</span>
							<span><?php echo numFormat($allCartTotal); ?></span>
						</p>
						<p class="d-flex">
							<span>Delivery</span>
							<span><?php echo $delivery; ?>€</span>
						</p>
						<p class="d-flex">
							<span>Discount</span>
							<span><?php echo $discount; ?>€</span>
						</p>
						<hr>
						<p class="d-flex total-price">
							<span>Total</span>
							<span><?php echo number_format((float)$allCartTotal->price + $delivery - $discount, 2, '.', '');; ?>€</span>
						</p>
					</div>
					<form method="POST" action="cart.php">
						<input name="totalPrice" type="hidden" value="<?php echo $allCartTotal->price + $delivery - $discount; ?>" />
						<p class="text-center"><button style="color: white !important;" name="checkout" type="submit" class="btn btn-primary py-3 px-4">Proceed to Checkout</button></p>
					</form>
				</div>
			</div>
		<?php else : ?>
			<div class="mx-auto col-md-8 col-sm-12 text-center ftco-animate fadeInUp ftco-animated">
				<p class="mb-4 mb-md-5">Your cart is empty</p>
				<a href="<?php echo APPURL; ?>/menu.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a>
			</div>
		<?php endif ?>
	</div>
</section>

<!-- <section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-3">
			<div class="col-md-7 heading-section ftco-animate text-center">
				<span class="subheading">Discover</span>
				<h2 class="mb-4">Related products</h2>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="menu-entry">
					<a href="#" class="img" style="background-image: url(images/menu-1.jpg);"></a>
					<div class="text text-center pt-4">
						<h3><a href="#">Coffee Capuccino</a></h3>
						<p>A small river named Duden flows by their place and supplies</p>
						<p class="price"><span>$5.90</span></p>
						<p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="menu-entry">
					<a href="#" class="img" style="background-image: url(images/menu-2.jpg);"></a>
					<div class="text text-center pt-4">
						<h3><a href="#">Coffee Capuccino</a></h3>
						<p>A small river named Duden flows by their place and supplies</p>
						<p class="price"><span>$5.90</span></p>
						<p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="menu-entry">
					<a href="#" class="img" style="background-image: url(images/menu-3.jpg);"></a>
					<div class="text text-center pt-4">
						<h3><a href="#">Coffee Capuccino</a></h3>
						<p>A small river named Duden flows by their place and supplies</p>
						<p class="price"><span>$5.90</span></p>
						<p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="menu-entry">
					<a href="#" class="img" style="background-image: url(images/menu-4.jpg);"></a>
					<div class="text text-center pt-4">
						<h3><a href="#">Coffee Capuccino</a></h3>
						<p>A small river named Duden flows by their place and supplies</p>
						<p class="price"><span>$5.90</span></p>
						<p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section> -->

<?php include("../includes/footer.php") ?>