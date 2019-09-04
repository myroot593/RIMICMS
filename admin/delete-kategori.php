<?php
// Memproses delete data setelah dilakukan konfirmasi terlebih dahulu
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "../databases/koneksi.php";
    require_once "../function/admin.web.fungsi.php";
         //memanggil function delete kategori  
        if(delete_kategori(trim($_POST['id']))){
         // jika berhasil menghapus data
                header("location: lihat-kategori.php");
            exit();
        } else{
            echo "Oops! terjadi kesalahan.Coba lagi nanti";
        }
    
    // Close connection
   close($koneksi);
} else{
    // Mengecek keberadaan ID
    if(empty(trim($_GET["id"]))){
        //Jika Parameter id tidak ditemukan atau kosong maka arahkan ke halaman error
        header("location: error");
        exit();
    }
}
?>
<?php
include ('head.php');
include ('css.php');
include ('navigasi.php');
?>
 <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Delete kategori</li>
          </ol>

          <!-- Page Content -->
          
          <hr>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger" role="alert">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="javascript:history.back()">No</a>
                            </p>
                        </div>
                    </form>
<?php include('footer.php');?>      
