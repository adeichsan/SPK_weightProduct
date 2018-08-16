<?php
function nomor() {
  include "../../connect.php";
  $sql = mysqli_query($koneksi,"SELECT ID_MK FROM nilai_mk ORDER BY ID_MK DESC LIMIT 0,1");
  list ($no_temp) = mysqli_fetch_row($sql);
  if ($no_temp == '') {
  $no_urut = 'MK001';

  } else {
  $jum = substr($no_temp,2,4);
  $jum++;
  if($jum <= 9) {
      $no_urut = 'MK00' . $jum;
  } elseif ($jum <= 99) {
      $no_urut = 'MK0' . $jum;
  } elseif ($jum <= 999) {
    $no_urut = 'MK' . $jum;
  }
  }
  return $no_urut;
  }
include '../../connect.php';
session_start();
$id_mhs = $_SESSION['ID_MHS'];
if(isset($_POST['simpan'])){
	foreach ($_POST['kriteria'] as $key => $id_kriteria) {
    $nilai = $_POST['nilai'][$key];
    $alternatif = $_POST['alternatif'][$key];
		$grade = $_POST['grade'][$key];
    $idselanjutnya = nomor();
    $sql = mysqli_query($koneksi,"INSERT INTO `nilai_mk`(ID_MK,ID_MHS,ID_ALTERNATIF,ID_KRITERIA,GRADE,NILAI) VALUES ('{$idselanjutnya}','{$id_mhs}','{$alternatif}','{$id_kriteria}','{$nilai}','{$grade}')");
	  

    # kita masukkan kriteria yang sama
    if ($sql) {
      # cari kriteria yang namanya sama dengan id kriteria
      echo "select ID_KRITERIA, KRITERIA from kriteria where ID_KRITERIA='{$id_kriteria}' LIMIT 1";
      echo "<br>";
      $idKriteriaYangDimasukkanDariFormQuery = mysqli_query($koneksi, "select ID_KRITERIA, KRITERIA from kriteria where ID_KRITERIA='{$id_kriteria}' LIMIT 1");
      if ($idKriteriaYangDimasukkanDariFormQuery) {
        $kriteriaPatokan = mysqli_fetch_object($idKriteriaYangDimasukkanDariFormQuery);
        # kalau ketemu, ambil namanya. Terus cari kriteria lain yang sama dg dia, tapi idnya yang di atas ini dikecualikan
        echo "select ID_KRITERIA, ID_ALTERNATIF, SKS from kriteria where ID_KRITERIA != '{$id_kriteria}' and KRITERIA='{$kriteriaPatokan->KRITERIA}'";
        echo "<br>";
        echo json_encode($_POST['nilai']) . "<br>";

        $kriteriaLainYangSamaNamanyaQuery = mysqli_query($koneksi, "select ID_KRITERIA, ID_ALTERNATIF, SKS from kriteria where ID_KRITERIA != '{$id_kriteria}' and KRITERIA='{$kriteriaPatokan->KRITERIA}'");


        # setelah, masukkan satu persatu nilai mk-nya
        while ($kriteriaLain = mysqli_fetch_object($kriteriaLainYangSamaNamanyaQuery)) {
          $idMKBaru = nomor();
          $alternatifBaru = $kriteriaLain->ID_ALTERNATIF;
          $idKriteriaBaru = $kriteriaLain->ID_KRITERIA;

          if ($nilai === 'A') {
              $gradeNumerik = 4;
          }else if ($nilai === 'A-') {
              $gradeNumerik = 3.75;
          }else if ($nilai === 'B+') {
              $gradeNumerik = 3.5;
          }else if ($nilai === 'B') {
              $gradeNumerik = 3;
          }else if ($nilai === 'B-') {
              $gradeNumerik = 2.75;
          }else if ($nilai === 'C+') {
              $gradeNumerik = 2.5;
          }else if ($nilai === 'C') {
              $gradeNumerik = 2;
          }else if ($nilai === 'D') {
              $gradeNumerik = 1;
          } else if ($nilai === 'E') {
              $gradeNumerik = 0;
          }

          $nilaiBaru = $gradeNumerik * $kriteriaLain->SKS;
          mysqli_query(
            $koneksi,
            "INSERT INTO `nilai_mk` (ID_MK, ID_MHS, ID_ALTERNATIF, ID_KRITERIA, GRADE, NILAI) VALUES ('{$idMKBaru}','{$id_mhs}','{$alternatifBaru}','{$idKriteriaBaru}','{$nilai}','{$nilaiBaru}')"
          );
        }
      }
    }
  }


    # upload file
		if ($sql) {
      $ID_MHS = $_SESSION['ID_MHS'];
      $FILE = @$_FILES['file']['name'];
      $ukuran_file = @$_FILES['file']['size'];
      $tipe_file = @$_FILES['file']['type'];
      $tmp_file = @$_FILES['file']['tmp_name'];

      $path = "../../document/".$FILE;

      if ($tipe_file == "application/pdf" || $tipe_file == "text/html"){ 
        if($ukuran_file <= 1000000){ 
          if(move_uploaded_file($tmp_file, $path)){
            $query = "UPDATE mahasiswa SET TRANSKIP_NILAI = '$FILE' WHERE ID_MHS = '$ID_MHS'";
            $sql = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
            if($sql){
             header('location:tambahNilai.php');
              // header("location: admin.php"); // Redirectke halaman index.php
            }else{
              // Jika Gagal, Lakukan :
              echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
                // echo "<br><a href='form.php'>Kembali Ke Form</a>";
            }
          }else{
            // Jika gambar gagal diupload, Lakukan :
              echo "Maaf, Gambar gagal untuk diupload.";
            // echo "<br><a href='form.php'>Kembali Ke Form</a>";
          }
        }else{
          // Jika ukuran file lebih dari 1MB, lakukan :
          echo "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB";
          // echo "<br><a href='form.php'>Kembali Ke Form</a>";
        }
      }else{
        // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
        echo "";
        // echo "<br><a href='form.php'>Kembali Ke Form</a>";
      }
		 header('location:tambahNilai.php');
		} else {
		 echo "Error: ".$sql.". ".mysqli_error($koneksi);
		}
}
?>

