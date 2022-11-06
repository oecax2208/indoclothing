    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <a href="#">Beranda</a>
            </li>
			<li>Pesan</li>
            <li class="active">Pesan masuk</li>
          </ul>
          <!-- /.breadcrumb -->
        </div>
        <div class="page-content">
          <div class="page-header">
            <h1>
				Pesan 
				<small> Pesan Masuk</small>
			</h1>
          </div>
          <!-- /.page-header -->
		  
          <div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="panel panel-success">
					<div class="panel-heading">
						Pesan Masuk
					</div>
    				<div class="panel-body">
						<div class="form-group">
							<p class="bold">Dari</p>
							<p><?php echo $pesan->nama_pengirim ?></p>
							<p class="bold">Email Pengirim</p>
							<p><?php echo $pesan->email_pengirim ?></p>
							<p class="bold">Dikirim Pada</p>
							<p><?php echo $pesan->waktu_kirim ?></p>
							<p class="bold">Isi Pesan</p>
							<p><?php echo str_replace("\\r\\n","<br />",$pesan->isi_pesan) ?></p>
						</div>
					</div>
				</div>
			</div>
		  </div>
		</div>
	  </div>
    </div>
    <!-- /.main-content -->
	<script src="<?php echo base_url() ?>assets_admin/ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'txtIsiPesan', {
			height : 600
		});

	</script>
	<style>
		.bold{
			font-weight:bold;
	
	</style>
