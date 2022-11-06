    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <a href="#">Beranda</a>
            </li>
			<li>Pesan</li>
            <li class="active">Balas Pesan</li>
          </ul>
          <!-- /.breadcrumb -->
        </div>
        <div class="page-content">
          <div class="page-header">
            <h1>
				Pesan 
				<small> Balas Pesan</small>
			</h1>
          </div>
          <!-- /.page-header -->
		  
          <div class="row">
			<div class="col-md-12 col-xs-12">
				<?php 
					$status = $this->session->flashdata('status'); 
					$group_input = $this->session->flashdata('group_input');
					
					$txtIdPesan = $group_input['txtIdPesan'];
					$txtKepada = $group_input['txtKepada'];
					$txtIsiPesan = $group_input['txtIsiPesan'];
					
					$txtIdPesan = !empty($txtKepada)? $txtKepada: $pesan->id_pesan;
					$txtKepada = !empty($txtKepada)? $txtKepada: $pesan->email_pengirim;
					$txtIsiPesan = !empty($txtIsiPesan)? $txtIsiPesan: "";
					
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
						Tambah Data Pesan
					</div>
    				<?php echo form_open('admin.php/pesan/kirim-pesan', "class='form'") ?>
					<div class="panel-body">
						<div class="form-group">
							<label>Kepada</label>
							<input type="text" class="form-control" readonly="readonly" name="txtKepada" max-length="" value="<?php echo $txtKepada ?>" />
							<input type="hidden" name="txtIdPesan" value="<?php echo $txtIdPesan ?>">
							<label>Isi Pesan</label>
							<textarea class="form-control" name="txtIsiPesan" id="txtIsiPesan"><?php echo $txtIsiPesan ?></textarea>
						</div>
					</div>
					<div class="panel-footer">
						<input type="submit" name="btnSimpan" value="Kirim Balasan" class="btn btn-primary" />
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
		CKEDITOR.replace( 'txtIsiPesan', {
			height : 600
		});

	</script>
