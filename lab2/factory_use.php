<?php
// spl_autoload_register();

require_once 'factory/router.php';
require_once 'factory/models/collection.php';
require_once 'factory/models/user.php';   
require_once 'factory/models/users.php';

use Factory\Router;

$obj = Router::parse('users');
echo $obj->render();
