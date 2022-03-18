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

$route['default_controller'] = 'page/homepage'; // Landings page

// Pages
$route['signup'] = 'page_controller/signup_form'; // Signup form
$route['login'] = 'page_controller/login_form'; // Login form
$route['homepage'] = 'page_controller/homepage'; // Homepage
// /Pages


// Confirmation pages
$route['account-deletion'] = 'page_controller/ask_account_deletion'; // Deletion of the account
// /Confirmation pages



// Account settings
$route['profile'] = 'page_controller/account_settings/profile';
$route['settings'] = 'page_controller/account_settings/settings';
// /Account settings


// Redirects to get/update the data of the user
$route['logout'] = 'general/logout'; // Logout of the account
$route['delete-account'] = 'account_controller/delete_account'; // Delete the account
$route['signup_submit'] = 'account_controller/signup'; // Signup
$route['login_submit'] = 'account_controller/login'; // Login
$route['profile_submit'] = 'account_controller/update_account'; // Updates the profile inside the settings
// Redirects to get/update the data of the user