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
$route['default_controller'] = 'user/index';
$route['404_override'] = '';

/*admin*/
$route['admin'] = 'user/index';
$route['admin/signup'] = 'user/signup';
$route['admin/create_member'] = 'user/create_member';
$route['admin/login'] = 'user/index';
$route['admin/logout'] = 'user/logout';
$route['admin/login/validate_credentials'] = 'user/validate_credentials';

$route['admin/quest'] 					= 'quest/index';
$route['admin/quest/add'] 				= 'quest/add';
$route['admin/quest/update'] 			= 'quest/update';
$route['admin/quest/update/(:any)'] 	= 'quest/update/$1';
$route['admin/quest/delete/(:any)'] 	= 'quest/delete/$1';
$route['admin/quest/(:any)'] 			= 'quest/index/$1'; //$1 = page number

$route['admin/transferlv'] 					= 'transferlv/index';
$route['admin/transferlv/add'] 				= 'transferlv/add';
$route['admin/transferlv/update'] 			= 'transferlv/update';
$route['admin/transferlv/update/(:any)'] 	= 'transferlv/update/$1';
$route['admin/transferlv/delete/(:any)'] 	= 'transferlv/delete/$1';
$route['admin/transferlv/(:any)'] 			= 'transferlv/index/$1'; //$1 = page number

$route['admin/sacrificehr'] 				= 'sacrificehr/index';
$route['admin/sacrificehr/add'] 			= 'sacrificehr/add';
$route['admin/sacrificehr/update'] 			= 'sacrificehr/update';
$route['admin/sacrificehr/update/(:any)'] 	= 'sacrificehr/update/$1';
$route['admin/sacrificehr/delete/(:any)'] 	= 'sacrificehr/delete/$1';
$route['admin/sacrificehr/(:any)'] 			= 'sacrificehr/index/$1'; //$1 = page number

$route['admin/users'] 						= 'admin_users/index';
$route['admin/users/add'] 					= 'admin_users/add';
$route['admin/users/update'] 				= 'admin_users/update';
$route['admin/users/update/(:any)'] 		= 'admin_users/update/$1';
$route['admin/users/delete/(:any)'] 		= 'admin_users/delete/$1';
$route['admin/users/(:any)'] 				= 'admin_users/index/$1'; //$1 = page number

$route['member'] 							= 'member/index';
$route['member/infos/changepass'] 			= 'member/changepass';
$route['member/infos/resetgift'] 			= 'member/resetgif';
$route['member/quest/list'] 				= 'member/questItemsList';
$route['member/quest/view/(:any)'] 			= 'member/viewQuest/$1';
$route['member/transferlv/list'] 			= 'member/transferLvItemsList';
$route['member/transferlv/view/(:any)'] 	= 'member/viewQuestTransferLv/$1';
/* End of file routes.php */
/* Location: ./application/config/routes.php */