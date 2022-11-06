    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <a href="#">Home</a>
            </li>
			<li>Kategori</li>
            <li class="active">Tambah</li>
          </ul>
          <!-- /.breadcrumb -->
        </div>
        <div class="page-content">
          <div class="page-header">
            <h1>
				Kategori 
				<small> Tambah Kategori</small>
			</h1>
          </div>
          <!-- /.page-header -->
		  
          <div class="row">
			<div class="col-md-12 col-xs-12">
				<?php 
					$status = $this->session->flashdata('status'); 
					$group_input = $this->session->flashdata('group_input');
					
					$txtIdKategori = $group_input['txtIdKategori'];
					$txtNamaKategori = $group_input['txtNamaKategori'];
					
					$txtIdKategori = !empty($txtIdKategori)? $txtIdKategori: $kategori->id_kategori;
					$txtNamaKategori = !empty($txtNamaKategori)? $txtNamaKategori: $kategori->nama_kategori;
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
						Tambah Data Kategori
					</div>
    				<?php echo form_open_multipart('admin.php/kategori/update-kategori', "class='form'") ?>
					<div class="panel-body">
						<div class="form-group">
							<label>Nama Kategori</label>
							<input type="text" class="form-control" name="txtNamaKategori" max-length="100" value="<?php echo $txtNamaKategori ?>" />
							<input type="hidden" class="form-control" name="txtIdKategori" max-length="100" value="<?php echo $txtIdKategori ?>" />
							<label>Gambar Kategori</label>
							<input type="file" class="form-control" name="txtGambarKategori" max-length="100" />
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

