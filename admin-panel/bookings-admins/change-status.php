<?php include("../layouts/header.php") ?>
<?php include("../../config/config.php") ?>
<?php
//only access this page if user loged in
if (!isset($_SESSION["adminName"])) {
  header("location: " . ADMINURL . "/admins/login-admins.php");
}

if (isset($_GET["id"])) {
  if (isset($_POST["submit"])) {
    if (empty($_POST["status"])) {
      echo "<script>alert('one or more inputs are empty');</script>";
    } else {
      $id = $_GET["id"];
      $status = $_POST["status"];

      $update = $conn->prepare("UPDATE bookings SET status = :status WHERE id = '$id'");
      $update->execute([
        ":status" => $status
      ]);

      header("location: " . ADMINURL . "/orders-admins/show-bookings.php");
    }
  }
} else {
  header("location: " . ADMINURL . "/orders-admins/show-bookings.php");
}
?>
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Change Status</h5>
          <form method="POST" action="change-status.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
            <div class="form-outline mb-4 mt-4">
              <select name="status" class="form-select  form-control" aria-label="Default select example">
                <option disabled selected>Status</option>
                <option value="Pending">Pending</option>
                <option value="Delivered">Delivered</option>
              </select>
            </div>
            <br>
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

</script>
</body>

</html>