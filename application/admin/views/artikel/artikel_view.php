<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<a href="#">Home</a>
				</li>
				<li>Artikel</li>
				<li class="active">Artikel</li>
			</ul>
			<!-- /.breadcrumb -->
		</div>
		<!-- /.nav-search -->
		<div class="page-content">
			<div class="page-header">
				<h1>Artikel
				<small>Daftar Artikel</small></h1>
			</div>
			<!-- /.page-header -->
			<div class="" id="nav-search">
				<?php echo form_open(base_url()."artikel/cari-artikel.html","class='''") ?>
				<input type="text" name="txtSearch" placeholder="Cari Judul Artikel ..." class="nav-search-input" id="nav-search-input" autocomplete="on" />
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
					<div class="alert alert-success">Data Artikel telah berhasil disimpan</div>
					<?php
							elseif($status="Sukses-Hapus"):
					?>
					<div class="alert alert-success">Data Artikel telah berhasil dihapus</div>
					<?php
							endif;
						endif;
					?>
					<?php echo form_open('admin.php/artikel/hapus-artikel-pilihan', "class='form'" ); ?>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th colspan="12"><?php echo $links ?> </th>
							</tr>
							<tr>
								<th></th>
								<th>No</th>
								<th>Judul Artikel</th>
								<th>Gambar Artikel </th>
								<th>Isi Artikel </th>
								<th>Status Aktif</th>
								<th colspan="2" style="width:10%">Aksi</th>
							</tr>
							<tr>
								<th colspan="12" style="text-align:right">
									<a href="<?php echo base_url() ?>admin.php/artikel/tambah-artikel.html" class="btn btn-success">Tambah Baru
									</a>
								</th>
							</tr>
							<?php
								$no=1;
								foreach ($data_artikel as $artikel):
							?>
							<tr>
								<td>
									<input type="checkbox" name="txtIdArtikel[]" value="<?php echo $artikel->id_artikel ?>">
								</td>
								<td>
									<?php echo $no ?>
								</td>
								<td><?php echo $artikel->judul_artikel ?></td>
								<td>
									<img src="<?php echo base_url() ?>artikel_/thumbs_artikel/<?php echo $artikel->gambar_mini ?>" style="width:200px"/>
								</td>
								<td><?php echo $artikel->isi_singkat ?></td>
								<td><?php echo($artikel->status_tampil==1? "Aktif" : "Tidak Aktif") ?></td>
								<td><a href="<?php echo base_url() ?>admin.php/artikel/ubah-artikel/<?php echo $artikel->slug_artikel ?>.html" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a></td>
								<td><a onclick="return confirm('Hapus data ini?')" href="<?php echo base_url() ?>admin.php/artikel/hapus-artikel/<?php echo $artikel->id_artikel ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
							</tr>
							<?php
								$no++;
								endforeach
							?>
							<tr>
								<td colspan="12"><?php echo $links ?> </td>
							</tr>
						</table>
					</div>
					<div style="text-align: center;">						
						<input type="submit" name="btnHapus" value="Hapus Data Terpilih" class="btn btn-primary btn-lg">
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.main-content -->