<?
define('ROOTPATH',strlen(dirname($_SERVER['SCRIPT_NAME'])) >1 ? dirname($_SERVER['SCRIPT_NAME']).'/' : '/');
define('PAGEPATH', ROOTPATH.'views/pages/');
define('SHAREDPATH', ROOTPATH.'views/shared/');
define('DATABASE',ROOTPATH.'src/database/db.json');
define('USER_PICTURE_PATH', ROOTPATH.'assets/images/upload/users/');
define('IMAGEPATH',ROOTPATH.'assets/images/');



define('PEPPER', '.m9h-RL=^M/72;tdU\Bz');
define('HASHOPTIONS', $options = ['cost' => 13]);

