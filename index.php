<?php

/* If the user is not logged, it is going to redirect him to the login page */
session_start();
if(!isset($_SESSION['UserData']['Username'])){
header("location:login.php");
exit;
}
/* Includes the database connection file */
include_once 'includes/dbh.php';


/* Sql query to get the datas of each row */
$sql = 'SELECT * FROM transactions;';
$result = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($result);

/* Sql query to get the datas of each row for the table */
$table_sql = 'SELECT * FROM transactions ORDER BY id DESC;';
$table_result = mysqli_query($conn, $table_sql);
$table_resultcheck = mysqli_num_rows($table_result);



/* Foreach row it does this */
if($resultcheck > 0){
  while($row = mysqli_fetch_assoc($result)){
      $type = $row['type'];
      $id = $row['id'];
      $value = $row['value'];
      /* if it is an income */
      if($type == 1){
        $money = $money + $value;
        $incomes = $incomes + $value;
      } 
      /* if it is an expenditure */
      else {
        $money = $money - $value;
        $expenditures = $expenditures + $value;
      }
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

  <title>DNDify - Homepage</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-moon"></i>
        </div>
        <div class="sidebar-brand-text mx-3">DND<sup>ify</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="submit.php">
          <i class="fas fa-fw fa-wallet"></i>
          <span>Add</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Account
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="logout.php" >
        <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </a>
      </li>



    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">


        <!-- Begin Page Content -->
        <div class="container-fluid">
<br>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Actual money -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Actual money</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $money ?>€</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-euro-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total incomes -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total incomes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $incomes ?>€</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-plus fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total expenditures -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total expenditures</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $expenditures; ?>€</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Date</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo date("d/m/Y"); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Transactions</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Type</th>
                      <th>Value</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>Date</th>
                      <th>Type</th>
                      <th>Value</th>
                      <th>Description</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php 
                    /* Foreach row it does this */
if($table_resultcheck > 0){
  while($row = mysqli_fetch_assoc($table_result)){
      $type = $row['type'];
      $value = $row['value'];
      $description = $row['description'];
      $date = $row['date'];
      /* if it is an income */
      if($type == 1){
        $type = "Income";
      } else {
        $type = "Expensure";
      }
      echo "
      <tr>
      <th>".$date."</th>
        <th>".$type."</th>
        <th>".$value."€</th>
        <th>".$description."</th>
      </tr>
      ";
  }
}
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>

      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Coded by <a href="https://moonmatt.cf">moonmatt</a> | Project on <a href="https://github.com/moonmatt/dndify">GitHub</a> </span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>


</body>

</html>
