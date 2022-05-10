<?php
session_start();
if (!isset($_SESSION['masuk'])) {
  header("location:../login.php");
  exit;
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
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
  <section class="py-5 my-5">
    <div class="about-section">
      <h1>ABOUT US</h1>
      <p>Aplikasi Web Ayo Gas merupakan Sistem Layanan Pemesanan Gas Berbasis Web untuk mempermudah
        Agen dalam pemesanan Gas. Menyediakan Berbagai Macam Produk GAS LPG, Bright Gas dan Blue Gas.</p>

    </div>

    <h2 class="judul" style="text-align:center; color: aliceblue; text-transform: uppercase;">Our Team</h2>
    <div class="row">
      <div class="column">
        <div class="card">
          <img src="../asset-img/PROFIL YUDHA.png" alt="Jane" style="width:100%">
          <div class="container">
            <b>
              <p class="nama">Elang Andhika Yudha Prawira
            </b><br><br>6706213073<br>D3 RPLA 45-03<br>
            <div style="font-size: 13px;">yudhabae@student.telkomuniversity.ac.id</div>
            </p>

          </div>
        </div>
      </div>

      <div class="column">
        <div class="card">
          <img src="../asset-img/PROFIL DZAKWAN.png" alt="Mike" style="width:100%">
          <div class="container">
            <b>
              <p class="nama">Dzakwan Dhiya Ulhaq
            </b><br><br>6706210092<br>D3 RPLA 45-03<br>
            <div style="font-size: 13px;">dzakwandhiya@student.telkomuniversity.ac.id</div>
            </p>
          </div>
        </div>
      </div>

      <div class="column">
        <div class="card">
          <img src="../asset-img/PROFIL HAIDAR.png" alt="John" style="width:100%">
          <div class="container">
            <b>
              <p class="nama">Haidar Jindan Ahnif
            </b><br><br>6706210009<br>D3 RPLA 45-03<br>
            <div style="font-size: 13px;">haidarjindan@student.telkomuniversity.ac.id</div>
            </p>
          </div>
        </div>
      </div>
    </div>

</body>

</html>