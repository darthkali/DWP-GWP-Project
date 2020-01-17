<?
//ROOT
//efine('ROOTPATH',strlen(dirname($_SERVER['SCRIPT_NAME'])) >1 ? dirname($_SERVER['SCRIPT_NAME']).'/' : '/');
define('ROOTPATH','../');

// main Paths
define('ASSETS_PATH', ROOTPATH.'assets/');
define('CONTROLLER_PATH', ROOTPATH.'controller/');
define('MODELS_PATH', ROOTPATH.'models/');

// sub Paths
define('JAVA_SCRIPT_PATH', ASSETS_PATH.'js/');
define('CSS_PATH', ASSETS_PATH.'css/');

// Images
define('IMAGE_PATH',ASSETS_PATH.'images/');
define('PAGE_IMAGE_PATH',IMAGE_PATH.'pageImages/');
define('PICTURE_RASTER_PATH',IMAGE_PATH.'pictureRaster/');
define('ERROR_GIF_PATH',IMAGE_PATH.'errorGif/');
define('USER_PICTURE_PATH', IMAGE_PATH.'upload/users/');
define('EVENT_PICTURE_PATH', IMAGE_PATH.'upload/events/');

// Password Hash
define('PEPPER', '.m9h-RL=^M/72;tdU\Bz');
define('HASHOPTIONS', $options = ['cost' => 13]);