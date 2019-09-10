<?php
function load_header(){
echo '<!DOCTYPE html>
	<html lang="id">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CMS RIMI INDONESIA">
    <meta name="author" content="Ahmad Zaelani">
    <link rel="icon" href="http://localhost/cmsroot/properties/content/favicon.png">
    <title>CMS RIMI</title>';
}

function load_css(){
	echo '    
	<!-- Bootstrap core CSS -->    
    <link href="properties/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <link href="properties/css/kostum.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="properties/css/4-col-portfolio.css" rel="stylesheet">

  </head>';
}
function load_navigasi(){
	echo 
	'<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="logo navbar-btn pull-left" href="index.php" title="Home">
          <img src="properties/content/nav.png" alt="Home"> 
        <a class="navbar-brand" href="index.php">CMS RIMI INDONESIA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>';
         
            //memanggil fungsi tampil menu
            $tampil_menu=tampil_menu();
            if($tampil_menu){
              if(num_rows($tampil_menu)>0){
              while($data=mysqli_fetch_array($tampil_menu)){
         
        
            //jika kategori single menu maka panggil seluruh bagian single menu
            if($data['kategori_menu']=='single_menu'){
         
            echo '<li class="nav-item">
              <a class="nav-link" href="'.$data[link_menu].'">'.$data[link_menu].'</a>
            </li>';
    
          //jika kategori dropdown menu mana panggil seluruh bag dropdown menu
          }elseif($data['kategori_menu']=='dropdown_menu'){
          
          echo '<li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$data['nama_menu'].'</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                  
                  //kemudian selanjutnya jika terdapat dapat sub menu didalam dropdown panggil submenunya
                  $sub_menu=tampil_sub_menu($data['id']);
                  //lakukan perulangan sub menu berdasarkan id menu parentnya
                  while($sub=fetch($sub_menu)){
                  
                  echo '<a class="dropdown-item" href="'.$sub['link_menu'].'">'.$sub['nama_menu'].'</a>'; 
                  } 
           echo '</div>
          </li>';
            } //end dropdown 
           
                }//end while 
                   }//end > 0 
                }// end function tampil menu and create free result
                free_result($tampil_menu);

         
          echo '</ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">';
}
function load_header_read(){
	global $judul_berita;
	echo '
	<!DOCTYPE html>
	<html lang="id">

  	<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CMS RIMI INDONESIA">
    <meta name="author" content="Ahmad Zaelani">
    <link rel="icon" href="../cmsrimi/properties/content/favicon.png">
    <title>'.$judul_berita.' - CMS RIMI</title>';

}
function load_footer(){
	echo '
	</div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; CMS RIMI ROOT93 2019</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="properties/vendor/jquery/jquery.min.js"></script>
    <script src="properties/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>';
}
?>
