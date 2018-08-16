<?php
  function nomor() {
  include "../../connect.php";
  $sql = mysqli_query($koneksi,"SELECT ID_ALTERNATIF FROM alternatif ORDER BY ID_ALTERNATIF DESC LIMIT 0,1");
  list ($no_temp) = mysqli_fetch_row($sql);

  if ($no_temp == '') {
  $no_urut = 'A01';

  } else {
  $jum = substr($no_temp,1,6);
  $jum++;
  if($jum <= 9) {
      $no_urut = 'A0' . $jum;
  } elseif ($jum <= 99) {
      $no_urut = 'A' . $jum;
  } else {
      die("Nomor urut melebih batas");        
  }
  }
  return $no_urut;
  }
                   
?>

<?php
session_start();
?>
<!-- tambah data -->
<?php
include '../../connect.php';
if(isset($_POST['simpan'])){
  $auto = nomor();
  $id_admin = $_SESSION['ID_ADMIN'];
  $alternatif = $_POST['alternatif'];
  $ID_PRODI = $_POST['prodi'];
  $sql = mysqli_query($koneksi,"INSERT INTO `alternatif`(`ID_ALTERNATIF`,`ID_ADMIN`,`ID_PRODI`,`ALTERNATIF`) VALUES ('$auto','$id_admin','$ID_PRODI','$alternatif')") ;
  if ($sql) {
  $_SESSION['tambah'] = 'berhasil';
  header('location:tambahAlternatif.php');
  } else {
  echo "Error: ".$sql.". ".mysqli_error($koneksi);
  }
}
?>

<?php
  if(isset($_POST['editAlternatif'])){
  $ID_ALTERNATIF = $_GET['ID_ALTERNATIF'];
  $ALTERNATIF = $_POST['alternatif'];
  $KODE_PRODI = $_POST['prodi'];
  $queryupdate = mysqli_query($koneksi, "UPDATE alternatif SET ALTERNATIF = '$ALTERNATIF', ID_PRODI = '$KODE_PRODI' WHERE ID_ALTERNATIF = '$ID_ALTERNATIF'");
  if($queryupdate){
   $_SESSION['update'] = 'berhasil';
   header('location:daftarAlternatif.php');
  }else{
   echo "Error: ".$queryupdate.". ".mysqli_error($koneksi);
   echo "UPDATE alternatif SET ALTERNATIF = '$ALTERNATIF', ID_PRODI = '$KODE_PRODI' WHERE ID_ALTERNATIF = '$ID_ALTERNATIF'";
  }
  }
 ?>

<!-- <?php
if ($_GET['aksi'] == 'hapusAlternatif') {
$ID_ALTERNATIF = $_GET['ID_ALTERNATIF'];
$queryhapus = mysqli_query($koneksi, "DELETE FROM alternatif WHERE  ID_ALTERNATIF = '$ID_ALTERNATIF'");
if($queryhapus){
  $_SESSION['hapus'] = 'berhasil';
  header('location:daftarAlternatif.php');
 }else{
  echo "Error: ".$queryhapus.". ".mysqli_error($koneksi);
}
}
?> -->

