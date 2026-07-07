<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']  = 'auth/login';
$route['404_override']        = '';
$route['translate_uri_dashes'] = FALSE;

$route['login']    = 'auth/login';
$route['logout']   = 'auth/logout';

$route['dashboard']                 = 'dashboard/index';
$route['buku']                      = 'buku/index';
$route['buku/tambah']               = 'buku/tambah';
$route['buku/edit/(:num)']          = 'buku/edit/$1';
$route['buku/hapus/(:num)']         = 'buku/hapus/$1';
$route['buku/detail/(:num)']        = 'buku/detail/$1';
$route['peminjam']                  = 'peminjam/index';
$route['peminjam/tambah']           = 'peminjam/tambah';
$route['peminjam/edit/(:num)']      = 'peminjam/edit/$1';
$route['peminjam/hapus/(:num)']     = 'peminjam/hapus/$1';
$route['peminjaman']                = 'peminjaman/index';
$route['peminjaman/tambah']         = 'peminjaman/tambah';
$route['peminjaman/kembali/(:num)'] = 'peminjaman/kembali/$1';
