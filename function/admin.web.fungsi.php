<?php

function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function cek_angka($data){
  if(!preg_match("/^[0-9]*$/",$data)){
  $data=true;
  }else{
  $data=false;
  }
  return $data;
}
function cek_alphabet($data){
  if(!preg_match("/^[a-zA-Z ]*$/",$data)){
  $data=true;
  }else{
  $data=false;
  }
  return $data;
}
function query($sql){
  global $koneksi;
  $perintah = mysqli_query($koneksi, $sql);
  if(!$perintah) die ("Gagal melakukan query".mysqli_error($koneksi));
  return $perintah;
}
function fetch($data){
  $perintah = mysqli_fetch_array($data);
  return $perintah;
}
function prepare($sql){
  global $koneksi;
  $perintah = mysqli_prepare($koneksi, $sql);
  if(!$perintah) die("Gagal melakukan koneksi".mysqli_error($koneksi));
  return $perintah;
}
function execute($stmt){
  $perintah = mysqli_stmt_execute($stmt);
  return $perintah;
}
function stmt_close($stmt){
  $perintah = mysqli_stmt_close($stmt);
  return $perintah;
}
function close($koneksi){
  $perintah = mysqli_close($koneksi);
  return $perintah;
}
function get_result($stmt){
  $perintah=mysqli_stmt_get_result($stmt);
  return $perintah;
}
function store_result($stmt){
  $perintah=mysqli_stmt_store_result($stmt);
  return $perintah;
}
function free_result($stmt){
  $perintah = mysqli_free_result($stmt);
  return $perintah;
}
function num_rows($stmt){
  $perintah = mysqli_num_rows($stmt);
  return $perintah;
}
function num_rows_2($stmt){
  $perintah=mysqli_stmt_num_rows($stmt);
  return $perintah;
}
function simpan_berita($judul_berita, $isi_berita, $kategori_berita, $status_berita, $penulis_berita, $gambar_berita, $tanggal_berita){

  global $item_gambar;
  global $upload_dir;
  
  $sql="INSERT INTO tabel_berita(judul_berita, isi_berita, kategori_berita, status_berita, penulis_berita, gambar_berita, tanggal_berita) VALUES (?,?,?,?,?,?,?)";

  if($stmt=prepare($sql)){
        mysqli_stmt_bind_param($stmt,"sssssss", $param_judul_berita, $param_isi_berita, $param_kategori_berita, $param_status_berita, $param_penulis_berita,  $param_gambar_berita, $param_tanggal_berita);
        $param_judul_berita = $judul_berita;
        $param_isi_berita = $isi_berita;
        $param_kategori_berita = $kategori_berita;
        $param_status_berita = $status_berita;
        $param_penulis_berita = $penulis_berita;
        $param_gambar_berita = $item_gambar;
        $param_tanggal_berita = $tanggal_berita;
          
        if(execute($stmt)&&(move_uploaded_file($gambar_berita, $upload_dir.$item_gambar))){
          $simpan=true;
          }else{
          $simpan=false;
          }
           return $simpan;
  }

          stmt_close($stmt);
}

