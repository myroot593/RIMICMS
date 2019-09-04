<?php
//Include properties
  include ('databases/koneksi.php');
  include ('function/public.web.fungsi.php');
  include ('head.php');
  include ('css.php');
  include ('navigasi.php');
?>
<?php
// Cek URL ID apakah berisi data atau tidak
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    if(!readmore_berita(trim($_GET["id"]))){
                /*
                Karena kita sudah mengganti get result dengan bind result maka tidak perlu lagi panggil dat satu persatu sesuai dengan kolom tabelnya
                langsung eksekusi saja variabelnya
                Menampilkan satu persatu data 
                $judul_berita = $row["judul_berita"];
                $isi_berita = $row["isi_berita"];
                $kategori_berita = $row["kategori_berita"];
                $penulis_berita = $row["penulis_berita"];
                $tanggal_berita = $row["tanggal_berita"];
                $gambar_berita = $row["gambar_berita"];
                */

            
                // Jika id tidak ditemukan maka alihkan ke halaman error
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
<div class="row">
<div id="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb" style="margin-top: 15px;">
            <li class="breadcrumb-item">
              <a href="index.php">Kembali</a>
            </li>
            <li class="breadcrumb-item active"><?php echo $judul_berita; ?></li>
          </ol>
          <!-- Page Content -->
         <figure class="figure">
        <img src="content/<?php echo $gambar_berita; ?> " alt="<?php echo $judul_berita;?>" title="<?php echo $judul_berita;?>" class="figure-img img-fluid">
        <figcaption class="figure-caption"><?php echo $judul_berita; ?></figcaption>
        <figcaption class="figure-caption">Ditulis pada : <?php echo $tanggal_berita; ?> oleh : <?php echo $penulis_berita; ;?> | Label : <?php echo $kategori_berita; ;?></figcaption>
    	</figure>
        <h3><?php echo $judul_berita; ?></h3>
        <hr>
        <?php echo htmlspecialchars_decode(htmlspecialchars_decode($isi_berita)); ?><br/>
              <p class="small text-lef text-muted my-5">
      
    </p>
  </div>
</div>
</div>
<?php
//footer
include('footer.php');
?>
  
