<?php
//Include properties
  include ('databases/koneksi.php');
  include ('function/public.web.fungsi.php');
  include ('function/template.web.fungsi.php');
  load_header();
  load_css();
  load_navigasi();
?>

      <!-- Page Heading -->
      <!--
      <h1 class="my-6 page-header">
        <small>Artikel</small>
      </h1>
      -->
      <div class="row" style="margin-top: 15px;">
        <?php 
        $result=tampil_berita();
        //jika query tampil berita dipanggil
        if($result){
        //dan data berita ada, maka tampilkan
        if(num_rows($result)>0){
        //lalu limit jumlah berita yang ditampilkan berdasarkan query limit
        while($row=fetch($limit)){
        echo "<div class='col-lg-3 col-md-4 col-sm-6 portfolio-item'>";
          echo "<div class='card h-100'>";
            echo "<a href='read.php?id=".$row['id']."'><img class='card-img-top' src='content/".$row['gambar_berita']."' alt='".$row['judul_berita']."'></a>";
            echo"<div class='card-body'>";
              echo "<h6 class='card-title'>";
                echo "<a href='read.php?id=".$row['id']."'>".$row['judul_berita']."</a>";
              echo "</h6>";
              echo "<p class='card-text'>".htmlspecialchars_decode(htmlspecialchars_decode(substr($row['isi_berita'],0,50)))."</p>";
              
            echo "</div>";
          echo "</div>";
        echo "</div>";
        }
          }else{
            echo "<p class='lead'><em>Data berita belum ada</em></p>";
          }

          }else{
           echo "ERROR: Tidak bisa mengeksekusi perintah. " . mysqli_error($koneksi);
        }
?>
       
       
      </div>
      <!-- /.row -->
      
<?php
/*  Pagination */
$total = num_rows($result);
$pages = ceil($total/$halaman); 
//total jumlah data dibagi pembagian halaman
?>
      <ul class="pagination justify-content-center">
         <li class="page-item">
          <a class="page-link" href="javascript:history.back()" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <?php
        for ($i=1; $i<=$pages ; $i++){ ?>
        <li class="page-item">          
          <a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li> 
        <?php } ?>
        <li class="page-item">
          <a class="page-link" href="?halaman=<?php echo $i-1; //Tombol Next ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>

<?php
//footer
load_footer();
?>
  
