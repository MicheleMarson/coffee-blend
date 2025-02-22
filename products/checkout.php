<?php include("../includes/header.php") ?>
<?php
//dont allow user to go to checkout if there is no products inside
if (!isset($_SERVER["HTTP_REFERER"])) {
	//redirect them to desired location
	header("location: http://localhost/coffee-blend/index.php");
	exit;
}

//only access this page if user loged in
if (!isset($_SESSION["username"])) {
	header("location: " . APPURL . "");
}

if (isset($_POST["submit"])) {
	if (
		empty($_POST["firstname"]) or empty($_POST["lastname"]) or empty($_POST["state"])
		or empty($_POST["address"]) or empty($_POST["town"]) or empty($_POST["zipCode"])
		or empty($_POST["phone"]) or empty($_POST["email"])
	) {
		echo "<script>alert('one or more inputs are empty');</script>";
	} else {
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$state = $_POST["state"];
		$address = $_POST["address"];
		$town = $_POST["town"];
		$zipCode = $_POST["zipCode"];
		$phone = $_POST["phone"];
		$email = $_POST["email"];
		$userId = $_SESSION["id"];
		$status = "Pending";
		$totalPrice = $_SESSION["totalPrice"];

		$placeOrders = $conn->prepare("INSERT INTO orders (firstname, lastname, state, address, town, 
		zipCode, phone, email, status, userId, totalPrice) VALUES(:firstname, :lastname, :state, :address, :town, 
		:zipCode, :phone, :email, :status, :userId, :totalPrice)");

		$placeOrders->execute([
			":firstname" => $firstname,
			":lastname" => $lastname,
			":state" => $state,
			":address" => $address,
			":town" => $town,
			":zipCode" => $zipCode,
			":phone" => $phone,
			":email" => $email,
			":status" => $status,
			":userId" => $userId,
			":totalPrice" => $totalPrice
		]);

		header("location: pay.php");
	}
}

?>

<section class="home-slider owl-carousel">
	<div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center">

				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">Checkout</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checout</span></p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<form action="checkout.php" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
					<h3 class="mb-4 billing-heading">Billing Details</h3>
					<div class="row align-items-end">
						<div class="col-md-6">
							<div class="form-group">
								<label for="firstname">Firt Name</label>
								<input name="firstname" type="text" class="form-control" placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="lastname">Last Name</label>
								<input name="lastname" type="text" class="form-control" placeholder="">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="country">State / Country</label>
								<div class="select-wrap">
									<div class="icon"><span class="ion-ios-arrow-down"></span></div>
									<select name="state" id="state" class="form-control">
										<option value="France">France</option>
										<option value="Italy">Italy</option>
										<option value="Philippines">Philippines</option>
										<option value="South Korea">South Korea</option>
										<option value="Hong Kong">Hong Kong</option>
										<option value="Japan">Japan</option>
									</select>
								</div>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="streetaddress">Street Address</label>
								<input name="address" type="text" class="form-control" placeholder="House number and street name">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="towncity">Town / City</label>
								<input name="town" type="text" class="form-control" placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="postcodezip">Postcode / ZIP *</label>
								<input name="zipCode" type="text" class="form-control" placeholder="">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="phone">Phone</label>
								<input name="phone" type="text" class="form-control" placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="email">Email Address</label>
								<input name="email" type="text" class="form-control" placeholder="">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<div class="form-group mt-4">
								<div class="radio">
									<button type="submit" name="submit" class="btn btn-primary py-3 px-4">Place an order</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div> <!-- .col-md-8 -->
		</div>
	</div>
	</div>
</section> <!-- .section -->

<?php include("../includes/footer.php") ?>