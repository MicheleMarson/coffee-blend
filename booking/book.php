<?php include("../includes/header.php") ?>

<?php
if (isset($_POST["submit"])) {
  if (
    empty($_POST["firstname"]) or empty($_POST["lastname"]) or empty($_POST["date"])
    or empty($_POST["time"]) or empty($_POST["phone"]) or empty($_POST["message"])
  ) {
    echo "<script>alert('one or more inputs are empty');</script>";
  } else {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    $userId = $_SESSION["id"];

    if (strtotime($date) > strtotime(date("m/d/Y"))) { //check if picked date is not pased date
      $insert = $conn->prepare("INSERT INTO bookings(firstname, lastname, date, time, phone, message, userId)
      VALUES(:firstname, :lastname, :date, :time, :phone, :message, :userId)");
      $insert->execute([
        ":firstname" => $firstname,
        ":lastname" => $lastname,
        ":date" => $date,
        ":time" => $time,
        ":phone" => $phone,
        ":message" => $message,
        ":userId" => $userId,
      ]);

      header("location: " . APPURL . "/users/bookings.php");
    } else {
      header("location: " . APPURL);
    }
  }
}
