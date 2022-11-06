<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<a href="#">Home</a>
				</li>
				<li>Produk</li>
				<li>Gambar Produk</li>
				<li class="active">Tambah</li>
			</ul>
			<!-- /.breadcrumb -->
		</div>
		<div class="page-content">
			<div class="page-header">
				<h1>
				Produk
				<small> Tambah Gambar Produk</small>
				</h1>
			</div>
			<!-- /.page-header -->
			
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<?php
						$status = $this->session->flashdata('status');
						$group_input = $this->session->flashdata('group_input');
						
											$txtKodeProduk = $group_input['txtKodeProduk'];
						$txtKodeProduk = !empty($txtKodeProduk)? $txtKodeProduk: $kode_produk;
						if(!empty($status)):
					?>
					<div class="alert alert-danger">
						<strong><i class="fa fa-warning"></i> Error </strong><br />
						<?php echo $status ?><br />
						Mohon periksa kembali data yang Anda input!
					</div>
					<?php
						endif
					?>
					<div class="panel panel-success">
						<div class="panel-heading">
							Tambah Data Gambar Produk
						</div>
						<?php echo form_open_multipart('admin.php/gambar-produk/simpan-gambar-produk/'.$kode_produk, "class='form'") ?>
						<div class="panel-body">
							<div class="form-group">
								<input type="hidden" class="form-control" name="txtKodeProduk" max-length="100" value="<?php echo $txtKodeProduk ?>" readonly />
								<label>Gambar Produk</label>
								<input type="file" class="form-control" name="txtGambarProduk" max-length="100" />
							</div>
						</div>
						<div class="panel-footer">
							<input type="submit" name="btnSimpan" value="Simpan" class="btn btn-primary" />
						</div>
						<? echo form_close() ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.main-content -->