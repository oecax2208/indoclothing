    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <a href="#">Home</a>
            </li>
			<li>Merk</li>
            <li class="active">Tambah</li>
          </ul>
          <!-- /.breadcrumb -->
        </div>
        <div class="page-content">
          <div class="page-header">
            <h1>
				Merk 
				<small> Tambah Merk</small>
			</h1>
          </div>
          <!-- /.page-header -->
		  
          <div class="row">
			<div class="col-md-12 col-xs-12">
				<?php 
					$status = $this->session->flashdata('status'); 
					$group_input = $this->session->flashdata('group_input');
					
					$txtIdMerk = $group_input['txtIdMerk'];
					$txtNamaVendor = $group_input['txtNamaVendor'];
					$txtMerk = $group_input['txtMerk'];
					
					$txtIdMerk = !empty($txtIdMerk)? $txtIdMerk: $merk->id_merk;
					$txtNamaVendor = !empty($txtNamaVendor)? $txtNamaVendor: $merk->nama_vendor;
					$txtMerk = !empty($txtMerk)? $txtMerk: $merk->merk;
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
						Tambah Data Merk
					</div>
    				<?php echo form_open_multipart('admin.php/merk/update-merk', "class='form'") ?>
					<div class="panel-body">
						<div class="form-group">
							<label>Nama Vendor</label>
							<input type="text" class="form-control" name="txtNamaVendor" max-length="100" value="<?php echo $txtMerk ?>" />
							<label>Merk</label>
							<input type="text" class="form-control" name="txtMerk" max-length="100" value="<?php echo $txtMerk ?>" />
							<input type="hidden" class="form-control" name="txtIdMerk" max-length="100" value="<?php echo $txtIdMerk ?>" />
							<label>Gambar Merk</label>
							<input type="file" class="form-control" name="txtGambarMerk" max-length="100" />
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

