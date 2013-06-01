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
| There is one reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
*/
$route['default_controller'] = "main";
$route['404_override'] = 'pages';
$route['en/auth/(.*)'] = "users/auth/$1";
$route['de/auth/(.*)'] = "users/auth/$1";
$route['fr/auth/(.*)'] = "users/auth/$1";
$route['hr/auth/(.*)'] = "users/auth/$1";
$route['es/auth/(.*)'] = "users/auth/$1";
$route['fi/auth/(.*)'] = "users/auth/$1";
$route['gr/auth/(.*)'] = "users/auth/$1";
$route['bg/auth/(.*)'] = "users/auth/$1";
$route['ba/auth/(.*)'] = "users/auth/$1";
$route['cz/auth/(.*)'] = "users/auth/$1";
$route['hu/auth/(.*)'] = "users/auth/$1";
$route['ie/auth/(.*)'] = "users/auth/$1";
$route['is/auth/(.*)'] = "users/auth/$1";
$route['dk/auth/(.*)'] = "users/auth/$1";
$route['al/auth/(.*)'] = "users/auth/$1";
$route['it/auth/(.*)'] = "users/auth/$1";
$route['me/auth/(.*)'] = "users/auth/$1";
$route['mk/auth/(.*)'] = "users/auth/$1";
$route['nl/auth/(.*)'] = "users/auth/$1";
$route['no/auth/(.*)'] = "users/auth/$1";
$route['pl/auth/(.*)'] = "users/auth/$1";
$route['pt/auth/(.*)'] = "users/auth/$1";
$route['rs/auth/(.*)'] = "users/auth/$1";
$route['ro/auth/(.*)'] = "users/auth/$1";
$route['ru/auth/(.*)'] = "users/auth/$1";
$route['se/auth/(.*)'] = "users/auth/$1";
$route['si/auth/(.*)'] = "users/auth/$1";
$route['sk/auth/(.*)'] = "users/auth/$1";
$route['tr/auth/(.*)'] = "users/auth/$1";
$route['ua/auth/(.*)'] = "users/auth/$1";
$route['(\w{2})/(.*)'] = '$2';
$route['(\w{2})'] = $route['default_controller'];
$route['en'] = "main";
$route['(\w{2})'] = $route['default_controller']; 
$route['fr'] = "main";
$route['(\w{2})'] = $route['default_controller']; 

#Ion Auth Routing
//$route[$this->config->item('language_abbr'). '/auth/(.*)'] = "users/auth/$1";


#Modules Routing
$route[$this->config->item('language_abbr'). '/admin'] = 'dashboard';
$route[$this->config->item('language_abbr').'/login'] = 'users/auth/login';

/* End of file routes.php */
/* Location: ./application/config/routes.php */