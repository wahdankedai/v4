<?php 
ini_set('display_error', 'On');
error_reporting("E_ALL");

define('ROOT', dirname(__FILE__));
define('BASE_URL', 'http://localhost/v4/');

define('DS', DIRECTORY_SEPARATOR);

define('EXT', '.php');


/**
 * ambil composer
 */

require 'vendor/autoload.php';

// start session

session_start();