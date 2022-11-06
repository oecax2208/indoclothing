<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<a href="#">Home</a>
				</li>
				<li>Artikel</li>
				<li class="active">Tambah</li>
			</ul>
			<!-- /.breadcrumb -->
		</div>
		<div class="page-content">
			<div class="page-header">
				<h1>
				Artikel
				<small> Tambah Artikel</small>
				</h1>
			</div>
			<!-- /.page-header -->
			
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<?php
						$status = $this->session->flashdata('status');
						$group_input = $this->session->flashdata('group_input');
						
						$txtIdArtikel = $group_input['txtIdArtikel'];
						$txtJudulArtikel = $group_input['txtJudulArtikel'];
						$txtIsiArtikel = $group_input['txtIsiArtikel'];
						$txtIsiSingkat = $group_input['txtIsiSingkat'];
						$txtStatusTampil = $group_input['txtStatusTampil'];
						
						$txtIdArtikel = !empty($txtIdArtikel)? $txtIdArtikel: $artikel->id_artikel;
						$txtJudulArtikel = !empty($txtJudulArtikel)? $txtJudulArtikel: $artikel->judul_artikel;
						$txtIsiArtikel = !empty($txtIsiArtikel)? $txtIsiArtikel: $artikel->isi_artikel;
						$txtIsiSingkat = !empty($txtIsiSingkat)? $txtIsiSingkat: $artikel->isi_singkat;
						$txtStatusTampil = !empty($txtStatusTampil)? $txtStatusTampil: $artikel->status_tampil;
						
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
							Tambah Data Artikel
						</div>
						<?php echo form_open_multipart('admin.php/artikel/update-artikel', "class='form'") ?>
						<div class="panel-body">
							<div class="form-group">
								<label>Judul Artikel</label>
								<input type="hidden" class="form-control" name="txtIdArtikel" max-length="100" value="<?php echo $txtIdArtikel ?>" />
								<input type="text" class="form-control" name="txtJudulArtikel" max-length="100" value="<?php echo $txtJudulArtikel ?>" />
								<label>Gambar Artikel</label>
								<input type="file" class="form-control" name="txtGambarArtikel" max-length="100" />
								<label>Isi Singkat</label>
								<textarea class="form-control" name="txtIsiSingkat"><?php echo $txtIsiSingkat ?></textarea>
								<label>Isi Artikel</label>
								<textarea class="form-control" name="txtIsiArtikel" id="txtIsiArtikel"><?php echo $txtIsiArtikel ?></textarea>
								<label>Status Aktif</label>
								<?php
									$status = array("Tidak Tampil", "Tampil");
								?>
								<select name="txtStatusTampil" class="form-control">
									<?php
										$i=0;
										foreach($status as $st):
									?>
									<option value="<?php echo $i?>" <?php echo($st==$i ? " selected" : "") ?>><?php echo $st ?></option>
									<?php
										$i++;
										endforeach
									?>
								</select>
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
<script src="<?php echo base_url() ?>assets_admin/ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'txtIsiArtikel', {
		height : 600
	});
</script>