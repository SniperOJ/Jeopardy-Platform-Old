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
$route['user/forget'] = 'user/forget_password';
$route['user/reset'] = 'user/reset_password';
$route['user/verify/(:any)'] = 'user/verify_reset_code';
$route['user/login'] = 'user/login';
$route['user/register'] = 'user/register';
$route['user/active/(:any)'] = 'user/active';
$route['user/score'] = 'user/score';
$route['user/logout'] = 'user/logout';
$route['user/(:any)'] = 'user/profile';
$route['user'] = 'user/profile';

$route['challenges/create'] = 'challenges/create';
$route['challenges/submit'] = 'challenges/submit';
// $route['challenges/view/web'] = 'challenges/view_web';
// $route['challenges/view/pwn'] = 'challenges/view_pwn';
// $route['challenges/view/misc'] = 'challenges/view_misc';
// $route['challenges/view/forensics'] = 'challenges/view_forensics';
// $route['challenges/view/stego'] = 'challenges/view_stego';
// $route['challenges/view/crypto'] = 'challenges/view_crypto';
// $route['challenges/view/other'] = 'challenges/view_other';
// $route['challenges/view/all'] = 'challenges/view';
$route['challenges/view'] = 'challenges/view';
$route['challenges/(:any)'] = 'challenges/view';
$route['challenges/detail/(:num)'] = 'challenges/detail';
$route['challenges'] = 'challenges/view';

// $route['news/create'] = 'news/create';
// $route['news/(:any)'] = 'news/view';
// $route['news'] = 'news';

$route['(:any)'] = 'home/view';
$route['default_controller'] = 'home/view';
