<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Indo Clothing Karawang</title>

		<meta name="description" content="overview & stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/colorbox.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css" />
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/ace-rtl.min.css" />
		
		
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url() ?>assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo base_url() ?>assets/js/html5shiv.min.js"></script>
		<script src="<?php echo base_url() ?>assets/js/respond.min.js"></script>
		<![endif]-->
		<!--[if !IE]> -->
  		<script src="<?php echo base_url() ?>assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script src="<?php echo base_url() ?>assets/js/jquery-1.11.3.min.js"></script>
		<![endif]-->
	</head>

	<body oncontextmenu="return false">
		<div id="navbar" class="navbar navbar-default ace-save-state visible-xs">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="index.html" class="navbar-brand">
						<small>
							Indo Clothing Karawang
						</small>
					</a>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<img src="<?php echo base_url() ?>assets/images/logo/logo_small.png" width="90%" />
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="">
						<a href="<?php echo base_url() ?>">
							<i class="menu-icon fa fa-home"></i>
							<span class="menu-text"> Beranda </span>
						</a>
						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Produk </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
						<?php
							foreach($produk_kategori as $kategori):
						?>
							<li class="">
								<a href="<?php echo base_url() ?>kategori/<?php echo $kategori->id_kategori ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									<?php echo stripslashes($kategori->nama_kategori) ?>
								</a>
								<b class="arrow"></b>
							</li>
						<?php endforeach ?>
						</ul>
 					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-barcode"></i>
							<span class="menu-text"> Merk </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
						<?php
							foreach($data_merk as $merk):
						?>
							<li class="">
								<a href="<?php echo base_url() ?>merk/<?php echo strtolower(str_replace(" ","-",$merk->merk)) ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									<?php echo stripslashes($merk->merk) ?>
								</a>
								<b class="arrow"></b>
							</li>
						<?php endforeach ?>
						</ul>
 					</li>
					<li class="">
						<a href="<?php echo base_url() ?>galeri.html">
							<i class="menu-icon fa fa-camera"></i>
							<span class="menu-text">Galeri</span>
						</a>
					</li>
					<li class="">
						<a href="<?php echo base_url() ?>cara-pemesanan.html">
							<i class="menu-icon fa  fa-pencil-square-o"></i>
							<span class="menu-text">Cara Pemesanan</span>
						</a>
					</li>
					<li class="">
						<a href="<?php echo base_url() ?>artikel.html">
							<i class="menu-icon fa fa-laptop"></i>
							<span class="menu-text">Artikel</span>
						</a>
					</li>
					<li class="">
						<a href="<?php echo base_url() ?>kontak-kami.html">
							<i class="menu-icon fa fa-envelope-o"></i>
							<span class="menu-text">Hubungi Kami</span>
						</a>
					</li>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-plus ace-save-state" data-icon1="ace-icon fa fa-plus" data-icon2="ace-icon fa fa-plus"></i>
				</div>
			</div>
