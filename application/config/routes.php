<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//GENERAL AREA
$route['login'] = 'general/login';
$route['shopPage'] = 'general/shopPage';
$route['logout'] = 'general/logout';
$route['profile'] = 'general/profile';
$route['forgotPassword'] = 'general/forgotPassword';
$route['default_controller'] = 'general';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['dashboard'] = 'general/dashboard';

//ADMIN AREA
$route['webconf'] = 'admin/webconf';
$route['category'] = 'admin/category';
$route['promo'] = 'admin/promo';
$route['account/(:any)'] = 'admin/account/$1';
$route['detailAccount/(:any)/(:any)'] = 'admin/detailAccount/$1/$2';

//MERCHANT AREA
