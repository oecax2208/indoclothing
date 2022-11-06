    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <a href="#">Home</a>
            </li>
			<li>Wilayah</li>
			<li>Kecamatan</li>
            <li class="active">Tambah</li>
          </ul>
          <!-- /.breadcrumb -->
        </div>
        <div class="page-content">
          <div class="page-header">
            <h1>
				Kecamatan 
				<small> Tambah Kecamatan</small>
			</h1>
          </div>
          <!-- /.page-header -->
		  
          <div class="row">
			<div class="col-md-12 col-xs-12">
				<?php 
					$status = $this->session->flashdata('status');
					$group_input = $this->session->flashdata('group_input');
					
					$txtIdKecamatan = $group_input['txtIdKecamatan'];
					$txtIdProvinsi = $group_input['txtIdProvinsi'];
					$txtIdKabupaten = $group_input['txtIdKabupaten'];
					$txtNamaKecamatan = $group_input['txtNamaKecamatan'];
					
					$txtIdProvinsi = !empty($txtIdProvinsi)? $txtIdProvinsi: "";
					$txtIdKecamatan = !empty($txtIdKecamatan)? $txtIdKecamatan: $id_auto;
					$txtIdKabupaten = !empty($txtIdKabupaten)? $txtIdKabupaten: "";
					$txtNamaKecamatan = !empty($txtNamaKecamatan)? $txtNamaKecamatan: "";
					
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
						Tambah Data Kecamatan
					</div>
    				<?php echo form_open('admin.php/kecamatan/simpan-kecamatan', "class='form'") ?>
					<div class="panel-body">
						<div class="form-group">
							<label>ID Kecamatan</label>
							<input type="text" class="form-control" name="txtIdKecamatan" value="<?php echo $txtIdKecamatan ?>" readonly />
							<label>Provinsi</label>
							<select class="form-control" name="txtIdProvinsi" id="txtIdProvinsi" />
								<option value="">-- PILIH --</option>
							<?php
								foreach($data_provinsi as $provinsi):
							?>
								<option value="<?php echo $provinsi->id_provinsi ?>" <?php echo($provinsi->id_provinsi==$txtIdProvinsi? " selected" : "") ?>><?php echo $provinsi->nama_provinsi ?></option>
							<?php 
								endforeach
							?>
							</select>
							<label>Kabupaten</label>
							<div id="DivKabupaten">
							<select class="form-control" name="txtIdKabupaten" />
								<option value="">-- PILIH --</option>
							</select>
							</div>
							<label>Nama Kecamatan</label>
							<input type="text" class="form-control" name="txtNamaKecamatan" max-length="100" value="<?php echo $txtNamaKecamatan ?>" />
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
    <script>
		$(document).ready(function(){
			$("#txtIdProvinsi").change(function(){
				$.ajax({
					type     : "POST",
					url      : "<?php echo base_url() ?>admin.php/kabupaten/cari-provinsi-id",
					data     : {txtIdProvinsi: $("#txtIdProvinsi").val()},
					dataType : "json",
					success  :
						function(data){
							var output = "<select name='txtIdKabupaten' class='form-control'>";
							for(var i in data){
								output += "<option value='" + data[i].id_kabupaten +"'>"+ data[i].nama_kabupaten+"</option>";
							} 
							output += "</select>";
							$("#DivKabupaten").html(output);							
						}
				});
				return false;
			});			
		});
    </script>
