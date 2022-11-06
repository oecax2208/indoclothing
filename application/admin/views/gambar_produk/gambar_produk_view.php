<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<a href="#">Home</a>
				</li>
				<li>Produk</li>
				<li class="active">Gambar Produk</li>
			</ul>
			<!-- /.breadcrumb -->
		</div>
		<!-- /.nav-search -->
		<div class="page-content">
			<div class="page-header">
				<h1>Produk
				<small>Daftar Gambar Produk</small></h1>
			</div>
			<!-- /.page-header -->
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div>
						<a href="<?php echo base_url() ?>admin.php/gambar-produk/tambah-gambar-produk/<?php echo $kode_produk ?>.html" class="btn btn-success">Tambah Baru
						</a>
					</div>
					<hr />
					<div>
						<ul class="ace-thumbnails clearfix">
							<?php
								foreach($data_gambar_produk as $gambar_produk):
							?>
							<li>
								<a href="<?php echo base_url()."gambar_produk_/".$gambar_produk->gambar_produk ?>" title="Gambar Produk" data-rel="colorbox">
									<img width="200" alt="150x150" src="<?php echo base_url()."gambar_produk_/thumbs_gambar_produk/".$gambar_produk->gambar_produk_mini ?>" />
								</a>
								<div class="tools">
									<a href="<?php echo base_url() ?>admin.php/gambar-produk/hapus-gambar-produk/<?php echo $gambar_produk->id_gambar?>">
										<i class="ace-icon fa fa-times red"></i>
									</a>
								</div>
							</li>
							<?php
								endforeach
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.main-content -->
<!-- page specific plugin scripts -->
<script src="<?php echo base_url() ?>assets/js/jquery.colorbox.min.js"></script>
<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
var $overflow = '';
var colorbox_params = {
rel: 'colorbox',
reposition:true,
scalePhotos:true,
scrolling:false,
previous:'<i class="ace-icon fa fa-arrow-left"></i>',
next:'<i class="ace-icon fa fa-arrow-right"></i>',
close:'&times;',
current:'{current} of {total}',
maxWidth:'100%',
maxHeight:'100%',
onOpen:function(){
	$overflow = document.body.style.overflow;
	document.body.style.overflow = 'hidden';
},
onClosed:function(){
	document.body.style.overflow = $overflow;
},
onComplete:function(){
	$.colorbox.resize();
}
};
$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon


$(document).one('ajaxloadstart.page', function(e) {
$('#colorbox, #cboxOverlay').remove();
});
})
</script>