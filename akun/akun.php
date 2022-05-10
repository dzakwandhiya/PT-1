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
$namaView = $row[1];
$kelaminView = $row[2];
$noTeleponView = $row[3];
$alamatView = $row[4];


//---------------------Update Akun----------------------//
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$newNama = "";
$newEmail = "";
$newKelamin = "";
$getNoTlp = "";
$newNoTelepon = "";
$newAlamat = "";
if (isset($_POST['update'])) {
    $newEmail = $_POST['email'];
    $newNama = $_POST['nama'];
    $newKelamin = $_POST['kelamin'];
    //$getNoTlp = $_POST['noTelepon'];
    $newNoTelepon = $_POST['noTelepon'];
    $newAlamat = $_POST['alamat'];

    $newEmail = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email tidak sesuai')</script>";
        header("Refresh: 0; url = ../akun/akun.php");
        return false;
    }

    $newNama = test_input($_POST["nama"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $newNama)) {
        echo "<script>alert('Gagal Update! Nama harus menggunakan huruf dan spasi')</script>";
        header("Refresh: 0; url = ../akun/akun.php");
        return false;
    } else {
        $updateNama = mysqli_query($koneksi, "UPDATE akun SET nama='$newNama' WHERE email='$getEmail'");
    }

    $updateKelamin = mysqli_query($koneksi, "UPDATE akun SET kelamin='$newKelamin' WHERE email='$getEmail'");
    $updateAlamat = mysqli_query($koneksi, "UPDATE akun SET alamat='$newAlamat' WHERE email='$getEmail'");
    $updateNoTelepon = mysqli_query($koneksi, "UPDATE akun SET noTelepon='$newNoTelepon' WHERE email='$getEmail'");
    header("Refresh: 0; url = akun.php");
    if ($newEmail == $getEmail) {
        header("Refresh: 0; url = akun.php");
    } else {
        $duplikasi = mysqli_query($koneksi, "SELECT email FROM akun WHERE email = '$newEmail'");
        if (mysqli_fetch_assoc($duplikasi)) {
            echo "<script>alert('Email Sudah Terdaftar!!!')</script>";
            header("Refresh: 0; url = akun.php");
            return false;
        } else {
            $updateEmail = mysqli_query($koneksi, "UPDATE akun SET email='$newEmail' WHERE email='$getEmail'");
            //echo "onclick='return confirm('Update Email Memerlukan Relog')'";
            echo "<script>alert('Update Email Berhasil. Silahkan Login Ulang')</script>";
            header("Refresh: 0; url = logout.php");
            exit;
        }
    }
}
//include ('update.php');

//require "../crud.php";

//-------------------------------------------------------------------------------------------//
//----------------------------------------Update Password------------------------------------//
$currentPassword = "";
$currentPassword2 = "";
$newPassword = "";
$newPassword2 = "";
$error1 = "";
$error2 = "";
if (isset($_POST['update2'])) {
    //echo "Bisa";
    $currentPassword = $row[5];
    //echo $currentPassword;
    //$newPassword = $_POST['password'];
    //echo $newPassword;
    $currentPassword2 = $_POST['oldPassword'];
    //echo $currentPassword2;
    //$currentPassword2 = $_POST['oldPassword'];
    $newPassword = $_POST['password'];
    $newPassword2 = $_POST['password2'];
    //echo $currentPassword."<br>".$currentPassword2."<br>".$newPassword."<br>".$newPassword2;
    if ($currentPassword2 != $currentPassword) {
        echo "<script>alert('Password Lama tidak Sesuai!')</script>";
        header("Refresh: 0; url = akun.php");
        return false;
    } else {
        if ($newPassword != $newPassword2) {
            echo "<script>alert('Konfirmasi Password baru tidak sesuai!')</script>";
            header("Refresh: 0; url = akun.php");
            return false;
        } else {
            $updatePassword = mysqli_query($koneksi, "UPDATE akun SET password='$newPassword' WHERE email='$getEmail'");
            echo "<script>alert('Password Telah Diperbaharui. Silahkan Login Kembali')</script>";
            header("Refresh: 0; url = logout.php");
            return false;
        }
    }
}
if (isset($_POST['cancel'])) {
    header("Refresh: 0; url = akun.php");
    return false;
}


