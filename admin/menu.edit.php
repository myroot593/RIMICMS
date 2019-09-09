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
                if(!menu_edit_view(trim($_GET["id"]))){                 
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

$berhasil_simpan = $berhasil_simpan_err = $nama_menu_err = $kategori_menu_err = $link_menu_err = $urut_err = $parent_err = "";
//single menu
if(isset($_POST['kirim_single_menu'])){
    if(empty(trim($_POST['id']))){
      die("Terjadi kesalahan. Nilai ID tidak ditemukan");
    }else{
      $id=test_input($_POST['id']);
      $id=mysqli_real_escape_string($koneksi, $id);
    }
    if(empty(trim($_POST['nama_menu']))){
      $nama_menu_err = "Judul Menu tidak boleh kosong";     
      }elseif(strlen($_POST['nama_menu'])>30){
      $nama_menu_err = "Judul berita tidak boleh lebih dari 30 karakter ";
      }else{
        /*Jika nama menu sama dengan sebelumnya, maka simpan itu */
        if($_POST['nama_menu']==$_POST['nama_menu_banding']){
        $nama_menu=test_input($_POST['nama_menu']);
        $nama_menu=mysqli_real_escape_string($koneksi,$nama_menu);
        }else{
          /*Tetapi jika berbeda, cek apakah nama menu itu sudah ada sebelumnya */
          if(cek_nama_menu($_POST['nama_menu'])){
          $nama_menu_err = "Nama menu tersebut sudah ada sebelumnya, ganti dengan nama lain"; 
          }else{
          $nama_menu=test_input($_POST['nama_menu']);
          $nama_menu=mysqli_real_escape_string($koneksi,$nama_menu);
          }  

         }

      
    }
    if(empty(trim($_POST['kategori_menu']))){
      $kategori_menu_err="Kategori menu tidak boleh kosong";
      }else{
      $kategori_menu=test_input($_POST['kategori_menu']);
      $kategori_menu=mysqli_real_escape_string($koneksi,$kategori_menu);
    }

   if(trim($_POST['link_menu'])==''){
      $link_menu=test_input($_POST['link_menu']);
      $link_menu=mysqli_real_escape_string($koneksi,$link_menu);
      }elseif(trim($_POST['link_menu'])!=''){
        if(cek_url_menu($_POST['link_menu'])){
        $link_menu_err="Format penulisan url salah. Contoh penulisan yang http://www.root93.co.id";
        }else{
        $link_menu=test_input($_POST['link_menu']);
        $link_menu=mysqli_real_escape_string($koneksi,$link_menu);
        }
    }
    if(empty(trim($_POST['urut']))){
      $urut_err="Nomor urut menu tidak boleh kosong";
      }else{
      $urut=test_input($_POST['urut']);
      $urut=mysqli_real_escape_string($koneksi,$urut);
    }

    
    if(empty($nama_menu_err) && empty($kategori_menu_err)&& empty($link_menu_err) && empty($urut_err)){
    
      if(menu_update($nama_menu, $kategori_menu, $link_menu, $urut, $parent, $id)){
          $berhasil_simpan = "<div class='alert alert-success'>Berhasil mengupdate data</div>";
          echo "<meta http-equiv=\"refresh\"content=\"2;URL=menu.php\"/>";
      }else{
         $berhasil_simpan_err = "<div class='alert alert-danger'>Gagal mengupdate data</div>";
      }
    }


  }
//sub Menu
if(isset($_POST['kirim_data_sub'])){
    if(empty(trim($_POST['id']))){
      die("Terjadi kesalahan. Nilai ID tidak ditemukan");
      }else{
      $id=test_input($_POST['id']);
      $id=mysqli_real_escape_string($koneksi, $id);
    }
    if(empty(trim($_POST['nama_menu']))){
      $nama_menu_err = "Judul Menu tidak boleh kosong";     
      }elseif(strlen($_POST['nama_menu'])>30){
      $nama_menu_err = "Judul berita tidak boleh lebih dari 30 karakter ";
      }else{
        /*Jika nama menu sama dengan sebelumnya, maka simpan itu */
        if($_POST['nama_menu']==$_POST['nama_menu_banding']){
        $nama_menu=test_input($_POST['nama_menu']);
        $nama_menu=mysqli_real_escape_string($koneksi,$nama_menu);
        }else{
          /*Tetapi jika berbeda, cek apakah nama menu itu sudah ada sebelumnya */
          if(cek_nama_menu($_POST['nama_menu'])){
          $nama_menu_err = "Nama menu tersebut sudah ada sebelumnya, ganti dengan nama lain"; 
          }else{
          $nama_menu=test_input($_POST['nama_menu']);
          $nama_menu=mysqli_real_escape_string($koneksi,$nama_menu);
          }  

         }

      
    }
    if(empty(trim($_POST['kategori_menu']))){
      $kategori_menu_err="Kategori sub menu tidak boleh kosong";
      }else{
      $kategori_menu=test_input($_POST['kategori_menu']);
      $kategori_menu=mysqli_real_escape_string($koneksi,$kategori_menu);
    }
    //jika menu kosong, tetap simpan menu
    if(trim($_POST['link_menu'])==''){
        $link_menu=test_input($_POST['link_menu']);
        $link_menu=mysqli_real_escape_string($koneksi,$link_menu);
      //tetapi jika tidak kosong lakukan validasi
      }elseif(trim($_POST['link_menu'])!=''){
        if(cek_url_menu($_POST['link_menu'])){
        $link_menu_err="Format penulisan untuk sub menu url salah . Contoh penulisan yang http://www.root93.co.id";
        }else{
        $link_menu=test_input($_POST['link_menu']);
        $link_menu=mysqli_real_escape_string($koneksi,$link_menu);
        }
    }
    if(empty(trim($_POST['urut']))){
      $urut_err="Nomor sub urut menu tidak boleh kosong";
      }else{
      $urut=test_input($_POST['urut']);
      $urut=mysqli_real_escape_string($koneksi,$urut);
    }
    if(empty(trim($_POST['parent']))){
      $parent_err="Parent menu tidak boleh kosong";
    }else{
      /*memanggil fungsi tambah_sisip_parent dengan memanfaatkan nama dropdown
      nama dropdown tersebut di query lagi supaya bisa mendapatkan id dari dropdown
      tersebut untuk di sisipkan kedalam kolom parent
      */
      tambah_sisip_parent($_POST['parent']);
      $parent=test_input($id_parent);
      $parent=mysqli_real_escape_string($koneksi,$parent);

   

    }
    
    if(empty($nama_menu_err) && empty($kategori_menu_err)&& empty($link_menu_err) && empty($urut_err) && empty($parent_err)){
         //panggil fungsi update sub menu
        if(menu_update($nama_menu, $kategori_menu, $link_menu, $urut, $parent, $id)){
          $berhasil_simpan = "<div class='alert alert-success'>Berhasil mengupdate data</div>";
          echo "<meta http-equiv=\"refresh\"content=\"2;URL=menu.php\"/>";
            }else{
         $berhasil_simpan_err = "<div class='alert alert-danger'>Gagal mengupdate data</div>";
      }

    }


  }
?>


<?php
  /*Jika kategori menu yang di edit adalah kategori sub menu maka panggil konten html untuk sub menu */
  if($kategori_menu=='sub_menu'){
?>
<div id="content-wrapper">
  <div class="container-fluid">
          <ol class="breadcrumb">
          <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Edit Menu</li>
          </ol>
          <!-- Page Content -->
          <h3>Edit Menu</h3>
          <hr>
     <?php echo $berhasil_simpan; ?>
          <?php echo $berhasil_simpan_err; ?>
    <form action="<?php echo htmlspecialchars(basename(($_SERVER['REQUEST_URI'])));?>" method="post">
      <div class="form-group">
          <label>Judul Menu :</label>
          <input type="text" name="nama_menu" class="form-control" id="nama_menu" placeholder="Masukan judul menu" value="<?php echo $nama_menu; ?>">
          <input type="hidden" name="nama_menu_banding" value="<?php echo $nama_menu; ?>">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <span><p class="error-form"><?php echo $nama_menu_err; ?></p></span>
      </div>
      <div class="form-group">
        <label>Pilih Menu :</label>
        <?php 
        //memanggil menu fungsi dropdown
        $tampil_drop=tampil_menu_dropdown();
        if($tampil_drop){
        if(num_rows($tampil_drop)>0){
        echo "<select class='form-control' name='parent' id='parent' required=''>";
        /*memanggil fungsi tampil_menu_dropdown_edit untuk
        mengambil nilai menu dropdown yang dipilih sebelumnya
        */        
        $row=tampil_menu_dropdown_edit();
        $row_data=fetch($row);
        echo "<option value=".$row_data['nama_menu'].">".$row_data['nama_menu']."</option>";
        free_result($row);
        while($data=fetch($tampil_drop)){ 
        //Menampilkan menu - menu kategori dropdown
        echo "<option value=".$data['nama_menu'].">".$data['nama_menu']."</option>";
        }
        echo "</select>";
        }else{
          echo "<p>Belum ada kategori untuk menu dropdown sub menu. Silahkan tambah menu baru terlebih dahulu</p>";
        }
        free_result($tampil_drop);
      }
       ?>
      <span><p class="error-form"><?php echo $parent_err; ?></p></span>
      </div>
        <div class="form-group">
        <label>Link Menu :</label>
         <input type="text" name="link_menu" class="form-control" id="link_menu" placeholder="Masukan link menu. Contoh http://www.root93.co.id" value="<?php echo $link_menu; ?>">
          <span><p class="error-form"><?php echo $link_menu_err; ?></p></span>
          <input type="hidden" name="kategori_menu" class="form-control" id="kategori_menu" value="sub_menu" />
      </div>
      <div class="form-group">
        <label>Urut</label>
         <input type="number" name="urut" class="form-control" id="urut" placeholder="Masukan nomor urut menu" value="<?php echo $urut; ?>">
          <span><p class="error-form"><?php echo $urut_err; ?></p></span>
      </div>
      <button type="submit" name="kirim_data_sub" class="btn btn-primary">Update</button>
    </form>

<?php
  /*Tetapi jika bukan maka panggil konten html untuk konten html menu edit dropdown atau single menu
  */ 
  }else{

?>

<div id="content-wrapper">

        <div class="container-fluid">
          <ol class="breadcrumb">
          <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Edit Menu</li>
          </ol>
          <!-- Page Content -->
          <h3>Edit Menu</h3>
          <hr>
          <?php echo $berhasil_simpan; ?>
          <?php echo $berhasil_simpan_err; ?>
          <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI']));?>" method="post">
            <div class="form-group">
                <label>Judul Menu :</label>
                <input type="text" name="nama_menu" class="form-control" id="nama_menu" placeholder="Masukan judul menu" value="<?php echo $nama_menu; ?>" />
                <input type="hidden" name="nama_menu_banding" value="<?php echo $nama_menu; ?>" />
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <span><p class="error-form"><?php echo $nama_menu_err; ?></p></span>
            </div>
            <div class="form-group">
              <label>Kategori :</label>
               <select class="form-control" name="kategori_menu" id="kategori_menu" required="">
                <option value="<?php echo $kategori_menu; ?>"><?php echo $kategori_menu; ?></option>
               <option value="single_menu">Single Menu</option>
               <option value="dropdown_menu">Dropdown Menu</option>
             </select>
                <span><p class="error-form"><?php echo $kategori_menu_err; ?></p></span>
            </div>
              <div class="form-group">
              <label>Link Menu :</label>
               <input type="text" name="link_menu" class="form-control" id="link_menu" placeholder="Masukan link menu. Contoh http://www.root93.co.id" value="<?php echo $link_menu; ?>">
                <span><p class="error-form"><?php echo $link_menu_err; ?></p></span>
            </div>
            <div class="form-group">
              <label>Urut</label>
               <input type="number" name="urut" class="form-control" id="urut" placeholder="Masukan nomor urut menu" value="<?php echo $urut; ?>">
                <span><p class="error-form"><?php echo $urut_err; ?></p></span>
            </div>
      <button type="submit" name="kirim_single_menu" class="btn btn-primary">Update</button>
    </form>
<?php }  ?>




<?php include('footer.php');?>
