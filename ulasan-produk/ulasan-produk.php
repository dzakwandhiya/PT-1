<?php
session_start();
if (!isset($_SESSION['masuk'])) {
  header("location:../login.php");
  exit;
}

//--------Conector-To-Database---------
require "../connector/koneksi.php";
//-------------------------------------

$id_barang = $_GET['id'];

?>
<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

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
      <!--<label class="logo">DesignX</label>-->
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
      <?php 
        $sql3 = "SELECT*FROM ulasan WHERE id_produk='$id_barang'";
        $result3 = $koneksi->query($sql3);
        if (!$result3) {
          echo "Data tidak dapat diakses";
        }
        $count = "";
        if ($result3->num_rows > 0) {
          while ($row5 = $result3->fetch_assoc()) {
            $count++;
            echo include 'view.php';
          }
        }
        
        
      ?>


    </div>
  </div>
  <!--<div class="menu">
                <h1>pppppppppp</h1>
            </div>?-->
  </div>
</body>

</html>