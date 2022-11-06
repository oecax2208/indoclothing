    <div class="main-content">
      <div class="main-content-inner">
        <!-- /.nav-search -->
        <div class="page-content">
          <div class="page-header">
            <h1>Artikel</h1>
          </div>
          <!-- /.page-header -->
          <div class="row">
		  <?php 
				$i=1;
				$bg = array(
				"bg-color-orange", 
				"bg-color-greenDark",
				"bg-color-purple",
				"bg-color-blue",
				"bg-color-red",
				"bg-color-green",
				"bg-color-blueDark",
				"bg-color-yellow",
				"bg-color-pink");
			foreach($data_artikel as $artikel):
			$my_bg = $bg[rand(0,8)];
		  ?>
            <div class="col-md-4 col-sm-4 col-sx-12" style="margin-top:5px; padding:5px;">
              <div class="card <?php echo $my_bg ?>">
                <img class="card-img-top" alt="Bootstrap Thumbnail First"
                src="<?php echo base_url()."artikel_/thumbs_artikel/".$artikel->gambar_mini ?>" height="300px"/>
                <div class="card-block">
                  <h3 class="card-title" style="text-align:center; min-height: 50px"><?php echo $artikel->judul_artikel ?></h3>
                  <p class="card-text"><?php echo substr($artikel->isi_singkat,0,200) ?></p>
                  <p style="text-align:right">
                  <a class=" btn btn-xs btn-primary" href="<?php echo base_url()."artikel/".$artikel->slug_artikel?>">Lihat Selengkapnya</a> 
                  </p>
                </div>
              </div>
            </div>
			<?php 
				endforeach
			?>
          </div>
        </div>
      </div>
    </div>
    <!-- /.main-content -->
