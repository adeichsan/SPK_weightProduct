<?php
session_start();
echo $_SESSION['ID_ADMIN'];
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
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../js/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="../../js/animate.css">

    <!-- Custom CSS -->
    <link href="../../css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                
                <a class="navbar-brand" href="index.php">SPK Peminatan Mata Kuliah Mahasiswa</a>
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
                            Profile
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="glyphicon glyphicon-home"></i>  <a href="../index.php">Home</a>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-user"></i> Profil
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <?php
                  include "../../connect.php";
                  $ID_ADMIN = $_SESSION['ID_ADMIN'];
                  $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE ID_ADMIN = '{$ID_ADMIN}'");
                  $result = mysqli_fetch_array($query);
                ?>
                <form role="form" method="POST" action="proses.php?ID_ADMIN=<?php echo $result['ID_ADMIN'] ?>">
                            <div class="form-group">
                                <label>NAMA ADMIN</label>
                                <input class="form-control" name="nama" value="<?php echo $result['NAMA_ADMIN'] ?>">
                            </div>
                            <div class="form-group">
                                <label>JENIS KELAMIN</label>
                                <select name="jk" class="form-control">
                                    <option <?php echo $result['JENKEL'] === 'PEREMPUAN' ? 'selected' : '' ?>>PEREMPUAN</option>
                                    <option <?php echo $result['JENKEL'] === 'PRIA' ? 'selected' : '' ?>>PRIA</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>USERNAMEL</label>
                                <input name="username" class="form-control" value="<?php echo $result['USERNAME_ADMIN'] ?>">
                            </div>
                            <div class="form-group">
                                <label>PASSWORD</label>
                                <input disabled="" type="password" class="form-control" value="<?php echo $result['PASSWORD_ADMIN'] ?>">
                                <a data-toggle="modal" data-target="#myModal" href=""> Change Password </a>
                            </div>
                            <button name="profil" style="float: right" class="btn btn-primary">Update</button>
                        </form>


            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">                
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Change Password</h4>
                        </div>

                        <div class="modal-body">
                            <form id="form-ganti-password" role="form" action="proses.php" method="POST">
                                <div class="form-group">
                                    <label for="name">Password Lama</label>
                                    <input type="password" name="lama" class="form-control" id="name" placeholder="Masukkan Password ">
                                </div>
                                <div class="form-group">
                                    <label for="name">Password Baru</label>
                                    <input type="password" name="baru" class="form-control" id="name" placeholder="Masukkan Password Baru ">
                                </div>
                                <div class="form-group">
                                    <label for="name">Password Konfimasi</label>
                                    <input type="password" name="konfirmasi" class="form-control" id="name" placeholder="Konfimasi ">
                                </div>
                        </div>
                                
                            <div class="modal-footer">
                                  <button name="submit" type="submit" form="form-ganti-password" class="btn btn-default">Update</button>
                            </div>
                        </div>
                              
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
    <script src="../../js/sweetalert2.min.js"></script>
    <script type="text/javascript">
        function alert_show(title, words) {
         swal({
          title: title,
          html: $('<div>')
          .addClass('some-class')
          .text(words),
          animation: false,
          customClass: 'animated tada'
        })
       }
    </script>
    <?php
    if (isset($_SESSION['password']) && ($_SESSION['password'] === 'berhasil')){

        echo "<script> alert_show('Update Password', 'Berhasil !!!') </script>";
        unset($_SESSION['password']);
    } 
    ?>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../../js/plugins/morris/raphael.min.js"></script>
    <script src="../../js/plugins/morris/morris.min.js"></script>
    <script src="../../js/plugins/morris/morris-data.js"></script>

</body>

</html>
