<!DOCTYPE html>
<?php require('./Server.php'); ?>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="" rel="icon">
        <title>BugTracking System</title>
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/ruang-admin.min.css" rel="stylesheet">
    </head>

    <body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
            <!-- Sidebar -->
                        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    <div class="sidebar-brand-icon">
                        <img src="">
                    </div>
                    <div class="sidebar-brand-text mx-3">BugTracking System</div>
                </a>
                <hr class="sidebar-divider my-0">
                <li class="nav-item active">
                    <a class="nav-link" href="Super_admincomplaints.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Features
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
                       aria-controls="collapseTable">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Bugs</span>
                    </a>
                    <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Bugs</h6>
                            <a class="collapse-item" href="Super_admincomplaints.php">Inprocess Bugs</a>
                            <a class="collapse-item" href="Super_admincomplainsclose.php">Closed Bugs</a>
                        </div>
                    </div>
                </li>
				
				<li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
                       aria-controls="collapseForm">
                        <i class="fab fa-fw fa-wpforms"></i>
                        <span>Manage Users</span>
                    </a>
                    <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Manage Users</h6>
                            <a class="collapse-item" href="Super_adminadduser.php">Add Users</a>
                            <a class="collapse-item" href="Super_adminblockuser.php">Block Users</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="Super_profile.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Profile</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="Super_login.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Logout</span>
                    </a>
                </li>

                <hr class="sidebar-divider">
                
            </ul>
            <!-- Sidebar -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <!-- TopBar -->
                    <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <ul class="navbar-nav ml-auto">
 
                            
                            
                        </ul>
                    </nav>
                    <!-- Topbar -->


                    <!-- Container Fluid-->
                    <div class="container-fluid" id="container-wrapper">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Bugs</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bugs</li>
                            </ol>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <!-- Simple Tables -->
                                <div class="card">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Inprocess Bugs</h6>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Bug ID</th>
                                                    <th>Nic</th>
                                                    <th>date</th>
                                                    <th>Bug type</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $st = 'inprocess';
                                                $query = mysqli_query($connection, "select bug_details.*,user.nic as fname from bug_details join user on user.iduser=bug_details.user_iduser where bug_details.status='$st'");

                                                while ($row = mysqli_fetch_array($query)) {
                                                    $uid = $row['idbug_details'];
                                                    ?>										
                                                    <TR>
                                                        <td><?php echo $uid ?></td>
                                                        <td><?php echo htmlentities($row['fname']); ?></td>
                                                        <td><?php echo htmlentities($row['date']); ?></td>
                                                        <td><?php echo htmlentities($row['bug_topic']); ?></td>
                                                        <td><span class="badge badge-danger">inprocess</span></td>
                                                        <td><a href="Super_complaintsupdate.php?id=<?php echo $uid?>">update</a></td>
                                                    </TR>




                                                    </font>
                                                <font size="+3" color="red"></b>
                                            <?php } ?>

                                            </font>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer"></div>
                                </div>
                            </div>
                        </div>
                        <!--Row-->

                        <!-- Modal Logout -->
                        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to logout?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                                        <a href="login.html" class="btn btn-primary">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!---Container Fluid-->
                </div>
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>copyright &copy; <script> document.write(new Date().getFullYear());</script> - developed by
                                <b><a href="https://indrijunanda.gitlab.io/" target="_blank">ashfak</a></b>
                            </span>
                        </div>
                    </div>
                </footer>
                <!-- Footer -->
            </div>
        </div>

        <!-- Scroll to top -->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/ruang-admin.min.js"></script>

    </body>

</html>