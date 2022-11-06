<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<a href="#">Home</a>
				</li>
				<li>Promo</li>
				<li class="active">Promo</li>
			</ul>
			<!-- /.breadcrumb -->
		</div>
		<!-- /.nav-search -->
		<div class="page-content">
			<div class="page-header">
				<h1>Promo
				<small>Daftar Promo</small></h1>
			</div>
			<!-- /.page-header -->
			<div class="" id="nav-search">
				<?php echo form_open(base_url()."promo/cari-promo.html","class='''") ?>
				<input type="text" name="txtSearch" placeholder="Cari Judul Promo ..." class="nav-search-input" id="nav-search-input" autocomplete="on" />
				<button type="submit" name="btnSearch" class="btn btn-primary"><i class="fa fa-search"></i></button>
				<?php echo form_close() ?>
			</div>
			<br />
			<br />
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<?php
									$status = $this->session->flashdata('status');
					if(!empty($status)):
										if($status=="Sukses"):
					?>
					<div class="alert alert-success">Data Promo telah berhasil disimpan</div>
					<?php
					elseif($status="Sukses-Hapus"):
					?>
					<div class="alert alert-success">Data Promo telah berhasil dihapus</div>
					<?php
					endif;
						endif;
					?>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th colspan="4"><?php echo $links ?> </th>
							</tr>
							<tr>
								<th>No</th>
								<th>Judul Promo</th>
								<th>Gambar Promo </th>
								<th style="width:10%">Aksi</th>
							</tr>
							<tr>
								<th colspan="4" style="text-align:right">
									<a href="<?php echo base_url() ?>admin.php/promo/tambah-promo.html" class="btn btn-success">Tambah Baru
									</a>
								</th>
							</tr>
							<?php
								$no=1;
								foreach ($data_promo as $promo):
							?>
							<tr>
								<td>
									<?php echo $no ?>
								</td>
								<td><?php echo $promo->judul_promo ?></td>
								<td>
									<img src="<?php echo base_url() ?>promo_/<?php echo $promo->gambar_promo ?>" style="width:200px"/>
								</td>
								<td><a onclick="return confirm('Hapus data ini?')" href="<?php echo base_url() ?>admin.php/promo/hapus-promo/<?php echo $promo->id_promo ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
							</tr>
							<?php
								$no++;
								endforeach
							?>
							<tr>
								<td colspan="4"><?php echo $links ?> </td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.main-content -->