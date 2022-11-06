<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<a href="#">Home</a>
				</li>
				<li>Galeri</li>
				<li class="active">Galeri</li>
			</ul>
			<!-- /.breadcrumb -->
		</div>
		<!-- /.nav-search -->
		<div class="page-content">
			<div class="page-header">
				<h1>Galeri
				<small>Daftar Galeri</small></h1>
			</div>
			<!-- /.page-header -->
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<?php
									$status = $this->session->flashdata('status');
					if(!empty($status)):
										if($status=="Sukses"):
					?>
					<div class="alert alert-success">Data Galeri telah berhasil disimpan</div>
					<?php
					elseif($status="Sukses-Hapus"):
					?>
					<div class="alert alert-success">Data Galeri telah berhasil dihapus</div>
					<?php
					endif;
						endif;
					?>
					<div class="table-responsive">
						<?php echo form_open(base_url()."admin.php/galeri/hapus-galeri-pilihan", "class='form'"); ?>
						<table class="table table-striped table-hover">
							<tr>
								<th colspan="5"><?php echo $links ?> </th>
							</tr>
							<tr>
								<th></th>
								<th>No</th>
								<th>Judul Galeri</th>
								<th>Gambar Galeri </th>
								<th>Deskripsi Galeri </th>
								<th>Aksi</th>
							</tr>
							<tr>
								<th colspan="5" style="text-align:right">
									<a href="<?php echo base_url() ?>admin.php/galeri/tambah-galeri.html" class="btn btn-success">Tambah Baru
									</a>
								</th>
							</tr>
							<?php
								$no=1;
								foreach ($data_galeri as $galeri):
							?>
							<tr>
								<td>
									<input type="checkbox" name="txtIdGaleri[]" value="<?php echo $galeri->id_galeri ?>">
								</td>
								<td>
									<?php echo $no ?>
								</td>
								<td><?php echo $galeri->judul_galeri ?></td>
								<td>
									<img src="<?php echo base_url() ?>galeri_/thumbs_galeri/<?php echo $galeri->gambar_mini_galeri ?>" class="img"/>
								</td>
								<td><?php echo $galeri->deskripsi_galeri ?></td>
								<td><a onclick="return confirm('Hapus data ini?')" href="<?php echo base_url() ?>admin.php/galeri/hapus-galeri/<?php echo $galeri->id_galeri ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
							</tr>
							<?php
								$no++;
								endforeach
							?>
							<tr>
								<td colspan="5"><?php echo $links ?> </td>
							</tr>
							<tr>
								<td colspan="5" style="text-align: center"><input type="submit" name="btnHapus" value="Hapus Galeri Terpilih" class="btn btn-success btn-lg"> </td>
							</tr>
						</table>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.main-content -->