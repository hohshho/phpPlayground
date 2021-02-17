<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
$route['topic/(:num)'] = "topic/get/$1";
$route['post/(:num)'] = "topic/get/$1";
$route['topic/([a-z]+)/([a-z]+)/(\d+)'] = "$1/$2/$3";
$route['default_controller'] = "topic/index";
$route['404_override'] = 'errors/notfound';