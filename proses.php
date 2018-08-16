<?php

// echo "<pre>";
// echo print_r($_POST);
// echo "</pre>";
// die();

function nomor() {
  include "connect.php";
  $sql = mysqli_query($koneksi,"SELECT ID_MHS FROM mahasiswa ORDER BY ID_MHS DESC LIMIT 0,1");
  list ($no_temp) = mysqli_fetch_row($sql);

  if ($no_temp == '') {
  $no_urut = 'MHS001';

  } else {
  $jum = substr($no_temp,3,5);
  $jum++;
  if($jum <= 9) {
      $no_urut = 'MHS00' . $jum;
  } elseif ($jum <= 99) {
      $no_urut = 'MHS0' . $jum;
  } elseif ($jum <= 999) {
      $no_urut = 'MHS' . $jum;
  } else {
      die("Nomor urut melebih batas");        
  }
  }
  return $no_urut;
  }
include 'connect.php';
session_start();
if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $depan = $_POST['depan'];
  $belakang = $_POST['belakang'];
  $nim = $_POST['nim'];
  $angkatan = $_POST['angkatan'];
  $id_prodi = $_POST['id_prodi'];
  $password = $_POST['password'];
  $query = mysqli_query($koneksi, "SELECT USERNAME_MHS FROM `mahasiswa` WHERE USERNAME_MHS='$email'");
  
  if (mysqli_fetch_row($query) > 0) {
    $_SESSION['sama'] = 'sama';
    header('location:index.php');
  }else{
    $auto = nomor();
    $sql = mysqli_query($koneksi,"INSERT INTO mahasiswa (`ID_MHS`,`ID_PRODI`,`NAMA_DEPAN`, `NAMA_BELAKANG`, `NIM_MHS`,`ANGKATAN`, `USERNAME_MHS`, `PASSWORD_MHS`) VALUES ('$auto','$id_prodi','$depan', '$belakang', '$nim','$angkatan', '$email', '$password')") ;
    if ($sql) {
      $_SESSION['status'] = 'sukses';
      header('location:index.php');
    } else {
      echo "Error: ".$sql.". ".mysqli_error($koneksi);
      }
  }
}
?>
<?php 
  if(isset($_POST['login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $query = mysqli_query($koneksi,"SELECT * FROM mahasiswa where USERNAME_MHS ='$email' AND PASSWORD_MHS = '$password'") ;
  $query2 = mysqli_query($koneksi,"SELECT * FROM admin where USERNAME_ADMIN ='$email' AND PASSWORD_ADMIN = '$password'") ;
  if (mysqli_fetch_row($query)>0) {
              mysqli_data_seek($query,0);
              $result = mysqli_fetch_array($query);
              $_SESSION['ID_MHS']=$result['ID_MHS'];
              $_SESSION['ID_PRODI']=$result['ID_PRODI'];
              $_SESSION['status_login'] = 'sukses';
              header('location:user/index.php');
  }elseif (mysqli_fetch_row($query2)>0) {
              mysqli_data_seek($query2,0);
              $result = mysqli_fetch_array($query2);
              $_SESSION['ID_ADMIN']=$result['ID_ADMIN'];
              $_SESSION['status_login_sukses'] = 'admin';
              header('location:admin/index.php');
  }else{
    $_SESSION['status_login'] = 'gagal';
    header('location:index.php');
  }
}