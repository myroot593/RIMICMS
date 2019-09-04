<?php
include ('head.php');
include ('css.php');
include ('navigasi.php');
include ('../databases/koneksi.php');
include ('../function/admin.web.fungsi.php');
?>
<?php
$berhasil_simpan = $username = $nama = $email =  $password = $confirm_password = "";
$berhasil_simpan_err = $username_err = $nama_err = $email_err = $password_err = $confirm_password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
// Validate username
if(empty(trim($_POST["username"]))){
    $username_err = "Harap masukan username.";
    }else{
    if(cek_username(trim($_POST["username"]))){
    $username_err = "Username yang Anda masukan sudah digunakan";
    }else{
    $username =trim($_POST["username"]);
    }
}
// Validate password
if(empty(trim($_POST["password"]))){
      $password_err = "harap masukan sebuah password.";     
        }elseif(strlen(trim($_POST["password"])) < 5){
        $password_err = "Password tidak boleh kurang dari 5 karakter";
        }else{
        $password = trim($_POST["password"]);
} 
// Validate confirm password
if(empty(trim($_POST["confirm_password"]))){
    $confirm_password_err = "Masukan konfirmasi password.";     
    }else{
    $confirm_password = trim($_POST["confirm_password"]);
    //jika password_err tidak error maka bandingkan  nilai password dengan confirm password, jika tidak mirip != maka aktifkan error confirm_passworderr
    if(empty($password_err) && ($password != $confirm_password)){
    $confirm_password_err = "Konfirmasi password tidak cocok";
    }
}
//Validate nama
if(empty(trim($_POST["nama"]))){
        $nama_err = "Mohon masukan sebuah nama";
        }elseif(strlen(trim($_POST["nama"]))> 20){
        $nama_err = "Nama tidak boleh lebih dari 20 karakter";
        }else{
        $nama = test_input($_POST["nama"]);
        $nama = mysqli_real_escape_string($koneksi, $nama);
}
//Validate email
if(empty(trim($_POST["email"]))){
        $email_err = "Plese fill your email";
        }else{
        $email = test_input($_POST["email"]);
        $email = mysqli_real_escape_string($koneksi, $email);
}
    
    // Jika semua nilai input error kosong makan jalankankan eksekusi ke db
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty ($nama_err) && empty($email_err)){
        
        if(tambah_user($username, $password, $nama, $email)){
                // Redirect to login page
                $berhasil_simpan="Akun $username berhasil disimpan";            
                echo "<meta http-equiv=\"refresh\"content=\"2;URL=tambah-user.php\"/>";
            } else{
                $berhasil_simpan_err="Maaf data tidak berhasil disimpan";
                
            }

         
        
    }
    
    // Close connection
    mysqli_close($koneksi);
}
?>
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Tambah user / pengguna</li>
          </ol>

          <!-- Page Content -->
          <h3>Tambah pengguna</h3>          
          <hr>
          <p class="sukses-form"><?php echo $berhasil_simpan; ?></p>
          <p class="error-form"><?php echo $berhasil_simpan_err; ?></p>
          <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI']));?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukan username yang Anda inginkan" value="<?php echo $username; ?>">
                <span class="error-form"><?php echo $username_err; ?></span>
            </div>  
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukan password" value="<?php echo $password; ?>">
                <span class="error-form"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Tulis ulang password" value="<?php echo $confirm_password; ?>">
                <span class="error-form"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
              <label>Nama Lengkap</label>
            <input type="text" maxlength="30" minlength="2" required="" name="nama" class="form-control" placeholder="Masukan Nama Lengkap Admin" value="<?php echo $nama; ?>">  </div>
            <div class="form-group">
              <label>Email</label>
            <input type="email" maxlength="30" minlength="2" required="" name="email" class="form-control" placeholder="Masukan Email Admin" value="<?php echo $email; ?>">  </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Simpan">             
            </div>
            
        </form>
          

 <?php include('footer.php');?>      
