<?php
include("db_connect.php");
error_reporting(0);
$edit_state = false;


//delete
if (isset($_POST["removed"])) {
    $id = $_POST['removed'];
    try {
        $sql = "DELETE FROM scheduledetails where scheduleDetail_id = $id limit 1";
        mysqli_query($connection, $sql);
        // header("location: movie.php");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    header("location: scheduleDetail.php");
}
//edit
if (isset($_POST['edits'])) {
    $edit_state = true;
    $scheduleDetail_id = $_POST['edits'];

    try {
        $sql = "SELECT scheduleDetail_id,movie_id,start_time,end_time,
        ticket_price FROM scheduledetails where scheduleDetail_id = $scheduleDetail_id limit 1";
        $result = mysqli_query($connection, $sql);
        $row = $result->fetch_assoc();
    
        $movie_id = $row['movie_id'];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];
        $hall_branch_id = $row['hall_branch_id'];
        $ticket_price = $row['ticket_price'];

        $query = "SELECT movie_title from movies where movie_id = $movie_id limit 1";
        $resultt = $connection->query($query);
        $row = $resultt->fetch_assoc();
        $movie_title = $row['movie_title'];
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
//update
if (isset($_POST['updates'])) {
    $edit_state = false;
    $id = $_POST['updates'];
    $movie_id = $_POST['movie_id'];
    $ticket_price = $_POST['ticket_price'];
    $sql = "UPDATE scheduledetails SET ticket_price = '$ticket_price', movie_id='$movie_id' WHERE scheduleDetail_id = $id LIMIT 1";
    mysqli_query($connection, $sql);
    if (mysqli_errno($connection) > 0) {
        die(mysqli_error($connection));
    }
    header("location: scheduleDetail.php");
}
// If upload button is clicked ...
if (isset($_POST['uploads'])) {
    $end_date = $_POST['End_date'];
    $end_date = date('y-m-d H:i:s', strtotime($end_date));
    $start_date = $_POST['Start_date'];
    $start_date = date('Y-m-d h:i:s', strtotime($start_date));
    if ($start_date < date("Y-m-d H:i:s")) {
        print("<h1>Start Date must be in the future. Thanks!</h1>");
        echo $start_date . "<br>";
        echo date("Y/m/d H:i:s");
        goto A;
    }
    $ticket_price = $_POST['ticket_price'];
    $hall_id = $_POST['hall_id'];
    $branch_id = $_POST['branch_id'];
    $movie_id = $_POST['movie_id'];


    $sql = 'SELECT hall_branch_id FROM Branches_Halls WHERE
	branch_id=' . $branch_id . ' and hall_id =' . $hall_id;
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $hall_branch_id = $row['hall_branch_id'];
    $sql = "INSERT INTO scheduledetails (scheduleDetail_id, schedule_id, movie_id, start_time, end_time,hall_branch_id, ticket_price) 
            VALUES (NULL, NULL,$movie_id,'$start_date','$end_date',$hall_branch_id,$ticket_price)";
    mysqli_query($connection, $sql);
    A:
}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="booking.php" class="nav-link">Booking</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="movie.php" class="nav-link">Movies</a>
                </li>

                <li class="nav-item d-none d-sm-inline-block">
                    <a href="scheduleDetail.php" class="nav-link">Schedule Details</a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../pages/index.php" class="brand-link">
                <img src="dist/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">ADMIN</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="movie.php" class="d-block">Alexander Pierce</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Starter Pages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="booking.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>booking</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="movie.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Movie</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="scheduleDetail.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Schedule Details</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--  -->
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="row">

                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">


                        <div class="col-sm-2"></div>
                        <!-- object/ -->
                        <div class="col-sm-8">
                            <form method="POST" action="" enctype="multipart/form-data">

                                <?php
                                $sql = "SELECT branch_id, branch_name FROM branches";
                                $result = $connection->query($sql);
                                if ($result->num_rows > 0) { ?>
                                    <select class="form-control" id="exampleFormControlSelect1" name="branch_id">
                                        <?php while ($row = $result->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['branch_id'] ?>"> <?php echo $row['branch_name'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                <?php }
                                ?>
                                <br>
                                <?php
                                $sql = "SELECT movie_id, movie_title FROM movies";
                                $result = $connection->query($sql);
                                if ($result->num_rows > 0) { ?>
                                    <select class="form-control" id="exampleFormControlSelect1" name="movie_id">
                                        <?php while ($row = $result->fetch_assoc()) {
                                            if ($row['movie_id'] == $movie_id) { ?>
                                                <option selected value="<?php echo $row['movie_id'] ?>"> <?php echo $row['movie_title'] ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $row['movie_id'] ?>"> <?php echo $row['movie_title'] ?></option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                <?php }
                                ?>
                                <br>
                                <?php
                                $sql = "SELECT hall_id, hall_name FROM halls";
                                $result = $connection->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                ?>
                                    <select class="form-control" id="exampleFormControlSelect1" name="hall_id">
                                        <?php while ($row = $result->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['hall_id'] ?>"> <?php echo $row['hall_name'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                <?php }
                                ?>
                                <br>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="ticket_price" value="<?php echo $ticket_price ?>" placeholder="Ticket Price" />
                                </div>
                                <br>
                                <label>Start time</label>
                                <div class="form-group">
                                    <input class="form-control" type="datetime-local" name="Start_date" />
                                </div>
                                <label>End time</label>
                                <div class="form-group">
                                    <input class="form-control" type="datetime-local" name="End_date" />
                                </div>
                                <div class="form-group">
                                    <?php if ($edit_state == false) { ?>
                                        <button class="btn btn-success" type="submit" name="uploads">SAVE</button>
                                    <?php } else { ?>
                                        <button class="btn btn-success" type="submit" value="<?php echo $scheduleDetail_id ?>" name="updates">UPDATE</button>
                                    <?php } ?>
                                </div>
                            </form>
                        </div>


                        <!-- end object -->
                        <div class="col-sm-2"></div>


                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>

</html>