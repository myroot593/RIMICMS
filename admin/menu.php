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
  include('menu.var.php');
?>
<?php
//sub Menu
  if(isset($_POST['kirim_data_sub'])){
    if(empty(trim($_POST['nama_menu_1']))){
      $nama_menu_err_1 = "Judul Sub Menu tidak boleh kosong";     
      }elseif(strlen($_POST['nama_menu_1'])>30){
      $nama_menu_err_1 = "Judul sub menu tidak boleh lebih dari 30 karakter ";
      }elseif(trim(cek_nama_menu($_POST['nama_menu_1']))){
      $nama_menu_err_1 = "Nama sub menu tersebut sudah ada sebelumnya, ganti dengan nama lain";
      }else{
      $nama_menu_1=test_input($_POST['nama_menu_1']);
      $nama_menu_1=mysqli_real_escape_string($koneksi,$nama_menu_1);
    }
    if(empty(trim($_POST['kategori_menu_1']))){
      $kategori_menu_err_1="Kategori sub menu tidak boleh kosong";
      }else{
      $kategori_menu_1=test_input($_POST['kategori_menu_1']);
      $kategori_menu_1=mysqli_real_escape_string($koneksi,$kategori_menu_1);
    }
    //jika menu kosong, tetap simpan menu
    if(trim($_POST['link_menu_1'])==''){
        $link_menu_1=test_input($_POST['link_menu_1']);
        $link_menu_1=mysqli_real_escape_string($koneksi,$link_menu_1);
      //tetapi jika tidak kosong lakukan validasi
      }elseif(trim($_POST['link_menu_1'])!=''){
        if(cek_url_menu($_POST['link_menu_1'])){
        $link_menu_err_1="Format penulisan untuk sub menu url salah . Contoh penulisan yang http://www.root93.co.id";
        }else{
        $link_menu_1=test_input($_POST['link_menu_1']);
        $link_menu_1=mysqli_real_escape_string($koneksi,$link_menu_1);
        }
    }
    if(empty(trim($_POST['urut_1']))){
      $urut_err_1="Nomor sub urut menu tidak boleh kosong";
      }else{
      $urut_1=test_input($_POST['urut_1']);
      $urut_1=mysqli_real_escape_string($koneksi,$urut_1);
    }
    if(empty(trim($_POST['parent_1']))){
      $parent_err_1="Parent menu tidak boleh kosong";
    }else{
      /*memanggil fungsi tambah_sisip_parent dengan memanfaatkan nama dropdown
      nama dropdown tersebut di query lagi supaya bisa mendapatkan id dari dropdown
      tersebut untuk di sisipkan kedalam kolom parent
      */
      tambah_sisip_parent($_POST['parent_1']);
      $parent_1=test_input($id_parent);
      $parent_1=mysqli_real_escape_string($koneksi,$parent_1);

   

    }
    
    if(empty($nama_menu_err_1) && empty($kategori_menu_err_1)&& empty($link_menu_err_1) && empty($urut_err_1) && empty($parent_err_1)){
         //panggil fungsi simpan berita
             if(tambah_sub_menu($nama_menu_1,$kategori_menu_1,$link_menu_1,$urut_1,$parent_1)){
                    $berhasil_simpan = "Data berhasil disimpan";
                    echo "<meta http-equiv=\"refresh\"content=\"2;URL=menu.php\"/>";
                }else{
                    $berhasil_simpan_err = "Data gagal disimpan";
                }

    }


  }
?>
<?php
//Single Menu
  if(isset($_POST['kirim_single_menu'])){
    if(empty(trim($_POST['nama_menu']))){
      $nama_menu_err = "Judul Menu tidak boleh kosong";     
      }elseif(strlen($_POST['nama_menu'])>30){
      $nama_menu_err = "Judul berita tidak boleh lebih dari 30 karakter ";
      }elseif(trim(cek_nama_menu($_POST['nama_menu']))){
      $nama_menu_err = "Nama menu tersebut sudah ada sebelumnya, ganti dengan nama lain";
      }else{
      $nama_menu=test_input($_POST['nama_menu']);
      $nama_menu=mysqli_real_escape_string($koneksi,$nama_menu);
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
         //panggil fungsi simpan berita
             if(tambah_single_menu($nama_menu,$kategori_menu,$link_menu,$urut)){
                    $berhasil_simpan = "Data berhasil disimpan";
                    echo "<meta http-equiv=\"refresh\"content=\"2;URL=menu.php\"/>";
                }else{
                    $berhasil_simpan_err = "Data gagal disimpan";
                }

    }


  }
?>


<div id="content-wrapper">
  <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Tambah berita</li>
          </ol>

          <!-- Page Content -->
          <h3>Tambah Menu</h3>
          <hr>
<p class="sukses-form"><?php echo $berhasil_simpan; ?></p>
<p class="error-form"><?php echo $berhasil_simpan_err; ?></p>
<!--Error Untuk Sub Menu -->
<span><p class="error-form"><?php echo $nama_menu_err_1; ?></p></span>
<span><p class="error-form"><?php echo $parent_err_1; ?></p></span>
<span><p class="error-form"><?php echo $link_menu_err_1; ?></p></span>
    <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">MENU BARU</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">SUB MENU</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">DATA MENU</a>
    </li>
     
  </ul>
