<?php
// Version
define('VERSION', '3.0.4.0');

define('ROOT_RATH', str_replace("/admin", "", __DIR__).'/'); //echo ROOT_RATH;
if (is_file(ROOT_RATH.'admin/config.php')) {
	require_once(ROOT_RATH.'admin/config.php');
}

// Startup
require_once(DIR_SYSTEM . 'startup.php');

start('admin');
