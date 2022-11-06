    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <a href="#">Home</a>
            </li>
			<li>Wilayah</li>
			<li>Provinsi</li>
            <li class="active">Tambah</li>
          </ul>
          <!-- /.breadcrumb -->
        </div>
        <div class="page-content">
          <div class="page-header">
            <h1>
				Provinsi 
				<small> Tambah Provinsi</small>
			</h1>
          </div>
          <!-- /.page-header -->
		  
          <div class="row">
			<div class="col-md-12 col-xs-12">
				<?php 
					$status = $this->session->flashdata('status'); 
					$group_input = $this->session->flashdata('group_input');
					
					$txtIdProvinsi = $group_input['txtIdProvinsi'];
					$txtNamaProvinsi = $group_input['txtNamaProvinsi'];
					
					$txtIdProvinsi = !empty($txtIdProvinsi)? $txtIdProvinsi: $id_auto;
					$txtNamaProvinsi = !empty($txtNamaProvinsi)? $txtNamaProvinsi: "";
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
						Tambah Data Provinsi
					</div>
    				<?php echo form_open('admin.php/provinsi/simpan-provinsi', "class='form'") ?>
					<div class="panel-body">
						<div class="form-group">
							<label>ID Provinsi</label>
							<input type="text" class="form-control" name="txtIdProvinsi" readonly="readonly" value="<?php echo $txtIdProvinsi ?>" />
							<label>Nama Provinsi</label>
							<input type="text" class="form-control" name="txtNamaProvinsi" max-length="100" value="<?php echo $txtNamaProvinsi ?>" />
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
