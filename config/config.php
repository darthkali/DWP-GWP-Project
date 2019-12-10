<?
define('ROOTPATH',strlen(dirname($_SERVER['SCRIPT_NAME'])) >1 ? dirname($_SERVER['SCRIPT_NAME']).'/' : '/');
define('PAGEPATH', 'views/pages/');
define('SHAREDPATH', 'views/shared/');
define('DATABASE','src/database/db.json');
define('USER_PICTURE_PATH', 'assets/images/upload/users/');
