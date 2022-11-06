    <div class="main-content">
      <div class="main-content-inner">
        </div>
        <div class="page-content">
          <div class="page-header">
            <h1>
				Kontak Kami 
			</h1>
          </div>
          <!-- /.page-header -->
		  
          <div class="row">
			<div class="col-md-6 col-xs-12" style="padding-bottom:40px;">
				<?php 
					$status = $this->session->flashdata('status'); 
					$group_input = $this->session->flashdata('group_input');
					
					$txtNamaPengirim = $group_input['txtNamaPengirim'];
					$txtEmailPengirim = $group_input['txtEmailPengirim'];
					$txtIsiPesan = $group_input['txtIsiPesan'];
					
					$txtNamaPengirim = !empty($txtNamaPengirim)? $txtNamaPengirim: "";
					$txtEmailPengirim = !empty($txtEmailPengirim)? $txtEmailPengirim: "";
					$txtIsiPesan = !empty($txtIsiPesan)? $txtIsiPesan: "";
					if(!empty($status)):
						if($status !='Sukses'):
				?>
					<div class="alert alert-danger">
						<strong><i class="fa fa-warning"></i> Error </strong><br />
						<?php echo $status ?><br />
					</div>
				<?php 
						else:
				?>
					<div class="alert alert-success">
						<strong><i class="fa fa-warning"></i> Informasi </strong><br />
						Pesan yang Anda kirim telah kami sampaikan kepada administrator<br />
					</div>
				<?php 
						endif;
					endif
				?>
				<?php echo form_open_multipart('kontak-kami/kirim-pesan', "class='form'") ?>
					<div class="form-group">
						<label>Nama Pengirim</label>
						<input type="text" class="form-control input" name="txtNamaPengirim" max-length="100" value="<?php echo $txtNamaPengirim ?>" />
						<label>Email Pengirim</label>
						<input type="text" class="form-control input" name="txtEmailPengirim" max-length="100" value="<?php echo $txtEmailPengirim ?>" />
						<label>Isi Pesan</label>
						<textarea class="form-control" id="txtIsiPesan" rows="10" name="txtIsiPesan"><?php echo $txtIsiPesan ?></textarea>
						<label>Kode Keamanan</label>
						<input type="text" class="form-control input" name="txtKodeKeamanan" max-length="100" value="" />
						<input type="hidden" class="form-control input" name="txtKodeKeamananValid" max-length="100" value="<?php echo $this->session->userdata('mycaptcha') ?>" />
						<br />
						<label><?php echo $captcha ?></label>
					</div>
					<div>
						<input type="submit" name="btnSimpan" value="Kirim" class="btn btn-success btn-lg" />
					</div>
				<? echo form_close() ?>
			</div>
			<div class="col-md-6 col-xs-12 address">			
				<h2>INDO CLOTHING KARAWANG</h2>
				<p>
					<strong>Alamat</strong> <br />
					Perum Kotabaru Permai<br />
					Blok K4 No. 6 Kec. Kotabaru<br />
					Kab. Karawang<br />
					<strong>Phone</strong> <br />
					0264-312652 <br />
					<strong>Handphone</strong> <br />
					0857 1714 0762 <br />
					<strong>Email</strong> <br />
                     indoclothingkarawang@yahoo.com					
				</p>
				<h2>Jam Operasional</h2>
				<p>
					<strong>Senin-Jumat</strong> <br />
					08.30-17.00 WIB <br />
					<strong>Sabtu</strong> <br />
					08.30-14.00 WIB <br />
					<strong>Minggu</strong> <br />
					Libur				
				</p>
			</div>
		  </div>
		</div>
	  </div>
    </div>
    <!-- /.main-content -->
	
	<style>
		.form-group label{
			color:#fff !important;
			font-size: 18px;
			padding-bottom:10px;
			padding-top: 10px;
		}
		
		.address{
			color: #fff !important;
			line-height: 2em;
			padding-left:2em;
		}
	</style>
	
