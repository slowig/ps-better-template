<?php
$mainDir = dirname(__DIR__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;
require_once $mainDir.'config/defines.inc.php';
require_once _PS_CONFIG_DIR_.'autoload.php';
require_once _PS_CONFIG_DIR_.'bootstrap.php';
require __DIR__.'/../vendor/autoload.php';
define('_TEST_DIRECTORY_', __DIR__);
