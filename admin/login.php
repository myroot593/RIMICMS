<?php 
session_start();
include('../databases/koneksi.php');
include('../function/login.web.fungsi.php');
/*Default variabel ketika tidak memiliki nilai */
$username = $password =$username_err = $password_err = $berhasil_login = $gagal_login = "";
/*Validasi ketika ada proses post dari html login */
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
if(empty(trim($_POST['username']))){
    $username_err = 'Mohon masukan username';
    } else{
    $username = trim($_POST['username']);
    $username = mysqli_real_escape_string($koneksi, $username);
}
if(empty(trim($_POST['password']))){
  $password_err = 'Mohon masukan password';
    }else{
    $password = trim($_POST['password']);
    $password = mysqli_real_escape_string($koneksi, $password);
}
    

if(empty($username_err) && empty($password_err)){
       
    if(Login_UserCek($username, $password)){                      
          $_SESSION['admin']=$username;  
          $berhasil_login="<div class='alert alert-success'>Login berhasil. Mengarahkan....</div>";             
          echo "<meta http-equiv=\"refresh\"content=\"5;URL=index.php\"/>";
          }else{
                            
          $password_err = "<div class='alert alert-danger'>Username atau password tidak valid</div>";
        }
               
    mysqli_close($koneksi);
  }
}

?>

<?php
  Load_HtmlLogin();
  
?>
