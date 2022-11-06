<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<a href="#">Home</a>
				</li>
				<li>Produk</li>
				<li class="active">Produk</li>
			</ul>
			<!-- /.breadcrumb -->
		</div>
		<!-- /.nav-search -->
		<div class="page-content">
			<div class="page-header">
				<h1>Produk
				<small>Daftar Produk</small></h1>
			</div>
			<!-- /.page-header -->
			<div class="" id="nav-search">
				<?php echo form_open(base_url()."produk/cari-produk.html","class='''") ?>
				<input type="text" name="txtSearch" placeholder="Cari Nama Produk ..." class="nav-search-input" id="nav-search-input" autocomplete="on" />
				<button type="submit" name="btnSearch" class="btn btn-primary"><i class="fa fa-search"></i></button>
				<?php echo form_close() ?>
			</div>
			<br />
			<br />
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<?php
									$status = $this->session->flashdata('status');
					if(!empty($status)):
										if($status=="Sukses"):
					?>
					<div class="alert alert-success">Data Produk telah berhasil disimpan</div>
					<?php
					elseif($status="Sukses-Hapus"):
					?>
					<div class="alert alert-success">Data Produk telah berhasil dihapus</div>
					<?php
					endif;
						endif;
					?>
					<div class="table-responsive">
						<?php echo form_open(base_url()."admin.php/produk/hapus-produk-pilihan", "class='form'"); ?>
						<table class="table table-striped table-hover">
							<tr>
								<th colspan="14"><?php echo $links ?> </th>
							</tr>
							<tr>
								<th></th>
								<th>No</th>
								<th>Kode Produk</th>
								<th>Nama Produk</th>
								<th>Kategori </th>
								<th>Merk </th>
								<th>Rating </th>
								<th>Stok</th>
								<th>Harga</th>
								<th>Diskon</th>
								<th>Status</th>
								<th colspan="3" style="width:10%">Aksi</th>
							</tr>
							<tr>
								<th colspan="13" style="text-align:right">
									<a href="<?php echo base_url() ?>admin.php/produk/tambah-produk.html" class="btn btn-success">Tambah Baru
									</a>
								</th>
							</tr>
							<?php
								$no=1;
								foreach ($data_produk as $produk):
							?>
							<tr>
								<td>
									<input type="checkbox" name="txtKodeProduk[]" value="<?php echo $produk->kode_produk ?>">
								</td>
								<td>
									<?php echo $no ?>
								</td>
								<td><?php echo $produk->kode_produk ?></td>
								<td><?php echo $produk->nama_produk ?></td>
								<td><?php echo $produk->nama_kategori ?></td>
								<td><?php echo $produk->merk ?></td>
								<td><?php echo $produk->stok_produk ?></td>
								<td><?php echo $produk->harga_produk ?></td>
								<td><?php echo $produk->diskon_produk ?></td>
								<td><?php echo $produk->status_produk ?></td>
								<td><a href="<?php echo base_url() ?>admin.php/produk/ubah-produk/<?php echo $produk->kode_produk ?>.html" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a></td>
								<td><a onclick="return confirm('Hapus data ini?')" href="<?php echo base_url() ?>admin.php/produk/hapus-produk/<?php echo $produk->kode_produk ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
								<td><a href="<?php echo base_url() ?>admin.php/gambar-produk/<?php echo $produk->kode_produk ?>.html" class="btn btn-success btn-circle"><i class="fa fa-camera"></i></a></td>
							</tr>
							<?php
								$no++;
								endforeach
							?>
							<tr>
								<td colspan="13"><?php echo $links ?> </td>
							</tr>
							<tr>
								<td colspan="13" style="text-align: center"><input type="submit" name="btnHapus" value="Hapus Produk Terpilih" class="btn btn-success btn-lg"> </td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.main-content -->