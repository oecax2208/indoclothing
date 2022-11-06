<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<a href="#">Home</a>
				</li>
				<li>Wilayah</li>
				<li class="active">Kecamatan</li>
			</ul>
			<!-- /.breadcrumb -->
		</div>
		<div class="page-content">
			<div class="page-header">
				<h1>
				Kecamatan
				<small> Daftar Kecamatan</small>
				</h1>
			</div>
			<!-- /.page-header -->
			
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<?php
						$status = $this->session->flashdata('status');
						if(!empty($status)):
							if($status=="Sukses"):
					?>
					<div class="alert alert-success">
						Data Kecamatan telah berhasil disimpan
					</div>
					<?php
							elseif($status="Sukses-Hapus"):
					?>
					<div class="alert alert-success">
						Data Kecamatan telah berhasil dihapus
					</div>
					<?php
							endif;
						endif;
					?>
					<div class="table-responsive">
						<?php echo form_open(base_url()."admin.php/kecamatan/hapus-kecamatan-pilihan", "class='form'"); ?>
						<table class="table table-striped table-hover">
							<tr>
								<th></th>
								<th>No</th>
								<th>ID Kecamatan</th>
								<th>Provinsi</th>
								<th>Kecamatan</th>
								<th>Nama Kecamatan</th>
								<th colspan="2" style="width:10%">Aksi</th>
							</tr>
							<tr>
								<th colspan="8" style="text-align:right"><a href="<?php echo base_url() ?>admin.php/kecamatan/tambah-kecamatan.html" class="btn btn-success">Tambah Baru <i class="fa fa-plus-square"></i></a></th>
							</tr>
							<tr>
								<td colspan="8"><?php echo $links ?> </td>
							</tr>
							<?php
								$no= $start_index+1;
								foreach ($data_kecamatan as $kecamatan):
							?>
							<tr>
								<td>
									<input type="checkbox" name="txtIdKecamatan[]" value="<?php echo $kecamatan->id_kecamatan ?>">
								</td>
								<td><?php echo $no ?></td>
								<td><?php echo $kecamatan->id_kecamatan ?></td>
								<td><?php echo $kecamatan->nama_provinsi ?></td>
								<td><?php echo $kecamatan->nama_kabupaten ?></td>
								<td><?php echo $kecamatan->nama_kecamatan ?></td>
								<td><a href="<?php echo base_url() ?>admin.php/kecamatan/ubah-kecamatan/<?php echo $kecamatan->id_kecamatan ?>.html" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a></td>
								<td><a onclick="return confirm('Hapus data ini?')" href="<?php echo base_url() ?>admin.php/kecamatan/hapus-kecamatan/<?php echo $kecamatan->id_kecamatan ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
							</tr>
							<?php
								$no++;
								endforeach
							?>
							<tr>
								<td colspan="8"><?php echo $links ?> </td>
							</tr>
							<tr>
								<td colspan="8" style="text-align: center"><input type="submit" name="btnHapus" value="Hapus Kecamatan Terpilih" class="btn btn-success btn-lg"> </td>
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