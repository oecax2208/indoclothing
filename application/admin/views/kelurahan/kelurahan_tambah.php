    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <a href="#">Home</a>
            </li>
			<li>Wilayah</li>
			<li>Kelurahan</li>
            <li class="active">Tambah</li>
          </ul>
          <!-- /.breadcrumb -->
        </div>
        <div class="page-content">
          <div class="page-header">
            <h1>
				Kelurahan 
				<small> Tambah Kelurahan</small>
			</h1>
          </div>
          <!-- /.page-header -->
		  
          <div class="row">
			<div class="col-md-12 col-xs-12">
				<?php 
					$status = $this->session->flashdata('status');
					$group_input = $this->session->flashdata('group_input');
					
					$txtIdKelurahan = $group_input['txtIdKelurahan'];
					$txtIdProvinsi = $group_input['txtIdProvinsi'];
					$txtIdKabupaten = $group_input['txtIdKabupaten'];
					$txtIdKecamatan = $group_input['txtIdKecamatan'];
					$txtNamaKelurahan = $group_input['txtNamaKelurahan'];
					$txtKodePos = $group_input['txtKodePos'];
					
					$txtIdKelurahan = !empty($txtIdKelurahan)? $txtIdKelurahan: $id_auto;
					$txtIdProvinsi = !empty($txtIdProvinsi)? $txtIdProvinsi: "";
					$txtIdKabupaten = !empty($txtIdKabupaten)? $txtIdKabupaten: "";
					$txtIdKecamatan = !empty($txtIdKecamatan)? $txtIdKecamatan: "";
					$txtNamaKelurahan = !empty($txtNamaKelurahan)? $txtNamaKelurahan: "";
					$txtKodePos = !empty($txtKodePos)? $txtKodePos: "";
					
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
						Tambah Data Kelurahan
					</div>
    				<?php echo form_open('admin.php/kelurahan/simpan-kelurahan', "class='form'") ?>
					<div class="panel-body">
						<div class="form-group">
							<label>ID Kelurahan</label>
							<input type="text" class="form-control" name="txtIdKelurahan" value="<?php echo $txtIdKelurahan ?>" readonly />
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
							<select class="form-control" name="txtIdKabupaten" id="txtIdKabupaten" />
								<option value="">-- PILIH --</option>
							</select>
							</div>
							<label>Kecamatan</label>
							<div id="DivKecamatan">
							<select class="form-control" name="txtIdKecamatan" />
								<option value="">-- PILIH --</option>
							</select>
							</div>
							<label>Nama Kelurahan</label>
							<input type="text" class="form-control" name="txtNamaKelurahan" max-length="100" value="<?php echo $txtNamaKelurahan ?>" />
							<label>Kode Pos</label>
							<input type="text" class="form-control" name="txtKodePos" max-length="100" value="<?php echo $txtKodePos ?>" />
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
							var output = "<select name='txtIdKabupaten' id='txtIdKabupaten' class='form-control' onchange='updateKecamatan()'>";
							for(var i in data){
								output += "<option value='" + data[i].id_kabupaten +"'>"+ data[i].nama_kabupaten+"</option>";
							} 
							output += "</select>";
							$("#DivKabupaten").html(output);	

							var output = "<select name='txtIdKecamatan' id='txtIdKecamatan' class='form-control'>";
							output += "</select>";
							$("#DivKecamatan").html(output);							
							
						}
				});
				return false;
			});	
			
		});
		
		function updateKecamatan(){
			$.ajax({
				type     : "POST",
				url      : "<?php echo base_url() ?>admin.php/kecamatan/cari-kabupaten-id",
				data     : {txtIdKabupaten: $("#txtIdKabupaten").val()},
				dataType : "json",
				success  :
					function(data){
						var output = "<select name='txtIdKecamatan' class='form-control'>";
						for(var i in data){
							output += "<option value='" + data[i].id_kecamatan +"'>"+ data[i].nama_kecamatan+"</option>";
						} 
						output += "</select>";
							
						$("#DivKecamatan").html(output);							
							
					}
			});
			return false;
		}
    </script>
