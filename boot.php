<?php 
ini_set('display_error', 'On');
error_reporting("E_ALL");

define('ROOT', dirname(__FILE__));

// define('BASE_URL', 'http://localhost/v4/');
define('BASE_URL', 'http://192.168.1.5/v4/');

define('DS', DIRECTORY_SEPARATOR);

define('EXT', '.php');

define('REPORT', ROOT . DS . 'report');
define('LIB', ROOT . DS . 'library');


/**
 * ambil composer
 */

require 'vendor/autoload.php';

// start session

session_start();

