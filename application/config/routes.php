<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'App';
$route['Forget-password'] = 'Auth/forget_password';


$route['404_override'] = 'Error404';
$route['translate_uri_dashes'] = TRUE;