<div class="tab-content">
  <div id="home" class="container tab-pane active"><br>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
          <label>Judul Menu :</label>
          <input type="text" name="nama_menu" class="form-control" id="nama_menu" placeholder="Masukan judul menu" value="<?php echo $nama_menu; ?>">
          <span><p class="error-form"><?php echo $nama_menu_err; ?></p></span>
      </div>
      <div class="form-group">
        <label>Kategori :</label>
         <select class="form-control" name="kategori_menu" id="kategori_menu" required="">
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
      <button type="submit" name="kirim_single_menu" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <div id="menu1" class="container tab-pane fade"><br>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
          <label>Judul Menu :</label>
          <input type="text" name="nama_menu_1" class="form-control" id="nama_menu_1" placeholder="Masukan judul menu" value="<?php echo $nama_menu_1; ?>">
          <span><p class="error-form"><?php echo $nama_menu_err_1; ?></p></span>
      </div>
      <div class="form-group">
        <label>Pilih Menu :</label>
        <?php 
        $tampil_drop=tampil_menu_dropdown();
        if($tampil_drop){
        if(num_rows($tampil_drop)>0){
        echo "<select class='form-control' name='parent_1' id='parent_1' required=''>";
        while($data=fetch($tampil_drop)){   
        echo "<option value=".$data['nama_menu'].">".$data['nama_menu']."</option>";
        }
        echo "</select>";
        }else{
          echo "<p>Belum ada kategori untuk menu dropdown sub menu. Silahkan tambah menu baru terlebih dahulu</p>";
        }
      }
       ?>
          <span><p class="error-form"><?php echo $parent_err_1; ?></p></span>
      </div>
        <div class="form-group">
        <label>Link Menu :</label>
         <input type="text" name="link_menu_1" class="form-control" id="link_menu_1" placeholder="Masukan link menu. Contoh http://www.root93.co.id" value="<?php echo $link_menu; ?>">
          <span><p class="error-form"><?php echo $link_menu_err_1; ?></p></span>
          <input type="hidden" name="kategori_menu_1" class="form-control" id="kategori_menu_1" value="sub_menu" />
      </div>
      <div class="form-group">
        <label>Urut</label>
         <input type="number" name="urut_1" class="form-control" id="urut_1" placeholder="Masukan nomor urut menu" value="<?php echo $urut_1; ?>">
          <span><p class="error-form"><?php echo $urut_err_1; ?></p></span>
      </div>
      <button type="submit" name="kirim_data_sub" class="btn btn-primary">Submit</button>
    </form>
   </div>
  <div id="menu2" class="container tab-pane fade"><br>
    <div class="table-responsive">
      <?php 
                        $result=tampil_semua_menu(); //memanggil fungsi tampil berita
                        if($result){
                        if(num_rows($result) > 0){
                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example' width='100%' cellspacing='0'>";
                          echo "<thead>";
                            echo "<tr>";
                            
                              echo "<th>Id</th>";
                               echo "<th>Nama</th>";
                               echo "<th>Link</th>";
                              echo "<th>Kategori</th>";                      
                              echo "<th>Urut</th>";
                              echo "<th>Parent</th>";
                              echo "<th>Aksi</th>";               
                            echo "</tr>";
                          echo "</thead>";
                         /*
                          echo "<tfoot>";
                            echo "<tr>";
                               echo "<th>No</th>";
                              echo "<th>Judul Berita</th>";
                             echo "<th>Penulis</th>";
                              echo "<th>Tanggal Terbit</th>";
                              echo "<th>Aksi</th>";
                             
                          echo "</tr>";
                          echo "</tfoot>";
                          */
                          echo "<tbody>";

              while($data=fetch($result)) {                     
                  echo "<tr>";
                 
                  echo "<td>".$data['id']. "</td>";
                  echo "<td>".$data['nama_menu']."</td>";
                  echo "<td>".substr($data['link_menu'],0,15)."</td>";
                  echo "<td>".$data['kategori_menu']. "</td>";
                  echo "<td>".$data['urut']. "</td>";
                  echo "<td>".$data['parent']. "</td>";
                   echo "<td>";
                    
                     echo "<a href='menu.edit.php?id=".$data['id']."'title='Edit Menu' alt='Edit Menu'><i class='fa fa-edit fa-fw small'></i></a>";

                    

                    echo "</td>";
                 
                  echo "</tr>";
                //$no+=1;   
              }
              echo "</tbody>";
              echo"</table>";
              free_result($result);
                }else{
                  echo "<p class='lead'><em>Data Menu Belum ada</em></p>";
               }

                }else{
                echo "ERROR: Tidak bisa mengeksekusi perintah. " . mysqli_error($koneksi);
                }
           
              ?>
    </div>
  </div>
</div>
<?php
include('footer.php');
?>      

