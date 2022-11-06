<div class="main-content">
  <div class="main-content-inner">
    <!-- /.nav-search -->
    <div class="page-content">
      <div class="row">
        <div class="col-sm-12 artikel">
          <h1><?php echo $artikel->judul_artikel ?></h1>
          <span><i class="glyphicon glyphicon-time"></i> Diposting pada <?php echo $artikel->waktu_posting ?></span>

          <img src="<?php echo base_url().'artikel_/'.$artikel->gambar_artikel ?>" alt="">
          <p><?php echo $artikel->isi_artikel ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.main-content -->
<style type="text/css" media="screen">
  .artikel{
    color:#fff !important;
    text-align: justify;
    font-size:16;
  }

  .artikel img{
    width:40%;
    float:left;
    padding: 10px;
  }

  .artikel h1{
    font-size: 50px;
    line-height: 50px;
    text-align: left;
  }

  .artikel span{
    font-size: :12px !important;
    color:#fff !important;
    padding-top: 10px;
    display: block;
    padding-bottom: 40px;
    font-style: italic;

  }

  .artikel p{
    line-height: 20px;
  }
</style>