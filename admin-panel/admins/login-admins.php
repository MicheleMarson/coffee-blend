<?php include("../layouts/header.php") ?>
<?php include("../../config/config.php") ?>
<?php
//only access this page if user loged in
if (isset($_SESSION["adminName"])) {
  header("location: " . ADMINURL . "/admins/admins.php");
}

if (isset($_POST["submit"])) {
  if (empty($_POST["email"]) or empty($_POST["password"])) {
    echo "<script>alert('one or more inputs are empty');</script>";
  } else {
    $email = $_POST["email"];
    $password = $_POST["password"];

    //check for email
    $login = $conn->query("SELECT * FROM admins WHERE email='$email'");
    $login->execute();

    $fetch = $login->fetch(PDO::FETCH_ASSOC);

    if ($login->rowCount() > 0) {
      if (password_verify($password, $fetch["password"])) {
        //start session
        $_SESSION["adminName"] = $fetch["adminname"];
        $_SESSION["adminEmail"] = $fetch["email"];
        $_SESSION["adminId"] = $fetch["id"];

        header("location: " . ADMINURL . "");
      } else {
        echo "<script>alert('email or password is incorect');</script>";
      }
    } else {
      echo "<script>alert('email or password is incorect');</script>";
    }
  }
}

?>
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mt-5">Login</h5>
          <form method="POST" class="p-auto" action="login-admins.php">
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
            </div>
            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
            </div>
            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>