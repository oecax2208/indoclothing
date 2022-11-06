    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <a href="#">Home</a>
            </li>
			<li>Promo</li>
            <li class="active">Tambah</li>
          </ul>
          <!-- /.breadcrumb -->
        </div>
        <div class="page-content">
          <div class="page-header">
            <h1>
				Promo 
				<small> Tambah Promo</small>
			</h1>
          </div>
          <!-- /.page-header -->
		  
          <div class="row">
			<div class="col-md-12 col-xs-12">
				<?php 
					$status = $this->session->flashdata('status'); 
					$group_input = $this->session->flashdata('group_input');
					
					$txtIdPromo = $group_input['txtIdPromo'];
					$txtJudulPromo = $group_input['txtJudulPromo'];
					
					$txtIdPromo = !empty($txtIdPromo)? $txtIdPromo: $promo->id_promo;
					$txtJudulPromo = !empty($txtJudulPromo)? $txtJudulPromo: $promo->judul_promo;
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
						Tambah Data Promo
					</div>
    				<?php echo form_open_multipart('admin.php/promo/update-promo', "class='form'") ?>
					<div class="panel-body">
						<div class="form-group">
							<label>Judul Promo</label>
							<input type="text" class="form-control" name="txtJudulPromo" max-length="100" value="<?php echo $txtJudulPromo ?>" />
							<input type="hidden" class="form-control" name="txtIdPromo" max-length="100" value="<?php echo $txtIdPromo ?>" />
							<label>Gambar Promo</label>
							<input type="file" class="form-control" name="txtGambarPromo" max-length="100" />
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

		// Replace the <textarea id="editor"> with an CKEditor
		// instance, using default configurations.
		CKEDITOR.replace( 'txtDeskripsiPromo', {
			height : 600
		});

	</script>
