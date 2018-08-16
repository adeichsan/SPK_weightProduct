<!-- tambah data -->
<?php
session_start();
?>

<?php
include '../../connect.php';
if(isset($_POST['simpan'])){
  $username = $_POST['Email'];
  $password = $_POST['password'];
  $nama = $_POST['nama'];
  $jk = $_POST['jk'];
$sql = mysqli_query($koneksi,"INSERT INTO `admin`(`USERNAME_ADMIN`, `PASSWORD_ADMIN`, `NAMA_ADMIN`, `JENKEL`) VALUES ('$username','$password','$nama','$jk')") ;
if ($sql) {
 header('location:tambahAdmin.php');
} else {
 echo "Error: ".$sql.". ".mysqli_error($koneksi);
}
}?>

<?php
  if(isset($_POST['profil'])){
  $ID_ADMIN = $_GET['ID_ADMIN'];
  $username = $_POST['username'];
  $nama = $_POST['nama'];
  $jk = $_POST['jk'];
  $queryupdate = mysqli_query($koneksi, "UPDATE admin SET NAMA_ADMIN = '$nama', USERNAME_ADMIN = '$username', JENKEL = '$jk' WHERE ID_ADMIN = '$ID_ADMIN'");
  if($queryupdate){
   $_SESSION['updateProfil'] = 'profil';
   header('location:../index.php');
  }else{
   echo "Error: ".$queryupdate.". ".mysqli_error($koneksi);
  }
  }
 ?>

 <?php
if ($_GET['aksi'] == 'hapusUser') {
$ID_ADMIN = $_GET['ID_ADMIN'];
$queryhapus = mysqli_query($koneksi, "DELETE FROM admin WHERE  ID_ADMIN = '$ID_ADMIN'");
if($queryhapus){
  header('location:daftarAdmin.php');
 }else{
  echo "Error: ".$queryhapus.". ".mysqli_error($koneksi);
}
}
?>
<!-- change password -->
<?php
if(isset($_POST['submit'])){
$user_id = $_SESSION['ID_ADMIN'];
$password1 = $_POST['lama'];
$password2 = $_POST['baru'];
$password3 = $_POST['konfirmasi'];
// var_dump($_POST);
$query = mysqli_query($koneksi, "SELECT * FROM admin WHERE ID_ADMIN = '$user_id'");
$result = mysqli_fetch_array($query);
$oldpassword = $result['PASSWORD_ADMIN'];

if($password1==$oldpassword){
  if ($password2==$password3) {
    $changequery = mysqli_query($koneksi, "UPDATE admin SET PASSWORD_ADMIN = '$password3' WHERE ID_ADMIN = '$user_id'");
    if ($changequery) {
      $_SESSION['password'] = 'berhasil';
      header('location:profil.php');
    }
  } else {
    echo "Password Tidak Sama";
  }

 } else {
   echo "Password Lama Anda Tidak Sama !!!";
 }
}
?>