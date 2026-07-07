<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('database', 'session', 'form_validation');
$autoload['drivers'] = array();
$autoload['helper'] = array('url', 'form', 'html', 'string', 'text');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('user_model', 'buku_model', 'peminjam_model', 'peminjaman_model');
