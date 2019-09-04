<?php
//include properti
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
// Cek parameter id URL kosong maka arahkan ke percabangan error terakhir
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){        
                //memanggil function detail berita
                if(!detail_berita(trim($_GET["id"]))){                 
                //Setelah menggunakan bind result tidak usah mendefiniskan nilai satu persatu lagi, langsung saja panggil variabel yang dibutuhkan
                //Jika data yang bersangkutan tidak ada di database, maka arahkan ke halaman error
                    header("location: error");
                    exit();
                }             
       
            
    }else{
        // Jika id kosong maka arahkan ke halaman error
        header("location: error");
        exit();
    }
?>

<?php
//SET UPDATE
$berhasil_simpan = $berhasil_simpan_err = $judul_berita_err = $isi_berita_err = $tanggal_berita_err = $penulis_berita_err = $gambar_berita_err = $kategori_berita_err = $id_err = "";
        /* POST DATA AND VALIDATION */
if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty(trim($_POST['id']))){
            $id_err="Terjadi kesalahan, data id tidak ditemukan";
            }else{
            $id=test_input($_POST['id']);
         }
        //Judul berita
        if(empty(trim($_POST['judul_berita']))){
             $judul_berita_err = "Judul Berita tidak boleh kosong";     
             }elseif(strlen($_POST['judul_berita'])>100){
             $judul_berita_err = "Judul berita tidak boleh lebih dari 100 karakter ";
             }else{
             $judul_berita=test_input($_POST['judul_berita']);
             $judul_berita=mysqli_escape_string($koneksi,$judul_berita);
            }
        //Isi Berita
        if(empty(trim($_POST['isi_berita']))){
            $isi_berita_err="Isi berita tidak boleh kosong";
            }else{
            $isi_berita=test_input($_POST['isi_berita']);
            } 
        //Kategori Berita
        if(empty(trim($_POST['kategori_berita']))){
            $kategori_berita_err = "Kategori berita tidak boleh kosong"; 
            }else{
            $kategori_berita = test_input($_POST['kategori_berita']);
            $kategori_berita = mysqli_real_escape_string ($koneksi, $kategori_berita);
          
          }
          if(empty(trim($_POST["status_berita"]))){
            $status_berita_err = "Status berita tidak boleh kosong";
            }else{
            $status_berita = test_input($_POST["status_berita"]);
            $status_berita = mysqli_real_escape_string($koneksi, $status_berita);
          }
        // Penulis Berita
        $penulis_berita = "$_SESSION[admin]";
        // Tanggal Berita 
        if(empty(trim($_POST['tanggal_berita']))){
          $tanggal_berita_err="Maaf terjadi kesalahan !";
          echo "<meta http-equiv=\"refresh\"content=\"2;URL=index.php\"/>";
          }elseif(strlen($_POST['tanggal_berita'])!=8){
          $tanggal_berita_err="Maaf terjadi kesalahan !";
          echo "<meta http-equiv=\"refresh\"content=\"2;URL=index.php\"/>";
          }else{
          $tanggal_berita=test_input($_POST['tanggal_berita']);
          $tanggal_berita=mysqli_real_escape_string($koneksi,$tanggal_berita);
        }

     if(empty($_FILES["gambar_berita"]["tmp_name"])){
            if(detail_berita_img(trim($_POST['id']))){              
              $item_gambar=$gambar_berita;                  
              } 
              }else{
              //Gambar berita
              $imgFile = $_FILES['gambar_berita']['name'];
              $tmp_dir = $_FILES['gambar_berita']['tmp_name'];
              $imgSize = $_FILES['gambar_berita']['size'];
              //letak direktori gambar
              $upload_dir = '../content/';
              //variabel pengecekan ektensi gambar
              $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
              $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
              //Merename gambar secara random
              $item_gambar = rand(1000,1000000).".".$imgExt; 
              /*Memulai Validasi */
             
             if(in_array($imgExt, $valid_extensions)){  
               if(!$imgSize < 2000000){
                $gambar_berita=$tmp_dir;
                }else{
                $gambar_berita_err="Maaf file foto berita terlalu besar. Max 2MB"; 
                } 
                }else{
                $gambar_berita_err="Maaf ektensi foto berita tidak sesuai ketentuan";
                }
          }
         
          //cek data before insert to db
        if(empty($judul_berita_err) && empty($isi_berita_err)&& empty($penulis_err) && empty($kategori_berita_err) && empty($tanggal_berita_err) && empty($gambar_berita_err) && empty($id_err)){
          //memanggil fungsi update berita
             if(update_berita($judul_berita, $isi_berita, $kategori_berita, $status_berita, $penulis_berita, $gambar_berita, $tanggal_berita, $id)){
                    $berhasil_simpan = "Data berhasil diperbaharui";
                    echo "<meta http-equiv=\"refresh\"content=\"2;URL=lihat-berita.php\"/>";
                }else{
                    $berhasil_simpan_err = "Data gagal diperbaharui";
                }

        }

     
}
?>

<div id="content-wrapper">

        <div class="container-fluid">
          <ol class="breadcrumb">
          <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Edit Berita</li>
          </ol>
          <!-- Page Content -->
          <h3>Edit Berita</h3>
          <hr>
    <p class="sukses-form"><?php echo $berhasil_simpan; ?></p>
    <p class="error-form"><?php echo $berhasil_simpan_err; ?></p>
    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI']));?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>Judul :</label>
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <input type="text" name="judul_berita" class="form-control" id="judul_berita" placeholder="Masukan judul berita" value="<?php echo $judul_berita;?>">
        <span><p class="error-form"><?php echo $judul_berita_err; ?></p></span>
        </div>
        <div class="form-group">
          <label>Isi Berita :</label>
          <textarea class="ckeditor" name="isi_berita" id="isi_berita"><?php echo $isi_berita; ?></textarea>
          <span><p class="error-form"><?php echo $isi_berita_err; ?></p></span>
        </div>
        <div class="form-group">
          <label>Kategori Berita :</label>
          <?php
              
              $result=tampil_kategori_berita();
              if($result){
                if(num_rows($result)>0){
                echo "<select class='form-control' name='kategori_berita' id='kategori_berita' required=''>";
                while($row=fetch($result)){
                echo "<option value=".$row['kategori_berita'].">".$row['kategori_berita']."</option>";
                }
                free_result($result);

                }else{
                 echo "<p class='lead'><em>Kategori berita masih kosong !</em></p>";
                }

              }else{
               echo "ERROR: Tidak bisa mengeksekusi perintah. ";
              }
              echo "</select>";
              //close connections
              close($koneksi);

          ?>
        </div>
        <div class="form-group">
          <label>Status:</label>
          <select class="form-control" name="status_berita" id="status_berita">
            <option value="Diterbitkan">Diterbitkan</option>
            <option value="Draft">Draft</option>
          </select>
         </div>
        <div class="form-group">
          <label>Gambar Berita</label>
          <input type="hidden" name="tanggal_berita" id="tanggal_berita" value="<?php echo date("y-m-d");?>">
          <input type="file" class="form-control-file" id="gambar_berita" name="gambar_berita" />
          <p>
            gambar saat ini :<br>
          <img src="../content/<?php echo $gambar_berita; ?>" class="img-fluid" height="100" width="100">
        </p>       
        <p class="error-form"><?php echo $gambar_berita_err; ?></p>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    <p><?php echo $tanggal_berita_err; ?></p>  
    <p class="error-form"><?php echo $penulis_berita_err; ?></p>



<?php include('footer.php');?>
