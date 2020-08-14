<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['customer'] = 'customer';
$route['customer/add'] = 'customer/add';
$route['customer/edit'] = 'customer/edit';
$route['customer/process'] = 'customer/process';
$route['customer/edit/(:num)'] = 'customer/edit/$1';
$route['customer/delete/(:num)'] = 'customer/delete/$1';

$route['stock/in'] = 'stock/stock_in_data';
$route['stock/in/add'] = 'stock/stock_in_add';
$route['stock/in/delete/(:num)/(:num)'] = 'stock/stock_in_delete';

