<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "welcome";
$route['404_override'] = '';

// $route['api/(:any)'] = "api/$1";
$route['api/stations/(:num)'] = "api/stations/index/id/$1";
// $route['api/stations/test'] = "api/stations/test";

$route['admin/([a-z_]+)/(:num)'] = "admin/$1/index/$2";
$route['admin/([a-z_]+)/(:num)/([a-z]+)'] = "admin/$1/index/$2/$3";


// $route['(:any)'] = "$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */