<?php

session_start(); /* Starts the session */
/* Checks if the user is logged */
if(!isset($_SESSION['UserData']['Username'])){
  header("location:login.php");
  exit;
}

/* Includes the database connection file */
include_once 'includes/dbh.php';

/* Check if form is submitted */
if(isset($_POST['submit'])){
  $value = mysqli_real_escape_string($conn, $_POST['value']);
  $type = mysqli_real_escape_string($conn, $_POST['type']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $date = mysqli_real_escape_string($conn, $_POST['date']);
  $value = str_replace(",", ".", $value);
  $value = str_replace("-", "", $value);

  /* If description is longer than 70 characters */
  if(strlen($description) > 70){
    /*Unsuccessful attempt: Set error message */
  $message = "The description is too long";
  echo "<script type='text/javascript'>alert('$message');</script>";
  }

  /* Add new row in database */
  $sql = "INSERT INTO transactions (date, value, type, description)
  VALUES ('$date', '$value', '$type', '$description')";

  if ($conn->query($sql) === TRUE) {
      header("location: index.php");
      die();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Submit - DNDify</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Insert your datas</h1>
                  </div>
                  <form class="user" method="POST" action="">
                    <div class="form-group">
                    <input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="date">
                      <input type="number" class="form-control form-control-user" id="value" name="value" aria-describedby="value" placeholder="Money" step="0.01" min="0" max="1000000000000" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="description" name="description" placeholder="Description" maxlength="70" required>
                    </div>
                    <div class="form-group">
                    <select name="type" id="type" class="form-control" required>
                    <option value="1">Income</option>
                    <option value="0">Expenditure</option>
                    </select>
                    </div>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-user btn-block">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
