<?php
//(B4) Load config
require_once 'config/config.php';

// load helpers
require_once 'helpers/url_helper.php';

// Load libraries - in (B5) it loads all classes in the library automatically
//require_once 'libraries/core.php'; //(A)
//require_once 'libraries/controller.php'; //(B.2)
//require_once 'libraries/database.php';

// (B5) autoload libraries - don't have to manually include them
spl_autoload_register(function($className){
    require_once 'libraries/'.$className.'.php';
});