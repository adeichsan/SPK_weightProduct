<?php
include 'connect.php';
session_start();
$query = mysqli_query($koneksi, "SELECT USERNAME_MHS FROM mahasiswa");
$result = mysqli_fetch_array($query);

$prodiQuery = mysqli_query($koneksi, "SELECT * FROM prodi");
$prodi = [];

while ($row = mysqli_fetch_object($prodiQuery)) {
  $prodi[] = $row;
}

?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" type="text/css" href="js/sweetalert2.min.css">
  <link rel="stylesheet" type="text/css" href="js/animate.css">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/logo.png">
  <title>SPK MATA KULIAH PILIHAN ADMIN</title>
  <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
<div class="form">
  
  <ul class="tab-group">
    <li class="tab active"><a href="#login">Log In</a></li>
    <li class="tab"><a href="#signup">Sign Up</a></li>
  </ul>
  
  <div class="tab-content">
    <div id="login">   
      <h1>Welcome Back</h1>
      
      <form action="proses.php" method="post">
        
        <div class="field-wrap">
          <label>
            Username<span class="req">*</span>
          </label>
          <input name='email' type=""required autocomplete="off"/>
        </div>
        
        <div class="field-wrap">
          <label>
            Password<span class="req">*</span>
          </label>
          <input name='password' type="password"required autocomplete="off"/>
        </div>
        
        <button name="login" class="button button-block"/>Log In</button>
        
      </form>

    </div>
    
    <div id="signup">   
      <h1>Sign In</h1>
      
      <form action="proses.php" method="post">
        
        <div class="top-row">
          <div class="field-wrap">
            <label>
              First Name<span class="req">*</span>
            </label>
            <input name="depan" type="text" required autocomplete="off" />
          </div>
          <div class="field-wrap">
            <label>
              Last Name<span class="req">*</span>
            </label>
            <input name="belakang" type="text" required autocomplete="off"/>
          </div>
        </div>
        <div class="field-wrap">
          <label>
            Nim Mahasiswa<span class="req"></span>
          </label>
          <input name='nim' maxlength="11" onkeypress="return angka(event)" type="text" required autocomplete="off"  onkeyup="getProdiDanAngkatan(event)"/>
        </div>
        <input type="hidden" name="id_prodi">
        <input type="hidden" name="angkatan">
        <div class="field-wrap">
          <input name='prodi' type="text" required autocomplete="off" disabled="" />
          <label style="font-size: 14px; margin: 2px; left:  2px;">
            Nama Prodi
          </label>
        </div>
        <div class="field-wrap">
          <input id='angkatan' disabled="" maxlength="11" type="text" required autocomplete="off"/>
          <label style="font-size: 14px; margin: 2px; left:  2px;">
            Angkatan
          </label>
        </div>
        <div class="field-wrap">
          <label>
            Username<span class="req">*</span>
          </label>
          <input name='email' required autocomplete="off"/>
        </div>
        
        <div class="field-wrap">
          <label>
            Set A Password<span class="req">*</span>
          </label>
          <input name='password' type="password"required autocomplete="off"/>
        </div>
        
        <button name="submit" type="submit" class="btn button button-block"/>Sign In</button>
        
      </form>

    </div>
    
  </div><!-- tab-content -->
</div> <!-- /form -->
<script src='css/jquery-3.2.1.min.js'></script>
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
<script src="js/sweetalert2.min.js"></script>
<?php
    if (isset($_SESSION['status']) && ($_SESSION['status'] === 'sukses')){

        echo "<script> alert_show('Sign Up', 'Anda Sudah Terdaftar') </script>";
        unset($_SESSION['status']);
    }elseif (isset($_SESSION['sama']) && ($_SESSION['sama'] === 'sama')) {
        echo "<script> alert_show('Sign Up', 'Anda Sudah Terdaftar') </script>";
        unset($_SESSION['sama']);
    }elseif (isset($_SESSION['status_login']) && ($_SESSION['status_login'] === 'gagal')){
      echo "<script> alert_show('Log In', 'Username dan Password anda tidak cocok silahkan coba lagi !!!') </script>";
      unset($_SESSION['status_login']);
    }
    ?>

<script src="js/index.js"></script>
<script type="text/javascript">
  let listProdi = <?php echo json_encode($prodi) ?>;

  function angka(evt) {

    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
  }

  function getProdiDanAngkatan(event) {
    let nim  = event.target.value
    let angkatan = "20" + nim.slice(0, 2)
    let kodeJurusan = nim.slice(4, 7)
    let jurusan = listProdi.find(prodi => prodi.KODE_PRODI === kodeJurusan)

    console.log(jurusan)
    console.log(angkatan)

    document.querySelector('input[name=id_prodi]').value = jurusan ? jurusan.ID_PRODI : null
    document.querySelector('input[name=prodi]').value = jurusan ? jurusan.NAMA_PRODI : null
    document.querySelector('#angkatan').value = nim ? angkatan : null
    document.querySelector('input[name=angkatan]').value = nim ? angkatan : null
  }
</script>
</body>
</html>

