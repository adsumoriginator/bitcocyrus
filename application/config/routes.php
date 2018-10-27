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

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['cms/(:any)'] = 'cms/cms/$1';
$route['contact'] = 'cms/contact';
$route['support'] = 'cms/support';
$route['reply'] = 'cms/reply';
$route['support_history'] = 'cms/support_history';
$route['faq'] = 'cms/faq';
$route['cnt_captcha'] = 'cms/cnt_captcha';
$route['captcha_exist'] = 'cms/captcha_exist';

//$route['YfQa6hmtE8a3G2Z6Ssuf'] = 'YfQa6hmtE8a3G2Z6Ssuf/Authentication';

//$route['sdrgsefdfrtghghgh'] = 'bitcowallet/Authentication';










$front_prefix='';

$route['trade'] 									= 	$front_prefix.'trade';
$route['trade/(:any)'] 								= 	$front_prefix.'trade/trade/$1';


$route['update_theme'] 									= 	$front_prefix.'trade/update_theme';

$route['trade_price'] 			= 	$front_prefix.'trade/add_prices';

$route['margin'] 									= 	$front_prefix.'trade/margin';
$route['transfer_list'] 									= 	$front_prefix.'trade/transfer_list';
$route['margin/(:any)'] 							= 	$front_prefix.'trade/margin/$1';
$route['tradechart_livedata/(:any)'] 				= 	$front_prefix.'trade/tradechart_livedata/$1';
$route['tradechart_livetimedata/(:any)'] 			= 	$front_prefix.'trade/tradechart_livetimedata/$1';
$route['verify_user/(:any)'] 						= 	$front_prefix.'user/verify_user/$1';
$route['createOrder'] 								= 	$front_prefix.'trade/createOrder';
$route['close_active_order'] 						= 	$front_prefix.'trade/close_active_order';
$route['trade_integration/(:any)/(:any)'] 			= 	$front_prefix.'trade/trade_integration/$1/$2';

$route['trade_integration/(:any)/(:any)'] 			= 	$front_prefix.'trade/trade_integration/$1/$2';
$route['trade_integration/(:any)/(:any)/(:any)'] 	= 	$front_prefix.'trade/trade_integration/$1/$2/$3';
$route['livechartdata/(:any)'] 						= 	$front_prefix.'trade/livechartdata/$1';
$route['lastapi/(:any)'] 							= 	$front_prefix.'trade/lastapi/$1';
$route['tradechartapp/(:any)'] 						= 	$front_prefix.'trade/tradechartapp/$1';
$route['tradechart/(:any)'] 						= 	$front_prefix.'trade/tradechart/$1';

$route['market_depth/(:any)'] 						= 	$front_prefix.'trade/market_depth/$1';

