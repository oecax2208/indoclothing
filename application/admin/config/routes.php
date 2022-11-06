<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'admin';

$route['login'] = 'login';
$route['login/autentikasi'] = 'login/autentikasi';

$route['logout'] = 'logout';
$route['ganti-sandi'] = 'ganti_sandi';
$route['ganti-sandi/update-sandi'] = 'ganti_sandi/simpan';

$route['kategori'] = 'kategori';
$route['kategori/tambah-kategori'] = 'kategori/tambah';
$route['kategori/simpan-kategori'] = 'kategori/simpan';
$route['kategori/ubah-kategori/(:any)'] = 'kategori/ubah/$1';
$route['kategori/hapus-kategori/(:any)'] = 'kategori/hapus/$1';
$route['kategori/update-kategori'] = 'kategori/update';

$route['produk'] = 'produk';
$route['produk/tambah-produk'] = 'produk/tambah';
$route['produk/simpan-produk'] = 'produk/simpan';
$route['produk/ubah-produk/(:any)'] = 'produk/ubah/$1';
$route['produk/hapus-produk/(:any)'] = 'produk/hapus/$1';
$route['produk/hapus-produk-pilihan'] = 'produk/hapus_produk_pilihan';
$route['produk/update-produk'] = 'produk/update';
$route['produk/cari-produk'] = 'produk/cari';

$route['gambar-produk/(:any)'] = 'gambar_produk/daftar_gambar/$1';
$route['gambar-produk/tambah-gambar-produk/(:any)'] = 'gambar_produk/tambah/$1';
$route['gambar-produk/simpan-gambar-produk/(:any)'] = 'gambar_produk/simpan/$1';
$route['gambar-produk/hapus-gambar-produk/(:any)'] = 'gambar_produk/hapus/$1';


$route['merk'] = 'merk';
$route['merk/tambah-merk'] = 'merk/tambah';
$route['merk/simpan-merk'] = 'merk/simpan';
$route['merk/ubah-merk/(:any)'] = 'merk/ubah/$1';
$route['merk/hapus-merk/(:any)'] = 'merk/hapus/$1';
$route['merk/update-merk'] = 'merk/update';

$route['promo'] = 'promo';
$route['promo/tambah-promo'] = 'promo/tambah';
$route['promo/simpan-promo'] = 'promo/simpan';
$route['promo/ubah-promo/(:any)'] = 'promo/ubah/$1';
$route['promo/hapus-promo/(:any)'] = 'promo/hapus/$1';
$route['promo/update-promo'] = 'promo/update';
$route['promo/cari-promo'] = 'promo/cari';

$route['galeri'] = 'galeri';
$route['galeri/(:num)'] = 'galeri';
$route['galeri/tambah-galeri'] = 'galeri/tambah';
$route['galeri/simpan-galeri'] = 'galeri/simpan';
$route['galeri/hapus-galeri/(:any)'] = 'galeri/hapus/$1';
$route['galeri/hapus-galeri-pilihan'] = 'galeri/hapus_galeri_pilihan';

$route['slider'] = 'slider';
$route['slider/tambah-slider'] = 'slider/tambah';
$route['slider/simpan-slider'] = 'slider/simpan';
$route['slider/hapus-slider/(:any)'] = 'slider/hapus/$1';


$route['provinsi'] = 'provinsi';
$route['provinsi/tambah-provinsi'] = 'provinsi/tambah';
$route['provinsi/simpan-provinsi'] = 'provinsi/simpan';
$route['provinsi/ubah-provinsi/(:any)'] = 'provinsi/ubah/$1';
$route['provinsi/hapus-provinsi/(:any)'] = 'provinsi/hapus/$1';
$route['provinsi/update-provinsi'] = 'provinsi/update';
$route['provinsi/cari-provinsi'] = 'provinsi/cari';