function update_berita($judul_berita, $isi_berita, $kategori_berita, $status_berita, $penulis_berita, $gambar_berita, $tanggal_berita, $id){
  global $item_gambar;
  global $upload_dir;
  $sql = "UPDATE tabel_berita SET judul_berita=?, isi_berita=?, kategori_berita=?, status_berita=?, penulis_berita=?, gambar_berita=?, tanggal_berita=? WHERE id=?";
        
      if($stmt = prepare($sql)){           
         mysqli_stmt_bind_param($stmt,"sssssssi", $param_judul_berita, $param_isi_berita, $param_kategori_berita, $param_status_berita, $param_penulis_berita, $param_gambar_berita, $param_tanggal_berita, $param_id);
            $param_judul_berita = $judul_berita;
            $param_isi_berita = $isi_berita;
            $param_kategori_berita = $kategori_berita;
            $param_status_berita = $status_berita;
            $param_penulis_berita = $penulis_berita;
            $param_gambar_berita = $item_gambar;
            $param_tanggal_berita = $tanggal_berita;
            $param_id= $id;
            
          if(empty($_FILES["gambar_berita"]["tmp_name"])){
            if(execute($stmt)){
            $simpan=true;
            }else{
            $simpan=false;
            }
            return $simpan;
          }else{    

            if(execute($stmt) && (move_uploaded_file($gambar_berita, $upload_dir.$item_gambar))){
            $simpan=true;
            }else{
            $simpan=false;
            }
            return $simpan;
          }
      }
            stmt_close($stmt);
}
function tampil_berita(){
        $sql = "SELECT id, judul_berita, isi_berita, penulis_berita, tanggal_berita, gambar_berita FROM tabel_berita order by id desc";
        $result = query($sql);
        return $result;
}
function detail_berita($var_id){
    global $id, $judul_berita, $isi_berita, $penulis_berita, $gambar_berita, $tanggal_berita;
     $sql = "SELECT id, judul_berita, isi_berita, penulis_berita, gambar_berita, tanggal_berita FROM tabel_berita WHERE id = ?";
      if($stmt = prepare($sql)){
          mysqli_stmt_bind_param($stmt, "i", $param_id);
          $param_id = $var_id;
          if(execute($stmt)){     
             
             /*
             Old Get Result
             global $row;
             $result = get_result($stmt);
             $row = fetch($result, MYSQLI_ASSOC);
              */
          store_result($stmt);
          mysqli_stmt_bind_result($stmt, $id, $judul_berita, $isi_berita, $penulis_berita, $gambar_berita, $tanggal_berita);
            mysqli_stmt_fetch($stmt);
            if(num_rows_2($stmt) == 1){
              return true;
              }else{                 
              return false;
              }

            }else{
              echo "Terjadi kesalahan. Coba lagi nanti";
            }
             
          }

             stmt_close($stmt);
}
function detail_berita_img($var_id){
    global $var_item, $gambar_berita;
     $sql = "SELECT id, gambar_berita FROM tabel_berita WHERE id = ?";
      if($stmt = prepare($sql)){
          mysqli_stmt_bind_param($stmt, "i", $param_id);
          $param_id = $var_id;
          if(execute($stmt)){     
             
             /*
             Old Get Result
             global $row;
             $result = get_result($stmt);
             $row = fetch($result, MYSQLI_ASSOC);
              */
          store_result($stmt);
          mysqli_stmt_bind_result($stmt, $var_item, $gambar_berita);
            mysqli_stmt_fetch($stmt);
            if(num_rows_2($stmt) == 1){
              return true;
              }else{                 
              return false;
              }

            }else{
              echo "Terjadi kesalahan. Coba lagi nanti";
            }
             
          }

             stmt_close($stmt);
}
function delete_berita($var_id){
    $sql = "DELETE FROM tabel_berita WHERE id = ?";
      if($stmt = prepare($sql)){
         mysqli_stmt_bind_param($stmt, "i", $param_id);
         $param_id = $var_id;

                //Query kedua untuk mengrow atau unlink
                $sql="SELECT id, gambar_berita FROM tabel_berita where id=?";
                if($prepare=prepare($sql)){
                  mysqli_stmt_bind_param($prepare, "i", $param_id);
                  execute($prepare);
                  /*
                  $result = get_result($prepare)
                  */
                  store_result($prepare);
                  mysqli_stmt_bind_result($prepare, $id, $gambar_berita);
                  mysqli_stmt_fetch($prepare);
                    if(num_rows_2($prepare)==1){
                    /*bind result tidak usah di fetch langsung kses saja variabelnya
                    $jalankan=fetch($result);
                    */
                    $hapus_gambar=unlink("../content/$gambar_berita");
                    }else{
                    header("location: error");
                    exit();                   
                    }
                  }
                  if(execute($stmt) && ($hapus_gambar)){
                    return true;
                     }else{
                     return false;
                   }
      }
  
      stmt_close($stmt);
      stmt_close($prepare);   
}
function simpan_kategori_berita($kategori_berita){
	
	 $sql = "INSERT INTO tabel_kategori (kategori_berita) VALUES (?)";
  	if($stmt=prepare($sql)){
		mysqli_stmt_bind_param($stmt,"s",$param_kategori_berita);
		$param_kategori_berita = $kategori_berita;
  	if(execute($stmt)){
		$berhasil_simpan = true;
  	}else{
		$berhasil_simpan = false;
	  }
	   return $berhasil_simpan;
    } 
}
function tampil_kategori_berita(){
  $sql = "SELECT id, kategori_berita FROM tabel_kategori";
  $result = query($sql);
  return $result;
}
function delete_kategori($var_id){
    $sql = "DELETE FROM tabel_kategori WHERE id = ?";
      if($stmt = prepare($sql)){
         mysqli_stmt_bind_param($stmt, "i", $param_id);
         $param_id = $var_id;
          if(execute($stmt)){
            return true;
            }else{
            return false;
            }
      }
  
      stmt_close($stmt);
      
}
/*All Function add new user */
function tambah_user($username, $password, $nama, $email){
  $sql = "INSERT INTO user (username, password, nama, email) VALUES (?,?,?,?)";
  if($stmt=prepare($sql)){
    mysqli_stmt_bind_param($stmt,"ssss",$param_username, $param_password, $param_nama, $param_email);
    //set paramater
    $param_username = $username;
    $param_password = password_hash($password, PASSWORD_DEFAULT); 
    $param_nama = $nama;
    $param_email = $email;
    if(execute($stmt)){
      $simpan = true;
    }else{
      $simpan = false;
    }
      return $simpan;
  }
  close_stmt($stmt);
}
function tampil_user(){
  $sql="SELECT id, username, password, nama, email FROM user WHERE username='$_SESSION[admin]'";
  $perintah=query($sql);
  return $perintah;
}
function update_user($username, $password, $nama, $email, $id){
  $sql = "UPDATE user SET username =?, password=?, nama=?, email=? WHERE id=?";
  if($stmt=prepare($sql)){
    mysqli_stmt_bind_param($stmt,"ssssi",$param_username, $param_password, $param_nama, $param_email, $param_id);
    //set parameter
    $param_username = $username;
    $param_password = password_hash($password, PASSWORD_DEFAULT); 
    $param_nama = $nama;
    $param_email = $email;
    $param_id = $id;
    if(execute($stmt)){
      $simpan=true;
    }else{
      $simpan=false;
    }
    return $simpan;
  }
  close($stmt);
}
function cek_username($username){
  $sql = "SELECT id FROM user WHERE username =?";
  if($stmt=prepare($sql)){
    mysqli_stmt_bind_param($stmt,"s",$param_username);
    $param_username = $username;
    if(execute($stmt)){
      store_result($stmt);
    if(num_rows_2($stmt)==1){
      $simpan=true;
    }else{
      $simpan= false;
    }
    return $simpan; 
    }else{
      die ("Terjadi kesalahan, mohon bersabar ini ujian !");
    }
  }

  close_stmt($stmt);
}

?>


