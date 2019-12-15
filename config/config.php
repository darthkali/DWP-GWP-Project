<?
define('ROOTPATH',strlen(dirname($_SERVER['SCRIPT_NAME'])) >1 ? dirname($_SERVER['SCRIPT_NAME']).'/' : '/');
define('PAGEPATH', 'views/pages/');
define('SHAREDPATH', 'views/shared/');
define('DATABASE','src/database/db.json');
define('USER_PICTURE_PATH', 'assets/images/upload/users/');
define('PEPPER', '.m9h-RL=^M/72;tdU\Bz');
define('HASHOPTIONS', $options = ['cost' => 13]);

