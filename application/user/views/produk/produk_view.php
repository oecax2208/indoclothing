    <div class="main-content">
      <div class="main-content-inner">
        <!-- /.nav-search -->
        <div class="page-content">
          <div class="page-header">
            <h1>Produk</h1>
          </div>
          <!-- /.page-header -->
		  <br />
		  <br />
		  <div class="row">
			<?php 
				foreach ($data_produk as $produk):
					$CI =& get_instance();
					$CI->load->model("produk_model");
					$gambar = $CI->produk_model->cari_gambar_produk($produk->kode_produk); 
			?>			  
			  <div class="col-sm-3">
				<div class="thumbnail search-thumbnail">
				<?php 
					if($produk->status_produk !=''):
						$label_text = "";
						if($produk->status_produk=='Baru'):
							$label_text="Baru";
							$label_color = "label-success";
						else:
							$label_text="Promo";
							$label_color = "label-danger";
						endif
						
				?>
					<span class="search-promotion label <?php echo $label_color ?> arrowed-in arrowed-in-right"><?php echo $label_text ?></span>
				<?php endif ?>
					<img class="media-object" src="<?php echo base_url()."gambar_produk_/thumbs_gambar_produk/". $gambar[0]->gambar_produk_mini ?>" style="width:100%" />
					<div class="caption">
					  <h3 class="search-title">
						<a href="#" class="blue"><?php echo $produk->nama ?></a>
					  </h3>
					  <p>Merk : <strong><?php echo strtoupper($produk->merk) ?></strong></p>
					  <p></p>
					  <p>
						<div class="row">
							<div class="col-md-6 col-sm-12 col-xs-12">
								<strong><?php echo number_format($produk->harga_produk,2) ?>&nbsp;(IDR)</strong>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12">
								<a href="<?php echo base_url() ?>produk/produk-detail/<?php echo $produk->kode_produk ?>.html" class="btn btn-info btn-block">Detail</a>
							</div>
						</div>
					  </p>

					</div>
				</div>
			  </div>
			<?php endforeach ?>
		   </div>
		</div>
      </div>
    </div>
    <!-- /.main-content -->

<style>
	.thumbnail{
		background:transparent !important;
		border: none !important;
	}
	.thumbnail .caption p,
	.thumbnail .caption h3{
		color:#FFF !important;
		text-align:center;
	}

</style>