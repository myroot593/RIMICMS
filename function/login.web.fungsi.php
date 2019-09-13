<?php    
function Login_UserCek($username, $password){
        global $koneksi, $username_err;
        $sql = "SELECT username, password FROM user WHERE username = ?";
         if($stmt = mysqli_prepare($koneksi, $sql)){
             mysqli_stmt_bind_param($stmt, "s", $param_username);            
            $param_username = $username;            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                //cek apakah data tersebut Anda (num rows), jika ada                
                if(mysqli_stmt_num_rows($stmt) == 1){ 
                //lakukan bind result
                mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                //kemudian fetch datanya
                 if(mysqli_stmt_fetch($stmt)){
                    //jika password benar
                    if(password_verify($password, $hashed_password)){
                    /*Berikan nilai true dan panggil session
                    $_SESSION['admin']=$username; 
                    atau masukan variabel yang dibutuhkan kedalam session 
                    */
                    return true;

                    }else{
                    /*
                    Tapi jika password salah ataupun username yang salah
                    maka berikan nilai false, dan akan menghasilkan nilai username 
                    atau password salah, jika ingin memberitahu mana yang salah secara terpisah antara username dan password pada num rows (end num rows) buat lagi percabangan else yang menyatakan username salah, dan kita tidak useh memberikan nilai return true atau false disini, nilai session diberikan langsung didalam function, dan variabel error untuk password atau username dibuat global. Contohnya bisa dilihat pada bagian kedua
                    */
                    return false;
                    }
                } 
            }//end num row
        } //end execute
    }//end prepare
    mysqli_stmt_close($stmt);
}    
function Login_UserCekSecond($username, $password){
        global $koneksi, $username_err, $password_err, $berhasil_login, $gagal_login;
        $sql = "SELECT username, password FROM user WHERE username = ?";
         if($stmt = mysqli_prepare($koneksi, $sql)){
             mysqli_stmt_bind_param($stmt, "s", $param_username);            
            $param_username = $username;            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                //cek apakah data tersebut Anda (num rows), jika ada                
                if(mysqli_stmt_num_rows($stmt) == 1){ 
                //lakukan bind result
                mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                //kemudian fetch datanya
                 if(mysqli_stmt_fetch($stmt)){
                    //jika password benar
                    if(password_verify($password, $hashed_password)){
                    $_SESSION['admin']=$username;
                    $berhasil_login="<div class='alert alert-success'>Login berhasil. Mengarahkan....</div>";             
                    echo "<meta http-equiv=\"refresh\"content=\"5;URL=index.php\"/>";
                    }else{
                    $password_err="<div class='alert alert-danger'>Password salah</div>";
                    }
                } 
            }else{ $username_err = "<div class='alert alert-danger'>Username salah</div>"; } //end num row
        }else{$gagal_login="Terjadi kesalahan. Login gagal";} //end execute
    }//end prepare
    mysqli_stmt_close($stmt);
}

function Load_HtmlLogin(){
    global $username_err, $password_err, $berhasil_login, $gagal_login;
    echo '
    <!DOCTYPE html>
    <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Admin Panel RIMI CMS ROOT93">
    <meta name="author" content="Ahmad Zaelani">
    <link rel="icon" href="http://localhost/cmsroot/properties/content/favicon.png">
    <title>Login Panel RIMI CMS</title>
    <link href="../properties/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../properties/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" 
    <!-- Custom styles for this template-->
    <link href="../properties/css/sb-admin.css" rel="stylesheet">
    <link href="../properties/css/kostum-admin.css" rel="stylesheet">
  </head>


  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header"> <img class="logo-login img-responsive" src="../properties/content/logo.png" alt="Logo CMS RIMI"> LOGIN CMS RIMI</div>
          <div class="logo-login">           
          </div>
        <div class="card-body">         
          '.$berhasil_login.'
          '.$gagal_login.'
          <form action="'.htmlspecialchars(basename($_SERVER['REQUEST_URI'])).'" method="post">

            <div class="form-group">
              <div class="form-label-group">
                <input id="username" name="username" class="form-control" placeholder="Masukan Username" required="required" autofocus="autofocus">
                <label for="username">Username</label>
              </div>
              
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
                <label for="password">Password</label>
              </div>             
            </div>
            <p class="error-form">'. $password_err.'</p>
            <p class="error-form">'.$username_err.'</p>
            <!--
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Remember Password
                </label>
              </div>
            </div>
          -->
        <input type="submit" class="btn btn-primary btn-block" name="login" value="Login" />
          </form>
          <!--
          <div class="text-center">
            <a class="d-block small mt-3" href="register.html">Register an Account</a>
            <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
          </div>
        -->
        </div>
      </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>  
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>
  </html>

    ';
}


?>
