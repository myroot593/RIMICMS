<?php
// Cek URL ID apakah berisi data atau tidak
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "../databases/koneksi.php";
    require_once "../function/admin.web.fungsi.php";
         //memanggil function detail berita
    if(!detail_berita(trim($_GET["id"]))){
               //Setelah menggunakan bind result tidak usah mendefiniskan nilai satu persatu lagi, langsung saja panggil variabel yang dibutuhkan
                //Jika data yang bersangkutan tidak ada di database, maka arahkan ke halaman error
                header("location: error");
                exit();
    }   
    // Close connection
    mysqli_close($koneksi);
    }else{
    // Jika URL ID di Address bar kosong maka arahkan ke halaman error
    header("location: error");
    exit();
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
              <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Detail Berita</li>
          </ol>
          <!-- Page Content -->
        <h1><?php echo $judul_berita; ?></h1>
        <hr>
        <img src="../content/<?php echo $gambar_berita; ?> " class="img-fluid">
        <?php echo htmlspecialchars_decode(htmlspecialchars_decode($isi_berita)); ?><br/>
  
    <p class="small text-lef text-muted my-5">
            <em>Ditulis pada : <?php echo $tanggal_berita; ?> oleh : <?php echo $penulis_berita; ;?> </em>
    </p>

 <?php include('footer.php');?>      
