<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<a href="#">Home</a>
				</li>
				<li>Galeri</li>
				<li class="active">Tambah</li>
			</ul>
			<!-- /.breadcrumb -->
		</div>
		<div class="page-content">
			<div class="page-header">
				<h1>
				Galeri
				<small> Tambah Galeri</small>
				</h1>
			</div>
			<!-- /.page-header -->
			
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<?php
						$status = $this->session->flashdata('status');
						$group_input = $this->session->flashdata('group_input');
						
						$txtJudulGaleri = $group_input['txtJudulGaleri'];
						$txtDeskripsiGaleri = $group_input['txtDeskripsiGaleri'];
						
						$txtJudulGaleri = !empty($txtJudulGaleri)? $txtJudulGaleri: "";
						$txtDeskripsiGaleri = !empty($txtDeskripsiGaleri)? $txtDeskripsiGaleri: "";
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
							Tambah Data Galeri
						</div>
						<?php echo form_open_multipart('admin.php/galeri/simpan-galeri', "class='form'") ?>
						<div class="panel-body">
							<div class="form-group">
								<label>Judul Galeri</label>
								<input type="text" class="form-control" name="txtJudulGaleri" max-length="100" value="<?php echo $txtJudulGaleri ?>" />
								<label>Deskrisi Galeri</label>
								<textarea name="txtDeskripsiGaleri" class="form-control"><?php echo $txtDeskripsiGaleri ?></textarea>
								<label>Gambar Galeri</label>
								<input type="file" class="form-control" name="txtGambarGaleri" max-length="100" />
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
<!-- /.main-content