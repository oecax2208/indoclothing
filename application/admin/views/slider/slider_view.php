    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <a href="#">Home</a>
            </li>
            <li>Slider</li>
            <li class="active">Slider</li>
          </ul>
          <!-- /.breadcrumb -->
        </div>
        <!-- /.nav-search -->
        <div class="page-content">
          <div class="page-header">
            <h1>Slider 
            <small>Daftar Slider</small></h1>
          </div>
          <!-- /.page-header -->
          <div class="row">
            <div class="col-md-12 col-xs-12">
              <?php 
				$status = $this->session->flashdata('status');
                if(!empty($status)):
					if($status=="Sukses"):
              ?>
              <div class="alert alert-success">Data Slider telah berhasil disimpan</div>
			  <?php 
                    elseif($status="Sukses-Hapus"):
              ?>
              <div class="alert alert-success">Data Slider telah berhasil dihapus</div>
			  <?php 
                    endif;
				endif;
              ?>
              <div class="table-responsive">
				  <table class="table table-striped table-hover">
					<tr>
					  <th>No</th>
					  <th>Gambar Slider </th>
					  <th style="width:10%">Aksi</th>
					</tr>
					<tr>
					  <th colspan="12" style="text-align:right">
						<a href="<?php echo base_url() ?>admin.php/slider/tambah-slider.html" class="btn btn-success">Tambah Baru
						</a>
					  </th>
					</tr>
					<?php 
						$no=1;
						foreach ($data_slider as $slider): 
					?>
					<tr>
					  <td>
						<?php echo $no ?>
					  </td>
					  <td>
						<img src="<?php echo base_url() ?>slider_/<?php echo $slider->gambar_slider ?>" style="width:300px"/>
					  </td>
					  <td><a onclick="return confirm('Hapus data ini?')" href="<?php echo base_url() ?>admin.php/slider/hapus-slider/<?php echo $slider->id_slider ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
					</tr>
					<?php 
						$no++;
						endforeach 
					?>
				  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.main-content -->
