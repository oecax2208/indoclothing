<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<a href="#">Home</a>
				</li>
				<li>Wilayah</li>
				<li class="active">Kelurahan</li>
			</ul>
			<!-- /.breadcrumb -->
		</div>
		<div class="page-content">
			<div class="page-header">
				<h1>
				Kelurahan
				<small> Daftar Kelurahan</small>
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
						Data Kelurahan telah berhasil disimpan
					</div>
					<?php
							elseif($status="Sukses-Hapus"):
					?>
					<div class="alert alert-success">
						Data Kelurahan telah berhasil dihapus
					</div>
					<?php
							endif;
						endif;
					?>
					<div class="table-responsive">
						<?php echo form_open(base_url()."admin.php/kelurahan/hapus-kelurahan-pilihan", "class='form'"); ?>
						<table class="table table-striped table-hover">
							<tr>
								<th></th>
								<th>No</th>
								<th>ID Kelurahan</th>
								<th>Kabupaten</th>
								<th>Kecamatan</th>
								<th>Kelurahan</th>
								<th style="width:10%">Aksi</th>
							</tr>
							<tr>
								<th colspan="7" style="text-align:right"><a href="<?php echo base_url() ?>admin.php/kelurahan/tambah-kelurahan.html" class="btn btn-success">Tambah Baru <i class="fa fa-plus-square"></i></a></th>
							</tr>
							<tr>
								<td colspan="7"><?php echo $links ?> </td>
							</tr>
							<?php
								$no= $start_index+1;
								foreach ($data_kelurahan as $kelurahan):
							?>
							<tr>
								<td>
									<input type="checkbox" name="txtIdKelurahan[]" value="<?php echo $kelurahan->id_kelurahan ?>">
								</td>
								<td><?php echo $no ?></td>
								<td><?php echo $kelurahan->id_kelurahan ?></td>
								<td><?php echo $kelurahan->nama_kabupaten ?></td>
								<td><?php echo $kelurahan->nama_kecamatan ?></td>
								<td><?php echo $kelurahan->nama_kelurahan ?></td>
								<td><a onclick="return confirm('Hapus data ini?')" href="<?php echo base_url() ?>admin.php/kelurahan/hapus-kelurahan/<?php echo $kelurahan->id_kelurahan ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
							</tr>
							<?php
								$no++;
								endforeach
							?>
							<tr>
								<td colspan="7"><?php echo $links ?> </td>
							</tr>
							<tr>
								<td colspan="7" style="text-align: center"><input type="submit" name="btnHapus" value="Hapus Kelurahan Terpilih" class="btn btn-success btn-lg"> </td>
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