<?php
// core
require_once 'core/controller.php';

// include all models
foreach(glob('models/*.php') as $modelclass)
{
    require_once $modelclass;
}

require_once 'config/config.php';
require_once 'core/functions.php';