<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "welcome";

$route['api/pays'] = 'api/tfpays';
$route['api/stations/(:num)'] = 'api/stations/index/$1';
$route['api/instruments/(:num)'] = 'api/instruments/index/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
