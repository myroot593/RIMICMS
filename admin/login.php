<?php 
session_start();
include('../databases/koneksi.php');
$username = $password = "";
$username_err = $password_err = "";
$berhasil_login = $gagal_login = "";
// Processing form data when form is submitted
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
    
    // Validate credentials
if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM user WHERE username = ?";
        
        if($stmt = mysqli_prepare($koneksi, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);            
            // Set parameters
            $param_username = $username;            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                      /* Password is correct, so start a new session and
                      save the username to the session */                           
                      $_SESSION['admin']=$username;  
                      $berhasil_login="Login berhasil. Mengarahkan....";             
                      echo "<meta http-equiv=\"refresh\"content=\"5;URL=index.php\"/>";
                        }else{
                            // Display an error message if password is not valid
                            $password_err = 'Username atau Password tidak valid';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'Username atau password tidak valid';
                }
            } else{
                $gagal_login="Oops! terjadi kesalahan, Coba lagi nanti";
            }
        }        
        // Close statement
        mysqli_stmt_close($stmt);
    }    
    // Close connection
    mysqli_close($koneksi);
}

?>

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
    <?php  include ('css.php'); ?>   

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header"> <img class="logo-login img-responsive" src="../properties/content/logo.png" alt="Logo CMS RIMI"> LOGIN CMS RIMI</div>
          <div class="logo-login">           
          </div>
        <div class="card-body">         
          <p class="sukses-form"><?php echo $berhasil_login; ?></p>
          <p class="error-form"><?php echo $gagal_login; ?></p>
          <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI']));?>" method="post">

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
             <p class="error-form"><?php echo $password_err; ?></p>
            <p class="error-form"><?php echo $username_err; ?></p>
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
        <input type="submit" class="btn btn-primary btn-block" name="login" value="login" />
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
