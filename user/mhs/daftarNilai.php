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
    <title>SPK Peminatan Mata Kuliah Pilihan</title>
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
                    <a href="profil.php"><i style="padding-right: inherit;" class="fa fa-fw fa-user"></i> Profile</a>
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
                            <a href="../mhs/tambahNilai.php" class="waves-effect  active"><i class="fa fa-user m-r-10" aria-hidden="true"></i>Tambah Nilai</a>
                        </li>
                        <?php
                            $query = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM nilai_mk WHERE ID_MHS = '$ID_MHS'");
                            $result = mysqli_fetch_array($query);
                            $nilai = $result['jumlah'];
                            if ( $result["jumlah"] > 0 ) {        
                                echo "<li>
                                <a href='../soal/quiz.php' class='waves-effect'><i class='fa fa-edit m-r-10' aria-hidden='true'></i>Tes Kemampuan</a>
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
                        <h3 class="text-themecolor m-b-0 m-t-0">Daftar Nilai</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item active">Daftar Nilai</li>
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
                    <div class="col-sm-12">
                    <!-- Column -->
                    <div class="table-responsive">
                        <?php
                            include '../../connect.php';
                            $query = "SELECT alternatif.ID_ALTERNATIF,alternatif.ALTERNATIF, kriteria.KRITERIA,kriteria.ID_KRITERIA, ID_MK,GRADE,NILAI,SKS from nilai_mk left join alternatif on alternatif.ID_ALTERNATIF = nilai_mk.ID_ALTERNATIF left join kriteria on nilai_mk.ID_KRITERIA = kriteria.ID_KRITERIA WHERE ID_MHS = '$ID_MHS' ORDER BY `alternatif`.`ALTERNATIF` ASC";
                            $result = mysqli_query($koneksi, $query); 
                        ?>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Jurusan</th>
                                    <th>Nama Mata Kuliah</th>
                                    <th>Grade Mata Kuliah</th>
                                    <th "text-align: center;">ACTION</th>
                                </tr>
                            </thead>
                            <?php  
                            while($row = mysqli_fetch_array($result))  {
                                echo    '<tr>  
                                            <td>'.$row["ALTERNATIF"].'</td>  
                                            <td>'.$row["KRITERIA"].'</td>  
                                            <td>'.$row["GRADE"].'</td> 
                                            <td class="text-center">
                                                <div class="btn-group">
                                                 <a id-alternatif="' . $row['ID_ALTERNATIF'] . '" id-mk="' . $row['ID_MK'] . '"  id-kriteria="'. $row['ID_KRITERIA'] .'" class="btn btn-success tombol-update" 
                                                 sks="' . $row['SKS'] . '">Update</a></td>
                                                </div> 
                                        </tr>';  
                                  }  
                                  ?>
                        </table>
                    </div>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">                
                        <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Update Nilai Mata Kuliah</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                    <div class="modal-body">
                                        <form id="form-ganti-password" role="form" action="proses.php" method="POST">
                                            <input type="hidden" name="ID_MK">
                                            <input type="hidden" name="ID_KRITERIA">
                                            <input type="hidden" name="ID_ALTERNATIF">
                                            <div class="form-group">
                                                <label id="label-matkul"></label>
                                                <select name="grade" id="nilai-matkul" class="form-control input-nilai">
                                                    <option>Silahkan Pilih Grade</option>
                                                    <option>A</option>
                                                    <option>A-</option>
                                                    <option>B+</option>
                                                    <option>B</option>
                                                    <option>B-</option>
                                                    <option>C+</option>
                                                    <option>C-</option>
                                                    <option>D</option>
                                                    <option>E</option>
                                                </select>
                                                <!-- <input onkeyup="this.value = this.value.toUpperCase()" maxlength="2" id="nilai-matkul" type="text" name="grade" class="form-control" placeholder="Nilai"> -->
                                                <input id="nilai-sks" type="hidden">
                                                <input id="nilai-matkul-desimal" type="hidden" name="nilai" class="form-control">
                                            </div>
                                    </div>   
                                    <div class="modal-footer">
                                        <button name="submit" type="submit" form="form-ganti-password" class="btn btn-primary">Update</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                    </div>   
                    <!-- Column -->
                    </div>
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
    <script type="text/javascript">
        $('.tombol-update').click(function() {
            let aku = $(this)
            let idMk = aku.attr('id-mk')
            let idKriteria = aku.attr('id-kriteria')
            let idAlternative = aku.attr('id-alternatif')

            let label = $(aku.parent().parent().parent().find('td')[0])
            let alternatif = $(aku.parent().parent().parent().find('td')[1])
            let nilai = $(aku.parent().parent().parent().find('td')[2])
            // console.log(label.text())

            $('[name=ID_MK]').val(idMk)
            $('[name=ID_KRITERIA]').val(idKriteria)
            $('[name=ID_ALTERNATIF]').val(idAlternative)
            $('#label-matkul').text(label.text() + " - " + alternatif.text())
            $('#nilai-matkul').val(nilai.text())
            
            let nilaiHuruf = nilai.text()
            let nilaiDesimal = 0
            if (nilaiHuruf === 'A') {
                nilaiDesimal = 4
            }else if (nilaiHuruf === 'A-') {
                nilaiDesimal = 3.75
            }else if (nilaiHuruf === 'B+') {
                nilaiDesimal = 3.5
            }else if (nilaiHuruf === 'B') {
                nilaiDesimal = 3
            }else if (nilaiHuruf === 'B-') {
                nilaiDesimal = 2.75
            }else if (nilaiHuruf === 'C+') {
                nilaiDesimal = 2.5
            }else if (nilaiHuruf === 'C') {
                nilaiDesimal = 2
            }else if (nilaiHuruf === 'D') {
                nilaiDesimal = 1
            } else if (nilaiHuruf === 'E') {
                nilaiDesimal = 0
            }

            let sks = aku.attr('sks')
            $('#nilai-sks').val(sks)
            $('#nilai-matkul-desimal').val(nilaiDesimal * sks)
            
            $('#myModal').modal('show')
        })

        $('#nilai-matkul').change(function () {
            let nilaiHuruf = $(this).val()
            let nilaiDesimal = 0

            if (nilaiHuruf === 'A') {
                nilaiDesimal = 4
            }else if (nilaiHuruf === 'A-') {
                nilaiDesimal = 3.75
            }else if (nilaiHuruf === 'B+') {
                nilaiDesimal = 3.5
            }else if (nilaiHuruf === 'B') {
                nilaiDesimal = 3
            }else if (nilaiHuruf === 'B-') {
                nilaiDesimal = 2.75
            }else if (nilaiHuruf === 'C+') {
                nilaiDesimal = 2.5
            }else if (nilaiHuruf === 'C') {
                nilaiDesimal = 2
            }else if (nilaiHuruf === 'D') {
                nilaiDesimal = 1
            } else if (nilaiHuruf === 'E') {
                nilaiDesimal = 0
            }

            let sks = parseInt($('#nilai-sks').val())
            $('#nilai-matkul-desimal').val(nilaiDesimal * sks)
        })
    </script>
</body>

</html>
