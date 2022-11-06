    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <a href="#">Home</a>
            </li>
			<li>Slider</li>
            <li class="active">Tambah</li>
          </ul>
          <!-- /.breadcrumb -->
        </div>
        <div class="page-content">
          <div class="page-header">
            <h1>
				Slider 
				<small> Tambah Slider</small>
			</h1>
          </div>
          <!-- /.page-header -->
		  
          <div class="row">
			<div class="col-md-12 col-xs-12">
				<?php 
					$status = $this->session->flashdata('status'); 
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
						Tambah Data Slider
					</div>
    				<?php echo form_open_multipart('admin.php/slider/simpan-slider', "class='form'") ?>
					<div class="panel-body">
						<div class="form-group">
							<label>Gambar Slider</label>
							<input type="file" class="form-control" name="txtGambarSlider" max-length="100" />
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
		CKEDITOR.replace( 'txtDeskripsiSlider', {
			height : 600
		});

	</script>

	
