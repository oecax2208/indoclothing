<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<a href="#">Beranda</a>
				</li>
				<li>Pesan</li>
				<li class="active">Pesan Masuk</li>
			</ul>
			<!-- /.breadcrumb -->
		</div>
		<!-- /.nav-search -->
		<div class="page-content">
			<div class="page-header">
				<h1>Pesan
				<small>Daftar Pesan Masuk</small></h1>
			</div>
			<!-- /.page-header -->
			<br />
			<br />
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<?php
						$status = $this->session->flashdata('status');
						if(!empty($status)):
							if($status=="Sukses"):
					?>
					<div class="alert alert-success">Pesan balasan telah dikirim</div>
					<?php
						elseif($status="Sukses-Hapus"):
					?>
					<div class="alert alert-success">Data pesan masuk telah berhasil dihapus</div>
					<?php
						endif;
							endif;
					?>
					<div class="table-responsive">
						<?php echo form_open(base_url()."admin.php/pesan/hapus-pesan-masuk-pilihan", "class='form'"); ?>
						<table class="table table-striped table-hover">
							<tr>
								<th colspan="10"><?php echo $links ?> </th>
							</tr>
							<tr>
								<th></th>
								<th>No</th>
								<th>Pengirim</th>
								<th>Email Pengirim </th>
								<th>Isi Pesan </th>
								<th>Waktu Kirim</th>
								<th>Waktu Baca</th>
								<th colspan="3" style="width:10%">Aksi</th>
							</tr>
							<?php
								$no=1;
								foreach ($data_pesan as $pesan):
							?>
							<tr>
								<td> <input type="checkbox" name="txtIdPesan[]" value="<?php echo $pesan->id_pesan ?>"> </td>
								<td><?php echo $no ?></td>
								<td><?php echo $pesan->nama_pengirim ?></td>
								<td><?php echo $pesan->email_pengirim ?></td>
								<td><?php echo str_replace("\\r\\n","<br />",$pesan->isi_pesan) ?></td>
								<td><?php echo $pesan->waktu_kirim ?></td>
								<td><?php echo $pesan->dibaca_pada ?></td>
								<td><a href="<?php echo base_url() ?>admin.php/pesan/balas-pesan/<?php echo $pesan->id_pesan ?>.html" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a></td>
								<td><a href="<?php echo base_url() ?>admin.php/pesan/detail-pesan-masuk/<?php echo $pesan->id_pesan ?>.html" class="btn btn-success btn-circle"><i class="fa fa-eye"></i></a></td>
								<td><a onclick="return confirm('Hapus data ini?')" href="<?php echo base_url() ?>admin.php/pesan/hapus-pesan-masuk/<?php echo $pesan->id_pesan ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
							</tr>
							<?php
								$no++;
								endforeach
							?>
							<tr>
								<td colspan="10"><?php echo $links ?> </td>
							</tr>
							<tr>
								<td colspan="10" style="text-align: center"><input type="submit" name="btnHapus" value="Hapus Pesan Terpilih" class="btn btn-success btn-lg"> </td>
							</tr>
						</table>

						<?php echo form_close();?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.main-content -->