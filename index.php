<?php 

error_reporting(E_ALL);
ini_set('display_errors', 'On'); 

require_once('autoload.php');

use BeeJee\Core\Router;

Router::route();
