<!DOCTYPE html>
<?php
  include "connectdb.php";
  $sql1 = "SELECT COUNT(user_plant_category) AS cpramong FROM bot_log where user_plant_category = 'ประมง'";
  $result1 = $mysql->query($sql1); 
  while($row1 = mysqli_fetch_assoc($result1)){
    $cpramong = $row1['cpramong'];
  }
  $sql2 = "SELECT COUNT(user_plant_category) AS cphertsuan FROM bot_log where user_plant_category = 'พืชสวน'";
  $result2 = $mysql->query($sql2); 
  while($row2 = mysqli_fetch_assoc($result2)){
    $cphertsuan = $row2['cphertsuan'];
  }
  $sql3 = "SELECT COUNT(user_plant_category) AS cphert FROM bot_log where user_plant_category = 'พืชไร่'";
  $result3 = $mysql->query($sql3); 
  while($row3 = mysqli_fetch_assoc($result3)){
    $cphert = $row3['cphert'];
  }
  $sql4 = "SELECT COUNT(user_plant_category) AS cprasusat FROM bot_log where user_plant_category = 'ปศุสัตว์'";
  $result4 = $mysql->query($sql4); 
  while($row4 = mysqli_fetch_assoc($result4)){
    $cprasusat = $row4['cprasusat'];
  }
  $dataPoints = array( 
    array("label"=>"ประมง", "y"=>$cpramong),
    array("label"=>"พืชไร่", "y"=>$cphert),
    array("label"=>"ปศุสัตว์", "y"=>$cprasusat),
    array("label"=>"พืชสวน", "y"=>$cphertsuan)
    )
?>
<html lang="en">

<script>
window.onload = function() {
 
 
 var chart = new CanvasJS.Chart("chartContainer", {
   theme: "light2",
   animationEnabled: true,
   data: [{
     type: "pie",
     indexLabel: "{y}",
     yValueFormatString: "#,##0.00\"%\"",
     indexLabelPlacement: "inside",
     indexLabelFontColor: "#FFFFFF",
     indexLabelFontSize: 18,
     indexLabelFontWeight: "bolder",
     showInLegend: true,
     legendText: "{label}",
     dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
   }]
 });
 chart.render();
  
 }
</script>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Line Chatbot - Tables</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">LINE Chatbot Chaokaset</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Tables -->
      <li class="nav-item active">
        <a class="nav-link" href="tables.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
     <!-- Heading -->
     <div class="sidebar-heading">
     conclude
      </div>

      <!-- Nav Item - Charts -->
      <li class="nav-item active">
        <a class="nav-link" href="charts.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>
      <!-- Nav Item - News -->
      <li class="nav-item active">
        <a class="nav-link" href="news.php">
          <i class="fas fa-fw fa-folder"></i>
          <span>News</span></a>
      </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->


        </nav>

        <!-- End of Topbar -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Charts</h1>
          <p class="mb-4">Chart.js is a third party plugin that is used to generate the charts in this theme. The charts below have been customized - for further customization options, please visit the <a target="_blank" href="https://www.chartjs.org/docs/latest/">official Chart.js documentation</a>.</p>

          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-12 col-lg-7">
            <!-- pie Chart -->
            <div class="col-md-12 py-6">
                <div class="card shadow lg-24">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Pie Chart</h6>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                  <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                      
                  </div>
                </div>
            </div>

            <!-- Donut Chart -->
          </div>
          </div>
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <br>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">Table showing information of users who are following LINE Chatbot Chaokaset</a>.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Users following LINE Chatbot Chaokaset</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>User ID</th>
                      <th>Plant Category</th>
                      <th>User Address</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    //include "connectdb.php";
                    $query = "SELECT * FROM bot_log"; 
                    $result = $mysql->query($query); 
                    while($row = mysqli_fetch_assoc($result)){
                      echo "<tr>  
                            <td>".$row['user_id']."</td>
                            <td>".$row['user_plant_category']."</td>
                            <td colspan=\"3\">".$row['user_address']."</td>
                            </tr>";
                    }
                    ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Chaokaset &copy; NECTEC 2020</span>
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

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
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

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>

</html>
