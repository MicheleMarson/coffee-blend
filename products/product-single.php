<?php include("../includes/header.php") ?>
<?php

if (isset($_GET["id"])) {
	$id = $_GET["id"];

	//data for single product
	$product = $conn->query("SELECT * FROM products WHERE id='$id'");
	$product->execute();

	$singleProduct = $product->fetch(PDO::FETCH_OBJ);
	if (!$singleProduct) {
		header("location: " . APPURL . "/404.php");
	}

	//data for related products
	$relatedProducts = $conn->query("SELECT * FROM products WHERE type='$singleProduct->type' 
	AND id!='$singleProduct->id'");

	$relatedProducts->execute();
	$allRelatedProducts = $relatedProducts->fetchAll((PDO::FETCH_OBJ));

	//add to cart
	if (isset($_POST["submit"])) {
		$name = $_POST["name"];
		$image = $_POST["image"];
		$price = $_POST["price"];
		$prodSize = $_POST["prodSize"];
		$description = $_POST["description"];
		$quantity = $_POST["quantity"];
		$prodId = $_POST["prodId"];

		$userId = $_SESSION["id"];

		$insertCart = $conn->prepare("INSERT INTO cart(name, image, price, prodSize, prodId, description ,quantity, userId)
		VALUES(:name, :image, :price, :prodSize, :prodId, :description, :quantity, :userId)");

		$insertCart->execute([
			":name" => $name,
			":image" => $image,
			":price" => $price,
			":prodSize" => $prodSize,
			":prodId" => $prodId,
			":description" => $description,
			":quantity" => $quantity,
			":userId" => $userId,
		]);

		echo "<script>alert('Product added!')</script>";
	}

	//validation for the cart
	if (isset($_SESSION["id"])) {
		$validateCart = $conn->query("SELECT * FROM cart WHERE prodId='$id' AND userId='$_SESSION[id]'");
		$validateCart->execute();

		$rowCount = $validateCart->rowCount();
	}
} else {
	header("location: " . APPURL . "/404.php");
}
?>

<?php
$heroVar = (object)["title" => "Product Detail"];
include("../includes/hero.php");
?>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mb-5 ftco-animate">
				<a href="<?php echo APPURL; ?>/images/<?php echo $singleProduct->image; ?>" class="image-popup"><img src="<?php echo APPURL; ?>/images/<?php echo $singleProduct->image; ?>" class="img-fluid" alt="Colorlib Template"></a>
			</div>
			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
				<form method="POST" action="product-single.php?id=<?php echo $id; ?>">
					<h3><?php echo $singleProduct->name; ?></h3>
					<p class="price"><span><?php echo numFormat($singleProduct); ?></span></p>
					<p><?php echo $singleProduct->description; ?></p>
					<div class="row mt-4">
						<div class="col-md-6">
							<div class="form-group d-flex">
								<div class="select-wrap">
									<div class="icon"><span class="ion-ios-arrow-down"></span></div>
									<select name="prodSize" id="prodSize" class="form-control">
										<option value="Small">Small</option>
										<option value="Medium">Medium</option>
										<option value="Large">Large</option>
										<option value="Extra Large">Extra Large</option>
									</select>
								</div>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="input-group col-md-6 d-flex mb-3">
							<span class="input-group-btn mr-2">
								<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
									<i class="icon-minus"></i>
								</button>
							</span>

							<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
							<span class="input-group-btn ml-2">
								<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
									<i class="icon-plus"></i>
								</button>
							</span>
						</div>
					</div>
					<input name="name" value="<?php echo $singleProduct->name; ?>" type="hidden" />
					<input name="image" value="<?php echo $singleProduct->image; ?>" type="hidden" />
					<input name="price" value="<?php echo $singleProduct->price; ?>" type="hidden" />
					<input name="prodId" value="<?php echo $singleProduct->id; ?>" type="hidden" />
					<input name="description" value="<?php echo $singleProduct->description; ?>" type="hidden" />
					<?php if (isset($_SESSION["id"])) : ?>
						<?php if ($rowCount > 0) : ?>
							<button style="color: white !important;" type="submit" name="submit" class="btn btn-primary py-3 px-5 disabled" disabled>Added to Cart</button>
						<?php else : ?>
							<button style="color: white !important;" type="submit" name="submit" class="btn btn-primary py-3 px-5">Add to Cart</button>
						<?php endif ?>
					<?php else: ?>
						<button style="color: white !important;" type="submit" name="submit" class="btn btn-primary disabled" disabled>Register to add product</button>
					<?php endif ?>
				</form>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-3">
			<div class="col-md-7 heading-section ftco-animate text-center">
				<span class="subheading">Discover</span>
				<h2 class="mb-4">Related products</h2>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
			</div>
		</div>
		<div class="row">
			<?php foreach ($allRelatedProducts as $prod) : ?>
				<div class="col-md-3">
					<div class="menu-entry">
						<a href="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $prod->id; ?>" class="img" style="background-image: url(<?php echo APPURL; ?>/images/<?php echo $prod->image; ?>);"></a>
						<div class="text text-center pt-4">
							<h3><a href="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $prod->id; ?>"><?php echo $prod->name; ?></a></h3>
							<p><?php echo $prod->description; ?></p>
							<p class="price"><span><?php echo numFormat($prod); ?></span></p>
							<p><a href="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $prod->id; ?>" class="btn btn-primary btn-outline-primary">Show</a></p>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</section>

<?php include("../includes/footer.php") ?>