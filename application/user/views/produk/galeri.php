    <div class="main-content">
      <div class="main-content-inner">
        <!-- /.nav-search -->
        <div class="page-content dynamicTile">
          <div class="page-header">
            <h1>Galeri
			<small></small>
			</h1>
          </div>
          <!-- /.page-header -->
		  <br />
		  <br />
		    <div class="row ">
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
				foreach ($data_produk as $produk):
				$my_bg = $bg[rand(0,8)];
			?>			  
			  <div class="col-md-4 col-sm-6 col-xs-6" style="padding:5px;">
				<a href="<?php echo base_url()."galeri_/".$produk->gambar_galeri ?>" title="<?php echo $produk->judul_galeri ?>" data-rel="colorbox" >
					<div class="galeri <?php echo $my_bg ?>" >
						<div class="row">
							<div class="col-sm-8 col-xs-12">
								<img src="<?php echo base_url()."galeri_/thumbs_galeri/". $produk->gambar_mini_galeri ?>" class="img-responsive" style="width:100%;height:100%"  />
							</div>
							<div class="col-sm-4 cols-sx-12">
								<div class="galeri-desc">
								<h5><?php echo $produk->judul_galeri ?></h5>
								<p><?php echo substr($produk->deskripsi_galeri,0,80) ?></p>
								</div>
							</div>
						</div>
					</div>
			    </a>
			  </div>

			<?php 
				$i++;
				endforeach 
			?>
		   </div>
		   <?php echo $links ?>
		</div>
      </div>
    </div>
    <!-- /.main-content -->

<script src="<?php echo base_url() ?>assets/js/jquery.colorbox.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
		var $overflow = '';
		var colorbox_params = {
			rel: 'colorbox',
			reposition:true,
			scalePhotos:true,
			scrolling:false,
			previous:'<i class="ace-icon fa fa-arrow-left"></i>',
			next:'<i class="ace-icon fa fa-arrow-right"></i>',
			close:'&times;',
			current:'{current} of {total}',
			maxWidth:'100%',
			maxHeight:'100%',
			onOpen:function(){
				$overflow = document.body.style.overflow;
				document.body.style.overflow = 'hidden';
			},
			onClosed:function(){
				document.body.style.overflow = $overflow;
			},
			onComplete:function(){
				$.colorbox.resize();
			}
		};

		$('.a [data-rel="colorbox"]').colorbox(colorbox_params);
		$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
		
		
		$(document).one('ajaxloadstart.page', function(e) {
			$('#colorbox, #cboxOverlay').remove();
	   });
	});
	
</script>
<style>
	.gal{
		max-height: 270px;
		overflow: hidden;
	}

</style>