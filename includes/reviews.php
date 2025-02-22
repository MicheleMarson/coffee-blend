<?php

$reviews = $conn->query("SELECT * FROM reviews ORDER BY created_at DESC LIMIT 5");
$reviews->execute();

$allReviews = $reviews->fetchAll(PDO::FETCH_OBJ);

?>
<section class="ftco-section img" id="ftco-testimony" style="background-image: url(images/bg_1.jpg);" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 heading-section text-center ftco-animate">
        <span class="subheading">Testimony</span>
        <h2 class="mb-4">Customers Says</h2>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
      </div>
    </div>
  </div>
  <div class="container-wrap">
    <div class="row d-flex no-gutters">
      <?php foreach ($allReviews as $review) : ?>
        <div class="col-lg align-self-sm-end ftco-animate">
          <div class="testimony">
            <blockquote>
              <p>&ldquo;<?php echo $review->review; ?>&rdquo;</p>
            </blockquote>
            <div class="author d-flex mt-4">
              <div class="image mr-3 align-self-center">
                <img src="images/person_1.jpg" alt="">
              </div>
              <div class="name align-self-center"><?php echo $review->username; ?></div>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>