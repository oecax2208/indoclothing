<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1><?php echo strtolower($data_produk->nama_produk) ?>
				<small>detail produk</small></h1>
			</div>
			<!-- /.page-header -->
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<div>
						<div class="user-profile row">
							<div class="col-xs-12 col-sm-3 center">
								<div>
									<span class="profile-picture">
										<div class="carousel slide" data-ride="carousel">
											<!-- Wrapper for slides -->
											<ol class="carousel-indicators">
												<?php
													$rows = $jumlah_gambar;
													for($i=0;$i<$rows;$i++):
												?>
												<li data-target="#produk_detail" data-slide-to="<?php echo $i ?>" class="<?php echo ($i==1? 'active':'') ?>"></li>
												<?php
													endfor
												?>
											</ol>
											<div class="carousel-inner">
												<?php
												$i=1;
													foreach($gambar_produk as $gmb):
												?>
												<div class="item <?php echo ($i==1?'active':'') ?>">
													<img src="<?php echo base_url()."gambar_produk_/".$gmb->gambar_produk ?>" class="img-responsive" width="250px" />
												</div>
												<?php
													$i++;
													endforeach
												?>
											</div>
										</div>
									</span>
									<div class="space-4"></div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-9">
								<div class="profile-user-info" id="produk_detail">
									<div class="profile-info-row">
										<div class="profile-info-name">nama produk</div>
										<div class="profile-info-value">
											<span class="editable"><?php echo strtolower($data_produk->nama_produk) ?></span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name">merk</div>
										<div class="profile-info-value">
											<span class="editable"><?php echo strtolower($data_produk->merk) ?></span></div>
										</div>
										<div class="profile-info-row">
											<div class="profile-info-name">harga</div>
											<div class="profile-info-value">
												<span class="editable"><?php echo strtolower($data_produk->harga_produk) ?></span>
											</div>
										</div>
										<div class="profile-info-row">
											<div class="profile-info-name">diskon</div>
											<div class="profile-info-value">
												<span class="editable"><?php echo strtolower($data_produk->diskon_produk) ?></span>
											</div>
										</div>
										<div class="profile-info-row">
											<div class="profile-info-name">stok</div>
											<div class="profile-info-value">
												<span class="editable"><?php echo strtolower($data_produk->stok_produk) ?></span>
											</div>
										</div>
										<div class="profile-info-row">
											<div class="profile-info-name">deskripsi produk</div>
											<div class="profile-info-value">
												<span class="editable"><?php echo str_replace(array('\r\n','\\r\\n'), "<br />", $data_produk->deskripsi_produk) ?></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- PAGE CONTENT ENDS -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
				<br />
				<br />
				<h3>produk dengan kategori serupa
				<hr />
				
				<div class="row">
					<?php
						foreach ($data_produk_kat as $produk):
							$CI =& get_instance();
							$CI->load->model("produk_model");
							$gambar = $CI->produk_model->cari_gambar_produk($produk->kode_produk);
					?>
					<div class="col-md-2 col-sm-2 col-xs-6">
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
								<?php echo $produk->nama_produk ?>
								</h3>
								<p>Merk : <strong><?php echo strtoupper($produk->merk) ?></strong></p>
								<p>
									<strong><?php echo number_format($produk->harga_produk,2) ?>&nbsp;(IDR)</strong>
								</p>
								<p>
									<a href="<?php echo base_url() ?>produk/produk-detail/<?php echo $produk->kode_produk ?>.html" class="btn btn-success btn-block">Detail</a>
								</p>
							</div>
						</div>
					</div>
					<?php endforeach ?>
				</div>
				<!-- /.row -->
			</div>
			<!-- /.page-content -->
		</div>
	</div>
	<style>
		body h3{
			color: #fff !important;
		}
		
		#produk_detail{
			color: #ffffff !imprtant
		}
		
		.profile-info-name{
			color: #fff !important;
			text-transform:uppercase;
			width: 20%;
			font-weight: bold;
			background:#008641;
		}
		.profile-info-value{
			color:#fff !important;
			text-transform:uppercase;
			text-align:justify;
			padding:10px;
		}
		
		.thumbnail{
			background:transparent !important;
			border: none !important;
		}
		.thumbnail .caption p,
		.thumbnail .caption h3{
			color:#FFF !important;
			text-align:center;
			font-size:13px;
		}
	</style>