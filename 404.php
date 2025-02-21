<?php include("includes/header.php") ?>
<?php include("config/config.php") ?>

<section class="home-slider owl-carousel">
  <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center">
        <div class="col-md-7 col-sm-12 text-center ftco-animate">
          <h1 class="mb-3 mt-5 bread">404 Page not Found</h1>
          <a href="<?php echo APPURL; ?>/index.php" type="submit" name="submit" class="btn btn-primary py-3 px-4">Home</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include("includes/footer.php") ?>