<?php

// Version
define('VERSION', '3.0.4.0');

// Configuration
define('ROOT_RATH',  __DIR__.'/'); //echo ROOT_RATH;
if (is_file(ROOT_RATH.'config.php')) {
	require_once(ROOT_RATH.'config.php');
}


// Startup
require_once(DIR_SYSTEM . 'startup.php');

start('catalog');
