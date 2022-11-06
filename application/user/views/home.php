    <div class="main-content">
      <div class="main-content-inner">
        <!-- /.nav-search -->
        <div class="page-content dynamicTile">
          <div class="page-header">
            <h1>Indo Clothing Karawang</h1>
          </div>
          <!-- /.page-header -->
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <div id="slide" class="tile">
                <div class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
					<?php
						$i=1;
						foreach($data_slider as $slider):
					?>
                    <div class="item <?php echo($i==1 ? " active":"") ?>" id="A">
                      <img src="<?php echo base_url()."slider_/".$slider->gambar_slider ?>" class="img-responsive" style="width:100%;height:100%" />
                    </div>
					<?php 
						$i++;
						endforeach
					?>
                  </div>
                </div>
              </div>
            </div>
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
				foreach($produk_kategori as $kat):
				$my_bg = $bg[rand(0,8)];
			?>
            <div class="col-sm-2 col-xs-4">
              <div id="tile1" class="<?php echo $my_bg ?>">
			    <a href="<?php echo base_url()."kategori/".$kat->id_kategori ?>">
                <div class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                    <div class="item active">
                      <img src="<?php echo base_url()."kategori_/".$kat->gambar_kategori ?>" class="img-responsive" style="width:100%;height:100%"/>
                    </div>
                    <div class="item">
                      <h3 class="tilecaption"><?php echo $kat->nama_kategori ?></h3>
                    </div>
                  </div>
                </div>
				</a>
              </div>
            </div>
			<?php 
				endforeach
			?>
            <div class="col-sm-4 col-xs-8">
              <div id="tile7" class="tile">
                <div class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
					<?php
						$i=1;
						foreach($data_promo as $promo):
					?>

					<div class="item <?php echo $i==1? " active":"" ?>">
                      <img src="<?php echo base_url()."promo_/".$promo->gambar_promo ?>" class="img-responsive" style="width:100%;height:100%" />
                    </div>
					<?php
						$i++;
						endforeach
					?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-2 col-xs-4">
              <div id="tile2" class="tile bg-color-red">
                <div class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                    <div class="item active">
                      <img src="<?php echo base_url()."assets/images/yt-image.jpg" ?>" style="width:100%;height:100%" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-2 col-xs-4">
              <div id="tile2" class="tile bg-color-purple">
                <div class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                    <div class="item active">
                      <img src="<?php echo base_url()."assets/images/ig-image.jpg" ?>" style="width:100%;height:100%" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-2 col-xs-4">
              <div id="tile2" class="tile bg-color-blue">
                <div class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                    <div class="item active">
                      <img src="<?php echo base_url()."assets/images/fb-image.jpg" ?>" style="width:100%;height:100%" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
          </div>
        </div>
      </div>
    </div>
	
<style>
	.dynamicTile .col-sm-2.col-xs-4{
		padding:5px;
	}
	
	.dynamicTile .col-sm-12.col-xs-12{
		padding:5px;
	}

	.dynamicTile .col-sm-4.col-xs-8{
		padding:5px;
	}

	#tile1{
		background: rgb(0,172,238);
	}

	#tile2{
		background: rgb(243,243,243);
	}

	#tile3{
		background: rgb(71,193,228);
	}

	#tile4{
		background-image: url('http://handsontek.net/demoimages/tiles/facebook.png');
		background-size: cover;
	}

	#tile5{
		background: rgb(175,26,63);
	}

	#tile6{
		background: rgb(62,157,215);
	}

	#tile7{
		background: white;
	}

	#tile8{
		background: rgb(209,70,37);
	}

	#tile9{
		background: rgb(0,142,0);
	}

	#slide{
		background: rgb(0,93,233);
	}

	.tilecaption{
		position: relative;
		top: 50%;
		transform: translateY(-50%);
		-webkit-transform: translateY(-50%);
		-ms-transform: translateY(-50%); 
		margin:0!important;
		text-align: center;
		color:white;
		font-family: Segoe UI;
		font-weight: lighter;
	}
</style>

<script>
	$( document ).ready(function() {
		$(".tile").height($("#tile1").width());
		$(".carousel").height($("#tile1").width());
		$(".item").height($("#tile1").width());
		 
		$(window).resize(function() {
		if(this.resizeTO) clearTimeout(this.resizeTO);
		this.resizeTO = setTimeout(function() {
			$(this).trigger('resizeEnd');
		}, 10);
		});
		
		$(window).bind('resizeEnd', function() {
			$(".tile").height($("#tile1").width());
			$(".carousel").height($("#tile1").width());
			$(".item").height($("#tile1").width());
		});

	});
</script>