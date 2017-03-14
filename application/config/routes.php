<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "welcome";

$route['api/pays'] = 'api/tfpays';
$route['api/stations/(:num)'] = 'api/stations/index/$1';
$route['api/roles/(:num)'] = 'api/roles/index/$1';

// Instruments
$route['api/instruments/(:num)/?'] = 'api/instruments/index/$1';
$route['api/instruments/(:num)/(:any)/?'] = 'api/instruments/$2/$1';

// Prets
$route['api/prets/(:num)/?'] = 'api/prets/index/$1';
$route['api/prets/search(/:any/:num+)/?'] = 'api/prets/search$1';
$route['api/prets/(:num)/(:any)/?'] = 'api/prets/$2/$1';

// Users
$route['api/users/(:num)/?'] = 'api/users/index/$1';
$route['api/users/(:num)/(:any)/?'] = 'api/users/$2/$1';
$route['api/users/(:num)/(:any)/(:any)/?'] = 'api/users/$2/$1/$3';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
