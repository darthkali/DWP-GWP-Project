<?

define('ROOTPATH',strlen(dirname($_SERVER['SCRIPT_NAME'])) >1 ? dirname($_SERVER['SCRIPT_NAME']).'/' : '/');
define('VIEWPATH', 'pages/');
define ('DATABASE','data/db.json');