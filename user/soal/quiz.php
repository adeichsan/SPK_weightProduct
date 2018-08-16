<?php
include '../../checkLogin.php';
?>
<?php 
                include "../../connect.php";
                $ID_MHS = $_SESSION['ID_MHS'];  
                $ID_PRODI = $_SESSION['ID_PRODI'];
                $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE ID_MHS = '$ID_MHS' and ID_PRODI = '$ID_PRODI'");
                $result = mysqli_fetch_array($query);
 ?>
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/logo.png">
    <title>Monster Admin Template - The Most Complete & Trusted Bootstrap 4 Admin Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/User/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS USER -->
    <link href="../../assets/User/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here RED-->
    <link href="../../assets/User/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="../index.php">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../../assets/logo.png" width="33px" height="34px" alt="homepage" class="dark-logo" />
                            
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                            <!-- dark Logo text -->
                            <label style="font-size: x-small;">SPK PEMINATAN MATA KULIAH PILIHAN</label>
                        </span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
            <ul class="nav navbar-right top-nav">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i style="padding-right: inherit;" class="fa fa-user"></i><?php echo $result['NAMA_DEPAN'] ?> <?php echo $result['NAMA_BELAKANG'] ?>
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li style="margin-bottom: 10px;margin-left: 10px;">
                    <a href="../mhs/profil.php"><i style="padding-right: inherit;" class="fa fa-fw fa-user"></i> Profile</a>
                  </li>
                  <li style="margin-bottom: 10px;margin-left: 10px;">
                    <a href="../logout.php"><i style="padding-right: inherit;" class="fa fa-fw fa-power-off"></i> Log Out</a>
                  </li>
                </ul>
              </div>
            </div>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <a href="../index.php" class="waves-effect"><i class="fa fa-clock-o m-r-10" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="../mhs/tambahNilai.php" class="waves-effect"><i class="fa fa-user m-r-10" aria-hidden="true"></i>Tambah Nilai</a>
                        </li>
                        <?php
                            $query = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM nilai_mk WHERE ID_MHS = '$ID_MHS'");
                            $result = mysqli_fetch_array($query);
                            $nilai = $result['jumlah'];
                            if ( $result["jumlah"] > 0 ) {        
                                echo "<li>
                                <a href='quiz.php' class='waves-effect'><i class='fa fa-edit m-r-10' aria-hidden='true'></i>Tes Kemampuan</a>
                                </li>";
                            }
                        ?>
                        <?php
                            $query = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM hasiltkd WHERE ID_MHS = '$ID_MHS'");
                            $result = mysqli_fetch_array($query);
                            $b = $result['jumlah'];
                            $query1 = mysqli_query($koneksi, "SELECT COUNT(*) as alternatif FROM alternatif WHERE ID_PRODI = '$ID_PRODI'");
                            $result = mysqli_fetch_array($query1);
                            $a = $result['alternatif'];
                            if ($a === $b) {        
                                echo "<li>
                                        <a href='../spk/peminatanSPK.php' class='waves-effect'><i class='fa fa-book m-r-10' aria-hidden='true'></i>Perhitungan Metode</a>
                                        </li>";
                            }
                        ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tes Kemampuan</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item active">Tes Kemampuan</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <?php
                            include "../../connect.php";
                            $jurusan_rows = mysqli_query($koneksi,"SELECT * FROM `alternatif` where ID_PRODI = '$ID_PRODI'");
                            while ($jurusan = mysqli_fetch_object($jurusan_rows)) {
                                $sudahDijawab = mysqli_query($koneksi,"select count(*) as rows from hasiltkd where ID_ALTERNATIF='{$jurusan->ID_ALTERNATIF}' and ID_MHS='{$ID_MHS}'"
                                );
                            ?>
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-block" style="background: paleturquoise;">
                                <b>
                                <h3 class="card-title" style="text-align:center;"><?php echo $jurusan->ALTERNATIF; ?></h3>
                                </b>
                                <div class="Container">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x" style="color: blue;margin-left: 15px;"></i>
                                </div>
                                    <?php if (!mysqli_fetch_object($sudahDijawab)->rows) {
                                        ?>
                                        <a href="soal.php?reset=true&id=<?php echo $jurusan->ID_ALTERNATIF ?>"><span style="margin-left: 13px;" class="btn btn-danger">Link Soal</span></a>
                                    <?php } else {
                                        ?>
                                        <a><span style="margin-left: 13px;" class="btn btn-danger disabled">Link Soal</span></a>
                                        <?php
                                    } ?>
                                </div>
                                </div>
                            </div>
                        </div>
                            <?php 
                            } 
                            ?> 
                    </div>
                </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                © 2017 by Fauziah Alifa D3 Manajemen Informatika
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../assets/User/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/User/plugins/bootstrap/js/tether.min.js"></script>
    <script src="../../assets/User/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../assets/User/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../../assets/User/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../assets/User/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../../assets/User/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="../../assets/User/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- Flot Charts JavaScript -->
    <script src="../../assets/User/plugins/flot/jquery.flot.js"></script>
    <script src="../../assets/User/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../../assets/User/js/flot-data.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../../assets/User/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
