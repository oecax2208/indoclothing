    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <a href="#">Home</a>
            </li>
            <li>Wilayah</li>
            <li class="active">Provinsi</li>
          </ul>
          <!-- /.breadcrumb -->
        </div>
        <!-- /.nav-search -->
        <div class="page-content">
          <div class="page-header">
            <h1>Provinsi 
            <small>Daftar Provinsi</small></h1>
          </div>
          <!-- /.page-header -->

          <div class="row">
            <div class="col-md-12 col-xs-12">
              <?php 
				$status = $this->session->flashdata('status'); 
                if(!empty($status)):
					if($status=="Sukses"):
              ?>
              <div class="alert alert-success">Data Provinsi telah berhasil disimpan</div>
			  <?php 
                    elseif($status="Sukses-Hapus"):
              ?>
              <div class="alert alert-success">Data Provinsi telah berhasil dihapus</div>
			  <?php 
                    endif;
				endif;
              ?>
              <table class="table table-striped table-hover">
                <tr>
                  <th>No</th>
                  <th>ID Provinsi</th>
                  <th>Nama Provinsi</th>
                  <th colspan="2" style="width:10%">Aksi</th>
                </tr>
                <tr>
                  <th colspan="5" style="text-align:right">
                    <a href="<?php echo base_url() ?>admin.php/provinsi/tambah-provinsi.html" class="btn btn-success">Tambah Baru
                    </a>
                  </th>
                </tr>
				<?php 
                    $no=1;
					foreach ($data_provinsi as $provinsi): 
                ?>
                <tr>
                  <td>
                    <?php echo $no ?>
                    </td>
                  <td><?php echo $provinsi->id_provinsi ?></td>
                  <td><?php echo $provinsi->nama_provinsi ?></td>
				  <td><a href="<?php echo base_url() ?>admin.php/provinsi/ubah-provinsi/<?php echo $provinsi->id_provinsi ?>.html" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a></td>
				  <td><a onclick="return confirm('Hapus data ini?')" href="<?php echo base_url() ?>admin.php/provinsi/hapus-provinsi/<?php echo $provinsi->id_provinsi ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
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
    <!-- /.main-content -->
