<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<a href="#">Home</a>
				</li>
				<li>Produk</li>
				<li class="active">Tambah</li>
			</ul>
			<!-- /.breadcrumb -->
		</div>
		<div class="page-content">
			<div class="page-header">
				<h1>
				Produk
				<small> Tambah Produk</small>
				</h1>
			</div>
			<!-- /.page-header -->
			
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<?php
						$status = $this->session->flashdata('status');
						$group_input = $this->session->flashdata('group_input');
						
						$txtKodeProduk = $group_input['txtKodeProduk'];
						$txtIdKategori = $group_input['txtIdKategori'];
						$txtNamaProduk = $group_input['txtNamaProduk'];
						$txtMerkProduk = $group_input['txtMerkProduk'];
						$txtDeskripsiProduk = $group_input['txtDeskripsiProduk'];
						$txtDiskonProduk = $group_input['txtDiskonProduk'];
						$txtStokProduk = $group_input['txtStokProduk'];
						$txtHargaProduk = $group_input['txtHargaProduk'];
						$txtStatusProduk = $group_input['txtStatusProduk'];
						
						$txtKodeProduk = !empty($txtKodeProduk)? $txtKodeProduk: $id_auto;
						$txtIdKategori = !empty($txtIdKategori)? $txtIdKategori: "";
						$txtNamaProduk = !empty($txtNamaProduk)? $txtNamaProduk: "";
						$txtMerkProduk = !empty($txtMerkProduk)? $txtMerkProduk: "";
						$txtDeskripsiProduk = !empty($txtDeskripsiProduk)? $txtDeskripsiProduk: "";
						$txtDiskonProduk = !empty($txtDiskonProduk)? $txtDiskonProduk: "";
						$txtStokProduk = !empty($txtStokProduk)? $txtStokProduk: "";
						$txtHargaProduk = !empty($txtHargaProduk)? $txtHargaProduk: "";
						$txtStatusProduk = !empty($txtStatusProduk)? $txtStatusProduk: "";
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
							Tambah Data Produk
						</div>
						<?php echo form_open('admin.php/produk/simpan-produk', "class='form'") ?>
						<div class="panel-body">
							<div class="form-group">
								<label>Kode Produk</label>
								<input type="text" class="form-control" name="txtKodeProduk" readonly="readonly" value="<?php echo $txtKodeProduk ?>" />
								<label>Kategori Produk</label>
								<select name="txtIdKategori" class="form-control">
									<option value="">-- PILIH --</option>
									<?php
										foreach($data_kategori as $kategori):
									?>
									<option value="<?php echo $kategori->id_kategori ?>" <?php echo ($kategori->id_kategori==$txtIdKategori? " selected": "") ?>><?php echo $kategori->nama_kategori ?></option>
									<?php
										endforeach
									?>
								</select>
								<label>Nama Produk</label>
								<input type="text" class="form-control" name="txtNamaProduk" max-length="100" value="<?php echo $txtNamaProduk ?>" />
								<label>Merk Produk</label>
								<select name="txtMerkProduk" class="form-control">
									<option value="">-- PILIH --</option>
									<?php
										foreach($data_merk as $merk):
									?>
									<option value="<?php echo $merk->id_merk ?>" <?php echo ($merk->id_merk==$txtMerkProduk? " selected": "") ?>><?php echo $merk->merk ?></option>
									<?php
										endforeach
									?>
								</select>
								<label>Deskripsi Produk</label>
								<textarea class="form-control" rows="8" name="txtDeskripsiProduk"><?php echo $txtDeskripsiProduk ?></textarea>
								<label>Diskon Produk</label>
								<input type="text" class="form-control" name="txtDiskonProduk" max-length="100" value="<?php echo $txtDiskonProduk ?>" />
								<label>Harga Produk</label>
								<input type="text" class="form-control" name="txtHargaProduk" max-length="100" value="<?php echo $txtHargaProduk ?>" />
								<label>Stok Produk</label>
								<input type="text" class="form-control" name="txtStokProduk" max-length="100" value="<?php echo $txtStokProduk ?>" />
								<label>Status Produk</label>
								<?php
									$status = array("","Baru", "Promo");
								?>
								<select name="txtStatusProduk" class="form-control">
									<?php
										foreach($status as $st):
									?>
									<option value="<?php echo $st?>" <?php echo($st==$txtStatusProduk ? " selected" : "") ?>><?php echo $st ?></option>
									<?php
										endforeach
									?>
								</select>
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