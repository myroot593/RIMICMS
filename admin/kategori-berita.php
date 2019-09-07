<?php
//include properties
  include ('head.php');
  include ('css.php');
  include ('navigasi.php');
?>
<?php
//Database function and session
  include ('../databases/koneksi.php');
  include ('../function/admin.web.fungsi.php');
?>
<?php
//POST DATA AND VALIDATION 
    //set varibel input
      $kategori_berita = $berhasil_simpan = $gagal_simpan = ""; 
      //set error variabel
      $kategori_berita_err = "";

      if($_SERVER["REQUEST_METHOD"] == "POST"){

      if(empty(trim($_POST['kategori_berita']))){
          $kategori_berita_err = "Kategori Berita tidak boleh kosong";     
          }elseif(strlen($_POST['kategori_berita'])>20){
          $kategori_berita_err = "Kategori berita tidak boleh lebih dari 20 karakter ";
          }else{
          //cek apakah kategori sudah ada, panggil fungsi cek kategori
          if(cek_kategori(trim($_POST['kategori_berita']))){
            $kategori_berita_err = "Maaf kategori ".trim($_POST['kategori_berita'])." sudah ada !";
            }else{
            $kategori_berita= test_input($_POST["kategori_berita"]);
            $kategori_berita=mysqli_real_escape_string($koneksi,$kategori_berita);
            }
                               
               
          }

        if(empty($kategori_berita_err)){

            if(simpan_kategori_berita($kategori_berita)){
          	 $berhasil_simpan = "Data berhasil disimpan";
          	 echo "<meta http-equiv=\"refresh\"content=\"1;URL=kategori-berita.php\"/>";
              }else{
          	 $gagal_simpan = "Data gagal disimpan";
            }

          }

      }
?>
<div id="content-wrapper">
<div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
          <li class="breadcrumb-item">
          <a href="index.html">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Tambah kategori berita</li>
          </ol>
          <!-- Page Content -->
          <h3>Buat Kategori Berita</h3>
          <hr>

  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
    <div class="form-group">
    <label>Kategori baru :</label>
    <input type="text" name="kategori_berita" class="form-control" id="kategori_berita" placeholder="Masukan kategori berita yang baru" value="<?php echo $kategori_berita;?>" required="">
    <span class="error-form"><?php echo $kategori_berita_err; ?></span>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <hr/>
   <!-- DataTables Example -->
 <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Data kategori berita</div>
            <div class="card-body">
            <div class="table-responsive">
  <?php 
                $result=tampil_kategori_berita(); 
                if($result){
                if(num_rows($result) > 0){
                echo "<table class='table table-striped table-bordered table-hover' id='dataTable' width='100%' cellspacing='0'>";
                echo "<thead>";
                echo "<tr>";                
                echo "<th>Kategori Berita</th>";
                echo "<th>Aksi</th>";                                
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                //$awal=0;
                //$no=$awal+1;
                while($data=fetch($result)) {              
                             
                echo "<tr>";
                //echo "<td>". $no. "</td>";
                echo "<td>". substr($data['kategori_berita'],0,30). "</td>";
                echo "<td>";
                echo "<a href='delete-kategori.php?id=". $data['id'] ."' title='Delete Kategori'  alt='Delete'><i  class='fa fa-trash fa-fw'></i></a>";
                echo "</td>";
                echo "</tr>";
                //$no+=1;   
                 }
               echo "</tbody>";
               echo"</table>";
               free_result($result);
                }else{
                echo "<p class='lead'><em>Kategori berita belum ada</em></p>";
                }

                }else{
                echo "ERROR: Tidak bisa mengeksekusi perintah. " . mysqli_error($koneksi);
  }

  ?>
</div>
</div>

<div class="card-footer small text-muted"> <a href="#"><i class="fa fa-calendar"></i> <?php
  $Today=date('y:m:d');
  $new=date('l, F d, Y',strtotime($Today));
  echo $new; ?></a>
</div>
</div>

          <p class="small text-center text-muted my-5">
            <em>More table examples coming soon...</em>
          </p>
  <?php echo $berhasil_simpan; ?>
  <?php echo $gagal_simpan; ?>
  

<?php
include('footer.php');
?>      

