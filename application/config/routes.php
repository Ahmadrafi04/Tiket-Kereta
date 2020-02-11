<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'dashboard/list';
$route['setasiun'] = 'setasiun/list';
$route['kelas'] = 'kelas/list';
$route['kereta'] = 'kereta/list';
$route['tiket'] = 'tiket/list';
$route['auth'] = 'user';
$route['logout'] = 'user/logout';
$route['admin'] = 'dashboard/list';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