$route['kabupaten'] = 'kabupaten';
$route['kabupaten/(:num)'] = 'kabupaten';
$route['kabupaten/tambah-kabupaten'] = 'kabupaten/tambah';
$route['kabupaten/simpan-kabupaten'] = 'kabupaten/simpan';
$route['kabupaten/ubah-kabupaten/(:any)'] = 'kabupaten/ubah/$1';
$route['kabupaten/hapus-kabupaten/(:any)'] = 'kabupaten/hapus/$1';
$route['kabupaten/hapus-kabupaten-pilihan'] = 'kabupaten/hapus_kabupaten_pilihan';
$route['kabupaten/update-kabupaten'] = 'kabupaten/update';
$route['kabupaten/cari-provinsi-id'] = 'kabupaten/cari_kabupaten_by_id';

$route['kecamatan'] = 'kecamatan';
$route['kecamatan/(:num)'] = 'kecamatan';
$route['kecamatan/tambah-kecamatan'] = 'kecamatan/tambah';
$route['kecamatan/simpan-kecamatan'] = 'kecamatan/simpan';
$route['kecamatan/ubah-kecamatan/(:any)'] = 'kecamatan/ubah/$1';
$route['kecamatan/hapus-kecamatan/(:any)'] = 'kecamatan/hapus/$1';
$route['kecamatan/hapus-kecamatan-pilihan'] = 'kecamatan/hapus_kecamatan_pilihan';
$route['kecamatan/update-kecamatan'] = 'kecamatan/update';
$route['kecamatan/cari-kabupaten-id'] = 'kecamatan/cari_kecamatan_by_id_kabupaten';

$route['kelurahan'] = 'kelurahan';
$route['kelurahan/(:num)'] = 'kelurahan';
$route['kelurahan/tambah-kelurahan'] = 'kelurahan/tambah';
$route['kelurahan/simpan-kelurahan'] = 'kelurahan/simpan';
$route['kelurahan/ubah-kelurahan/(:any)'] = 'kelurahan/ubah/$1';
$route['kelurahan/hapus-kelurahan/(:any)'] = 'kelurahan/hapus/$1';
$route['kelurahan/hapus-kelurahan-pilihan'] = 'kelurahan/hapus_kelurahan_pilihan';
$route['kelurahan/update-kelurahan'] = 'kelurahan/update';

$route['artikel'] = 'artikel';
$route['artikel/tambah-artikel'] = 'artikel/tambah';
$route['artikel/simpan-artikel'] = 'artikel/simpan';
$route['artikel/ubah-artikel/(:any)'] = 'artikel/ubah/$1';
$route['artikel/hapus-artikel/(:any)'] = 'artikel/hapus/$1';
$route['artikel/hapus-artikel-pilihan'] = 'artikel/hapus_artikel_pilihan';
$route['artikel/update-artikel'] = 'artikel/update';
$route['artikel/cari-artikel'] = 'artikel/cari';


$route['pesan'] = 'pesan';
$route['pesan/masuk'] = 'pesan/pesan_masuk';
$route['pesan/keluar'] = 'pesan/pesan_keluar';
$route['pesan/kirim-pesan'] = 'pesan/kirim_pesan';
$route['pesan/balas-pesan/(:num)'] = 'pesan/balas_pesan/$1';
$route['pesan/hapus-pesan-masuk/(:num)'] = 'pesan/hapus_pesan_masuk/$1';
$route['pesan/hapus-pesan-keluar/(:num)'] = 'pesan/hapus_pesan_keluar/$1';
$route['pesan/hapus-pesan-masuk-pilihan'] = 'pesan/hapus_pesan_masuk_pilihan';
$route['pesan/hapus-pesan-keluar-pilihan'] = 'pesan/hapus_pesan_keluar_pilihan';
$route['pesan/detail-pesan-masuk/(:num)'] = 'pesan/pesan_masuk_detail/$1';
$route['pesan/detail-pesan-keluar/(:num)'] = 'pesan/pesan_keluar_detail/$1';

$route['404_override'] = 'admin/show_404';
$route['translate_uri_dashes'] = FALSE;
