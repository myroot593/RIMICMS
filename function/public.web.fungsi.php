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
function store_result($stmt){
  $perintah = mysqli_stmt_store_result($stmt);
  return $perintah;
}
function get_result($stmt){
  $perintah=mysqli_stmt_get_result($stmt);
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
function tampil_berita(){

  global $limit, $halaman;

        //batasan halaman
        $halaman = 8; 
        //get halaman
        $page = isset($_GET['halaman'])? (int)$_GET["halaman"]:1;
        //mulai perhitungan
        $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
        //query ini di limit ditampilkan di halaman index
        $limit = query("SELECT id, judul_berita, isi_berita, gambar_berita FROM tabel_berita order by id desc LIMIT $mulai, $halaman");
        //bagian ini query tanpa limit data
        $sql="SELECT id, judul_berita, isi_berita, gambar_berita FROM tabel_berita";
        $result = query($sql);
        return $result;
}

function readmore_berita($var_id){
   global $id, $judul_berita, $isi_berita, $kategori_berita, $penulis_berita, $gambar_berita, $tanggal_berita;
      $sql = "SELECT id, judul_berita, isi_berita, kategori_berita, penulis_berita, gambar_berita, tanggal_berita FROM tabel_berita WHERE id = ?";
      if($stmt = prepare($sql)){
          mysqli_stmt_bind_param($stmt, "i", $param_id);
          $param_id = $var_id;
          if(execute($stmt)){  
            /*Get result diganti bind result   
             $result = get_result($stmt);
              $row = fetch($result, MYSQLI_ASSOC);
             */
             store_result($stmt);
             mysqli_stmt_bind_result($stmt, $id, $judul_berita, $isi_berita, $kategori_berita, $penulis_berita, $gambar_berita, $tanggal_berita); 
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
?>