<?php
  if(isset($_POST['profil'])){
  $ID_MHS = $_GET['ID_MHS'];
  $nim = $_POST['nim'];
  $depan = $_POST['depan'];
  $belakang = $_POST['belakang'];
  $username = $_POST['username'];
  $queryupdate = mysqli_query($koneksi, "UPDATE mahasiswa SET NAMA_DEPAN = '$depan', NAMA_BELAKANG = '$belakang', NIM_MHS = '$nim', USERNAME_MHS = '$username' WHERE ID_MHS = '$ID_MHS'");
  if($queryupdate){
   header('location:profil.php');
  }else{
   echo "Error: ".$queryupdate.". ".mysqli_error($koneksi);
  }
  }
 ?>

 <?php
if(isset($_POST['update'])){
$ID_MHS = $_SESSION['ID_MHS'];
$password1 = $_POST['lama'];
$password2 = $_POST['baru'];
$password3 = $_POST['konfirmasi'];
// var_dump($_POST);
$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE ID_MHS = '$ID_MHS'");
$result = mysqli_fetch_array($query);
$oldpassword = $result['PASSWORD_MHS'];

if($password1==$oldpassword){
  if ($password2==$password3) {
    $changequery = mysqli_query($koneksi, "UPDATE mahasiswa SET PASSWORD_MHS = '$password3' WHERE ID_MHS = '$ID_MHS'");
    if ($changequery) {
      header('location:profil.php');
    }
  } else {
    echo "Password Tidak Sama";
    header('location:profil.php');
  }

 } else {
   echo "Password Lama Anda Tidak Sama !!!";
   header('location:profil.php');
 }
}
?>

 <?php
if(isset($_POST['submit'])){
$ID_MHS = $_SESSION['ID_MHS'];
$ID_MK = $_POST['ID_MK'];
$grade = $_POST['grade'];
$nilai = $_POST['nilai'];
  $queryupdate = mysqli_query($koneksi, "UPDATE `nilai_mk` SET `GRADE` = '$grade',`NILAI` = '$nilai' WHERE `nilai_mk`.`ID_MK` = '$ID_MK'");
  if($queryupdate){
   header('location:daftarNilai.php');
  }else{
   echo "Error: ".$queryupdate.". ".mysqli_error($koneksi);
  }
  }
 ?>


<?php
if (isset($_POST['fotoProfil'])) {
  $ID_MHS = $_SESSION['ID_MHS'];
  $FOTO = @$_FILES['foto']['name'];
  $ukuran_file = @$_FILES['foto']['size'];
  $tipe_file = @$_FILES['foto']['type'];
  $tmp_file = @$_FILES['foto']['tmp_name'];

  $path = "../../images/".$FOTO;

  if ($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ 
    if($ukuran_file <= 1000000){ 
      if(move_uploaded_file($tmp_file, $path)){
        $query = "UPDATE mahasiswa SET FOTO_MHS = '$FOTO' WHERE ID_MHS = '$ID_MHS'";
        echo $query;
        $sql = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
        if($sql){
         header('location:profil.php');
          // header("location: admin.php"); // Redirectke halaman index.php
        }else{
          // Jika Gagal, Lakukan :
          echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
          // echo "<br><a href='form.php'>Kembali Ke Form</a>";
        }
      }else{
        // Jika gambar gagal diupload, Lakukan :
        echo "Maaf, Gambar gagal untuk diupload.";
        // echo "<br><a href='form.php'>Kembali Ke Form</a>";
      }
    }else{
      // Jika ukuran file lebih dari 1MB, lakukan :
      echo "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB";
      // echo "<br><a href='form.php'>Kembali Ke Form</a>";
    }
  }else{
    // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
    echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
    // echo "<br><a href='form.php'>Kembali Ke Form</a>";
  }   
}
?>

 