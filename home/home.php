<?php
session_start();
if (!isset($_SESSION['masuk'])) {
  header("location:../login.php");
  exit;
}

//--------Conector-To-Database---------
require "../connector/koneksi.php";
//-------------------------------------

$getEmail = $_SESSION['email'];
$sql = "SELECT email, nama, kelamin, noTelepon, alamat, password FROM akun WHERE email='$getEmail'";
$result = $koneksi->query($sql);
if (!$result) {
  echo "Data tidak dapat diakses";
}
$row = mysqli_fetch_row($result);
$emailView = $row[0];
$namaView = strtok(strtoupper($row[1]), " ");
$kelaminView = $row[2];
$noTeleponView = $row[3];
$alamatView = $row[4];
$count = "";
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Home</title>
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
  <div class="banner">
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <img src="../asset-img/logo-4.png" class="logo">
      <ul>
        <li><a href="../home/home.php"> Home </a></li>
        <li><a href="../about/about.php">About</a></li>
        <li><a href="../produk2/produk.php">Produk</a></li>
        <li><a href="../pesanan/pesanan.php">Pesanan</a></li>
        <li><a href="../contact/contact.php">Contact</a></li>
        <li><a href="../akun/akun.php"><i class="fa fa-fw fa-user"></i> Akun</a></li>

      </ul>
    </nav>
    <div class="content">
      <img class="logo-containt" src="../asset-img/logo.png">
      <h1>HALO <?php echo $namaView ?> !</h1>
      <p>Selamat datang di Website Ayo Gass. Sistem Layanan Pemesanan Gas Berbasis Web untuk mempermudah Agen dalam pemesanan Gas.
        Menyediakan Berbagai Macam Produk GAS LPG, Bright Gas dan Blue Gas. Mulai Pemesanan ?
      </p>
      <div>
        <a href="../produk2/produk.php"><button type="button">Pesan Sekarang</button></a>

      </div>
    </div>
  </div>
</body>

</html>