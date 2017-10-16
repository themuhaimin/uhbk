<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

// $route['default_controller'] = "welcome";
$route['default_controller'] = "login";

//$route['404_override'] = '';
$route['404_override'] = 'error404';

// Siswa Paging
$route['siswa/halaman'] = "siswa/index";
$route['siswa/halaman/(:num)'] = "siswa/index/$1";
// Absen Paging
$route['guru/halaman'] = "guru/index";
$route['guru/halaman/(:num)'] = "guru/index/$1";
// Ujian Paging
$route['ujian/halaman'] = "ujian/index";
$route['ujian/halaman/(:num)'] = "ujian/index/$1";
// siswa Paging
$route['kelola_rombel/'] = "kelola_rombel/index";
$route['kelola_rombel/halaman/(:num)'] = "kelola_rombel/halaman/$1";
 //login admin
$route['administrator'] = "admin_login/index";
$route['admin'] = "admin_login/index";
$route['admin/logout'] = "admin_login/logout";
$route['administrator/logout'] = "admin_login/logout";
$route['logout'] = "login/logout";

/* End of file routes.php */
/* Location: ./application/config/routes.php */