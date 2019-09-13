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
$route['detailProduct/(:any)'] = 'general/detailProduct/$1';
//ADMIN AREA
$route['webconf'] = 'admin/webconf';
$route['category'] = 'admin/category';
$route['promo'] = 'admin/promo';
$route['account/(:any)'] = 'admin/account/$1';
$route['detailAccount/(:any)/(:any)'] = 'admin/detailAccount/$1/$2';
$route['paymentVerification'] = 'admin/paymentVerification';
$route['redeemMerchant'] = 'admin/redeemMerchant';
$route['redeem/(:any)'] = 'admin/redeem/$1';

//MERCHANT AREA
$route['product'] = 'merchant/product';
$route['detailMyProduct/(:any)'] = 'merchant/detailMyProduct/$1';
$route['addProduct'] = 'merchant/addProduct';
$route['setDefaultImage/(:any)/(:any)'] = 'merchant/setDefaultImage/$1/$2';
$route['order'] = 'merchant/order';
$route['downloadRecap'] = 'merchant/downloadRecap';
//CLIENT AREA
$route['myCart'] = 'client/myCart';
$route['payment/(:any)'] = 'client/payment/$1';
$route['myOrder'] = 'client/myOrder';
$route['StatusOrder/(:any)'] = 'client/StatusOrder/$1';
$route['promoList'] = 'client/promoList';
