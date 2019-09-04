<?php
//Include properties
  include ('head.php');
  include ('css.php');
  include ('navigasi.php');
?>
<?php
//Database function and session
  include ('../databases/koneksi.php');
  include ('../function/admin.web.fungsi.php');
?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Postingan</li>
          </ol>

            <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Data Berita</div>
              <div class="entri-baru"><a href="tambah-berita.php" class="btn btn-primary btn-md">Entri Baru</a></div>
            <div class="card-body">
              <div class="table-responsive">
                <?php 
                $result=tampil_berita(); //memanggil fungsi tampil berita
                if($result){
                if(num_rows($result) > 0){
                echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example' width='100%' cellspacing='0'>";
                  echo "<thead>";
                    echo "<tr>";
                    
                      echo "<th>Judul Berita</th>";
                       echo "<th>Penulis</th>";
                      echo "<th>Tanggal Terbit</th>";                      
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
//$awal=0;
//$no=$awal+1;
while($data=fetch($result)) {                     
    echo "<tr>";
   
    echo "<td>". substr($data['judul_berita'],0,30). "</td>";
    echo "<td>".$data['penulis_berita']."</td>";
    echo "<td>".$data['tanggal_berita']. "</td>";
    
    echo "<td>";
    echo "<a href='detail-berita.php?id=". $data['id'] ."' title='Lihat Berita' alt='Lihat Berita'><i  class='fa fa-eye fa-fw small'></i></a>";
     echo "<a href='edit-berita.php?id=".$data['id']."'title='Edit Berita' alt='Edit Berita'><i class='fa fa-edit fa-fw small'></i></a>";
     echo "<a href='delete-berita.php?id=". $data['id'] ."' title='Delete Berita' alt='Delete Berita'><i  class='fa fa-trash fa-fw small'></i></a>";

    echo "</td>";
    echo "</tr>";
  //$no+=1;   
}
echo "</tbody>";
echo"</table>";
              free_result($result);
  } else{
    echo "<p class='lead'><em>Data berita belum ada</em></p>";
 }
            } else{
  echo "ERROR: Tidak bisa mengeksekusi perintah. " . mysqli_error($koneksi);
  }
 //close connections
mysqli_close($koneksi);
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

      <?php include('footer.php');?>
