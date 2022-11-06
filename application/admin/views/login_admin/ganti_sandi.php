    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <a href="#">Home</a>
            </li>
			<li>Admin</li>
            <li class="active">Ganti Sandi</li>
          </ul>
          <!-- /.breadcrumb -->
        </div>
        <div class="page-content">
          <div class="page-header">
            <h1>
				Login 
				<small> Ganti Sandi</small>
			</h1>
          </div>
          <!-- /.page-header -->
		  
          <div class="row">
			<div class="col-md-12 col-xs-12">
				<?php 
					$status = $this->session->flashdata('status'); 
					$group_input = $this->session->flashdata('group_input');
					
					$txtIdLogin = $group_input['txtIdLogin'];
					$txtIdLoginOld = $group_input['txtIdLoginOld'];
					$txtNamaPengguna = $group_input['txtNamaPengguna'];
					
					$txtIdLoginOld = !empty($txtIdLoginOld)? $txtIdLoginOld: $id_login;
					$txtIdLogin = !empty($txtIdLogin)? $txtIdLogin: $id_login;
					$txtNamaPengguna = !empty($txtNamaPengguna)? $txtNamaPengguna: $nama_pengguna;
					if(!empty($status)):
						if($status!='Sukses'):
				?>
					<div class="alert alert-danger">
						<strong><i class="fa fa-warning"></i> Error </strong><br />
						<?php echo $status ?><br />
						Mohon periksa kembali data yang Anda input!
					</div>
						
				<?php 
					   else:				
				?>
					<div class="alert alert-success">
						<strong><i class=""></i> Sukses </strong><br />
						Kata Sandi berhasil diganti
					</div>
				<?php 
					   endif;
					endif;
				?>

				<div class="panel panel-success">
					<div class="panel-heading">
						Ganti Kata Sandi
					</div>
    				<?php echo form_open('admin.php/ganti-sandi/update-sandi', "class='form'") ?>
					<div class="panel-body">
						<div class="form-group">
							<label>ID Login</label>
							<input type="text" class="form-control" name="txtIdLogin" readonly="readonly" value="<?php echo $txtIdLogin ?>" />
							<input type="hidden" class="form-control" name="txtIdLoginOld" readonly="readonly" value="<?php echo $txtIdLoginOld ?>" />
							<label>Nama Pengguna</label>
							<input type="text" class="form-control" name="txtNamaPengguna" max-length="100" value="<?php echo $txtNamaPengguna ?>" />
							<label>Kata Sandi</label>
							<input type="text" class="form-control" name="txtKataSandi" max-length="100" value="" />
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
