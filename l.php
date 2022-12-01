<?php
$showAlert = false;
$showError = false;
$exists = false;
$login = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Include file which makes the
  // Database Connection.
  include 'dbconnect.php';

  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "Select * from users where username='$username'";

  $result = mysqli_query($conn, $sql);

  $num = mysqli_num_rows($result);

  if ($num > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row['password'])) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        header("location: index.php");
      } else {

        $showError = true;
      }
    }
    if ($login) {
      echo 'you are logged in';
    }
  } else {
    $showError = true;
  }
}

?>


<!doctype html>

<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,
		shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<?php require 'partials/_nav.php';
if ($showError) {
  echo ' <div class="alert alert-danger
  alert-dismissible fade show" id="alert" role="alert">

  <strong>NAH!</strong> Wrong Credintials
  <button type="button" class="close"
    data-dismiss="#alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div> ';
}
?>

<div class="container my-3" style="padding: 14px">
  <h1 class="text-center">Log In</h1>
  <form action="l.php" method="post">
    <div class="mb-3">
      <label for="exampleInputEmail1" style="font-size: 20px" class="form-label">Username</label>
      <input type="text" name='username' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      <div id="emailHelp" class="form-text">We'll never share your details with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" name='password' class="form-control" id="exampleInputPassword1">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>

</html>