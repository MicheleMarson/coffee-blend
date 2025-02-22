<?php include("../includes/header.php") ?>
<?php
//dont allow user to go to checkout if there is no products inside
if (!isset($_SERVER["HTTP_REFERER"])) {
  //redirect them to desired location
  header("location: http://localhost/coffee-blend/index.php");
}

//only access this page if user loged in
if (!isset($_SESSION["username"])) {
  header("location: " . APPURL . "");
}

if (isset($_POST["submit"])) {
  if (empty($_POST["review"])) {
    echo "<script>alert('one or more inputs are empty');</script>";
  } else {
    $review = $_POST["review"];

    $writeReview = $conn->prepare("INSERT INTO reviews (review, username, userId) 
    VALUES(:review, :username, :userId)");

    $writeReview->execute([
      ":review" => $review,
      ":username" => $_SESSION["username"],
      ":userId" => $_SESSION["id"],
    ]);

    header("location: http://localhost/coffee-blend/index.php");
  }
}
?>

<section class="home-slider owl-carousel">
  <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center">

        <div class="col-md-7 col-sm-12 text-center ftco-animate">
          <h1 class="mb-3 mt-5 bread">Write review</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Write review</span></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 ftco-animate">
        <form action="write-review.php" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
          <h3 class="mb-4 billing-heading">Write review</h3>
          <div class="row align-items-end">
            <div class="col-md-6">
              <div class="form-group">
                <label for="firstname">Review</label>
                <input name="review" type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mt-4">
                <div class="radio">
                  <button type="submit" name="submit" class="btn btn-primary py-3 px-4">Send</button>
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