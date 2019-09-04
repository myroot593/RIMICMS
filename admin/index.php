<?php
include ('head.php');
include ('css.php');
include ('navigasi.php');
include ('../databases/koneksi.php');
include ('../function/admin.web.fungsi.php');
?>
<?php
//panggil fungsi untuk untuk memilih data lalu jumlah banyak data pada tabel berita
$tampil=tampil_berita();
$jumlah_data=num_rows($tampil);
?>
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>

          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-edit"></i>
                  </div>
                  <div class="mr-5"><?php echo $jumlah_data; ?> Postingan</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="lihat-berita.php">
                  <span class="float-left">Lihat Postingan</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-edit"></i>
                  </div>
                  <div class="mr-5">Buat Berita</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="tambah-berita.php">
                  <span class="float-left">Tambah</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5">Komentar</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-book"></i>
                  </div>
                  <div class="mr-5">Label</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="kategori-berita.php">
                  <span class="float-left">Buat kategori</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>

<?php include('footer.php');?>
