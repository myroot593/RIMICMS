<body>

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
            </li>
            <?php
            //memanggil fungsi tampil menu
            $tampil_menu=tampil_menu();
            if($tampil_menu){
              if(num_rows($tampil_menu)>0){
              while($data=mysqli_fetch_array($tampil_menu)){
            ?>
            <?php
            //jika kategori single menu maka panggil seluruh bagian single menu
            if($data['kategori_menu']=='single_menu'){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $data['link_menu'];?>"><?php echo $data['nama_menu'];?></a>
            </li>
          <?php
          //jika kategori dropdown menu mana panggil seluruh bag dropdown menu
          }elseif($data['kategori_menu']=='dropdown_menu'){
          ?>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $data['nama_menu'];?></a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php
                  //kemudian selanjutnya jika terdapat dapat sub menu didalam dropdown panggil submenunya
                  $sub_menu=tampil_sub_menu($data['id']);
                  //lakukan perulangan sub menu berdasarkan id menu parentnya
                  while($sub=fetch($sub_menu)){
                  ?>
                  <a class="dropdown-item" href="<?php echo $sub['link_menu'];?>"><?php echo $sub['nama_menu'];?></a> 
                  <?php } ?>
              </div>
          </li>
           <?php } //end dropdown ?>
            <?php 
                }//end while 
                   }//end > 0 
                }//free result
                free_result($tampil_menu);

          ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
