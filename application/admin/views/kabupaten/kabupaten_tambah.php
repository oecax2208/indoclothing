    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <a href="#">Home</a>
            </li>
			<li>Wilayah</li>
			<li>Kabupaten</li>
            <li class="active">Tambah</li>
          </ul>
          <!-- /.breadcrumb -->
        </div>
        <div class="page-content">
          <div class="page-header">
            <h1>
				Kabupaten 
				<small> Tambah Kabupaten</small>
			</h1>
          </div>
          <!-- /.page-header -->
		  
          <div class="row">
			<div class="col-md-12 col-xs-12">
				<?php 
					$status = $this->session->flashdata('status');
					$group_input = $this->session->flashdata('group_input');
					
					$txtIdKabupaten = $group_input['txtIdKabupaten'];
					$txtIdProvinsi = $group_input['txtIdProvinsi'];
					$txtNamaKabupaten = $group_input['txtNamaKabupaten'];
					
					$txtIdKabupaten = !empty($txtIdKabupaten)? $txtIdKabupaten: $id_auto;
					$txtIdProvinsi = !empty($txtIdProvinsi)? $txtIdProvinsi: "";
					$txtNamaKabupaten = !empty($txtNamaKabupaten)? $txtNamaKabupaten: "";
					
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
						Tambah Data Kabupaten
					</div>
    				<?php echo form_open('admin.php/kabupaten/simpan-kabupaten', "class='form'") ?>
					<div class="panel-body">
						<div class="form-group">
							<label>ID Kabupaten</label>
							<input type="text" class="form-control" name="txtIdKabupaten" readonly="readonly" value="<?php echo $txtIdKabupaten ?>" />
							<label>Provinsi</label>
							<select class="form-control" name="txtIdProvinsi" />
								<option value="">-- PILIH --</option>
							<?php
								foreach($data_provinsi as $provinsi):
							?>
								<option value="<?php echo $provinsi->id_provinsi ?>"><?php echo $provinsi->nama_provinsi ?></option>
							<?php 
								endforeach
							?>
							</select>
							<label>Nama Kabupaten</label>
							<input type="text" class="form-control" name="txtNamaKabupaten" max-length="100" value="<?php echo $txtNamaKabupaten ?>" />
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
