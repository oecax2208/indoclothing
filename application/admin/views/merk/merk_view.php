<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<a href="#">Home</a>
				</li>
				<li>Merk</li>
				<li class="active">Merk</li>
			</ul>
			<!-- /.breadcrumb -->
		</div>
		<!-- /.nav-search -->
		<div class="page-content">
			<div class="page-header">
				<h1>Merk
				<small>Daftar Merk</small></h1>
			</div>
			<!-- /.page-header -->
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<?php
						$status = $this->session->flashdata('status');
						if(!empty($status)):
							if($status=="Sukses"):
					?>
					<div class="alert alert-success">Data Merk telah berhasil disimpan</div>
					<?php
						elseif($status="Sukses-Hapus"):
					?>
					<div class="alert alert-success">Data Merk telah berhasil dihapus</div>
					<?php
					endif;
						endif;
					?>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th>No</th>
								<th>Nama Vendor</th>
								<th>Merk</th>
								<th>Gambar Merk </th>
								<th colspan="2" style="width:10%">Aksi</th>
							</tr>
							<tr>
								<th colspan="12" style="text-align:right">
									<a href="<?php echo base_url() ?>admin.php/merk/tambah-merk.html" class="btn btn-success">Tambah Baru
									</a>
								</th>
							</tr>
							<?php
								$no=1;
								foreach ($data_merk as $merk):
							?>
							<tr>
								<td>
									<?php echo $no ?>
								</td>
								<td><?php echo $merk->nama_vendor ?></td>
								<td><?php echo $merk->merk ?></td>
								<td>
									<img src="<?php echo base_url() ?>/merk_/<?php echo $merk->gambar_merk ?>" style="width:100px"/>
								</td>
								<td><a href="<?php echo base_url() ?>admin.php/merk/ubah-merk/<?php echo $merk->id_merk ?>.html" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a></td>
								<td><a onclick="return confirm('Hapus data ini?')" href="<?php echo base_url() ?>admin.php/merk/hapus-merk/<?php echo $merk->id_merk ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
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