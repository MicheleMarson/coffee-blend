<?php include("../layouts/header.php") ?>
<?php include("../../config/config.php") ?>
<?php
//only access this page if user loged in
if (!isset($_SESSION["adminName"])) {
  header("location: " . ADMINURL . "/admins/login-admins.php");
}

$bookings = $conn->query("SELECT * FROM bookings");
$bookings->execute();

$allBookings = $bookings->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Bookings</h5>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Full Name</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Phone</th>
                <th scope="col">Message</th>
                <th scope="col">Status</th>
                <th scope="col">Change Status</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($allBookings as $booking) : ?>
                <tr>
                  <th scope="row"><?php echo $booking->id; ?></th>
                  <td><?php echo $booking->firstname . " " . $booking->lastname; ?></td>
                  <td><?php echo $booking->date; ?></td>
                  <td><?php echo $booking->time; ?></td>
                  <td><?php echo $booking->phone; ?></td>
                  <td><?php echo $booking->message; ?></td>
                  <td><?php echo $booking->status; ?></td>
                  <td><a href="change-status.php?id=<?php echo $booking->id; ?>" class="btn btn-warning  text-center ">Change</a></td>
                  <td><a href="delete-bookings.php?id=<?php echo $booking->id; ?>" class="btn btn-danger  text-center ">Delete</a></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
</script>
</body>

</html>