?>
<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">

    <title>Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/sweetalert/sweetalert.css">
    <script type="text/javascript" src="plugins/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="banner">
        <div class="navb">
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <img src="../asset-img/logo-4.png" class="logoicon">
            <ul>
                <li><a href="../home/home.php"> Home </a></li>
                <li><a href="../about/about.php">About</a></li>
                <li><a href="../produk2/produk.php">Produk</a></li>
                <li><a href="../pesanan/pesanan.php">Pesanan</a></li>
                <li><a href="../contact/contact.php">Contact</a></li>
                <li><a href="../akun/akun.php"><i class="fa fa-fw fa-user"></i> Akun</a></li>

            </ul>
        </div>
        <section class="py-5 my-5">

            <div class="container">
                <h1 class="mb-5" style="text-align: center;">&ensp; Pengaturan<i class="fa fa-fw fa-user"></i></h1>
                <div class="bg-white shadow rounded-lg d-block d-sm-flex">
                    <div class="profile-tab-nav border-right">
                        <div class="p-4">
                            <div class="img-circle text-center mb-4">
                                <img src="../asset-img/profil.png" alt="Image" class="shadow">
                            </div>
                            <h4 class="text-center">
                                <div style="text-transform: uppercase;"><b><?php echo $namaView ?></b></div>
                            </h4>
                        </div>
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
                                <i class="fa fa-home text-center mr-1"></i>
                                Akun
                            </a>
                            <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
                                <i class="fa fa-key text-center mr-1"></i>
                                Password
                            </a>
                            </a>
                            <a class="nav-link" id="notification-tab" data-toggle="pill" href="#notification" role="tab" aria-controls="notification" aria-selected="false">
                                <i class="fa fa-power-off" style="font-size:15px;"></i>
                                Keluar
                            </a>
                        </div>
                    </div>
                    <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                            <h3 class="mb-4">Pengaturan Akun</h3>

                            <div class="row">
                                <form class="col-lg-12" action="" method="post" id="update">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <textarea style="resize:none;" class="form-control" rows="1" placeholder="" form="update" name="email" value="<?php echo $newEmail ?>"><?php echo $emailView ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Lengkap </label>
                                            <textarea style="resize:none;" class="form-control" rows="1" placeholder="" form="update" name="nama" value="<?php echo $newNama ?>"><?php echo $namaView ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Jenis Kelamin </label>
                                            <textarea style="resize:none;" class="form-control" rows="1" placeholder="" form="update" name="kelamin" value="<?php echo $newKelamin ?>"><?php echo $kelaminView ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>No Telepon </label>
                                            <textarea style="resize:none;" class="form-control" rows="1" placeholder="" form="update" name="noTelepon" value="<?php echo $newNoTelepon ?>">0<?php echo $noTeleponView ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Alamat </label>
                                            <textarea style="resize:none;" class="form-control" rows="4" placeholder="" form="update" name="alamat" value="<?php echo $newAlamat ?>"><?php echo $alamatView ?></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <form action="" method="post" id="cancel"></form>
                            <div>
                                <button class="btn btn-success" onclick="return confirm('Yakin Perbaharui Akun ?')" type="submit" form="update" name="update">Update</button>
                                <button class="btn btn-light" type="submit" form="cancel" name="cancel">Cancel</button>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                            <h3 class="mb-4">Password Settings</h3>

                            <form class="col-lg-12" action="" method="post" id="updatePass">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password Lama</label>
                                            <input type="password" class="form-control" name="oldPassword" value="<?php echo $currentPassword2 ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password Baru</label>
                                            <input type="password" class="form-control" name="password" value="<?php echo $newPassword ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control" name="password2" value="<?php echo $newPassword2 ?>">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div>
                                <button class="btn btn-success" onclick="return confirm('Yakin Perbaharui Password ?')" type="submit" form="updatePass" name="update2">Update</button>
                                <button class="btn btn-light" type="submit" form="cancel" name="cancel">Cancel</button>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                            <h3 class="mb-4">Keluar</h3>

                            <div>
                                <a href="../logout/logout.php"><button onclick="return confirm('Keluar dari website ?')" class="btn btn-success">Keluar</button></a>
                                <button class="btn btn-light" type="submit" form="cancel" name="cancel">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>