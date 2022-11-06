<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<a href="#">Home</a>
				</li>
				<li>Kategori</li>
				<li class="active">Kategori</li>
			</ul>
			<!-- /.breadcrumb -->
		</div>
		<!-- /.nav-search -->
		<div class="page-content">
			<div class="page-header">
				<h1>Kategori
				<small>Daftar Kategori</small></h1>
			</div>
			<!-- /.page-header -->
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<?php
						$status = $this->session->flashdata('status');
						if(!empty($status)):
							if($status=="Sukses"):
					?>
					<div class="alert alert-success">Data Kategori telah berhasil disimpan</div>
					<?php
						elseif($status="Sukses-Hapus"):
					?>
					<div class="alert alert-success">Data Kategori telah berhasil dihapus</div>
					<?php
						endif;
							endif;
					?>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th>No</th>
								<th>Nama Kategori</th>
								<th>Gambar Kategori </th>
								<th colspan="2" style="width:10%">Aksi</th>
							</tr>
							<tr>
								<th colspan="12" style="text-align:right">
									<a href="<?php echo base_url() ?>admin.php/kategori/tambah-kategori.html" class="btn btn-success">Tambah Baru
									</a>
								</th>
							</tr>
							<?php
								$no=1;
								foreach ($data_kategori as $kategori):
							?>
							<tr>
								<td>
									<?php echo $no ?>
								</td>
								<td><?php echo $kategori->nama_kategori ?></td>
								<td>
									<img src="<?php echo base_url() ?>/kategori_/<?php echo $kategori->gambar_kategori ?>" style="width:100px"/>
								</td>
								<td><a href="<?php echo base_url() ?>admin.php/kategori/ubah-kategori/<?php echo $kategori->id_kategori ?>.html" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a></td>
								<td><a onclick="return confirm('Hapus data ini?')" href="<?php echo base_url() ?>admin.php/kategori/hapus-kategori/<?php echo $kategori->id_kategori ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
							</tr>
							<?php
								$no++;
								endforeach
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.main-content -->