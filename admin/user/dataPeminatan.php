<?php
session_start();
?>
<?php
                  include "../../connect.php";
                  $ID_ADMIN = $_SESSION['ID_ADMIN'];
                  $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE ID_ADMIN = '$ID_ADMIN'");
                  $result = mysqli_fetch_array($query);
                ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/logo.png">
    <title>SPK MATA KULIAH PILIHAN ADMIN</title>


    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="../../plugin/DataTables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../../plugin/DataTables/media/css/dataTables.bootstrap.css">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <style type="text/css">
    @media print {
          body * {
            visibility: hidden;
          }
          #print *{
            visibility: visible;
          }
          #print {
            position: inherit;
            margin: 30px;
            margin-top:-300px; 
          }
          .panel-body {
            padding: 15px;
          }
          .table {
                display: table;
                width: 100%;
                max-width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>

</head>

<body>


    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="admin/index.php">SPK Peminatan Mata Kuliah Mahasiswa</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $result['NAMA_ADMIN'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profil.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="../index.php"><i class="glyphicon glyphicon-home"></i> Home</a>
                    </li>
                    <!-- <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#admin"><i class="glyphicon glyphicon-menu-hamburger"></i> Admin <i style="float: right;padding-right: 30px;" class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="admin" class="collapse">
                            <li>
                                <a href="tambahAdmin.php"><i class="glyphicon glyphicon-plus"></i> Tambah </a>
                            </li>
                            <li>
                                <a href="daftarAdmin.php" class="glyphicon glyphicon-list"> Daftar </a>
                            </li>
                        </ul>
                    </li> -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#jurusan"><i class="glyphicon glyphicon-menu-hamburger"></i> Data Prodi <i style="float: right;padding-right: 30px;" class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="jurusan" class="collapse">
                            <li>
                                <a href="../jurusan/tambahJurusan.php"><i class="glyphicon glyphicon-plus"></i> Tambah </a>
                            </li>
                            <li>
                                <a href="../jurusan/daftarJurusan.php" class="glyphicon glyphicon-list"> Daftar </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#alternatif"><i class="glyphicon glyphicon-menu-hamburger"></i> Data Peminatan <i style="float: right;padding-right: 30px;" class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="alternatif" class="collapse">
                            <li>
                                <a href="../alternatif/tambahAlternatif.php"><i class="glyphicon glyphicon-plus"></i> Tambah </a>
                            </li>
                            <li>
                                <a href="../alternatif/daftarAlternatif.php" class="glyphicon glyphicon-list"> Daftar </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#kriteria"><i class="glyphicon glyphicon-menu-hamburger"></i> Data Mata Kuliah <i style="float: right;padding-right: 30px;" class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="kriteria" class="collapse">
                            <li>
                                <a href="../kriteria/tambahKriteria.php"><i class="glyphicon glyphicon-plus"></i> Tambah </a>
                            </li>
                            <li>
                                <a href="../kriteria/daftarKriteria.php" class="glyphicon glyphicon-list"> Daftar </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#soal"><i class="glyphicon glyphicon-menu-hamburger"></i> Soal <i style="float: right;padding-right: 30px;" class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="soal" class="collapse">
                            <li>
                                <a href="../soal/tambahSoal.php"><i class="glyphicon glyphicon-plus"></i> Tambah </a>
                            </li>
                            <li>
                                <a href="../soal/daftarSoal.php" class="glyphicon glyphicon-list"> Daftar </a>
                            </li>
                        </ul>
                    </li>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Data Peminatan Mahasiswa
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="glyphicon glyphicon-home"></i>  <a href="../index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-menu-hamburger"></i> Data Peminatan Mahasiswa
                            </li>
                        </ol>
                            <a href="#" style="float: right;" onclick="window.print()" class="btn btn-primary">Download</a>
                    </div>
                </div>
                <!-- /.row -->
                <div id="print">                        
                <div class="panel-body">
                    <div style="overflow-x:auto;">
                        <?php
                        $users = mysqli_query($koneksi, "SELECT mahasiswa.NIM_MHS, mahasiswa.NAMA_DEPAN, mahasiswa.NAMA_BELAKANG, hasilpeminatan.HASILPEMINATAN FROM mahasiswa INNER JOIN hasilpeminatan ON hasilpeminatan.ID_MHS = mahasiswa.ID_MHS");
                        ?>
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>NAMA</th>
                                    <th>HASIL PEMINATAN MAHASISWA</th>
                                </tr>
                            </thead>
                                <?php  
                                    while ($user = mysqli_fetch_object($users)) {
                                        echo "<tr>";
                                        echo "<td>{$user->NIM_MHS}</td>";
                                        echo "<td>{$user->NAMA_DEPAN} {$user->NAMA_BELAKANG}</td>";
                                        echo "<td>{$user->HASILPEMINATAN}</td>";
                                        echo "</tr>";

                                    }
                                  ?>
                        </table>
                    </div>
                </div>
                </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../plugin/DataTables/media/js/jquery.dataTables.js"></script>

    <script>  
         $(document).ready(function(){  
              $('#employee_data').DataTable();  
         });  
     </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../../js/plugins/morris/raphael.min.js"></script>
    <script src="../../js/plugins/morris/morris.min.js"></script>
    <script src="../../js/plugins/morris/morris-data.js"></script>

    <!-- Flot Charts JavaScript -->
    <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    <script src="../../js/plugins/flot/jquery.flot.js"></script>
    <script src="../../js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../../js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../../js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="../../js/plugins/flot/flot-data.js"></script>

</body>

</html>
